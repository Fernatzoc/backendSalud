<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregnant extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombres',
        'apellidos',
        'cui',
        'direccion',
        'fecha_de_nacimiento',
        'tipo_de_examen',
        'ultima_regla',
        'peso',
        'cmb',
        'altura',
        'id_user'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }
}