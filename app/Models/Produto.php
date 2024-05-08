<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = "produtos";
    protected $fillable = ['nome', 'descricao', 'peso', 'unidade_id'];

    public function fornecedor(){

        return $this->belongsTo('App\Models\Fornecedor');
    }
}
