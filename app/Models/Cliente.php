<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'cliente';
    protected $primaryKey = 'id_cliente';

    protected $fillable = [
        'nom_cliente',
        'tel_cliente',
        'dir_cliente',
        'dui_cliente',
        'nit_cliente',
        'tipo_cliente',
        'ingreso_cliente',
        'egreso_cliente',
        'lugar_trabajo_cliente',
        'estado_civil_cliente'
    ];
}
