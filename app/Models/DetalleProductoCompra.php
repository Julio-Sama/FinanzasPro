<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleProductoCompra extends Model
{
    use HasFactory;

    protected $table = 'detalle_producto_compra';

    protected $primaryKey = 'id_detalle_compra';

    protected $fillable = [
        'cantidad_detalle_compra',
        'precio_detalle_compra',
        'id_producto',
        'id_compra'
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }

    public function compra()
    {
        return $this->belongsTo(Compra::class, 'id_compra');
    }

}
