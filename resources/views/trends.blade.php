@extends('layout.main')

@section('main-content')
    <div class="container">
        <div class="content">
            <div class="title text-center">
                <h1>
                    Twitter Task
                </h1>
                <a href="/" class="btn btn-primary">Go To Home</a>
            </div>
            <hr>
            <div class="row">

                <div class="col-6">
                    <h3 class="text-center"> Click and Get Tweets of top 5 trending hashtags</h3>
                    <div class="list-group">
                        @foreach($tweetData as $hashtag)
                        <a href="/trends/tweets?hashtag={{str_replace('#','',$hashtag->name)}}" class="btn btn-primary list-group-item-danger">Fetch tweets of {{$hashtag->name}}</a>
                        @endforeach
                    </div>
                </div>

                <div class="col-6">
                    <h3 class="text-center"> Post a tweet now</h3>
                    @if(session()->has('access_token'))
                    <div>
                        <form action="/twitter/profile/postTweet" method="post">
                            {{csrf_field()}}
                            <div class="form-group">
                                <textarea name="status" id="status" cols="30" rows="4" class="form-control"></textarea>
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-success" type="submit">Post Tweet</button>
                            </div>
                        </form>
                    </div>
                    @else
                    <a href="/twitter/login" class="btn btn-danger">Login To Tweet</a>
                    @endif
                </div>
            </div>
        </div>
    </div>



@endsection