<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function depenses()
    {
        return $this->hasMany(Depense::class);
    }

    public function colocation()
    {
        return $this->belongsTo(Colocation::class);
    }
}
