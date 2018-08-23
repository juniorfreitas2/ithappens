@extends('master.master')

@section('content')
<h3>Lista de pedidos</h3>

<div class="box box-warning">
    <a href="{{url('ithappens/pedidos/create')}}" class="btn btn-info" style="float: right; margin: 10px">Novo</a>
    <div class="box-body" style="padding: 0px">

        <table class="table table-condensed table-bordered">
            <thead>
            <tr>
                <th>Id</th>
                <th>Descrição</th>
                <th>Filial</th>
                <th>Usuário</th>
                <th>Ação</th>
            </tr>
            </thead>
            <tbody>
            @foreach($pedidos as $pedido)
                <tr>
                    <td>{{$pedido->ped_id}}</td>
                    <td>{{$pedido->ped_descricao}}</td>
                    <td>{{$pedido->ped_filial}}</td>
                    <td>{{$pedido->ped_user_id}}</td>
                    <td>
                        <a href="{{url('/ithappens/pedidos/view/'.$pedido->ped_id)}}" class="btn btn-info btn-sm">Detalhes</a>
                        <a href="{{url('/ithappens/pedidos/'.$pedido->ped_id.'/edit')}}" class="btn btn-warning btn-sm">Editar</a>
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop
