<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;


    protected $primaryKey = 'id_user';

    protected $fillable = [
        'id_user',
        'rol_id',
        'nombre',
        'apellido',
        'usuario',
        'password',
        'email',
    ];

    //un usuario tiene UN rol
    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id', 'id_rol');
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    //relacion con carrito 
    public function carritos()
    {
        return $this->hasMany(CarritoCabecera::class, 'id_user', 'id_user');
    }


    //metodos necesarios para la autenticacion JWTAuth
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    //metodos necesarios para la autenticacion JWTAuth - f

}
