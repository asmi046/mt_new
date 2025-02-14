<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Client extends Model
{
    public $fillable = [
        'fio',
        'dr',
        'document_type',
        'document_number'
    ];


    protected function dr(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ($value)?date("d.m.Y", strtotime($value)):null,
            set: fn ($value) => ($value)?date("Y-m-d", strtotime($value)):null,
        );
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(PayOrder::class);
    }
}
