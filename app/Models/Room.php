<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Room extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function tenant() : BelongsToMany
    {
        return $this->belongsToMany(Tenant::class);
    }

    public function inclusions() : BelongsToMany {
        return $this->belongsToMany(Inclusion::class);
    }
}
