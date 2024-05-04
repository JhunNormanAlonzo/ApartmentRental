@extends('layouts.master')
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Room Inclusion</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Update Inclusion</h5>
                            <a class="btn btn-secondary" href="{{route('rooms.index')}}"><i class="bi bi-back"></i> Back to room lists</a>



                            <form action="{{route('rooms.updateInclusions', [$room->id])}}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    @foreach($inclusions as $inclusion)
                                        @php
                                            $isChecked = $room->inclusions->contains($inclusion->id);
                                        @endphp
                                    <div class="col-3 mt-2">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="inclusion_{{ $inclusion->id }}" name="inclusions[]" value="{{ $inclusion->id }}" {{ $isChecked ? 'checked' : '' }}>
                                            <label class="form-check-label" for="inclusion_{{ $inclusion->id }}">{{ $inclusion->name }}</label>
                                        </div>
                                    </div>
                                    @endforeach
                                    <div class="col-12 mt-2">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </section>


        <form action="{{route('rooms.store')}}" method="POST">
            @csrf
            <div class="modal fade" data-bs-backdrop="static" id="addRoomModal">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                Add Room
                            </h5>
                            <button type="button" class="btn btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12 mt-2">
                                    <x-input id="title" name="title" type="text" placeholder="Room # (eg. Room 1)" value="{{old('title')}}">
                                        <x-validation-error name="title"></x-validation-error>
                                    </x-input>
                                </div>
                                <div class="col-12 mt-2">
                                    <textarea class="tinymce form-select @error('description') is-invalid @enderror" name="description" placeholder="Description"></textarea>
                                    <x-validation-error name="description"></x-validation-error>
                                </div>

                                <div class="col-4 mt-2">
                                    <x-input id="pax" name="pax" type="number" placeholder="Pax" value="{{old('pax')}}">
                                        <x-validation-error name="pax"></x-validation-error>
                                    </x-input>
                                </div>

                                <div class="col-4 mt-2">
                                    <x-input id="amount" name="amount" type="number" placeholder="Amount" value="{{old('amount')}}">
                                        <x-validation-error name="amount"></x-validation-error>
                                    </x-input>
                                </div>

                                <div class="col-4 mt-2">
                                    <div class="form-floating">
                                        <select name="occupied" id="occupied" class="form-select @error('occupied') is-invalid @enderror">
                                            <option value="0">Not Occupied</option>
                                            <option value="1">Occupied</option>
                                        </select>
                                        <label for="occupied" class="text-muted">Status</label>
                                        <x-validation-error name="occupied"></x-validation-error>
                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>
    @push('scripts')

        <script>
            $(document).ready(function(){
                $("#table").DataTable();
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


