<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    use HasFactory;

    protected $fillable = [
        'number_phone',
        'telefoneable_id',
        'telefoneable_type',

    ];

    public function telefoneable(){
        return $this->morphTo();
    }
}
