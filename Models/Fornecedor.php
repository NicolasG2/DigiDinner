<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fornecedor extends Model
{
    use HasFactory;

    protected $table = 'fornecedors';

    public function produto() {
        return $this->belongsToMany('App\Models\Produto');  
    }
    
    public function ingrediente() {
        return $this->belongsToMany('App\Models\Ingrediente');  
    }
}
