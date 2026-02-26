<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'owner_id', 'status'
    ];

    // Relation: Colocation a un owner
    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    // Relation: Colocation a plusieurs membres (adhesions)
    public function adhesions()
    {
        return $this->hasMany(Adhesion::class);
    }

    // Relation: Colocation a plusieurs depenses
    public function depenses()
    {
        return $this->hasMany(Depense::class);
    }

    // Relation: Colocation a plusieurs invitations
    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }
}
