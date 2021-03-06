@extends('layout.app')

@section('page-title', $usuario->name)
@section('breadcrumb')
	<li><a href="/">Dashboard</a></li>
	<li><a href="/usuarios">usuarios</a></li>
	<li><a href="/usuarios/{{ $usuario->slug }}">{{ $usuario->name }}</a></li>
	<li><a class="active" href="#!">edit</a></li>
@stop

@section('content')
	<fildset>
		<form method="post"  action="{{ action('UserController@update', $usuario->id)}}" enctype="multipart/form-data">
			{!! csrf_field() !!}
			<input name="_method" type="hidden" value="PUT">
			<div class="form-group">

				<div class="row">

					<div class="col-md-3 col-sm-12">
						@include('usuarios.edit._contact-info')
					</div>

					<div class="col-md-9 col-sm-12">
						<fieldset>
							@include('usuarios.edit._gereral-info-and-pass')
							<br/>
							@include('usuarios.edit._personal-resume')
						</fieldset>
					</div>

				</div>

			</div>
			<div class="row">
				<hr />
				<div class="row">
					<p class="text-left">
						<button type="submit"  class="btn btn-blue">Guardar Cambios</button>
						<a class="btn btn-flat btn-alt" href="/roles">Cancelar</a>
					</p>
				</div>
			</div>
		</form>
	</fildset>
@stop
@section('post-script')
	<script src="/js/user-edit.js"></script>
@stop