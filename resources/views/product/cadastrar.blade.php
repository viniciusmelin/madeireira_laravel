@extends('adminlte.page')

@section('title', 'Cadastrar Produtos')

@section('content_header')
    <h1>Gerenciar Produtos</h1>
<ol class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i>Iniciar</a></li>
        <li><a href="{{route('produto.inicial')}}">Produtos</a></li>
        <li class="active"><a href="{{route('produto.cadastrar')}}">Cadastrar</a></li>
</ol>
@stop
@section('css')
<link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck/square/_all.min.css')}} "/>
@stop
@section('content')
<div class="row">
    <div class="col-lg-12">

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Cadastrar Produtos</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form class="role" method="POST" action="{{route('produto.salvar')}}">
                        {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group has-feedback {{$errors->has('description') ? 'has-error':''}}">
                                <label for="description">Descrição</label>
                                <input type="text" id="description" class="form-control" name="description" placeholder="Descrição do Produto" value="{{old('description')}}"> @if($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{$errors->first('description')}}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group has-feedback {{$errors->has('amount_min') ? 'has-error':''}}">
                                <label for="amount_min">Quantidade Minima</label>
                                <input type="number" id="amount_min" class="form-control" name="amount_min" placeholder="Qtd minima de Produtos" value="{{old('amount_min')}}"> @if($errors->has('amount_min'))
                                <span class="help-block">
                                    <strong>{{$errors->first('amount_min')}}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group has-feedback {{$errors->has('amount') ? 'has-error':''}}">
                                <label for="amount">Quantidade</label>
                                <input type="number" id="amounamountt_min" class="form-control" name="amount" value="{{old('amount')}}" placeholder="Qtd atual do Estoque"> @if($errors->has('amount'))
                                <span class="help-block">
                                    <strong>{{$errors->first('amount')}}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group has-feedback {{$errors->has('height') ? 'has-error':''}}">
                                <label for="height">Altura</label>
                                <input type="number" id="height" class="form-control" name="height" placeholder="Altura do Produto" value="{{old('height')}}"> @if($errors->has('height'))
                                <span class="help-block">
                                    <strong>{{$errors->first('height')}}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group has-feedback {{$errors->has('width') ? 'has-error':''}}">
                                <label for="width">Largura</label>
                                <input type="number" id="width" class="form-control" name="width" placeholder="Largura do Produto" value="{{old('width')}}"> @if($errors->has('width'))
                                <span class="help-block">
                                    <strong>{{$errors->first('width')}}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group has-feedback {{$errors->has('deep') ? 'has-error':''}}">
                                <label for="deep">Profundidade</label>
                                <input type="number" id="deep" class="form-control" name="deep" value="{{old('deep')}}" placeholder="Profundidade do Produto"> @if($errors->has('deep'))
                                <span class="help-block">
                                    <strong>{{$errors->first('deep')}}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group has-feedback {{$errors->has('cubing') ? 'has-error':''}}">
                                <label for="cubing">Cubagem</label>
                                <input type="number" id="cubing" class="form-control" name="cubing" value="{{old('cubing')}}" placeholder="Cubagem do Produto"> @if($errors->has('cubing'))
                                <span class="help-block">
                                    <strong>{{$errors->first('cubing')}}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group has-feedback {{$errors->has('price') ? 'has-error':''}}">
                                <label for="price">Preço de Compra</label>
                                <input type="text" id="price" class="form-control" name="price" placeholder="Preço de Compra" value="{{old('price')}}"> @if($errors->has('price'))
                                <span class="help-block">
                                    <strong>{{$errors->first('price')}}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group has-feedback {{$errors->has('price_sale') ? 'has-error':''}}">
                                <label for="price_sale">Preço de Venda</label>
                                <input type="number" id="price_sale" class="form-control" name="price_sale" value="{{old('price_sale')}}" placeholder="Preço de Venda"> @if($errors->has('price_sale'))
                                <span class="help-block">
                                    <strong>{{$errors->first('price_sale')}}</strong>
                                </span>
                                @endif
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
                    <div class="row">
                        <div class="col-lg-12">
                            <a class="btn btn-danger btn-lg" href="{{route('produto.inicial')}}">Cancelar</a>
                            <button type="submit" class="btn btn-success btn-lg">Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
@stop 
@section('js') 
<script src="{{ asset('adminlte/plugins/icheck/icheck.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/input-mask/jquery.inputmask.bundle.js') }}" type="text/javascript"></script> 
<script>
            $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });

        $(document).ready(function(){
            $('#price').inputmask( 'currency',{"autoUnmask": true,
            radixPoint:",",
            groupSeparator: ".",
            allowMinus: false,
            prefix: 'R$ ',            
            digits: 2,
            digitsOptional: false,
            rightAlign: false,
            unmaskAsNumber: true,
            });
        });
</script>
@stop