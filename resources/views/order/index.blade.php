@extends('adminlte.page') @section('title', 'AdminLTE') @section('content_header')
<h1>Gerenciar Pedidos</h1>
<ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i>Iniciar</a></li>
        <li class="active"><a href="{{route('pedido.inicial')}}">Pedidos</a></li>
</ol>
@stop @section('content')
<div class="row">
	<div class="col-xs-12">
		<p>
			<a class="btn btn-success btn-lg" href="{{route('pedido.cadastrar')}}">Novo Pedido</a>
		</p>
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Lista de Pedidos</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body table-responsive">
				<table class="table table-hover table-bordered" id="tableOrders">
					<thead>
						<tr>
							<th>Código</th>
							<th>Cliente</th>
							<th>Vendedor</th>
							<th>Valor Total</th>
							<th>Qtd. de Produtos</th>
							<th>Situação</th>
							<th>Dt. Pedido</th>
							<th>Ação</th>
						</tr>
					</thead>
					<tbody>
					@foreach($allOrders as $order)
						<tr>
							<td>{{$order->id}}</td>
						@foreach($order->client as $client)
								<td>{{$client->people->name}}</td>
						@endforeach
						@foreach($order->salesman as $salesman)
								<td>{{$salesman->people->name}}</td>
						@endforeach
							<td>{{$order->amount}}</td>

							<td>
							@if($order->order_item->count() < 1)
								0.00
							@endif
								@foreach($order->order_item as $order_item)
								
									{{$order_item->where('order_id','=',$order->id)->sum('amount')}}
								@endforeach
							</td>
							<td><span class="label label-success">{{$order->situation->description}}</span></td>
							<td>{{$order->created_at}}</td>
							<td>
								<a href="{{route('pedido.editar',$order->id)}}" class="btn btn-xs btn-primary" title="Editar Pedido"><i class="glyphicon glyphicon-edit"></i></a>
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.box -->
	</div>
</div>
@stop 
@section('js')
<script>
$(document).ready(function(){
	$('#tableOrders').DataTable({
		"columnDefs":[
			{
				"targets": [7],
        "searchable": false
			}
		]
	});
});
</script> 
@stop