<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    //
    protected $table = 'rols';
    protected $primaryKey = 'id_rol'; 
    public $timestamps = true;
    protected $fillable = ['nombre_rol'];

    //un rol tiene MUCHOS usuarios
    public function users()
    {
        return $this->hasMany(User::class, 'rol_id', 'id_rol');
    }

}
