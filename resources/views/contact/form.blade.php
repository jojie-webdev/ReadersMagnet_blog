@extends('layouts.admin')

@section('content')
<div class="row">
		<div class="col-sm-6 offset-sm-3">
			<h1>Send Email</h1>
			<hr>

			<form action="{{ route('contact.send')}}" method="POST">
				@csrf
				<label for="name">Name</label>
				<input type="text" name="username" class="form-control"  value="{{$username}}" >

				<label for="email" class="mt-3">eMail</label>
				<input type="email" name="email" class="form-control"  value="{{$email}}"> 

				<label for="url" class="mt-3">Post URL</label>
				<input name="url" cols="30" rows="10" class="form-control">
                &nbsp;
				<button type="submit" class="btn btn-success btn-block my-3">Send Email</button>
			</form>
		</div>
</div>
@endsection
