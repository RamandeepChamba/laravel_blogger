document.getElementById('app').addEventListener('click', function (e) {
    let clist = e.target.classList;
    if(clist.contains('renderReplyForm') || clist.contains('renderEditForm')) {
        $editing = clist.contains('renderEditForm');
        // Prevent double click
        e.target.innerHTML = 'Wait...';
        e.target.disabled = true;

        // Render Form
        function renderForm(form, formToggleButton) {
            formToggleButton.insertAdjacentHTML('beforebegin', form);
            formToggleButton.disabled = false;
            // Toggle button
            formToggleButton.classList.remove($editing ? 'renderEditForm' : 'renderReplyForm');
            formToggleButton.classList.add($editing ? 'cancelEditForm' : 'cancelReplyForm');
            formToggleButton.innerHTML = 'Cancel';
        }
        
        // - Make Ajax call and get form
        function makeRequest(url, data, formToggleButton) {
          axios.post(url, data)
            .then(function (response) {
              renderForm(response.data, formToggleButton);
            })
            .catch(function (error) {
              console.log(error);
            });
        }
        
        // -- Send blog and parent id
        const url = '/comments/getForm';
		const comment = {};
		if ($editing) {
			comment['comment_id'] = e.target.dataset.comment_id;
		}
		else {
			comment['parent_id'] = e.target.dataset.parent_id;
			comment['blog_id'] = e.target.dataset.blog_id;
		}
        // -- Get response
        // - Display the form
        let form;
        makeRequest(url, comment, e.target);
    }

    else if(clist.contains('cancelReplyForm') || clist.contains('cancelEditForm')) {
        $editing = clist.contains('cancelEditForm');
        e.target.disabled = true;
        // Remove Form
        e.target.parentNode.removeChild(e.target.previousElementSibling);        
        // Toggle button
        e.target.classList.remove($editing ? 'cancelEditForm' : 'cancelReplyForm');
        e.target.classList.add($editing ? 'renderEditForm' : 'renderReplyForm');
        e.target.innerHTML = $editing ? 'Edit' : 'Reply';

        e.target.disabled = false;
    }
});