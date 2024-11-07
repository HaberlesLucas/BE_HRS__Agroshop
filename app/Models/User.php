<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */ 
    use HasFactory, Notifiable;


    protected $primaryKey = 'id_user';

    protected $fillable = [
        'id_user',
        'nombre',
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
}
