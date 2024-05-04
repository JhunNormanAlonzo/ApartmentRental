<?php

namespace App\Http\Controllers;

use App\Models\Ledger;
use App\Models\Tenant;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class LedgerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ledgers = Ledger::orderBy('created_at', 'desc')->get();
        return view('ledger.index', compact('ledgers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tenants = Tenant::all();
        return view('ledger.create', compact('tenants'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tenant = Tenant::find($request->tenant_id);
        $userId = $tenant?->user?->id;
        $data = [
            'user_id' => $userId,
            'tenant_id' => $tenant->id,
            'payment_date' => now(),
            'registration_date' => $tenant->registration_date,
            'tenant' => $tenant->user?->name,
            'monthly_rate' => $tenant->room?->price,
            'amount' => $request->amount,
            'invoice' => $request->invoice
        ];
        if (Ledger::create($data)){
            Alert::success('Success', "Payment posted successfully!");
            return redirect()->route('ledgers.index');
        }
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


    public function getTenantPaymentList(Tenant $tenant)
    {
        return response()->json($tenant->ledgers());

    }



}
