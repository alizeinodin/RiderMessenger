<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnonymousMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'ip'
    ];
    protected $hidden = [
        'ip',
    ];

    public function room(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Room::class);
    }
}
