<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'reputation', 'is_banni'
    ];

    protected $hidden = [
        'password',
    ];

    // Relation: User peut avoir plusieurs Adhesions (membership)
    public function adhesions()
    {
        return $this->hasMany(Adhesion::class);
    }

    // Relation: User peut posséder plusieurs colocations (owner role)
    public function colocationsOwn()
    {
        return $this->hasMany(Colocation::class, 'owner_id');
    }

    // Relation: Depenses payées par user
    public function depensesPayees()
    {
        return $this->hasMany(Depense::class, 'payer_id');
    }

    // Relation: DepenseParticipant pour savoir combien user doit
    public function depenseParticipants()
    {
        return $this->hasMany(DepenseParticipant::class);
    }

    // Relation: Invitations envoyées par user
    public function invitationsSent()
    {
        return $this->hasMany(Invitation::class, 'invited_by');
    }

    // Vérifier si admin global
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}
