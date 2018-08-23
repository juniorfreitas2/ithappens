@extends('master.master')

@section('content')

    <div class="box box-warning">
        <div class="box-header">
            <h1 class="box-title">Atualizar solicitação</h1>
        </div>
        <div class="box-body">
            {!! Form::model($solicitacao,["url" => baseUrl('/') . "solicitacoes/update/$solicitacao->ID", "method" => "PUT", "id" => "form", "role" => "form"]) !!}
                @include('solicitacao.includes.form')
            {!! Form::close() !!}
        </div>
    </div>

@stop
