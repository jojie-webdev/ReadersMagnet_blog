@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2>Hi, {{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}}!</h2>
    </div>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                {{ $post->post_title }} <span class="pull-right" style="color: #e02b20;"><em>Category: {{ $category }}</em></span>
            </div>
            <div class="panel-body">
                 <div class="form-group">
                    <div class="col-lg-12">
                        <small><em>Posted on: {{ $post->created_at }}</em></small>
                    </div>
                </div>
                &nbsp;
                <div class="form-group">
                    <div class="col-lg-12">
                    <!-- php artisan storage:link   for linking image asset-->
                    <img src="{{ asset('public/uploads/'.$post->image) }}" alt="Post Image">
                    </div>
                </div>
                &nbsp;
                <div class="form-group">
                    <div class="col-lg-12">
                        <p>{{ strip_tags($post->post_content) }} </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection