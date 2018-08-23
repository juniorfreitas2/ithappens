<div class="col-md-8">
    <div class="col-md-12">
        <label>Filial</label>
        <select name="ped_fil_id" class="form-control" id="">
            @foreach($filiais as $filial)
                <option value="{{$filial->fil_id}}">{{$filial->fil_nome}}</option>
            @endforeach
        </select>
        {{--        {!! Form::select('ipe_pro_id', [], ['class'=>'form-control']) !!}--}}
    </div>

    <div class="col-md-12">
        <label>Descrição</label>
        <textarea name="ped_descricao" class="form-control"></textarea>
    </div>

    <div class="col-md-12">
        <label>Usuário</label>
        <input type="number" name="ped_user_id" class="form-control">
    </div>

    <div class="text-right" style="margin-top:20px;margin-right:0px">
        <button class="btn btn-success" type="submit">Salvar</button>
    </div>
</div>
