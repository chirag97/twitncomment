                @foreach($comments as $comment)                
                {{-- <div class="list-group-item">
                    <p>
                        {{$comment->comment_text}}
                    </p>
                </div> --}}

{{-- @include('comments.child-comment',['comment' => $comment->children]) --}}



                @if(count($comment->children) >= 1)
                @include('comments.child-comment',['comment' => $comment , 'child' => 0])
                @include('comments.child-comment',['comment' => $comment->children , 'child' => 1])
                @else
                @if(is_null($comment->is_relative_comment))
                @include('comments.child-comment',['comment' => $comment , 'child' => 0])
                @endif
                @endif


                @endforeach



                {{-- {{!is_null($comment->is_relative_comment) ? 'bg-primary' : ''}} --}}
                