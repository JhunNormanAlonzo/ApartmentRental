@extends('layouts.master')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Ledgers</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">List of Payments</h5>
                            <a class="btn btn-secondary" href="{{route('ledgers.create')}}"><i class="bi bi-plus"></i> New Entry</a>
                            <div class="table-responsive">
                            <table class="table table-bordered" id="table">
                                <thead>
                                <tr>
                                    <th>Payment Date</th>
                                    <th>Name</th>
                                    <th>Invoice</th>
                                    <th>Amount</th>
                                    <th>Edit</th>
                                    <th>Delete</th>

                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($ledgers as $ledger)
                                        <tr>
                                            <td>{{\Carbon\Carbon::parse($ledger->payment_date)->format('M d, Y') ?? ""}}</td>
                                            <td>{{$ledger->tenant ?? ""}}</td>
                                            <td>{{$ledger->invoice ?? ""}}</td>
                                            <td>{{number_format($ledger->amount, 2) ?? ""}}</td>
                                            <td class="text-center">
                                                <a href="{{route('ledgers.edit', [$ledger->id])}}"><span class="bi bi-pencil" style="pointer-events: none;" aria-hidden="true"></span></a>
                                            </td>
                                            <td class="text-center">
                                                <a  href="{{ route('ledgers.destroy', $ledger->id) }}" class="btn btn-danger" data-confirm-delete="true">
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

    </main>
    @push('scripts')

        <script>
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
