<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemPedidoEstoque extends Model
{

    protected $primaryKey = 'ipe_id';

    protected $table = 'item_pedido_estoque';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ipe_ped_id',
        'ipe_pro_id'
    ];
}
