<?php

namespace App\Http\Controllers;

use App\Models\Ledger;
use App\Models\Tenant;
use Illuminate\Http\Request;

class LedgerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ledgers = Ledger::latest()->get();
        dd($ledgers);
        return view('ledger.index', compact('ledgers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Ledger $ledger)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ledger $ledger)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ledger $ledger)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ledger $ledger)
    {
        //
    }


    public function totalPaid($tenantId)
    {
        $tenant = Tenant::find($tenantId);
        $registrationDate = $tenant->registration_date;
        $currentDate = now()->format('Y-m-d');
        return Ledger::where('tenant_id', $tenant->id)
            ->whereBetween('registration_date', [$registrationDate, $currentDate])
            ->sum('amount');
    }


}