<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shirt extends Model
{
    use HasFactory;

    // Nom de la table (facultatif ici, Laravel peut le deviner)
    protected $table = 'shirts';

    // Clé primaire personnalisée
    protected $primaryKey = 'id_shi';

    // Colonnes modifiables en masse
    protected $fillable = [
        'nom_shi',
        'taille_shi',
        'prix_shi',
    ];

    // Si tu veux cacher des champs lors du retour JSON
    // protected $hidden = [];

    // Exemple de relation : une chemise peut être dans plusieurs commandes
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_shirts', 'shirts_id_shi', 'orders_id_ord');
    }
    public $timestamps = false;
}
