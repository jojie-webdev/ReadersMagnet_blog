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
        <div style="padding: 20px 5px; text-decoration: underline!important;"><a href="{{ URL::previous() }}">Go Back</a></div>
    </div>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Users</div>
            <table id="users-table" class="table table-striped" data-form="deleteForm">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>MOBILE</th>
                        <th>EMAIL</th>
                        <th>NO. OF POST</th>
                        <!-- show action if user is admin -->
                        @if (Auth::user()->isAdmin() || Auth::user()->isSuperAdmin())
                            <th>ACTION</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->username}}</td>
                            <td>{{$user->mobile}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{ App\Post::where('user_id', $user->id)->count() }}</td>
                            <!-- show action if user is admin -->
                            @if (Auth::user()->isAdmin() || Auth::user()->isSuperAdmin())
                                <td>
                                    <form action="{{url('users', [$user->id])}}" method="POST" class="form-delete">
                                        <input type="hidden" name="_method" value="DELETE">
                                        {{ csrf_field() }}
                                        @if(Auth::check())
                                            @if (Auth::user()->isSuperAdmin())
                                                <!-- disable delete button in superadmin -->
                                                @if (Auth::id() === $user->id)
                                                    <input type="submit" class="btn btn-danger" value="DELETE" disabled="">
                                                @else
                                                    <input type="submit" class="btn btn-danger" value="DELETE">
                                                @endif
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
