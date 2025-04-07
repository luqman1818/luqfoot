<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderShirt extends Model
{
    use HasFactory;

     // Nom de la table pivot
     protected $table = 'order_shirts';

     // Définir les clés primaires et étrangères de la table pivot
     protected $primaryKey = null;  // Pas de clé primaire dans la table pivot
     public $incrementing = false;  // La table pivot n'a pas de champ auto-incrémenté
 
     // Colonnes modifiables en masse (facultatif)
     protected $fillable = [
         'shirts_id_shi',
         'orders_id_ord',
     ];
}
