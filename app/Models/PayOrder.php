<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PayOrder extends Model
{
    public $fillable = [
        'uuid',
        "type",
        "status",
        "name",
        "start_data",
        "email",
        "phone",
        'img',
        'price'
    ];


    protected function startData(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ($value)?date("d.m.Y", strtotime($value)):null,
            set: fn ($value) => ($value)?date("Y-m-d", strtotime($value)):null,
        );
    }

    public function clients(): HasMany
    {
        return $this->hasMany(Client::class);
    }
}
