@extends('layout.main') @section('main-content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">

            <h1 class="text-center">
                Commenting Home

            </h1>
            <div class="text-center">
                <a href="/" class="btn btn-primary">Go To Home</a>
            </div>
            <hr>
            <form action="/commenting/store" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <textarea name="comment_text" id="comment" cols="30" rows="4" placeholder="Type your comment" class="form-control"></textarea>
                </div>
                <div class="form-group text-center">
                    <button class="btn btn-success" type="submit">Post Comment</button>
                </div>
            </form>
        </div>
        <hr>
        <div class="col-lg-10">
            <div class="list-group">
                @include('comments.comment',['comments'=>$comments])
            </div>

        </div>
    </div>
</div>



@endsection