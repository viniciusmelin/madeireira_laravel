@extends('adminlte.page') @section('title', 'AdminLTE') @section('content_header')
<h1>Painel</h1>
<ol class="breadcrumb panel-heading">
	<li>
		<a href="{{ route('cliente.inicial') }}">Vendedores</a>
	</li>
	<li class="active">Visualizar</a>
	</li>
</ol>
@stop 
@section('css')
<link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck/square/_all.min.css')}} " />
<link rel="stylesheet" href="{{ asset('adminlte/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" /> @stop @section('content') {{--
<meta name="csrf-token" content="{{ csrf_token() }}"> --}}
<div class="container-fluid">

	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Visualizar Vendedor</h3>
		</div>
		<div class="box-body">
			<p>
				<button type="button" class="btn btn-success btn-lg">Alterar</button>
			</p>
			<input type="hidden" id="code" value="{{$client->people_id}}">
			<div class="row">
				<div class="col-lg-4">
					<div class="form-group has-feedback {{$errors->has('name') ? 'has-error': ''}}">
						<label for="name">Nome</label>
						<input type="text" class="form-control" name="name" id="name" placeholder="Nome do Cliente" value="{{$client->people->name}}"
						 disabled>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group  has-feedback {{$errors->has('cpfcnpj') ? 'has-error': ''}}">
						<label for="cpfcnpj">CPF</label>
						<input type="text" class="form-control" name="cpfcnpj" id="cpfcnpj" placeholder="CPF do Cliente" value="{{$client->people->cpfcnpj}}"
						 disabled>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group  has-feedback {{$errors->has('birth_register') ? 'has-error': ''}}">
						<label for="birth_register">Data de Registro</label>
						<div class="input-group date">
							<div class="input-group-addon">
								<i class="fa fa-calendar"></i>
							</div>
							<input type="text" name="birth_register" class="form-control pull-right" id="birth_register" value="{{$client->birth_register}}"
							 readOnly>
						</div>
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
							<input type="text" class="form-control pull-right" name="birth_date" id="datepicker" placeholder="Escolha Data" value="{{$client->birth_date}}"
							 readOnly>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group has-feedback {{$errors->has('limitmin') ? 'has-error': ''}}">
						<label form="limitmin" id="limitmin">Limite Minímo</label>
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-dollar"></i>
							</span>
							<input type="number" name="limitmin" id="limitmin" class="form-control" min="0.00" step="0.01" value="{{$client->limitmin}}"
							 disabled>
						</div>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="form-group has-feedback {{$errors->has('limitmax') ? 'has-error': ''}}">
						<label form="limitmax">Limite Maxímo</label>
						<div class="input-group">
							<span class="input-group-addon">
								<i class="fa fa-dollar"></i>
							</span>
							<input type="number" name="limitmax" id="limitmax" class="form-control" min="0.00" step="0.01" value="{{$client->limitmax}}"
							 disabled>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4">
					<div class="form-group">
						<label for="active">Ativo</label>
						<div class="">
							<label>
								<input type="radio" name="active" id="active" value="1" checked> Sim
							</label>
							<label>
								<input type="radio" name="active" id="active" value="0"> Não
							</label>
						</div>
					</div>
				</div>
			</div>
			<div class="box-footer">

			</div>
		</div>
	</div>
	<div class="box box-default box-solid">
		<div class="box-header with-border">
			<h3 class="box-title">Endereços
				<span class="pull-right-container">
					<small class="label pull-right bg-red" id="countAddress">{{$client->address->count()}}</small>
				</span>
			</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse">
					<i class="fa fa-minus"></i>
				</button>
			</div>
			<!-- /.box-tools -->
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<p>
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalAddress">Adicionar</button>
			</p>
			<div class="box-body table-responsive no-padding">
				<table class="table table-hover" id="tableAddress">

					<thead>
						<tr>
							<th>Id</th>
							<th>Logradouro</th>
							<th>Bairro</th>
							<th>N°</th>
							<th>Cidade</th>
							<th>CEP</th>
							<th>Complemento</th>
							<th>Ação</th>
						</tr>
					</thead>
					<tbody>
						@foreach($client->address as $address)
						<tr>
							<td>{{$address->id}}</td>
							<td>{{$address->street}}</td>
							<td>{{$address->neighborhood}}</td>
							<td>{{$address->number}}</td>
							<td>{{$address->city}}</td>
							<td>{{$address->zip_code}}</td>
							<td>{{$address->complement}}</td>
							<td>
								<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalAddress" title="Editar Endereço">
									<span class="fa fa-edit"></span>
								</button>
								<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalRemoveAddress" title="Excluir Endereço">
									<span class="glyphicon glyphicon-remove">
								</button>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="box box-default box-solid">
		<div class="box-header with-border">
			<h3 class="box-title">Telefones
				<span class="pull-right-container">
					<small class="label pull-right bg-red" id="countPhones">{{$client->phone->count()}}</small>
				</span>
			</h3>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse">
					<i class="fa fa-minus"></i>
				</button>
			</div>
			<!-- /.box-tools -->
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<p>
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalPhone">Adicionar</button>
			</p>
			<div class="box-body table-responsive no-padding">
				<table class="table table-hover" id="phonetable">
					<thead>
						<tr>
							<th>Id</th>
							<th>Número</th>
							<th>Principal</th>
							<th>Tipo</th>
							<th>Ação</th>
						</tr>
					</thead>
					<tbody>

						@foreach($client->phone as $phone)
						<tr>
							<td class="hidden">{{ $phone->id}}</td>
							<td>{{$phone->number}}</td>
							<td>{{$phone->main == 1 ? 'Sim':'Não'}}</td>
							<td>{{$phone->phone_type->description}}</td>
							<td>
								<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalPhone" title="Editar Telefone">
									<span class="fa fa-edit"></span>
								</button>
								<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalremove" title="Editar Telefone">
									<span class="glyphicon glyphicon-remove">
								</button>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="box box-default box-solid">
		<div class="box-header with-border">
			<h3 class="box-title">E-mails
				<span class="pull-right-container">
					<small class="label pull-right bg-red" id="countEmail">{{$client->email->count()}}</small>
				</span>
			</h3>
			<div>
			</div>
			<div class="box-tools pull-right">
				<button type="button" class="btn btn-box-tool" data-widget="collapse">
					<i class="fa fa-minus"></i>
				</button>
			</div>
			<!-- /.box-tools -->
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<p>
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalEmail">Adicionar</button>
			</p>
			<div class="box-body table-responsive no-padding">
				<table class="table table-hover" id="tableEmail">
					<thead>
						<tr>
                            <th>Id</th>
							<th>Email</th>
							<th>Principal</th>
							<th>Ação</th>
						</tr>
                    </thead>
                    <tbody>    
						@foreach($client->email as $email)
						<tr>
                            <td>{{$email->id}}</td>
							<td>{{$email->email}}</td>
							<td>{{$email->main==1 ? 'Sim':'Não' }}</td>
							<td>
								<button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalEmail" title="Editar Email">
									<span class="fa fa-edit"></span>
								</button>
								<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalRemoveEmail" title="Excluir Email">
									<span class="glyphicon glyphicon-remove">
								</button>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>


	<div id="modalPhone" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h2 class="modal-title">Telefone</h2>
				</div>
				<div class="modal-body">
					<form role="form">
						<input type="hidden" name="id" id="phone_id">
						<div class="row">
							<div class="col-lg-4">
								<div class="form-group">
									<label for="phone_type_id">Tipo</label>
									<select class="form-control" id="phone_type_id">
										@foreach($phone_type as $phonetype)
										<option name="{{$phonetype->description}}" value="{{$phonetype->id}}">{{$phonetype->description}}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label for="phone_number">Número</label>
									<input type="text" class="form-control" id="phone_number" name="phone_number">
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group ">
									<label for="main_phone"></label>
									<div class="checkbox icheck">
										<label>
											<input type="checkbox" class="form-control" id="main_phone" name="main_phone">
											<b>Principal</b>
										</label>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger pull-left btn-lg" data-dismiss="modal">Cancelar</button>
					<button type="button" class="btn btn-success btn-lg" id="savephone">Salvar</button>
				</div>
			</div>

		</div>
	</div>

	<div id="modalremove" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h3 class="modal-title">Excluir Telefone</h3>
				</div>
				<div class="modal-body">
					<input type="hidden" id="removephone_id" value="">
					<p>Deseja realmente excluir o telefone selecionado?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger  btn-lg" data-dismiss="modal">Não</button>
					<button type="button" class="btn btn-success btn-lg" id="removephone">Sim</button>
				</div>
			</div>
		</div>
	</div>

	<div id="modalAddress" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h2 class="modal-title">Endereço</h2>
				</div>
				<div class="modal-body">
					<form role="form">
						<input type="hidden" name="id" id="address_id">
						<div class="row">
							<div class="col-lg-8">
								<div class="form-group has-feedback {{$errors->has('street') ? 'has-error': ''}}">
									<label for="street">Logradouro</label>
									<input type="text" class="form-control" name="street" id="street" value="{{old('street')}}"> 
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
									<input type="number" class="form-control" name="number" id="number" value="{{old('number')}}"> @if($errors->has('number'))
									<span class="help-block">
										<strong>{{ $errors->first('number') }}</strong>
									</span>
									@endif
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-8">
								<div class="form-group has-feedback {{$errors->has('neighborhood') ? 'has-error': ''}}">
									<label for="neighborhood">Bairro</label>
									<input type="text" class="form-control" name="neighborhood" id="neighborhood" value="{{old('neighborhood')}}"> @if($errors->has('neighborhood'))
									<span class="help-block">
										<strong>{{ $errors->first('neighborhood') }}</strong>
									</span>
									@endif
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-group has-feedback {{$errors->has('complement') ? 'has-error': ''}}">
									<label for="complement">Complemento</label>
									<input type="text" class="form-control" name="complement" id="complement" value="{{old('complement')}}"> @if($errors->has('complement'))
									<span class="help-block">
										<strong>{{ $errors->first('complement') }}</strong>
									</span>
									@endif
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group has-feedback {{$errors->has('city') ? 'has-error': ''}}">
									<label for="city">Cidade</label>
									<input type="text" class="form-control" name="city" id="city" value="{{old('city')}}"> @if($errors->has('city'))
									<span class="help-block">
										<strong>{{ $errors->first('city') }}</strong>
									</span>
									@endif
								</div>
							</div>
							<div class="col-lg-5">
								<label for="zip_code">CEP</label>
								<div class="form-group has-feedback {{$errors->has('zip_code') ? 'has-error': ''}}">
									<div class="input-group">
										<input type="text" class="form-control" name="zip_code" id="zipcode" value="{{old('zip_code')}}">
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
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger pull-left btn-lg" data-dismiss="modal">Cancelar</button>
					<button type="button" class="btn btn-success btn-lg" id="saveAddress">Salvar</button>
				</div>
			</div>

		</div>
	</div>

	<div id="modalRemoveAddress" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h3 class="modal-title">Excluir Endereço</h3>
				</div>
				<div class="modal-body">
					<input type="hidden" id="removeAddress_id" value="">
					<p>Deseja realmente excluir o Endereço selecionado?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger  btn-lg" data-dismiss="modal">Não</button>
					<button type="button" class="btn btn-success btn-lg" id="removeAddress">Sim</button>
				</div>
			</div>
		</div>
	</div>


    <div id="modalEmail" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h2 class="modal-title">Email</h2>
				</div>
				<div class="modal-body">
					<form role="form">
						<input type="hidden" name="id" id="email_id">
						<div class="row">
							<div class="col-lg-8">
								<div class="form-group has-feedback {{$errors->has('email') ? 'has-error': ''}}">
									<label for="email">Email</label>
									<input type="text" class="form-control" id="email" name="email">
								@if($errors->has('email'))
									<span class="help-block">
                           				<strong>{{ $errors->first('email') }}</strong>
                        			</span>
								@endif
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-group ">
									<label for="main_email"></label>
									<div class="checkbox icheck">
										<label>
											<input type="checkbox" class="form-control" id="main_email" name="main_email">
											<b>Principal</b>
										</label>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger pull-left btn-lg" data-dismiss="modal">Cancelar</button>
					<button type="button" class="btn btn-success btn-lg" id="saveEmail">Salvar</button>
				</div>
			</div>

		</div>
	</div>

	<div id="modalRemoveEmail" class="modal fade" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h3 class="modal-title">Excluir Email</h3>
				</div>
				<div class="modal-body">
					<input type="hidden" id="removeEmail_id" value="">
					<p>Deseja realmente excluir o email selecionado?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger  btn-lg" data-dismiss="modal">Não</button>
					<button type="button" class="btn btn-success btn-lg" id="removeEmail">Sim</button>
				</div>
			</div>
		</div>
	</div>
@stop 
@section('js')
	<script src="{{ asset('adminlte/plugins/icheck/icheck.min.js') }}"></script>
	<script>
		$(function () {
			$('#main_phone,#active,#main_email').iCheck({
				checkboxClass: 'icheckbox_square-blue',
				radioClass: 'iradio_square-blue',
				increaseArea: '20%' // optional
			});
		});
	</script>
	<script src="{{ asset('js/client_editar.js')}}" type="text/javascript"></script>
@stop