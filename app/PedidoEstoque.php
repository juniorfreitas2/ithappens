<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoEstoque extends Model
{

    protected $primaryKey = 'ped_id';

    protected $table = 'pedido_estoque';

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ped_descricao',
        'ped_user_id',
        'ped_fil_id'
    ];

    public function filial()
    {
        return $this->hasOne('App\Filial', 'fil_id', 'ped_fil_id');
    }

    public function itensPedido()
    {
        return $this->hasMany('App\ItemPedidoEstoque', 'ipe_ped_id', 'ped_id');
    }
}
