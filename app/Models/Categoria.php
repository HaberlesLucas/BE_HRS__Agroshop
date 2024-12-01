<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categoria extends Model
{
    //
    use HasFactory;

    protected $table = 'categorias';
    protected $primaryKey = 'id_categoria'; //especifico la clave primaria personalizada 
    public $incrementing = true; //confirmo que se trata de ids autoincremental 
    protected $keyType = 'int'; //especifico el tipo de dato de la clave primaria
    protected $fillable = ['nombre_categoria'];

    //relacion con producto 
    public function productos()
    {
        return $this->hasMany(Producto::class, 'id_categoria', 'id_categoria');
    }
}
