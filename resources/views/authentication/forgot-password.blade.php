@extends('layouts.master')

@section('content')

<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Forgot Password</h3>
			</div>

			<div class="panel-body">
				<form action="/forgot-password" method="post">
					@csrf
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
						<input type="submit" value="Send Code" class="bnt btn-success pull-right">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection

