<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarritoCabecera extends Model
{
    // CarritoCabecera CarritoCabecera CarritoCabecera CarritoCabecera CarritoCabecera CarritoCabecera CarritoCabecera 
    use HasFactory;

    protected $table = 'carrito_cabecera';
    protected $primaryKey = 'id_carrito_cb';

    protected $fillable = [
        'fecha',
        'precio_total',
        'id_user',
    ];

    //relacionar con usuario
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    //relacionar con carrito detalle 
    public function detalles()
    {
        return $this->hasMany(CarritoDetalle::class, 'id_carrito_cb', 'id_carrito_cb');
    }
}
