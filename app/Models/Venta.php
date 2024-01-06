<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $table = 'venta';

    protected $primaryKey = 'id_venta';

    protected $fillable = [
        'total_venta',
        'fecha_venta',
        'estado_venta',
        'comprobante_venta',
        'condicion_pago_venta',
        'id_cliente',
        'id_usuario'
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function detalleProductoVenta()
    {
        return $this->hasMany(DetalleProductoVenta::class, 'id_venta');
    }
}
