<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // A category can contain multiple materials.
    public function materials(): HasMany
    {
        return $this->hasMany(Material::class);
    }

    // A category may be referenced by historical quantity transactions.
    public function transactions(): HasMany
    {
        return $this->hasMany(InwardTransaction::class);
    }
}
