<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    protected $primaryKey = 'est_id';

    protected $table = 'estoque';

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'est_fil_id',
        'est_pro_id',
        'est_disponivel',
        'est_reservado',

    ];

//    public function responsaveis()
//    {
//        return $this->hasMany('App\Models\EmpresaResponsavel', 'LC_EMPRESA_ID', 'ID');
//    }
}
