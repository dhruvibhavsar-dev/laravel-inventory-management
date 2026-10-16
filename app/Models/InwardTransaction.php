<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InwardTransaction extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'material_id', 'transaction_date', 'quantity'];

    protected $casts = [
        'transaction_date' => 'date',
        'quantity' => 'decimal:2',
    ];

    // A transaction records the category selected at entry time.
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // A transaction adjusts the balance of one material.
    public function material(): BelongsTo
    {
        return $this->belongsTo(Material::class)->withTrashed();
    }
}
