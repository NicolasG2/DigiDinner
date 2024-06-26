<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos';
    
    protected $fillable = ['produto_id', 'atendimento_id'];

    public function produto()
    {
        return $this->belongsTo('App\Models\Produto', 'produto_id');
    }

    public function atendimento() {
        return $this->belongsTo('App\Models\Atendimento', 'atendimento_id');
    }
}
