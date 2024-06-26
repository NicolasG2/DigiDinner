<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'produtos';
    protected $fillable = [
        'nome',
        'preco',
        'ativo',
        'quantidade',
        'descricao',
        'custo',
        'foto',
        'categoria_id',
        'fornecedor_id'
    ];

    public function fornecedor()
    {
        return $this->belongsTo('App\Models\Fornecedor');
    }

    public function ingrediente()
    {
        return $this->belongsToMany('App\Models\Ingrediente', 'produto_ingrediente', 'produto_id', 'ingrediente_id');
    }

    public function estoque()
    {
        return $this->belongsToMany('App\Models\Estoque');
    }

    public function mesa()
    {
        return $this->belongsToMany('App\Models\Mesa');
    }

    public function categoria()
    {
        return $this->belongsTo('App\Models\Categoria');
    }
}
