

@extends('auth.app')

@section('content')

<div class="col-md-6 offset-md-3 col-10 offset-1 mb-3">
	@if($errors->any())
		<div class="alert alert-danger" role="alert">
			{{$errors->first()}}
		</div>
	@else
		<div class="alert alert-danger invisible" role="alert">
			Hidden. Just to block
		</div>
	@endif
</div>

<form class="form-signin" role="form" method="POST" action="{{ url('/auth/register') }}">

	<input type="hidden" name="_token" value="{{ csrf_token() }}">

	<img class="mb-4" src="/img/sis-logo.png" alt="Logo sis binus" width="100">
	<h3 class="h4 mb-4 font-weight-normal ">Registration Form</h3>

	<input type="hidden" name="name" value="user" >

	<input type="email" placeholder="Email Address" class="form-control" name="email" value="{{ old('email') }}">
	<input type="password" placeholder="Password" class="form-control" name="password_confirmation">
	<input type="password" placeholder="Confirm Password" class="form-control" name="password">


	<button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>

	<p class="mt-2 mb-2 text-muted">Already Have Account? <a href="/auth/login">Login Here</a></p>
	<a href="#">Forget Password</a>
	

	<p class="mt-5 mb-3 text-muted">&copy; 2017-2021</p>
</form>
@endsection
