<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'producto';

    protected $primaryKey = 'id_producto';

    protected $fillable = [
        'descrip_producto',
        'precio_venta_producto',
        'stock_min_producto',
        'interes_producto',
        'id_categoria'
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public function detalleProductoCompra()
    {
        return $this->hasMany(DetalleProductoCompra::class, 'id_producto');
    }

}
