
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
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{{ URL::to('users') }}"><i class="fa fa-circle-o"></i> Show Users!</a>
            </div>
            <div class="panel-body">
                <h3><strong><a href="#">Show Posts <span class="badge">{{$posts->count()}}</span></a></strong></h3>
                <hr />
                <div class="pull-left" style="margin-bottom: 5px;">
                    <a href="{{ url('postExcel/xls') }}"><button class="btn btn-success">Download Excel xls</button></a>
                </div>
                <table id="users-table" class="table table-striped" data-form="deleteForm">
                    <thead>
                        <tr>
                            <th>NAME</th>
                            <th>TITLE</th>
                            <th>EXCERPT</th>
                            <th>DATE</th>
                            <th>SHOW</th>
                            <th>POSTED</th>
                            <!-- show action if user is admin -->
                            @if (Auth::user()->isAdmin() || Auth::user()->isSuperAdmin())
                                <th>ACTION</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td class="id" hidden>{{$post->id}}</td>
                                <td class="username">{{$post->user->username}}</td>
                                <td class="email" hidden>{{$post->user->email}}</td>
                                <td class="title">{{$post->post_title}}</td>
                                <td>{{strip_tags($post->excerpt)}}</td>
                                <td>{{$post->created_at}}</td>
                                <td>
                                    <form action="{{url('posts', [$post->id])}}" method="POST" enctype="multipart/form-data" class="profile-form">
                                        <input type="hidden" name="_method" value="GET">
                                        {{ csrf_field() }}
                                            <input type="submit" class="btn btn-default" value="Show more...">
                                    </form><!-- Form END -->
                                </td>
                                <td style="width: 11%;">
                                    <form action="{{url('posts/posted', [$post->id])}}" method="POST" enctype="multipart/form-data" class="approve-form"  id="myForm">
                                        <input type="hidden" name="_method" value="POST">
                                        {{ csrf_field() }}
                                            @if ($post->posted == 0  )
                                                <button type="submit" name="approved" class="btn btn-success" value="1">
                                                    <i class="fas fa-thumbs-up"></i>
                                                </button> | 
                                                <button type="button" name="approved" id="disapproved" class="btn btn-danger disapp" value="2" data-toggle="modal" data-target="#myModal">
                                                    <i class="fas fa-thumbs-down"></i>
                                                </button>
                                            @else
                                                @if ($post->posted == 1 )
                                                    <h4 style="background: green; color: #fff; padding: 2px; text-align: center;">POSTED</h4>
                                                @else
                                                    <h4 style="background: red; color: #fff; padding: 2px;">DISAPPROVED</h4>
                                                @endif
                                            @endif
                                    </form><!-- Form END -->
                                </td>
                                <!-- show action if user is admin -->
                                @if (Auth::user()->isAdmin() || Auth::user()->isSuperAdmin())
                                    <td>
                                        <form action="{{url('posts', [$post->id])}}" method="POST" class="form-delete">
                                            <input type="hidden" name="_method" value="DELETE">
                                            {{ csrf_field() }}
                                            @if(Auth::check())
                                                @if (Auth::user()->isSuperAdmin())
                                                    <input type="submit" class="btn btn-danger" value="DELETE"><i class="far fa-delete"></i>
                                                @else
                                                    <button type="submit" name="approved" class="btn btn-danger" value="1" disabled="">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                @endif
                                            @endif
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        
                            <div class="modal" id="myModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">DISAPPROVED!</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{url('posts/posted', [$post->id])}}" method="POST" id="my_form">
                                            <input type="hidden" name="_method" value="POST">
                                            {{ csrf_field() }}
                                                <div class="form-group">
                                                    <label for="inputMessage">REASON</label>
                                                    <input type="hidden" name="name" class="hidden-name"/>
                                                    <input type="hidden" name="email" class="hidden-email"/>
                                                    <input type="hidden" name="id" class="hidden-id"/>
                                                    <input type="hidden" name="approved" value="2"/>
                                                    <textarea class="form-control" name="reason" id="inputMessage" placeholder="Enter your message"></textarea>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                                <button type="submit" class="btn btn-sm btn-primary btn-submit">Submit</button>
                                                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>

    $(".disapp").click(function(){
        var id = $(this).closest('tr').find('td.id').html();
        var name = $(this).closest('tr').find('td.username').html();
        var email = $(this).closest('tr').find('td.email').html();
        $('.hidden-id').val(id);
        $('.hidden-name').val(name);
        $('.hidden-email').val(email);
        // alert(name);
    });
</script>
@endsection