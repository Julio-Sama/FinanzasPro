<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $table = 'compra';
    protected $primaryKey = 'id_compra';

    protected $fillable = [
        'total_compra',
        'fecha_compra',
        'estado_compra',
        'comprobante_compra',
        'condicion_pago_compra',
        'id_proveedor',
        'id_usuario'
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function detalleProductoCompra()
    {
        return $this->hasMany(DetalleProductoCompra::class, 'id_compra');
    }

}
