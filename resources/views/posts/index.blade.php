@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2>Hi, {{{ isset(Auth::user()->username) ? Auth::user()->username : Auth::user()->email }}}!</h2>
    </div>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{{ URL::to('posts/create') }}"><i class="fa fa-circle-o"></i> Create blog here!</a>
            </div>
            <div class="panel-body">
                <h4>Show all your post</h4>
                @foreach($posts as $post)
                    <h3 class="p-name text">{{ $post->post_title }} </h3>
                    <div class="description"><small>{{  strip_tags($post->excerpt) }}</small></div>
                    &nbsp;
                    <form action="{{url('posts', [$post->id])}}" method="POST" enctype="multipart/form-data" class="profile-form">
                        <input type="hidden" name="_method" value="GET">
                        {{ csrf_field() }}
                            <input type="submit" class="btn btn-default" value="Show more...">
                    </form><!-- Form END -->
                    
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
