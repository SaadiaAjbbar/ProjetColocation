<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepenseParticipant extends Model
{
    use HasFactory;

    protected $fillable = [
        'depense_id', 'user_id', 'montant_du'
    ];

    public function depense()
    {
        return $this->belongsTo(Depense::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }
}
