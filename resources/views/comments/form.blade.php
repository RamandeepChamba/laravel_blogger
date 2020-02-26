<form action="{{ route('comments.store') }}" method="POST" name="comment">
    @csrf
    <input type="text" name="blog_id" 
        value="{{ $blog_id }}" hidden>
    @if (isset($parent_id))
        <input type="text" name="parent_id"
        value="{{ $parent_id }}" hidden>
    @endif
    <textarea name="comment" cols="30" rows="10"
        placeholder="Add your comment here" 
        maxlength="250" required></textarea>
    <button type="submit">{{ isset($parent_id) ? 'Reply' : 'Comment' }}</button>
</form>