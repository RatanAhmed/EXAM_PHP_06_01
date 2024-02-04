@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h4 class="header-title">{{ $page_title }}</h4>
                        <a href="{{ route($index_route) }}" class="btn btn-sm btn-success text-bold pt-1">Office Colleague List</a>
                    </div>
                </div>
                <div class="card-body pb-4">
                    <form class="form-horizontal" action="{{ route($store_route) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input hidden name="id" value="{{ $data->id ?? '' }}" readonly>
                        <div class="row justify-content-center">
                            <div class="col-6">
                                
                                <div class="row mb-3">
                                    <div>
                                        <div class="row">
                                            <h5 class="mt-3 header-title">Office Information</h5>
                                            <table class="table table-responsive table-bordered" widht="100%">
                                                <tbody>
                                                    <tr>
                                                        <td>{{ $data->office_name }}</td>
                                                        <td>{{ $data->office_address }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ $data->office_phone }}</td>
                                                        {{-- <td>{{ $data->appointment_letter }}</td> --}}
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <h5 class="mt-3 header-title">Office Colleague</h5>
                                            <table class="table table-responsive table-bordered" widht="100%">
                                                <tbody>
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                SL.
                                                            </th>
                                                            <th>
                                                                Photo
                                                            </th>
                                                            <th>Name </th>
                                                            <th>Addressddress </th>
                                                            <th>Mobile </th>
                                                        </tr>
                                                    </thead>
                                                    @foreach ($data->colleagues as $colleague)
                                                    <tr>
                                                        <td>
                                                            {{ $loop->iteration }}
                                                        </td>
                                                        <td>
                                                            <img src="{{ asset('public/storage/'.$colleague->photo) }}">
                                                        </td>
                                                        <td>{{ $colleague->colleague_name }}</td>
                                                        <td>{{ $colleague->colleague_address }}</td>
                                                        <td>{{ $colleague->colleague_mobile }}</td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
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
    
@endpush
