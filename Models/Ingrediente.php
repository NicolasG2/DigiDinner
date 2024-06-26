<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingrediente extends Model
{
    use HasFactory;

    protected $table = 'ingredientes';
    protected $fillable = ['nome', 'quantidade'];

    public function fornecedor()
    {
        return $this->belongsTo('App\Models\Fornecedor');
    }

    public function estoque()
    {
        return $this->belongsToMany('App\Models\Estoque');
    }

    public function produto()
    {
        return $this->belongsToMany('App\Models\Produto', 'produto_ingrediente', 'ingrediente_id', 'produto_id');
    }

    public function categoria()
    {
        return $this->belongsTo('App\Models\Categoria');
    }
}
