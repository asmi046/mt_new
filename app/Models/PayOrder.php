<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PayOrder extends Model
{
    public $fillable = [
        'uuid',
        "type",
        "status",
        "name",
        'img',
        'price'
    ];

    public function clients(): HasMany
    {
        return $this->hasMany(Client::class);
    }
}
