@extends('master.baselayout')

@section('content')

    <div class="panel panel-warning">
        <div class="panel-heading">
            <h3><i class="fa fa-plus"></i> Cadastro de Solicitação </h3>
        </div>
        <div class="panel-body">
            <form action="{{baseUrl('/solicitacoes/store')}}" method="POST">
                {{csrf_field()}}
                @include('solicitacao.includes.form')
            </form>
        </div>
    </div>

@stop