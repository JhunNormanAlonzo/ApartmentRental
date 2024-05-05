<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function balance() : float
    {
        return $this->monthlyRate() * $this->totalPayableMonth() - $this->totalPaid();

    }

    /**
     * Calculate the total amount paid by the tenant.
     *
     * @return float
     */


    public function totalPayableMonth() : int
    {
        $registrationDate = Carbon::parse($this->registration_date);
        $now = Carbon::now();
        return $now->diffInMonths($registrationDate);
    }

    public function totalPaid() : float
    {
        return $this->ledgers()
            ->whereBetween('registration_date', [$this->registration_date, Carbon::now()->format('Y-m-d')])
            ->sum('amount');
    }

    public function monthlyRate()
    {
        return $this->room?->price ?? 0;
    }

    public function lastPayment()
    {

    }

    public function ledgers() : HasMany
    {
        return $this->hasMany(Ledger::class);
    }


}
