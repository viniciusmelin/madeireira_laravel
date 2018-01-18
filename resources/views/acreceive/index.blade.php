@extends('adminlte.page') @section('title', 'AdminLTE') @section('content_header')

<h1>Gerenciar Contas a Receber</h1>
<ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i>Iniciar</a></li>
        <li class="active"><a href="{{route('receber.inicial')}}">Receber</a></li>
</ol>
@stop @section('content')
<div class="row">
	<div class="col-xs-12">
		<p>
			<a class="btn btn-success btn-lg" href="{{route('receber.cadastrar')}}">Cadastrar</a>
		</p>
		<div class="box">
			<div class="box-header">
				<h3 class="box-title">Contas a Receber</h3>
			</div>
			<!-- /.box-header -->
			<div class="box-body table-responsive">
				<table class="table table-hover table-bordered" id="tableProduct">
					<thead>
						<tr>
							<th>Código</th>
							<th>Descrição</th>
							<th>Altura</th>
							<th>Largura</th>
							<th>Profundidade</th>
							<th>Cubagem</th>
							<th>Qtd Min.</th>
							<th>Qtd Atual</th>
							<th>Preço</th>
							<th>Ação</th>
						</tr>
					</thead>
					<tbody>
						{{--  @foreach($product as $p)
							<tr>
								<td>{{$p->id}}</td>
								<td>{{$p->description}}</td>
								<td>{{$p->height}}</td>
								<td>{{$p->width}}</td>
								<td>{{$p->deep}}</td>
								<td>{{$p->cubing}}</td>
								<td>{{$p->amount_min}}</td>
								<td>{{$p->amount}}</td>
								<td>{{$p->price}}</td>
								<td>
									<a class="btn btn-info btn-xs" href="{{route('produto.editar',$p->id)}}"><span class="fa fa-edit">Editar</span></a>
								</td>
							</tr>
						@endforeach  --}}
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
	$('#tableProduct').DataTable({
		"columnDefs":[
			{
				"targets": [9],
        "searchable": false
			}
		]
	});
});
</script> 
@stop