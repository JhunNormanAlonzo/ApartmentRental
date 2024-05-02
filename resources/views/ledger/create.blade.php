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
                        <div class="col-6 mt-2">
                            <x-input id="title" name="title" type="text" placeholder="Room # (eg. Room 1)" value="{{old('title')}}">
                                <x-validation-error name="title"></x-validation-error>
                            </x-input>
                        </div>

                        <div class="col-6 mt-2">
                            <x-input id="price" name="price" type="number" placeholder="Price" value="{{old('price')}}">
                                <x-validation-error name="price"></x-validation-error>
                            </x-input>
                        </div>
                        <div class="col-12 mt-2">
                            <textarea class="tinymce form-select @error('description') is-invalid @enderror" name="description" placeholder="Description"></textarea>
                            <x-validation-error name="description"></x-validation-error>
                        </div>

                        <div class="col-4 mt-2">
                            <x-input id="max_pax" name="max_pax" type="number" placeholder="Max Pax" value="{{old('max_pax')}}">
                                <x-validation-error name="max_pax"></x-validation-error>
                            </x-input>
                        </div>

                        <div class="col-4 mt-2 d-none">
                            <x-input id="current_pax" name="current_pax" type="number" placeholder="Current Pax" value="{{old('current_pax')}}">
                                <x-validation-error name="current_pax"></x-validation-error>
                            </x-input>
                        </div>



                        <div class="col-4 mt-2">
                            <div class="form-floating">
                                <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                                    <option value="0">Not Available</option>
                                    <option value="1">Available</option>
                                </select>
                                <label for="status" class="text-muted">Status</label>
                                <x-validation-error name="status"></x-validation-error>
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
