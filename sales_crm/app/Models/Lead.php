<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Lead extends Model
{
    protected $fillable = [
        'user_id', 'name', 'email', 'phone', 'company', 
        'source', 'status', 'expected_value'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function followUps(): HasMany
    {
        return $this->hasMany(FollowUp::class);
    }
}
