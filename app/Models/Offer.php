<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Offer extends Model
{
    //
    protected $fillable = [
        'user_id',
        'title',
        'company_name',
        'location',
        'contract_type',
        'description',
        'salary',
    ];

    // une offre appartient a un recruteur
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
