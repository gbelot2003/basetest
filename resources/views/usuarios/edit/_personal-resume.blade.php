<div class="row cyan lighten-5">
	<p>Etiqueta y resumen personal</p>
	<div class="col-sm-12 form-group-label">
		<label class="floating-label" for="label">Etiqueta de perfil</label>
		<input class="form-control" id="label" name="label" value="{{ $usuario->profile->label }}" type="text">
	</div>
	<br/>
	<div class="col-sm-12">
		<textarea class="" id="resume" name="resume">
			{{ $usuario->profile->resume }}
		</textarea>
		<br/>
	</div>
</div>