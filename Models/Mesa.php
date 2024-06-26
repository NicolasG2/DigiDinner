<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    use HasFactory;

    protected $table = 'mesas';

    protected $fillable = ['numero', 'capacidade', 'formato', 'tamanho'];

    public function atendimentos()
    {
        return $this->hasMany('App\Models\Atendimento', 'mesa_id');
    }
}
