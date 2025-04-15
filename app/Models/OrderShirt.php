<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderShirt extends Model
{
    use HasFactory;

    // Table associée
    protected $table = 'orders_shirts';

    // La table n'a pas de clé primaire classique
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false; // à mettre si ta table n'a pas de colonnes created_at / updated_at

    // Champs modifiables
    protected $fillable = [
        'shirts_id_shi',
        'orders_id_ord',
        'quantite_ord_shi',
    ];

    // Relations vers Order et Shirt
    public function order()
    {
        return $this->belongsTo(Order::class, 'orders_id_ord', 'id_ord');
    }

    public function shirt()
    {
        return $this->belongsTo(Shirt::class, 'shirts_id_shi', 'id_shi');
    }
}
