@extends('layouts.master')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Inclusions</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">List of Inclusions</h5>
                            <a class="btn btn-secondary" href="{{route('inclusions.create')}}"><i class="bi bi-plus"></i> Add Inclusion</a>
                            <div class="table-responsive">
                            <table class="table table-bordered" id="table">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Edit</th>
                                    <th>Delete</th>

                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($inclusions as $inclusion)
                                        <tr>
                                            <td>{{$inclusion->name ?? ""}}</td>
                                            <td class="text-center">
                                                <a href="{{route('inclusions.edit', [$inclusion->id])}}"><span class="bi bi-pencil" style="pointer-events: none;" aria-hidden="true"></span></a>
                                            </td>
                                            <td class="text-center">
                                                <a  href="{{ route('inclusions.destroy', $inclusion->id) }}" class="btn btn-danger" data-confirm-delete="true">
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
