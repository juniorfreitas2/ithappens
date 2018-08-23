<div class="row">
    <div class="col-md-6 form-group @if($errors->has('SOLICITACAO')) has-error @endif">
        <label for="SOLICITACAO" class="label-control">Solicitação*</label>
        <div class="controls">
            <input type="text" name="SOLICITACAO" class="form-control" value="{{empty($solicitacao) ? old('SOLICITACAO') : $solicitacao->SOLICITACAO}}">
            @if($errors->has('SOLICITACAO')) <p class="text-danger">{{$errors->first('SOLICITACAO')}}</p> @endif
        </div>
    </div>

    <div class="col-md-3 form-group @if($errors->has('SOLICITAR_DOCUMENTO')) has-error @endif">
        <label> Solicitar documento ? </label>
        <div class="controls">
            {!! Form::select('SOLICITAR_DOCUMENTO', ['1' => 'Sim', '0' => 'Não'], old('SOLICITAR_DOCUMENTO'), ['id'=>'selectDocumento', 'class'=> 'form-control', 'placeholder' => 'Selecione'] ) !!}
            @if($errors->has('SOLICITAR_DOCUMENTO')) <p class="text-danger">{{$errors->first('SOLICITAR_DOCUMENTO')}}</p> @endif
        </div>
    </div>

    <div class="col-md-3 form-group @if($errors->has('LC_SERVICO_ID')) has-error @endif">
        <label> Serviço* </label>
        <div class="controls">
            {!! Form::select('LC_SERVICO_ID', $servicos, old('LC_SERVICO_ID'), ['class'=> 'form-control', 'placeholder' => 'Selecione'] ) !!}
            @if($errors->has('LC_SERVICO_ID')) <p class="text-danger">{{$errors->first('LC_SERVICO_ID')}}</p> @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 form-group @if($errors->has('OBS_CANCELAMENTO')) has-error @endif">
        <label for="OBS_CANCELAMENTO" class="label-control">Obs. cancelamento*</label>
        <div class="controls">
            {!! Form::text('OBS_CANCELAMENTO',old('OBS_CANCELAMENTO'), ['class'=>'form-control']) !!}
            @if($errors->has('OBS_CANCELAMENTO')) <p class="text-danger">{{$errors->first('OBS_CANCELAMENTO')}}</p> @endif
        </div>
    </div>

    <div id="selectTiposDocumento" class="col-md-12 form-group hide @if($errors->has('TIPODOCUMENTO')) has-error @endif">
        <label>Selecione o tipo de documento: </label>
        <div class="controls">
            {!! Form::select('TIPODOCUMENTO', $tipoDocumento, old('TIPODOCUMENTO'), ['class'=> 'form-control', 'placeholder' => 'Selecione'] ) !!}
            @if($errors->has('TIPODOCUMENTO')) <p class="text-danger">{{$errors->first('TIPODOCUMENTO')}}</p> @endif
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 text-right">
        <button type="submit" class="btn btn-success btn-lg">Salvar</button>
    </div>
</div>
@section('scripts')
    @parent
    <script type="text/javascript">

        $(document).ready(function(){

            $('#selectDocumento').change(function(item) {

                if($(this).val() == 1) {
                    $('#selectTiposDocumento').removeClass('hide')
                    return;
                }

                $('#selectTiposDocumento').addClass('hide')
            });

        });
    </script>

@stop