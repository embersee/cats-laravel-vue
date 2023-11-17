<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Breed
 *
 * @mixin Builder
 */
class Breed extends Model
{
    use HasFactory;

    // Mass assignable attributes
    protected $fillable = ['name', 'description', 'average_life_expectancy'];

    // Define relationship with Cat
    public function cats(): HasMany
    {
        return $this->hasMany(Cat::class);
    }
}
