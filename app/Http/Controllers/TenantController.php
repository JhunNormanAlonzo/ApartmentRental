<?php

namespace App\Http\Controllers;

use App\Models\Ledger;
use App\Models\Room;
use App\Models\Tenant;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        confirmDelete("Delete", "Are you sure you want to delete?");
        $tenants = Tenant::all();
        return view('tenant.index', compact('tenants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rooms = Room::whereColumn('max_pax', '>', 'current_pax')->get();
        return view('tenant.create', compact('rooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'contact_number' => 'required',
            'address' => 'required',
            'registration_date' => 'required',
        ]);
        $user = User::create($request->all());
        $role = Role::where('name', 'Tenant')->first();
        $user->assignRole($role);
        $tenant = Tenant::create([
            'user_id' => $user->id,
            'room_id' => $request->room_id,
            'contact_number' => $request->contact_number,
            'address' => $request->address,
            'registration_date' => $request->registration_date,
        ]);

        if ($tenant){
            $this->storeFirstLedgerEntry($tenant->id);
            Alert::success('Success', "Tenant created successfully!");
            return redirect()->route('tenants.index');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Tenant $tenant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tenant $tenant)
    {
        $rooms = Room::whereColumn('max_pax', '>', 'current_pax')->get();
        return view('tenant.edit', compact('tenant', 'rooms'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tenant $tenant)
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$tenant->user->id,
            'contact_number' => 'required',
            'address' => 'required',
        ]);
        $passwordData = [
            'name' => $request->name,
            'email' => $request->email,
        ];
        if (!empty($request->password)) {
            $passwordData['password'] = $request->password;
        }
        $tenant->user->update($passwordData);

        $tenant = $tenant->update([
            'room_id' => $request->room_id,
            'contact_number' => $request->contact_number,
            'address' => $request->address,
            'registration_date' => $request->registration_date,
        ]);

        if ($tenant){
            Alert::success('Success', "Tenant updated successfully!");
            return redirect()->route('tenants.index');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant)
    {
        $userDeleted = $tenant->user->delete();

        // Delete the tenant
        if ($userDeleted) {
            $tenant->delete();
            Alert::success("Success", "Deleted Successfully!");
        } else {
            Alert::error("Error", "Failed to delete user!");
        }

        return redirect()->route('tenants.index');
    }

    public function getTenantInfo(Request $request): \Illuminate\Http\JsonResponse
    {
        $tenantId = $request->tenantId;
        $tenant = Tenant::with(['user', 'room'])->where('id', $tenantId)->first();

        $tenant->balance = $this->totalBalance($tenantId);
        $tenant->total_paid = number_format($this->totalPaid($tenantId), 2);
        $tenant->payable_month = $this->totalPayableMonth($tenantId);
        return response()->json($tenant);
    }

    public function totalPaid($tenantId) : int
    {
        $tenant = Tenant::find($tenantId);
        $registrationDate = $tenant->registration_date;
        $currentDate = now()->format('Y-m-d');
        return Ledger::where('tenant_id', $tenant->id)
            ->whereBetween('registration_date', [$registrationDate, $currentDate])
            ->sum('amount');
    }

    public function totalPayableMonth($tenantId) : int
    {
        $tenant = Tenant::find($tenantId);
        $registrationDate = Carbon::parse($tenant->registration_date);
        $now = Carbon::now();
        $totalMonths = $registrationDate->diffInMonths($now, false);
        if ($registrationDate->month === $now->month && $registrationDate->year === $now->year) {
            $totalMonths++; // Add 1 to account for the current month
        }
        $totalPaidMonths = $this->totalPaid($tenantId) / $tenant->room->price;
        return $totalMonths - $totalPaidMonths;
    }

    public function totalMonthlyRate($tenantId) : int
    {
        $tenant = Tenant::find($tenantId);
        $registrationDate = $tenant->registration_date;
        $currentDate = now()->format('Y-m-d');
        return Ledger::where('tenant_id', $tenant->id)
            ->whereBetween('registration_date', [$registrationDate, $currentDate])
            ->sum('monthly_rate');
    }

    public function totalBalance($tenantId) : int
    {
        $totalMonthlyRate = $this->totalMonthlyRate($tenantId);
        $totalPaid = $this->totalPaid($tenantId);
        return $totalMonthlyRate - $totalPaid;
    }

    public function storeFirstLedgerEntry($tenantId): void
    {
        $tenant = Tenant::find($tenantId);
        $user = $tenant->user;
        $room = $tenant->room;
        $monthlyRate = $room->price;
        Ledger::create([
            'user_id' => $user->id,
            'tenant_id' => $tenant->id,
            'payment_date' => now()->format('Y-m-d'),
            'registration_date' => now()->format('Y-m-d'),
            'tenant' => $user->name,
            'monthly_rate' => $monthlyRate,
            'amount' => 0,
            'balance' => $monthlyRate,
            'invoice' => 'first entry',
        ]);
    }

}
