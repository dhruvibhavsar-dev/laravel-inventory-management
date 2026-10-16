<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Material extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['category_id', 'name', 'opening_balance'];

    protected $casts = [
        'opening_balance' => 'decimal:2',
    ];

    // Each material belongs to one category.
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Keep the complete inward/outward transaction history for this material.
    public function transactions(): HasMany
    {
        return $this->hasMany(InwardTransaction::class);
    }

    // Current balance = opening balance + all signed quantity movements.
    public function getCurrentBalanceAttribute(): float
    {
        return (float) $this->opening_balance
            + (float) $this->transactions()->sum('quantity');
    }
}
