<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    // Clé primaire personnalisée
    protected $primaryKey = 'id_ord';

    // Colonnes modifiables en masse
    protected $fillable = [
        'date_ord',
        'users_id_use',
    ];

    // Si tu veux cacher des champs lors du retour JSON
    // protected $hidden = [];

    // Relation : une commande appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id_use', 'id_use');
    }
    public $timestamps = false;
}
