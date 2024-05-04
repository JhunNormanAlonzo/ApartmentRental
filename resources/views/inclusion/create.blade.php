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
                            <h5 class="card-title">Add Inclusions</h5>
                            <a class="btn btn-secondary" href="{{route('inclusions.index')}}"><i class="bi bi-back"></i> Back to inclusion lists</a>

                            <form action="{{route('inclusions.store')}}" method="POST">
                                @csrf

                                <div class="row">
                                    <div class="col-12 mt-2">
                                        <x-input id="name" name="name" type="text" placeholder="Name" value="{{old('name')}}">
                                            <x-validation-error name="name"></x-validation-error>
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
@endsection
