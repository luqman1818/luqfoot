<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'users';

    // Clé primaire personnalisée
    protected $primaryKey = 'id_use';

    // Colonnes modifiables en masse
    protected $fillable = [
        'prenom_use',
        'nom_use',
        'adresse_use',
        'email_use',
        'date_naissance_use',
        'mdp_use',
        //'roles_id_rol',
    ];

    // Champs à cacher lors de l’export JSON ou Array
    protected $hidden = [
        'mdp_use',
        'remember_token',
    ];

    // Type des colonnes (si tu veux que certains soient castés automatiquement)
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relation : un utilisateur appartient à un rôle
    
    // public function role()
    // {
    //     return $this->belongsTo(Role::class, 'roles_id_rol', 'id_rol');
    // }
    public $timestamps = false;
}
