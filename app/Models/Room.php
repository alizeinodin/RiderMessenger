<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    public function anonymousMessages(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(AnonymousMessage::class);
    }
}
