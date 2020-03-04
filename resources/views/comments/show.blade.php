@foreach ($comments as $comment)     
    <li class="{{ ($comment->parent_id != null) 
        ? 'reply ml-3' : 'comment'}} mt-3">
        <!-- Comment -->
        <p class="mb-0">{{ $comment->comment }}</p>
        <a href="/users/{{ $comment->user_id }}">
            {{ $comment->user->name }}
        </a>
        <br>
        <!-- Like comment -->
        <form action="/comments/like" method="POST" name="like">
            @csrf
            <input type="text" name="comment_id" 
                value="{{ $comment->id }}" hidden>
            <input type="text" name="blog_id" 
                value="{{ $blog->id }}" hidden>
            @if ($comment->likes->contains('user_id', auth()->user()->id))
                <button type="submit" class="btn btn-warning">
                    Dislike
            @else
                <button type="submit" class="btn btn-primary">
                    Like
            @endif
                </button>

            <span> {{ count($comment->likes) }}</span>
        </form>

        <!-- Delete comment  -->
        @if(auth()->user()->id == $comment->user->id)
            <a href="/comments/delete/{{ $comment->id }}" class="btn btn-danger">Delete</a>
        @endif

        <!-- Edit form  -->
        @if(auth()->user()->id == $comment->user->id)
            <button class="renderEditForm btn btn-secondary"
                data-comment_id="{{ $comment->id }}">
                Edit
            </button>
        @endif

        <br>

        <!-- Reply Form -->
        <button class="renderReplyForm btn btn-secondary" 
            data-blog_id="{{ $blog->id }}"
            data-parent_id="{{ $comment->id }}">
            Reply
        </button>

        <!-- Replies -->
        @if(isset($comment->replies[0]))
        <ul class="replies">
            @include('comments.show', 
                [
                    'comments' => $comment->replies
                ])
        </ul>
        @endif
    </li>
@endforeach