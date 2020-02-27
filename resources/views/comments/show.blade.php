@foreach ($comments as $comment)     
    <li class="{{ ($comment->parent_id != null) 
        ? 'reply ml-3' : 'comment'}} mt-3">
        <!-- Comment -->
        <p class="mb-0">{{ $comment->comment }}</p>
        <a href="/users/{{ $comment->user_id }}">
            {{ $comment->user->name }}
        </a>
        <br>
        <button>Like</button>

        <!-- Reply Form -->
        <button class="renderForm" data-blog_id="{{ $blog_id }}"
            data-parent_id="{{ $comment->id }}">
            Reply
        </button>

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