@extends('adminlte.page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Novo Cliente</h1>
<ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i>Iniciar</a></li>
		<li><a href="{{route('cliente.inicial')}}">Clientes</a></li>
        <li class="active"><a href="{{route('cliente.cadastrar')}}">Novo</a></li>
</ol>
@stop
@section('css')
<link rel="stylesheet" href="{{ asset('adminlte/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}"/>
<link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck/square/_all.min.css')}} "/>
<link rel="stylesheet" href="{{ asset('adminlte/plugins/input-mask/css/inputmask.css')}} " /> 
@stop
@section('content')
<div class="container-fluid">
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Cadastrar Cliente</h3>
		</div>
		<form role="form" action="{{route('cliente.salvar')}}" method="post">
		{!! csrf_field() !!}
			<div class="box-body">
				<div class="row">
					<div class="col-lg-4">
						<div class="form-group has-feedback {{$errors->has('name') ? 'has-error': ''}}">
							<label for="name">Nome</label>
							<input type="text" class="form-control" name="name" id="name" placeholder="Nome do Cliente" value="{{old('name')}}">
							@if($errors->has('name'))
								<span class="help-block">
                           			<strong>{{ $errors->first('name') }}</strong>
                        		</span>
							@endif
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-group  has-feedback {{$errors->has('cpfcnpj') ? 'has-error': ''}}">
							<label for="cpfcnpj">CPF</label>
							<input type="text" data-inputmask="'mask': '999.999.999-99'" class="form-control" name="cpfcnpj" id="cpfcnpj" placeholder="CPF do Cliente" value="{{old('cpfcnpj')}}">
							@if($errors->has('cpfcnpj'))
								<span class="help-block">
                           			<strong>{{ $errors->first('cpfcnpj') }}</strong>
                        		</span>
							@endif
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-group  has-feedback {{$errors->has('birth_register') ? 'has-error': ''}}">
							<label for="birth_register">Data de Registro</label>
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" name="birth_register" class="form-control pull-right" id="birth_register" value="{{$date_register}}" readOnly>
							</div>
							@if($errors->has('birth_register'))
								<span class="help-block">
                           			<strong>{{ $errors->first('birth_register') }}</strong>
                        		</span>
							@endif
						</div>
					</div>
				</div>
				<div class="row">

					<div class="col-lg-4">
						<div class="form-group  has-feedback {{$errors->has('birth_date') ? 'has-error': ''}}">
							<label for="birth_date">Data de Aniversário</label>
							<div class="input-group date">
								<div class="input-group-addon">
									<i class="fa fa-calendar"></i>
								</div>
								<input type="text" class="form-control pull-right" name="birth_date" id="datepicker" placeholder="Escolha Data" value="{{old('birth_date')}}" readOnly>
							</div>
							@if($errors->has('birth_date'))
								<span class="help-block">
                           			<strong>{{ $errors->first('birth_date') }}</strong>
                        		</span>
							@endif
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-group has-feedback {{$errors->has('limitmin') ? 'has-error': ''}}">
							<label form="limitmin" id="limitmin">Limite Minímo</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-dollar"></i></span>
								<input type="number" name="limitmin" id="limitmin" class="form-control" min="0.00" step="0.01" value="{{old('limitmin')}}">
							</div>							
							@if($errors->has('limitmin'))
								<span class="help-block">
                           			<strong>{{ $errors->first('limitmin') }}</strong>
                        		</span>
							@endif
						</div>
					</div>
					<div class="col-lg-4">
						<div class="form-group has-feedback {{$errors->has('limitmax') ? 'has-error': ''}}">
							<label form="limitmax">Limite Maxímo</label>
							<div class="input-group">
								<span class="input-group-addon"><i class="fa fa-dollar"></i></span>
								<input type="number" name="limitmax" id="limitmax" class="form-control" min="0.00" step="0.01" value="{{old('limitmax')}}">
							</div>
							@if($errors->has('limitmax'))
								<span class="help-block">
                           			<strong>{{ $errors->first('limitmax') }}</strong>
                        		</span>
							@endif
						</div>
					</div>
				</div>
			<div class="row">
				<div class="col-lg-4">
					<div class="form-group has-feedback {{$errors->has('street') ? 'has-error': ''}}" >
						<label for="street">Logradouro</label>
						<input type="text" class="form-control" name="street" value="{{old('street')}}">
						@if($errors->has('street'))
								<span class="help-block">
                           			<strong>{{ $errors->first('street') }}</strong>
                        		</span>
						@endif
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group has-feedback {{$errors->has('number') ? 'has-error': ''}}">
						<label for="number">Número</label>
						<input type="number" class="form-control" name="number" value="{{old('number')}}">
						@if($errors->has('number'))
								<span class="help-block">
                           			<strong>{{ $errors->first('number') }}</strong>
                        		</span>
						@endif
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group has-feedback {{$errors->has('neighborhood') ? 'has-error': ''}}">
						<label for="neighborhood">Bairro</label>
						<input type="text" class="form-control" name="neighborhood" value="{{old('neighborhood')}}">
						@if($errors->has('neighborhood'))
								<span class="help-block">
                           			<strong>{{ $errors->first('neighborhood') }}</strong>
                        		</span>
						@endif
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4">
					<div class="form-group has-feedback {{$errors->has('complement') ? 'has-error': ''}}">
						<label for="complement">Complemento</label>
						<input type="text" class="form-control" name="complement" value="{{old('complement')}}">
						@if($errors->has('complement'))
								<span class="help-block">
                           			<strong>{{ $errors->first('complement') }}</strong>
                        		</span>
						@endif
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group has-feedback {{$errors->has('city') ? 'has-error': ''}}">
						<label for="city">Cidade</label>
						<input type="text" class="form-control" name="city" value="{{old('city')}}">
						@if($errors->has('city'))
								<span class="help-block">
                           			<strong>{{ $errors->first('city') }}</strong>
                        		</span>
						@endif
					</div>
				</div>
				<div class="col-lg-4">
				<label for="zip_code">CEP</label>
					<div class="form-group has-feedback {{$errors->has('zip_code') ? 'has-error': ''}}">
						<div class="input-group">
							<input type="text" class="form-control" data-inputmask="'mask': '99999-999'"  id="zip_code" name="zip_code" value="{{old('zip_code')}}">
								<span class="input-group-btn">
									<button type="button" class="btn btn-info btn-flat">Buscar</button>
								</span>
						</div>
						@if($errors->has('zip_code'))
								<span class="help-block">
                           			<strong>{{ $errors->first('zip_code') }}</strong>
                        		</span>
							@endif	
					</div>
				</div>
			</div>
				<div class="row">
					<div class="col-lg-4">
						<div class="form-group">
							<label for="active">Ativar</label>
							<div class="">
								<label>
									<input type="radio" name="active" id="active" value="1" checked > Sim
								</label>
								<label>
									<input type="radio" name="active" id="active" value="0"> Não
								</label>
							</div>
						</div>
					</div>
				</div>
		    <div class="box-footer">
				<a href="{{route('cliente.inicial')}}"  class="btn btn-danger btn-lg">Cancelar</a>
				<button type="submit" class="btn btn-success btn-lg">Salvar</button>
            </div>	
		</form>
	</div>
</div>


@stop
@section('js')
<script src="{{ asset('adminlte/plugins/icheck/icheck.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/input-mask/jquery.inputmask.bundle.js') }}" type="text/javascript"></script> 

<script>
	$("#cpfcnpj,#zip_code").inputmask({ "clearIncomplete": true },{'autoUnmask': true});
    $('#datepicker').datepicker({
		autoclose: true,
		format: 'dd-mm-yyyy',
		locale: 'pt-br'
	  });
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
@stop