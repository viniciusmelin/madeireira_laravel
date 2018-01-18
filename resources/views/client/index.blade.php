@extends('adminlte.page') @section('title', 'AdminLTE') @section('content_header')
<h1>Gerenciar Clientes</h1>
<ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i>Iniciar</a></li>
        <li><a href="{{route('cliente.inicial')}}">Clientes</a></li>
</ol>
@stop @section('content')
<div class="row">
	<div class="col-xs-12">
		<p>
			<a class="btn btn-success btn-lg" href="{{route('cliente.cadastrar')}}">Cadastrar</a>
		</p>
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Clientes Cadastrados</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
          <table class="table table-hover table-bordered" id="tableclients">
            <thead>
              <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>CPF</th>
                <th>Status</th>
                <th>Ação</th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
	</div>
</div>
@stop @section('js')
<script>
	$(function(){
  $('#tableclients').DataTable({
    "processing": true,
    "serverSide": true,
    "ajax": "/admin/clientes/getJson",
    "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Portuguese-Brasil.json",
        },
    "columns": 
    [
      {"data": "id",name:'id'},
      {"data": "name", name:"name"},
      {"data": "cpfcnpj", name:"cpfcnpj"},
      {"data": "active", name:"active"},
      {'data': 'action', name: 'action', orderable: false, searchable: false}

    ],
    "columnDefs":[
      { 'targets':[2], 
        'render':function(data){
          return data.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/g,"\$1.\$2.\$3\-\$4");
        } 
      }
    ]
  });
});

</script>

@stop