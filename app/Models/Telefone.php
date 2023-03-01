<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    use HasFactory;

    protected $fillable = [
        'number_phone'
    ];

    public function telefoneable(){
        return $this->morphTo();
    }
}
