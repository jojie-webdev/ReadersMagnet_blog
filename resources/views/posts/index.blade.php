@extends('layouts.admin')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

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
                <h3><a href="#">Show Posts <span class="badge">{{$posts->count()}}</span></a></h3>
                <table id="users-table" class="table table-striped" data-form="deleteForm">
                    <thead>
                        <tr>
                            <th>NAME</th>
                            <th>TITLE</th>
                            <th>EXCERPT</th>
                            <th>DATE</th>
                            <th>SHOW</th>
                            <!-- show action if user is admin -->
                            @if (Auth::user()->isAdmin() || Auth::user()->isSuperAdmin())
                                <th>ACTION</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            use \App\User;
                        ?>
                        @foreach($posts as $post)
                            <tr>
                                <td>
                                    <?php 
                                        $users = User::all();

                                        foreach($users as $user) {
                                            $user_id = $user->id;
                                            $username = $user->username;
                                            if( $post->user_id === $user_id) {
                                                echo $username;
                                            }
                                        }
                                    ?>
                                </td>
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
                                @if (Auth::user()->isAdmin() || Auth::user()->isSuperAdmin())
                                    <td>
                                        <form action="{{url('post', [$post->id])}}" method="POST" class="form-delete">
                                            <input type="hidden" name="_method" value="PUT">
                                            {{ csrf_field() }}
                                            @if(Auth::check())
                                                @if (Auth::user()->isSuperAdmin())
                                                    <input type="submit" class="btn btn-danger" value="DELETE">
                                                @else
                                                    <input type="submit" class="btn btn-danger" value="DELETE" disabled="">
                                                @endif
                                            @endif
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
<!-- Confirmation Modal -->
<div class="modal" id="confirm">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirmation</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <p>Are you sure you?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-primary" id="delete-btn">Submit</button>
                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
