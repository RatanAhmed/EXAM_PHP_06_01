@extends('layouts.app')
@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" />
        
    <style>
        table.dataTable tbody td{
            text-align: center !important;
        }
        table.dataTable tbody td:nth-child(1){
            font-weight: 600;
        }
        table#DataTables_Table_0 img{
            transition: all .2s linear;
        }
        img.gridProductImage:hover{
            scale: 2;
            cursor: pointer;
        }
    </style>
    <!--CSRF META -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body pb-4">
                    <h4 class="mb-3 header-title mt-0">Office Colleague List</h4>

                    <label id="customFilter" style="float: right;">
                        @if ($create_route!= '')
                        <a href="{{ route($create_route) }}" class="btn btn-primary btn-sm" style="margin-left: 5px"><b><i class="bi bi-plus-circle"></i> &nbsp; Create New</b></a>
                        @endif
                    </label>

                    <table class="table table-sm table-striped table-bordered table-hover yajra-datatable" width="100%">
                        <thead>
                            <tr>
                                <th width="2%" class="text-center">SL</th>
                                @foreach ($columns as $col)
                                <th class="text-center">{{ strtoupper(str_replace('_',' ', $col)) }}</th>
                                @endforeach
                                {{-- <th class="text-center">STATUS</th> --}}
                                <th width="15%" class="text-center">OPT</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div>
    <!-- end row -->

@endsection

@push('js')
    <!-- Datatable -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        var table = $('.yajra-datatable').DataTable({
            order: [],
            processing: true,
            stateSave: true,
            serverSide: true,
            pageLength: 10,
            lengthMenu: [10, 20, 50, 100],
            "autoWidth": false,
            ajax: "{{ route($index_route) }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                @foreach ($columns as $col)
                {!! '{data: '.strval("'".$col."'").', name: '.strval("'".$col."'").'},' !!}
                @endforeach
                // {   data: 'status',
                //     name: 'status',
                //     orderable: false,
                //     searchable: false
                // },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
        $(".dataTables_filter").append($("#customFilter"));

    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('body').on('click', '.deleteBtn', function (e) {
            e.preventDefault();
            var uuid = $(this).data("id");
            if(confirm("Are You sure want to delete !")){
                $.ajax({
                    type: "Delete",
                    url: "{{ url($delete_url) }}"+'/'+uuid,
                    success: function (response) {
                        if(response.success){
                            table.draw(false);
                            toastr.success(response.success, 'Success');
                        }else{
                            table.draw(false);
                            toastr.warning(response.error, 'Error');
                        }
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            }
        });

    </script>
    <!-- End Datatable -->
@endpush
