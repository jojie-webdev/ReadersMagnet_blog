@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2>Hi, {{{ isset(Auth::user()->username) ? Auth::user()->username : Auth::user()->email }}}!</h2>
    </div>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <a href="{{ URL::to('users') }}"><i class="fa fa-circle-o"></i>Show all Authors</a>
            </div>
            <div class="panel-body">
                <h4>ACTIVITIES</h4>
            </div>
        </div>
    </div>
</div>
@endsection
