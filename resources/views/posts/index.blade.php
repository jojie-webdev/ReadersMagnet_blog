@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2>Hi, {{{ isset(Auth::user()->username) ? Auth::user()->username : Auth::user()->email }}}!</h2>
    </div>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{{ URL::to('users') }}"><i class="fa fa-circle-o"></i> Show Users!</a>
            </div>
            <div class="panel-body">
                <h3>Show all user post</h3>
                <table id="users-table" class="table table-striped" data-form="deleteForm">
                    <thead>
                        <tr>
                            <th>NAME</th>
                            <th>TITLE</th>
                            <th>EXCERPT</th>
                            <th>DATE</th>
                            <th>SHOW</th>
                            <!-- show action if user is admin -->
                            @if (Auth::user()->isAdmin())
                                <th>ACTION</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>{!! \App\User::findOrFail($post->user_id)->username; !!}</td>
                                <td>{{$post->post_title}}</td>
                                <td>{{strip_tags($post->excerpt)}}</td>
                                <td>{{$post->created_at}}</td>
                                <td>
                                <form action="{{url('posts', [$post->id])}}" method="POST" enctype="multipart/form-data" class="profile-form">
                                    <input type="hidden" name="_method" value="GET">
                                    {{ csrf_field() }}
                                        <input type="submit" class="btn btn-default" value="Show more...">
                                </form><!-- Form END -->
                                </td>
                                <!-- show action if user is admin -->
                                @if (Auth::user()->isAdmin())
                                    <td>
                                        <form action="{{url('post', [$post->id])}}" method="POST" class="form-delete">
                                            <input type="hidden" name="_method" value="PUT">
                                            {{ csrf_field() }}
                                            <input type="submit" class="btn btn-danger" value="DELETE">
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
