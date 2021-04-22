<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    use HasFactory;
    protected $table="medicamento";
    protected $fillable=[
        'nombre',
        'descripcion',
        'precio',
        'id_laboratorio'
    ];
    public $timestamps=false;
    public function laboratorio()
    {
        return $this->belongsTo('App\Models\Laboratorio');
    }
}
