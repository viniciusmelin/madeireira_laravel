@extends('adminlte.page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Novo Vendedor</h1>
<ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i>Iniciar</a></li>
		<li><a href="{{route('vendedor.inicial')}}">Vendedores</a></li>
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
			<h3 class="box-title">Cadastrar Vendedor</h3>
		</div>
		<form role="form" action="{{route('vendedor.salvar')}}" method="post">
		{!! csrf_field() !!}
			<div class="box-body">
				<div class="row">
					<div class="col-lg-4">
						<div class="form-group has-feedback {{$errors->has('name') ? 'has-error': ''}}">
							<label for="name">Nome</label>
							<input type="text" class="form-control" name="name" id="name" placeholder="Nome do Vendedor" value="{{old('name')}}">
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
							<input type="text" data-inputmask="'mask': '999.999.999-99'" class="form-control" name="cpfcnpj" id="cpfcnpj" placeholder="CPF do Vendedor" value="{{old('cpfcnpj')}}">
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
                
                <div class="box-header with-border">
                        <h3 class="box-title">Acesso ao Sistema</h3>
                    </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group  has-feedback {{$errors->has('email') ? 'has-error': ''}}">
                            <label for="email">Email</label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <input type="text" name="email" class="form-control pull-right" id="email" />
                            </div>
                            @if($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group  has-feedback {{$errors->has('user') ? 'has-error': ''}}">
                                <label for="user">Login</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <input type="text" name="user" class="form-control pull-right" id="user" />
                                </div>
                                @if($errors->has('user'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('user') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group  has-feedback {{$errors->has('password') ? 'has-error': ''}}">
                                <label for="password">Senha</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                    </div>
                                    <input type="text" name="password" class="form-control pull-right" id="user" />
                                </div>
                                @if($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group  has-feedback {{$errors->has('password_confirmation') ? 'has-error': ''}}">
                                <label for="password_confirmation">Confirmar Senha</label>
                                <div class="input-group date">
                                    <div class="input-group-addon">
                                        <i class="fa fa-lock"></i>
                                    </div>
                                    <input type="text" name="password_confirmation" class="form-control pull-right" id="password_confirmation" />
                                </div>
                                @if($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
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
				<a href="{{route('vendedor.inicial')}}"  class="btn btn-danger btn-lg">Cancelar</a>
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