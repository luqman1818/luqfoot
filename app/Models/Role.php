<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $table = 'roles';

    // Clé primaire personnalisée
    protected $primaryKey = 'id_rol';

    // Colonnes autorisées pour les insertions/updates en masse
    protected $fillable = [
        'nom_role_rol',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'roles_id_rol', 'id_rol');
    }

    public $timestamps = false;
}
