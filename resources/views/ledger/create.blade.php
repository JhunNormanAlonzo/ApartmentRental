@extends('layouts.master')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Invoice</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">New Invoice</h5>
                            <a class="btn btn-secondary" href="{{route('ledgers.index')}}"><i class="bi bi-back"></i> Back to payment lists</a>

                            <form action="{{route('ledgers.store')}}" method="POST">
                                @csrf

                                <div class="row">
                                    <div class="col-12 mt-2">
                                        <div class="form-floating">
                                            <select class="form-select" onchange="viewTenantInfo()" name="tenant_id" id="tenant_id" aria-label="Floating label select example">
                                                <option selected disabled>None</option>
                                                @foreach($tenants as $tenant)
                                                    <option value="{{$tenant->id}}">{{$tenant->user->name}}</option>
                                                @endforeach
                                            </select>
                                            <label for="tenant_id">Select Tenants</label>
                                        </div>
                                    </div>
                                    <div class="col-12" id="tenant_info">
                                        <br>
                                        <span class="fw-bold text-secondary">Details</span>
                                        <hr>
                                        <div class="row">
                                            <div class="col-12 mt-2">
                                                Tenant : <span class="fw-bold" id="tenant-name"></span>
                                            </div>
                                            <div class="col-12 mt-2">
                                                Monthly Rate : <span class="fw-bold" id="tenant-monthly-rate"></span>
                                            </div>
                                            <div class="col-12 mt-2">
                                                Balance : <span class="fw-bold" id="tenant-balance"></span>
                                            </div>
                                            <div class="col-12 mt-2">
                                                Total Paid : <span class="fw-bold" id="tenant-total-paid"></span>
                                            </div>
                                            <div class="col-12 mt-2">
                                                Rent Started : <span class="fw-bold" id="tenant-registration-date"></span>
                                            </div>
                                            <div class="col-12 mt-2">
                                                Payable Month : <span class="fw-bold" id="tenant-payable-month"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6 mt-2">
                                        <x-input id="invoice" name="invoice" type="text" placeholder="Invoice" value="{{old('invoice')}}">
                                            <x-validation-error name="invoice"></x-validation-error>
                                        </x-input>
                                    </div>

                                    <div class="col-6 mt-2">
                                        <x-input id="amount" name="amount" type="text" placeholder="Amount" value="{{old('amount')}}">
                                            <x-validation-error name="amount"></x-validation-error>
                                        </x-input>
                                    </div>


                                    <div class="col-12 mt-2">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>



                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>



    </main>

    @push('scripts')
        <script>
            $("#tenant_info").hide();
            function viewTenantInfo() {

                let tenantId = $("#tenant_id").val();

                $.ajax({
                    url: "{{route('tenants.get-tenant-info')}}",
                    method: "GET",
                    data: {
                        tenantId: tenantId
                    },
                    success: function (response) {
                        $("#tenant-name").text(response.user.name);
                        $("#tenant-monthly-rate").text(response.monthly_rate);
                        $("#tenant-balance").text(response.balance);
                        $("#tenant-total-paid").text(response.total_paid);
                        $("#tenant-registration-date").text(response.registration_date);
                        $("#tenant-payable-month").text(response.payable_month);
                        $("#tenant_info").show();
                    }
                });
            }
        </script>
    @endpush


@endsection
