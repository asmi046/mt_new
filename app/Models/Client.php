<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Client extends Model
{
    public $fillable = [
        'fio',
        'phone',
        'email',
        'document_type',
        'document_number'
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(PayOrder::class);
    }
}
