@extends('master.master')

@section('content')

    <div class="panel panel-warning">
        <div class="panel-heading">
            <h3><i class="fa fa-plus"></i> Cadastro de Pedidos </h3>
        </div>
        <div class="panel-body">
            <form action="{{url('/pedidos/store')}}" method="POST">
                {{csrf_field()}}
                @include('pedidos.includes.form')
            </form>
        </div>
    </div>

@stop