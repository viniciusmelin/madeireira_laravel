@extends('adminlte.page') @section('title', 'Cadastrar Pedido') 
@section('content_header')
<h1>Novo Pedido</h1>
<ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i>Iniciar</a></li>
		<li><a href="{{route('pedido.inicial')}}">Pedidos</a></li>
        <li class="active"><a href="{{route('pedido.cadastrar')}}">Novo</a></li>
</ol>
@stop 
@section('css')
<link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck/square/_all.min.css')}} " /> 
<link rel="stylesheet" href="{{ asset('adminlte/plugins/input-mask/css/inputmask.css')}} " /> 
@stop 
@section('content')
<div class="row">
	<div class="col-lg-6">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Informações do Pedido</h3>
			</div>
			<div class="box-body">
				<div class="row">
					<div class="col-lg-12 col-xs-12">
						<div class="col-lg-6 col-xs-6">
							<button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#modalClient" style="width: 100%">
								<span class="glyphicon glyphicon-search"></span> Cliente
							</button>
						</div>
						<div class="col-lg-6 col-xs-6">
							<button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#modalSalesman" style="width: 100%">
								<span class="glyphicon glyphicon-search"></span> Vendedor
							</button>
						</div>
	
					</div>
				</div>
				<input type="hidden" id="order_id" value="">
				<!-- <input type="hidden" id="salesman_id" value=""> -->
	
				<div style="margin-top: 15px">
					<div class="row">
						<div class="col-lg-7">
							<div class="form-group">
								<label for="nameClient">Cliente</label>
								<input type="text" class="form-control" name="nameClient" id="nameClient" placeholder="Nome do Cliente" value="" disabled>
							</div>
						</div>
						<div class="col-lg-5">
							<div class="form-group">
								<label for="cpfcnpj">CPF</label>
								<input data-inputmask="'mask': '999.999.999-99'" type="text" class="form-control" name="cpfcnpj" id="cpfcnpj" placeholder="CPF do Cliente"
								 value="" disabled>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-8">
							<div class="form-group">
								<label for="salesman_name">Vendedor</label>
								<input type="text" class="form-control" name="salesman_name" id="salesman_name" placeholder="Nome do Vendedor" value="" disabled>
							</div>
						</div>
					</div>
				</div>
				<div class="box-footer">
					<div class="row">
						<div class="col-lg-6 col-xs-6">
							<button class="btn btn-danger" style="width: 100%" id="btncancelar" data-toggle="modal" data-target="#modalCancelarPedido">
								<span class="glyphicon glyphicon-remove"></span> Cancelar
							</button>
						</div>
						<div class="col-lg-6 col-xs-6">
							<button class="btn btn-success" style="width: 100%;" id="btnfinalizar" data-toggle="modal" data-target="#modalFinalizarPedido">
								<span class="fa fa-check-square-o"></span> Finalizar
							</button>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Escolher Produto</h3>
			</div>
			<form id="formItem">
				<div class="box-body">
					<div>
						<div class="row">
	
							<div class="col-lg-8">
								<div class="form-group">
									<label for="nameproduct">Produto</label>
									<input type="text" class="form-control" name="nameproduct" id="nameproduct" placeholder="Escolha o Produto " value="{{$client->people->name or old('name')}}">
									<span class="help-block" style="display:none">
										<strong>Escolha um Produto</strong>
									</span>
								</div>
							</div>
	
							<div class="col-lg-2">
								<div class="form-group">
									<label for="" class="clear"></label>
									<button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#modalProduct" style="width: 100%">
										<span class="glyphicon glyphicon-search"></span>
									</button>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label for="priceproduct">Valor</label>
								<input type="text" class="form-control" name="priceproduct" id="priceproduct" placeholder="Valor do Produto" value="" disabled>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="amount">Quantidade</label>
								<input type="number" class="form-control" name="amount" id="amount" placeholder="Qtd. do Produto" value="">
								<span class="help-block" style="display:none">
									<strong>Escolha um Produto!</strong>
								</span>
							</div>
						</div>
					</div>
					<div class="row">
	
					</div>
				</div>
			</form>
				<div class="box-footer">
					<div class="col-lg-12">
						<button class="btn btn-success" style="width: 100%" id="btnAdicionar">
							<span class="glyphicon glyphicon-plus"></span> Adicionar
						</button>
					</div>
				</div>
		</div>
	</div>
</div>



<div class="row" id="message" style="display: none;">
	<div class="col-lg-5 col-lg-offset-3">
		<div id="message_class" class="callout callout-danger">
			<h4 id="message_title"></h4>
			<p id="message_body"></p>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="col-lg-3">
			<div class="info-box">
				<span class="info-box-icon bg-yellow">
					<i class="glyphicon glyphicon-piggy-bank"></i>
				</span>

				<div class="info-box-content">
					<span class="info-box-text">Valor Total</span>
					<span id="amountOrder" class="info-box-number">0</span>
				</div>
				<!-- /.info-box-content -->
			</div>
		</div>
		<div class="col-lg-3">
			<div class="info-box">
				<span class="info-box-icon bg-yellow">
					<i class="glyphicon glyphicon-th-list"></i>
				</span>

				<div class="info-box-content">
					<span class="info-box-text">Qtd. Produtos</span>
					<span id="amountOrderItem" class="info-box-number">0</span>
				</div>
				<!-- /.info-box-content -->
			</div>
		</div>
	</div>
</div>

<div class="box box-default box-solid">
	<div class="box-header with-border">
		<h3 class="box-title">Produtos do Pedido</h3>

		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse">
				<i class="fa fa-minus"></i>
			</button>
		</div>
		<!-- /.box-tools -->
	</div>
	<!-- /.box-header -->
	<div class="box-body">
		<div class="row">
			<div class="col-lg-12">
				<table class="table table-hover table-bordered" id="tableItems" style="width: 100%;">
					<thead>
						<tr>
							<th>Código</th>
							<th>Produto</th>
							<th>Preço</th>
							<th>Qtd.</th>
							<th>Ação</th>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>

		</div>
	</div>
	<!-- /.box-body -->
</div>
<div id="modalRemoveItem" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title">Excluir Item</h3>
			</div>
			<div class="modal-body">
				<input type="hidden" id="removeItem_id" value="">
				<p>Deseja realmente excluir o item selecionado?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger  btn-lg" data-dismiss="modal">Não</button>
				<button type="button" class="btn btn-success btn-lg" id="removeItem">Sim</button>
			</div>
		</div>
	</div>
</div>
<div id="modalFinalizarPedido" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title">Finalizar Pedido</h3>
			</div>
			<div class="modal-body">
				<h4>Deseja realmente finalizar o Pedido?</h4>
				<p>
					<b>Você será direcionado para o conta que foi criada, relacionada com este Pedido!</b>
				</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger  btn-lg" data-dismiss="modal">Não</button>
				<button type="button" class="btn btn-success btn-lg" id="btnFinalizar">Sim</button>
			</div>
		</div>
	</div>
</div>
<div id="modalCancelarPedido" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h3 class="modal-title">Cancelar Pedido Pedido</h3>
			</div>
			<div class="modal-body">
				<h4>Deseja realmente cancelar o Pedido?</h4>
				<p>
					<b>A conta gerada relacionada a este pedido será cancelada!</b>
				</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger  btn-lg" data-dismiss="modal">Não</button>
				<button type="button" class="btn btn-success btn-lg" id="btnCa">Sim</button>
			</div>
		</div>
	</div>
</div>
@include('layouts.salesman_pesq') @include('layouts.client_pesq') @include('layouts.product_pesq') 
@stop 
@section('js')
<script src="{{ asset('adminlte/plugins/icheck/icheck.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/salesman_pesq.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/client_pesq.js')}}" type="text/javascript"></script>
<script src="{{ asset('js/product_pesq.js')}}" type="text/javascript"></script>
<script src="{{ asset('adminlte/plugins/input-mask/jquery.inputmask.bundle.js') }}" type="text/javascript"></script> 
<script src="{{ asset('adminlte/plugins/jqueryvalidation/jquery.validate.min.js') }}" type="text/javascript"></script> 
<script src="{{ asset('js/order.js')}}" type="text/javascript">
$(document).ready(function(){
	$($.fn.dataTable.tables( true ) ).css('width', '100%');
    $($.fn.dataTable.tables( true ) ).DataTable().columns.adjust().draw();
});
</script>
@stop