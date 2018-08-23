<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filial extends Model
{
    protected $primaryKey = 'fil_id';

    protected $table = 'filial';

    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fil_nome'
    ];

    public function produtos()
    {
        return $this->hasMany('App\Produto', 'pro_fil_id', 'fil_id');
    }
}
