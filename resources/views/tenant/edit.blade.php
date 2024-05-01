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
                            <h5 class="card-title">Update Tenant</h5>
                            <a class="btn btn-secondary" href="{{route('tenants.index')}}"><i class="bi bi-back"></i> Back to tenant lists</a>

                            <form action="{{route('tenants.update', [$tenant->id])}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-6 mt-2">
                                        <x-input id="name" name="name" type="text" placeholder="Name" value="{{$tenant->user->name}}">
                                            <x-validation-error name="name"></x-validation-error>
                                        </x-input>
                                    </div>
                                    <div class="col-6 mt-2">
                                        <x-input id="email" name="email" type="text" placeholder="Email" value="{{$tenant->user->email}}">
                                            <x-validation-error name="email"></x-validation-error>
                                        </x-input>
                                    </div>
                                    <div class="col-6 mt-2">
                                        <x-input id="password" name="password" type="text" placeholder="Password" value="">
                                            <x-validation-error name="password"></x-validation-error>
                                        </x-input>
                                    </div>

                                    <div class="col-6 mt-2">
                                        <x-input id="contact_number" name="contact_number" type="tel" placeholder="Contact Number" value="{{$tenant->contact_number}}">
                                            <x-validation-error name="contact_number"></x-validation-error>
                                        </x-input>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <textarea class="tinymce form-select @error('address') is-invalid @enderror" name="address" placeholder="Address">{{$tenant->address}}</textarea>
                                        <x-validation-error name="address"></x-validation-error>
                                    </div>
                                    <div class="col-6 mt-2">
                                        <div class="form-floating">
                                            <select name="room_id" id="room_id" class="form-select @error('room_id') is-invalid @enderror">
                                                @foreach($rooms as $room)
                                                    <option @if($tenant->room_id == $room->id) selected @endif value="{{$room->id}}">{{$room->title}}</option>
                                                @endforeach
                                            </select>
                                            <label for="status" class="text-muted">Room</label>
                                            <x-validation-error name="room_id"></x-validation-error>
                                        </div>
                                    </div>

                                    <div class="col-6 mt-2">
                                        <x-input id="registration_date" name="registration_date" type="text" placeholder="Registration Date" value="{{$tenant->registration_date}}">
                                            <x-validation-error name="registration_date"></x-validation-error>
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
    @push('styles')
        <link rel="stylesheet" href="{{asset('flatpicker.css')}}">
    @endpush
    @push('scripts')

        <script src="{{asset('flatpicker.js')}}"></script>
        <script>
            $(document).ready(function(){
                $("#table").DataTable();
                tinymce.init({
                    selector: '.tinymce',  // change this value according to your HTML
                    menubar : false,
                    width : '100%',
                    height : '200px',
                    toolbar: 'fontfamily fontsizeinput | bold italic underline forecolor backcolor | alignleft aligncenter aligntright alignjustify | bullist numlist outdent indent',
                });
            })
        </script>


        <script>
            flatpickr("#registration_date", {});
        </script>
    @endpush
@endsection
