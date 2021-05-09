@extends('layouts.master')

@section('content')

<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Login</h3>
			</div>

			<div class="panel-body">
				<form action="/login" method="post">
					@csrf
					@if(session('error'))
					<div class="alert alert-danger">
						{{ session('error') }}
					</div>
					@endif

					@if(session('success'))
					<div class="alert alert-success">
						{{ session('success') }}
					</div>
					@endif
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
							<input type="email" name="email" class="form-control" placeholder="Eneter e-mail" required>
						</div>
					</div>
					
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-addon"><i class="fa fa-lock"></i></span>
							<input type="password" name="password" class="form-control" placeholder="Enetr password" required>
						</div>
					</div>

					<a href="/forgot-password">Forgot your Password ?</a>
		
					<div class="form-group">
						<input type="submit" value="Login" class="bnt btn-success pull-right">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection

