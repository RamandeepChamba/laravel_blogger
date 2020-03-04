<form action="{{ route('comments.store') }}" method="POST" 
    name="{{ isset($comment->parent_id) ? 'reply' : (isset($comment->id) ? 'edit' : 'comment') }}">
    @csrf
    @if (isset($comment->id))
        @method('PATCH')
        <input type="text" name="comment_id" 
            value="{{ $comment->id }}" hidden>
    @endif
    <input type="text" name="comment[blog_id]" 
        value="{{ $comment->blog_id }}" hidden>
    @if (isset($comment->parent_id))
        <input type="text" name="comment[parent_id]"
        value="{{ $comment->parent_id }}" hidden>
    @endif
    <textarea name="comment[comment]" cols="30" rows="10"
        placeholder="Add your comment here" 
        maxlength="250" required>{{ $comment->comment ?? '' }}</textarea>
    <button type="submit" class="btn btn-secondary">
        @if(isset($comment->id))
            Edit
        @else
            {{ isset($comment->parent_id) ? 'Reply' : 'Comment' }}
        @endif
    </button>
</form>