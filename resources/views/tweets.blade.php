@extends('layout.main')

@section('main-content')
    <div class="container">
        <div class="row">
            <a href="/trends/index" class="btn btn-primary">
                Go to Trends
            </a>
            <div class="list-group">
                @foreach($searchData['statuses'] as $item)
                <div class="list-group-item">
                    <p>
                        {{$item['text']}}
                    </p>
                </div>
                @endforeach
            </div>

        </div>
    </div>



@endsection