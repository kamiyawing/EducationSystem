<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Grade extends Model
{
    use HasFactory;

    public function curriculums(): HasMany
    {
        return $this->hasMany(Curriculum::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}