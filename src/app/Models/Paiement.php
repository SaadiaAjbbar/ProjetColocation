<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    use HasFactory;

    protected $fillable = [
        'depense_participant_id', 'montant', 'date_paiement'
    ];

    public function depenseParticipant()
    {
        return $this->belongsTo(DepenseParticipant::class);
    }
}
