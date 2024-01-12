<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activo extends Model
{
    use HasFactory;

    protected $table = 'activo';

    protected $primaryKey = 'id_activo';

    protected $fillable = [
        'descrip_activo',
        'marca_activo',
        'modelo_activo',
        'serie_activo',
        'color_activo',
        'fech_compra_activo',
        'vida_util_activo',
        'costo_compra_activo',
        'id_tipo'
    ];

    public function tipo()
    {
        return $this->belongsTo(Tipo::class, 'id_tipo');
    }
}
