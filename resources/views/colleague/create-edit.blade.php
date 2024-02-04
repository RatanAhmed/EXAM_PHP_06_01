@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body pb-4">
                    <form class="form-horizontal" action="{{ route($store_route) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input hidden name="id" value="{{ $data->id ?? '' }}" readonly>
                        <div class="row justify-content-center">
                            <div class="col-6">
                                <h4 class="mb-3 header-title mb-4 mt-0">{{ $page_title }}</h4>
                                <div class="row mb-3">
                                    <div>
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6 col-xl-6 mb-2">
                                                <label for="office_name" class="col-form-label">Office Name</label>
                                                <input id="office_name" name="office_name" value="{{ $data->office_name ?? old('office_name') }}" class="form-control" rows="5" placeholder="Office Name" required>
                                                @error('office_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-xl-6 mb-2">
                                                <label for="office_address" class="col-form-label">Office Address</label>
                                                <input id="office_address" name="office_address" value="{{ $data->office_address ?? old('office_address') }}" class="form-control" rows="5" placeholder="Office Address" required>
                                                @error('office_address')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-xl-6 mb-2">
                                                <label for="office_phone" class="col-form-label">Office Phone</label>
                                                <input id="office_phone" name="office_phone" value="{{ $data->office_phone ?? old('office_phone') }}" class="form-control" rows="5" placeholder="Office Phone" required>
                                                @error('office_phone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-xl-6 mb-2">
                                                <label for="appointment_letter" class="col-form-label">Appintment Letter</label>
                                                <input id="appointment_letter" type="file" name="appointment_letter" value="{{ $data->appointment_letter ?? old('appointment_letter') }}" class="form-control" rows="5" placeholder="Appintment Letter" required>
                                                @error('appointment_letter')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <h4 class="mb-3 header-title mb-4 mt-0">Office Colleague</h4>
                                    <div>
                                        @if(isset($data->colleagues))
                                        @foreach($data->colleagues as $key => $colleague)
                                        <div id="clonedInput{{ $loop->iteration != 1 ? $loop->iteration : '' }}" class="row clonedInput">
                                            <div class="actions d-flex justify-content-end">
                                                <a href="javascript:void(0)" class="btn btn-sm btn-success clone mx-1">Clone</a> 
                                                <a class="remove btn btn-sm btn-danger ">Remove</a>
                                            </div>
                                            <input hidden name="uuid[]" value="{{ $colleague->uuid ?? '' }}" readonly>
                                            <div class="col-md-6 col-lg-6 col-xl-6 mb-2">
                                                <label for="colleague_name" class="col-form-label">Colleague Name</label>
                                                <input id="colleague_name" name="colleague_name[]" value="{{ $colleague->colleague_name ?? old('colleague_name') }}" class="form-control" rows="5" placeholder="Colleague Name">
                                                @error('colleague_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-xl-6 mb-2">
                                                <label for="colleague_address" class="col-form-label">Colleague Address</label>
                                                <input id="colleague_address" name="colleague_address[]" value="{{ $colleague->colleague_address ?? old('colleague_address') }}" class="form-control" rows="5" placeholder="Colleague Address" required>
                                                @error('colleague_address')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-xl-6 mb-2">
                                                <label for="colleague_mobile" class="col-form-label">Colleague Phone</label>
                                                <input id="colleague_mobile" name="colleague_mobile[]" value="{{ $colleague->colleague_mobile ?? old('colleague_mobile') }}" class="form-control" rows="5" placeholder="Colleague Mobile" required>
                                                @error('colleague_mobile')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-xl-6 mb-2">
                                                <label for="photo" class="col-form-label">Photo</label>
                                                <input id="photo" type="file" name="photo[]" value="{{ $colleague->photo ?? old('photo') }}" class="form-control" rows="5" placeholder="Office Name" >
                                                @error('photo')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        @endforeach
                                        @else
                                        <div id="clonedInput" class="row clonedInput">
                                            <div class="actions d-flex justify-content-end">
                                                <a href="javascript:void(0)" class="btn btn-sm btn-success clone mx-1">Clone</a> 
                                                <a class="remove btn btn-sm btn-danger ">Remove</a>
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-xl-6 mb-2">
                                                <label for="colleague_name" class="col-form-label">Colleague Name</label>
                                                <input id="colleague_name" name="colleague_name[]" value="{{ $data->colleague_name ?? old('colleague_name') }}" class="form-control" rows="5" placeholder="Colleague Name" required>
                                                @error('colleague_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-xl-6 mb-2">
                                                <label for="colleague_address" class="col-form-label">Colleague Address</label>
                                                <input id="colleague_address" name="colleague_address[]" value="{{ $data->colleague_address ?? old('colleague_address') }}" class="form-control" rows="5" placeholder="Colleague Address" required>
                                                @error('colleague_address')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-xl-6 mb-2">
                                                <label for="colleague_mobile" class="col-form-label">Colleague Phone</label>
                                                <input id="colleague_mobile" name="colleague_mobile[]" value="{{ $data->colleague_mobile ?? old('colleague_mobile') }}" class="form-control" rows="5" placeholder="Colleague Mobile" required>
                                                @error('colleague_mobile')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-xl-6 mb-2">
                                                <label for="photo" class="col-form-label">Photo</label>
                                                <input id="photo" type="file" name="photo[]" value="{{ $data->photo ?? old('photo') }}" class="form-control" rows="5" placeholder="Office Name" required>
                                                @error('photo')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        @endif
                                        
                                    </div>
                                    <div id="cloned">

                                    </div>
                                </div>

                                <div class="d-flex ">
                                    <div class="d-grid col-6 px-1">
                                        <a href="{{ route($index_route) }}" class="btn btn-md btn-danger">Discard</a>
                                    </div>
                                    <div class="d-grid col-6 px-1">
                                        <button type="submit" class="btn btn-md btn-success">Save</button>
                                    </div>
                                </div>

                                
                            </div>
                        </div>
                    </form>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div>
    <!-- end row -->
@endsection
@push('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        var regex = /^(.+?)(\d+)$/i;
        var cloneIndex = $(".clonedInput").length;

        function clone(){
            $(this).parents(".clonedInput").clone()
                .appendTo("#cloned")
                .attr("id", "clonedInput" +  cloneIndex)
                .find("*")
                .each(function() {
                    var id = this.id || "";
                    var match = id.match(regex) || [];
                    if (match.length == 3) {
                        this.id = match[1] + (cloneIndex);
                    }
                })
                .on('click', 'a.clone', clone)
                .on('click', 'a.remove', remove);
            cloneIndex++;
        }
        function remove(){
            if($(this).parent().parent().attr('id') != "clonedInput"){
                $(this).parents(".clonedInput").remove();
            }else if ($(this).parent().attr('id') != "clonedInput"){
                $(this).parents(".clonedInput").remove();
            }else{
                alert("Users must provide one colleague's information.");
            }
        }
        $("a.clone").on("click", clone);

        $("a.remove").on("click", remove);
    </script>
@endpush
