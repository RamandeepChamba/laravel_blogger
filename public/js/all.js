document.getElementById('app').addEventListener('click', function (e) {

    if(e.target.classList.contains('renderForm')) {
        // Prevent double click
        e.target.innerHTML = 'Wait...';
        e.target.disabled = true;
        // Render Form
        function renderForm(form, formToggleButton) {
            formToggleButton.insertAdjacentHTML('beforebegin', form);
            e.target.disabled = false;
            // Toggle button
            e.target.classList.remove('renderForm');
            e.target.classList.add('cancelForm');
            e.target.innerHTML = 'Cancel';
        }
        
        // - Make Ajax call and get form
        // -- Send blog and parent id
        const url = '/comments/getReplyForm';
        const reply = {};
        reply['parent_id'] = e.target.dataset.parent_id;
        reply['blog_id'] = e.target.dataset.blog_id;
        // -- Get response
        // - Display the form
        let form;
        makeRequest(url, reply, e.target);
    }

    else if(e.target.classList.contains("cancelForm")) {
        e.target.disabled = true;
        // Remove Form
        e.target.parentNode.removeChild(e.target.previousElementSibling);        
        // Toggle button
        e.target.classList.remove('cancelForm');
        e.target.classList.add('renderForm');
        e.target.innerHTML = 'Reply';

        e.target.disabled = false;
    }

    function makeRequest(url, data, formToggleButton) {
        axios.post(url, data)
          .then(function (response) {
            console.log(response);
            renderForm(response.data, formToggleButton);
          })
          .catch(function (error) {
            console.log(error);
          });
    }
});