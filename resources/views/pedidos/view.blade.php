@extends('master.master')

@section('content')
    <div class="box box-warning">
        <div class="box-body" style="padding: 0px">

            <table class="table table-condensed table-bordered">
                <thead>
                    <tr>
                        <th>Descrição</th>
                        <th>Usuário</th>
                        <th>Filial</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$pedido->ped_descricao}}</td>
                        <td>{{$pedido->ped_user_id}}</td>
                        <td>{{$pedido->filial->fil_nome}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="box box-warning">
        <div class="box-body">
            <div class="box-header">
                <div class="col-md-6" style="float: left;"><h5>Produtos</h5></div>
                <div class="col-md-6" style="float: right;">
                    <a href="{{url('/ithappens/pedidos/adicionarproduto/'.$pedido->ped_id)}}" class="btn btn-primary" style="float: right; color: white">Novo</a>
                </div>
            </div>
            <table class="table table-striped table-condensed table-sm">
                <thead>
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                </tr>
                </thead>
                <tbody>
                @if(count($pedido->itensPedido ))
                    @foreach($pedido->itensPedido as $items)
                        <tr>
                            <td>{{$items->produto->pro_nome}}</td>
                            <td>{{$items->ipe_quantidade}}</td>
                        </tr>
                    @endforeach
                @else
                    <h3>Nenhum produto</h3>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@stop