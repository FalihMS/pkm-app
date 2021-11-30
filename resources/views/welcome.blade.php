
	<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laravel</title>

	<link href="{{ asset('/dist/css/bootstrap.min.css') }}" rel="stylesheet">
	<style>
		html,
body {
  height: 100%;
}

body {

  -ms-flex-align: center;
  align-items: center;
  padding-top: 20px;
  padding-bottom: 40px;
  background-color: #f5f5f5;

}

.form-signin {
  width: 100%;
  max-width: 500px;
  padding: 15px;
  margin: auto;
}
.form-signin .checkbox {
  font-weight: 400;
}
.form-signin .form-control {
  position: relative;
  box-sizing: border-box;
  height: auto;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}

	</style>
	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body class="text-center">

	

	<form class="form-signin">
		<img class="mb-4" src="/img/sis-logo.png" alt="Logo sis binus" width="175">

		<h3 class="h4 mb-4 font-weight-normal ">PKM Collection System</h3>
		<div class="alert alert-info mt-3" role="alert">
			<p class="mb-0 font-italic">Deadline Notification This Month</p>
			<hr>
			<p>Pengumpulan PKM-GT MIS - <span class="font-weight-bold">23/08/2021</span></p>
			<p>Pengumpulan PKM-KC Labsisfo - <span class="font-weight-bold">23/08/2021</span></p>
			<p>Pengumpulan PKM-KC AO - <span class="font-weight-bold">23/08/2021</span></p>
			
		</div>


		<a href="auth/register" class="btn btn-lg btn-primary btn-block">Create New Account</a>
		<p class="my-2 text-muted">or</p>
		<a href="auth/login" class="btn btn-lg btn-outline-primary btn-block">Login Now</a>
		<p class="mt-5 mb-3 text-muted">Copyrights &copy; 2021 IS Project Member</p>
	</form>
	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>
