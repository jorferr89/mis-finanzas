<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['descripcion','monto', 'fecha', 'user_id', 'categoria_id'];

    protected $table = 'transacciones';

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function categoria() {
        return $this->belongsTo(Categoria::class);
    }
}
