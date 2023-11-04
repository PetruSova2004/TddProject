<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static find(string $id)
 */
class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'occurrences',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function blogs(): BelongsToMany
    {
        return $this->belongsToMany(Blog::class);
    }

}
