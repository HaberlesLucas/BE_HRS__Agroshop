<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    //
    use HasFactory;

    protected $table = 'imagenes';
    protected $primaryKey = 'id_imagen';

    protected $fillable = [
        'id_producto',
        'url_imagen',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }
}
