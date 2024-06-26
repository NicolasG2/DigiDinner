<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    use HasFactory;

    protected $table = 'estoques';

    public function produto() {       
        return $this->belongsTo('App\Models\Produto');
    }

    public function ingrediente() {       
        return $this->belongsTo('App\Models\Ingrediente');
    }
}