<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'usuario';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_usuario';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom_usuario',
        'nick_usuario',
        'pass_usuario',
        'id_rol',
    ];

    /**
     * Relación con el modelo Rol.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol', 'id_rol');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'pass_usuario',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'nick_usuario_verified_at' => 'datetime',
    ];



    /**
     * Verifica si el usuario tiene el rol especificado.
     *
     * @param string $role
     * @return bool
     */
    public function hasRole($role)
    {
        // Cambié la comparación para verificar el nombre del rol
        return optional($this->rol)->nom_rol === $role;
    }

    public function getAuthPassword()
    {
        return $this->pass_usuario;
    }

    public function getAuthIdentifierName()
    {
        return 'nick_usuario';
    }
}
