<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Tenant extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function room() : BelongsTo{
        return $this->BelongsTo(Room::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
