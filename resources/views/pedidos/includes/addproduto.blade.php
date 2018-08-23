<div class="col-md-8">
    <div class="col-md-12">
        <label>Produto</label>
        <select name="ipe_pro_id" class="form-control" id="">
            @foreach($produtos as $produto)
                <option value="{{$produto->pro_id}}">{{$produto->pro_nome}}</option>
            @endforeach
        </select>
{{--        {!! Form::select('ipe_pro_id', [], ['class'=>'form-control']) !!}--}}
    </div>

    <input type="hidden" name="ipe_ped_id" value="{{$pedido->ped_id}}">

    <div class="col-md-12">
        <label>Quantidade</label>
        <input type="number" name="ipe_quantidade" class="form-control">
    </div>

    <div class="text-right" style="margin-top:20px;margin-right:0px">
        <button class="btn btn-success" type="submit">Salvar</button>
    </div>
</div>
