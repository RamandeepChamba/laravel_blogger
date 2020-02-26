@foreach ($comments as $comment)     
    <li class="{{ ($comment->parent_id != null) 
        ? 'reply ml-5' : 'comment'}} mt-3">
        <!-- Comment -->
        <p class="mb-0">{{ $comment->comment }}</p>
        <a href="/users/{{ $comment->user_id }}">
            {{ $comment->user->name }}
        </a>
        <br>
        <button>Like</button>

        <!-- Reply Form -->
        @include('comments.form', 
            [
                'blog_id' => $blog_id, 
                'parent_id' => $comment->id
            ])

        <!-- Replies -->
        @if(isset($comment->replies[0]))
        <ul class="replies">
            @include('comments.show', 
                [
                    'comments' => $comment->replies,
                    'parent_id' => $comment->id
                ])
        </ul>
        @endif
    </li>
@endforeach