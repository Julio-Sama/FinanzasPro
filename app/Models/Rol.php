<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $table = 'rol';

    protected $primaryKey = 'id_rol';

    protected $fillable = [
        'nom_rol',
    ];

    /**
     * Relación con el modelo Usuario.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    // public function usuarios()
    // {
    //     return $this->hasMany(Usuario::class, 'id_rol', 'id_rol');
    // }
}
