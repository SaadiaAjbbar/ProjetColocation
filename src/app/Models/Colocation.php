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

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function adhesions()
    {
        return $this->hasMany(Adhesion::class);
    }

    public function depenses()
    {
        return $this->hasMany(Depense::class);
    }

    public function invitations()
    {
        return $this->hasMany(Invitation::class);
    }
}
