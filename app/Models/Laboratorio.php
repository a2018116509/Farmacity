<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratorio extends Model
{
    use HasFactory;
    protected $table="laboratorio";
    protected $fillable=[
        'nombre'
    ];
    public $timestamps=false;
    public function medicamentos()
    {
        return $this->hasMany('App\Models\Medicamento');
    }
}
