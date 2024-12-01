<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarritoDetalle extends Model
{
    // CarritoDetalle CarritoDetalle CarritoDetalle CarritoDetalle CarritoDetalle CarritoDetalle CarritoDetalle 

    use HasFactory;

    protected $table = 'carrito_detalle';
    protected $primaryKey = 'id_carrito_dt';
    protected $fillable = [
        'cantidad',
        'precio_unitario',
        'id_carrito_cb',
        'id_producto'
    ];

    //realacion con carrito cabecera 
    public function carritoCabecera()
    {
        return $this->belongsTo(CarritoCabecera::class, 'id_carrito_cb', 'id_carrito_cb');
    }

    //relacion con producto 
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }
    
}
