<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Cat
 *
 * @mixin Builder
 */
class Cat extends Model
{
    use HasFactory;

    // Mass assignable attributes
    protected $fillable = ['name', 'image', 'age', 'breed_id'];

    // Define relationship with Breed
    public function breed(): BelongsTo
    {
        return $this->belongsTo(Breed::class);
    }
}
