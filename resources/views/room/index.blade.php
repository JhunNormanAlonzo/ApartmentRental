@extends('layouts.master')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Rooms</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">List of Rooms</h5>
                            <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addRoomModal"><i class="bi bi-plus"></i> Add Room</button>
                            <div class="table-responsive">
                            <table class="table" id="table">
                                <thead>
                                <tr>
                                    <th>Room</th>
                                    <th>Description</th>
                                    <th>Pax</th>
{{--                                    <th>Current Pax</th>--}}
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($rooms as $room)
                                        <tr>
                                            <td>{{$room->title}}</td>
                                            <td>{!! $room->description !!}</td>
                                            <td>{{$room->max_pax}}</td>
{{--                                            <td>{{$room->current_pax}}</td>--}}
                                            <td>{{$room->price}}</td>
                                            <td>{{$room->status ? "Occupied" : "Available"}}</td>

                                            <td>
                                                <a href="{{route('rooms.edit', [$room->id])}}"><span class="bi bi-pencil" style="pointer-events: none;" aria-hidden="true"></span></a>
                                            </td>
                                            <td>
                                                <a  href="{{ route('rooms.destroy', $room->id) }}" class="btn btn-danger" data-confirm-delete="true">
                                                    <span class="bi bi-trash" style="pointer-events: none;" aria-hidden="true"></span>
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

        <div class="modal fade" id="assignTenantModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Select Tenant
                        </h5>
                    </div>
                    <div class="modal-body">
                        <x-input id="current_pax" name="current_pax" type="number" placeholder="Current Pax" value="{{old('current_pax')}}">
                            <x-validation-error name="current_pax"></x-validation-error>
                        </x-input>
                    </div>
                </div>
            </div>
        </div>

        @include('room.create')
    </main>
    @push('scripts')

        <script>


            $(document).ready(function(){



                $("#table").DataTable();
                @if($errors->any())
                    new bootstrap.Modal($("#addRoomModal")).show();
                @endif


                tinymce.init({
                    selector: '.tinymce',  // change this value according to your HTML
                    menubar : false,
                    width : '100%',
                    toolbar: 'fontfamily fontsizeinput | bold italic underline forecolor backcolor | alignleft aligncenter aligntright alignjustify | bullist numlist outdent indent',
                });
            })
        </script>
    @endpush
@endsection
