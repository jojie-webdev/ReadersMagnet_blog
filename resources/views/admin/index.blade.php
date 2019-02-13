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
        <h2>Admin Panels</h2>
    </div>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Show All Users</div>
            <table id="users-table" class="table table-striped" data-form="deleteForm">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>MOBILE</th>
                        <th>EMAIL</th>
                        <!-- show action if user is admin -->
                        @if (Auth::user()->isAdmin())
                            <th>ACTION</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->mobile_no}}</td>
                            <td>{{$user->email}}</td>
                            <!-- show action if user is admin -->
                            @if (Auth::user()->isAdmin())
                                <td>
                                    <!-- <button class="btn btn-danger" data-catid={{$user->id}} data-toggle="modal" data-target="#delete">Deactivate</button> -->
                                    <form action="{{url('admin', [$user->id])}}" method="POST" class="form-delete">
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
@endsection
