<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleProductoVenta extends Model
{
    use HasFactory;

    protected $table = 'detalle_producto_venta';

    protected $primaryKey = 'id_detalle_producto_venta';

    protected $fillable = [
        'id_venta',
        'id_producto',
        'cant_detalle_venta',
        'precio_detalle_venta'
    ];

    public function venta()
    {
        return $this->belongsTo(Venta::class, 'id_venta');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }
}
