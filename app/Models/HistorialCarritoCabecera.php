<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialCarritoCabecera extends Model
{
    //
    use HasFactory;

    protected $table = 'historial_carrito_cabecera';

    protected $fillable = [
        'id_user',
        'fecha',
        'precio_total',
    ];

    // public function detalles()
    // {
    //     return $this->hasMany(HistorialCarritoDetalle::class, 'id_historial_cb');
    // }

    public function detalles()
    {
        return $this->hasMany(HistorialCarritoDetalle::class, 'id_historial_cb');
    }
}
