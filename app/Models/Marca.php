<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function fornecedor(){
        return $this->belongsTo(Fornecedor::class);
    }

    public function produtos(){
        return $this->hasMany(Produto::class); 
    }
}
