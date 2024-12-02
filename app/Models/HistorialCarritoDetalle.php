<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialCarritoDetalle extends Model
{
    //
    use HasFactory;

    protected $table = 'historial_carrito_detalle';

    protected $fillable = [
        'id_historial_cb',
        'id_producto',
        'cantidad',
        'precio_unitario',
    ];


    public function historialCarritoCabecera()
    {
        return $this->belongsTo(HistorialCarritoCabecera::class, 'id_historial_cb');
    }
}
