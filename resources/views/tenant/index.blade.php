@extends('layouts.master')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Tenants</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">List of Tenants</h5>
                            <a class="btn btn-secondary" href="{{route('tenants.create')}}"><i class="bi bi-plus"></i> Add Tenant</a>
                            <div class="table-responsive">
                            <table class="table" id="table">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Room</th>
                                    <th>Rate</th>
                                    <th>Balance</th>
                                    <th>LastPayment</th>
                                    <th>Contact Number</th>
                                    <th>Address</th>
                                    <th>Registration</th>
                                    <th>View</th>
                                    <th>Edit</th>
                                    <th>Delete</th>

                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($tenants as $tenant)
                                        <tr>
                                            <td>{{$tenant->user->name ?? ""}}</td>
                                            <td>{{$tenant->user->email ?? ""}}</td>
                                            <td>{{$tenant->room->title ?? ""}}</td>
                                            <td>{{number_format($tenant->room->price) ?? ""}}</td>
                                            <td>{{$tenant->ledger->balance ?? "N/A"}}</td>
                                            <td>{{$tenant->ledger->lastPayment ?? "N/A"}}</td>
                                            <td>{{$tenant->contact_number ?? ""}}</td>
                                            <td>{!! $tenant->address ?? "" !!}</td>
                                            <td>{{$tenant->registration_date ?? ""}}</td>

                                            <td class="text-center">
                                                <a onclick="viewTenant({{$tenant->id}})" type="button"><span class="bi bi-eye-fill text-info"></span></a>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{route('tenants.edit', [$tenant->id])}}"><span class="bi bi-pencil" style="pointer-events: none;" aria-hidden="true"></span></a>
                                            </td>
                                            <td class="text-center">
                                                <a  href="{{ route('tenants.destroy', $tenant->id) }}" class="btn btn-danger" data-confirm-delete="true">
                                                    <span class="bi bi-trash" style="pointer-events: none;"></span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="modal fade" id="tenantInfoModal">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Tenant's Information
                        </h5>
                        <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-4">
                                <span class="fw-bold text-secondary">Details</span>
                                <hr>
                                <div class="row">
                                    <div class="col-12">
                                        Tenant : <span class="fw-bold" id="tenant-name"></span>
                                    </div>
                                    <div class="col-12">
                                        Monthly Rate : <span class="fw-bold" id="tenant-monthly-rate"></span>
                                    </div>
                                    <div class="col-12">
                                        Balance : <span class="fw-bold" id="tenant-balance"></span>
                                    </div>
                                    <div class="col-12">
                                        Total Paid : <span class="fw-bold" id="tenant-total-paid"></span>
                                    </div>
                                    <div class="col-12">
                                        Rent Started : <span class="fw-bold" id="tenant-registration-date"></span>
                                    </div>
                                    <div class="col-12">
                                        Payable Month : <span class="fw-bold" id="tenant-payable-month"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-8">
                                <span class="fw-bold text-secondary">Payment List</span>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @push('scripts')

        <script>

            function viewTenant(tenantId){
                let tenantInfoModal = new bootstrap.Modal($("#tenantInfoModal"));


                $.ajax({
                    url : "{{route('tenants.get-tenant-info')}}",
                    method : "GET",
                    data : {
                        tenantId : tenantId
                    },
                    success : function (response){
                        // console.log(response);
                        $("#tenant-name").text(response.user.name);
                        $("#tenant-monthly-rate").text(response.monthly_rate);
                        $("#tenant-balance").text(response.balance);
                        $("#tenant-total-paid").text(response.total_paid);
                        $("#tenant-registration-date").text(response.registration_date);
                        $("#tenant-payable-month").text(response.payable_month);
                    }
                })

                tenantInfoModal.show();
            }
            $(document).ready(function(){
                $("#table").DataTable();
                tinymce.init({
                    selector: '.tinymce',  // change this value according to your HTML
                    menubar : false,
                    width : '1000px',
                    toolbar: 'fontfamily fontsizeinput | bold italic underline forecolor backcolor | alignleft aligncenter aligntright alignjustify | bullist numlist outdent indent',
                });
            })
        </script>
    @endpush
@endsection
