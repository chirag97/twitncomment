                @if($child == 0)
                <div class="list-group-item" style="background-color : greenyellow">
                
                    <p>
                        {{$comment->comment_text}}
                    </p>

                    <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#formModal">Open Modal</button> -->

                                <form action="/commenting/child_comment" method="post">
                                    {{csrf_field()}}
                                    <input type="hidden" name="is_relative_comment" value="1">
                                    <input type="hidden" name="related_comment_id" value="{{$comment->id}}">
                                    <div class="form-group">
                                        <textarea name="comment_text" id="comment" cols="30" rows="4" placeholder="Type your comment" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group text-center">
                                        <button class="btn btn-success" type="submit">Post Comment</button>
                                    </div>
                                </form>
                </div>
                @else
                    @foreach($comment as $item)
                <div class="list-group-item" style="padding-left: 100px">
                    <p>
                        {{$item->comment_text}}
                    </p>

                                                    <form action="/commenting/child_comment" method="post">
                                                        {{csrf_field()}}
                                                        <input type="hidden" name="is_relative_comment" value="1">
                                                        <input type="hidden" name="related_comment_id" value="{{$item->id}}">
                                                        <div class="form-group">
                                                            <textarea name="comment_text" id="comment" cols="30" rows="4" placeholder="Type your comment" class="form-control"></textarea>
                                                        </div>
                                                        <div class="form-group text-center">
                                                            <button class="btn btn-success" type="submit">Post Comment</button>
                                                        </div>
                                                    </form>
                </div>
                    @endforeach

                @endif
