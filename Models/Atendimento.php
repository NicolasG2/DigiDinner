<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Atendimento extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'atendimentos';

    protected $fillable = ['num_pessoas', 'comentario', 'cliente_id', 'mesa_id', 'user_id'];

    public function mesa() {
        return $this->belongsTo('App\Models\Mesa', 'mesa_id');
    }

    public function cliente() {
        return $this->belongsTo('App\Models\Cliente', 'cliente_id');
    }

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function pedidos() {
        return $this->hasMany('App\Models\Pedido', 'atendimento_id');
    }
}