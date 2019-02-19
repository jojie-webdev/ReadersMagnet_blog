@extends('layouts.admin')

@section('content')
<div class="row">
    &nbsp;
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{{ URL::to('posts/create') }}"><i class="fa fa-circle-o"></i> Create blog here!</a>
            </div>
            <div class="panel-body">
                <h3><strong>Your Article(s)</strong></h3>
                <hr />
                @foreach($posts as $post)
                    <h4 class="p-name text">{{ $post->post_title }} </h4>
                    <div class="description"><small>{{  strip_tags($post->excerpt) }}</small></div>
                    &nbsp;
                    <form action="{{url('posts', [$post->id])}}" method="POST" enctype="multipart/form-data" class="profile-form">
                        <input type="hidden" name="_method" value="GET">
                        {{ csrf_field() }}
                            <input type="submit" class="btn btn-default" value="Show more...">
                    </form><!-- Form END -->
                    <hr />
                    
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
