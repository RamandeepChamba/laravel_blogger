@foreach ($comments as $comment)
    <li class="comment mt-3" 
        @if($comment->parent_id != null) 
            style="margin-left:40px;" 
        @endif>
        
        <!-- Comment -->
        <p class="mb-0">{{ $comment->comment }}</p>
        <a href="/users/{{ $comment->user_id }}">
            {{ $comment->user->name }}
        </a>
        <br>
        <button>Like</button>

        <!-- Reply Form -->
        @include('blogs.commentForm', 
            [
                'blog_id' => $blog_id, 
                'parent_id' => $comment->id
            ])

        <!-- Replies -->
        @include('blogs.commentsDisplay', 
            [
                'comments' => $comment->replies,
                'parent_id' => $comment->id
            ])
    </li>
@endforeach