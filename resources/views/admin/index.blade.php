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
            
        <a href="{{ url('downloadExcel/xls') }}"><button class="btn btn-success">Download Excel xls</button></a>
            <div class="panel-heading">Users <span class="badge">{{$users->count()}}</span></div>
            <div class="form-group" style="margin-bottom: 5em!important;">
                <form name="search" id="search" action="{{url('search')}}" method="GET" class="form-delete">
                    <input type="hidden" name="_method" value="SEARCH">
                    {{ csrf_field() }}
                    <div class="col-lg-1" style="width: 2.333333%;">
                        <span class="fa fa-filter" title="Filter By" style="color: #777777; font-size: 18px; padding: 5px"></span>
                    </div>
                    <div class="col-lg-3">
                        <select class="form-control" name="year" id="year" required>
                            <option value=" ">Year</option>
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <select class="form-control" name="month" id="month" required>
                            <option value="all">Show All</option>
                            <option value="1">January</option>
                            <option value="2">February</option>
                            <option value="3">March</option>
                            <option value="4">April</option>
                            <option value="5">May</option>
                            <option value="6">June</option>
                            <option value="7">July</option>
                            <option value="8">August</option>
                            <option value="9">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                    </div>
                    <input type="submit" class="btn btn-primary" value="SEARCH">
                </form>
            </div>
            <table id="users-table" class="table table-striped" data-form="deleteForm" style="margin-top: 50em;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>AVATAR</th>
                        <th>NAME</th>
                        <th>MOBILE</th>
                        <th>EMAIL</th>
                        <th>NO. OF POST</th>
                        <!-- show action if user is admin -->
                        @if (Auth::user()->isAdmin() || Auth::user()->isSuperAdmin())
                            <th>ACTION</th>
                        @endif
                        <th>SEND EMAIL</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>
                                @if ($user->filename === null)
                					<img src="{{ asset('public/uploads/'.'Dummy-image.jpg')  }}" class="img-circle master" width="50" height="50" alt="User Image">
                                @else 
                					<img src="{{ asset('public/uploads/'.$user->filename)}}" class="img-circle master" width="50" height="50">
                				@endif
                            </td>
                            <td>{{$user->username}}</td>
                            <td>{{$user->mobile}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                @if ($user->no_of_post != null)
                					{{ $user->no_of_post }}
                                @else 
                					{{ 0 }}
                				@endif
                                &nbsp;
                                <form action="{{url('users/postcounter', [$user->id])}}" method="POST">
                                    <input type="hidden" name="_method" value="POST">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </form>
                            </td>
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
                            <td>
                                <form action="{{url('contact/form', [$user->id, $user->username, $user->email])}}" method="GET">
                                    <input type="hidden" name="_method" value="GET">
                                    {{ csrf_field() }}
                                    @if(Auth::check())
                                        @if (Auth::user()->isAdmin())
                                            <input type="submit" class="btn btn-success" value="SEND">
                                        @endif               
                                    @endif
                                </form>
                            </td>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
$(document).ready(function(){
    if ($('#year option').html() !== '') {
    //   $('#search').submit();
   }
});
</script>
@endsection
