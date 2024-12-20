<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    //
    use HasFactory;

    protected $table = 'productos';
    protected $primaryKey = 'id_producto';
    
    public $timestamps = true;

    protected $fillable = [
        'codigo',
        'nombre',
        'descripcion',
        'precio_compra',
        'incremento',
        'id_categoria',
        'stock',
        'stock_min',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id_categoria');
    }

    public function imagenes()
    {
        return $this->hasMany(Imagen::class, 'id_producto', 'id_producto');
    }
}
