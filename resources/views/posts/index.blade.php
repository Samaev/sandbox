@extends('layouts.layout')
@section('content')
    @if(isset($_GET['search']))
        @if(count($posts)>0)
            <h2 class="text-center m-5"><?=count($posts) ?> results for <i class="text-primary"><?=$_GET['search'] ?> has been found</i>.</h2>
        @else
            <div class="text-center">
                <h2 class="lead title">Your request found nothing with <i><?=$_GET['search'] ?></i>. Try again</h2>
                <a class="btn btn-outline-primary m-5" href="{{ route('post.index') }}">Show all posts</a>
            </div>
        @endif
    @endif
    <div class="row">
        @foreach($posts as $post)
        <div class="col-6">
            <div class="card mb-2">
                <div class="card-header"><h2><strong>{{ $post->short_title  }}</strong></h2></div>
                <div class="card-body">
                    <div class="card-img mb-2" style="background-image: url({{ $post->img ?? asset('img/1.jpg') }})"></div>
                    </div>
                <div class="card-author text-center lead mb-2">
                    <h3>Author: {{ $post->name }}</h3>
                </div>
                <div class="card-footer">
                    <a href="#" class="btn btn-outline-dark">Open the post</a>
                </div>
            </div>
        </div>
        @endforeach

    </div>
    @if(!isset($_GET['search']))
    <div class="row">
        <div class="col-md-12">
{{--            links have been added automatically with tailwind classes--}}
            {{ $posts->links() }}
        </div>
    </div>
    @endif
@endsection




