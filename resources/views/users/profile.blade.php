@extends('layouts.admin')

@section('content')
<div class="row">
    &nbsp;
    <div class="col-md-12 personal-info">
        <div class="panel panel-default">
            <div class="panel-heading">Edit Profile</div>
            <div class="panel-body">
                <!-- Update Form Request -->
                <form action="{{url('users', [$user->id])}}" method="POST" enctype="multipart/form-data" class="profile-form">
                <input type="hidden" name="_method" value="PUT">
                {{ csrf_field() }}
                    <div class="row">
                        <!-- left column -->
                        <div class="col-md-3">
                            <div class="text-center">
                            <img src="{{ asset('public/uploads/'.Auth::user()->filename)  }}" class="img-circle master" width="150" height="150" alt="User Image">
                                <h6>Upload a different photo...</h6>
                                <input class="form-control file" type="file" name="filename">
                            </div>
                        </div><!-- Col 3 END -->

                        <!-- right column -->
                        <div class="col-md-9">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">NAME:</label>
                                        <div class="col-lg-12">
                                            <input class="form-control file" name="username" type="text" value="{{$user->username}}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-lg-3 control-label">Email:</label>
                                        <div class="col-lg-12">
                                            <input class="form-control" name="email" type="text" value="{{$user->email}}" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-8" style="margin-top: 20px;">
                                            <input type="submit" class="btn btn-success" value="Update">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-lg-12 control-label">Mobile Number</label>
                                        <div class="col-lg-12">
                                        <input class="form-control" name="mobile" type="number" id="txtPhone" value="{{$user->mobile}}" >
                                        </div>
                                    </div>
                                    @if (Auth::user()->isAdmin() || Auth::user()->isSuperAdmin())
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Password:</label>
                                            <div class="col-md-12">
                                                <input class="form-control" type="password" name="password" disabled>
                                            </div>
                                        </div>
                                    @else
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Password:</label>
                                        <div class="col-md-12">
                                            <input class="form-control" type="password" name="password">
                                        </div>
                                    </div>
                                    @endif
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Confirm Password:</label>
                                        <div class="col-md-12">
                                            <input class="form-control" type="password" name="confirm-password">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- Col 9 END -->
                    </div><!-- Row END -->
                </form><!-- Form END -->
            </div>
        </div>
    </div>
</div>
@endsection
