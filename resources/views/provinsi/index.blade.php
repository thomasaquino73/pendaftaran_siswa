@extends('layouts')
@section('konten')
    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline-block">Provence</h4>
                <a href="javascript:void(0);" id="createProvinsi" type="button"
                    class="btn btn modal-trigger btn-primary btn-rounded float-right"> <i class="fa fa-plus"></i> Add Data</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">

                </div>

            </div>

        </div>

    </div>

    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-body">
                <button class="btn  btn-primary "><i class="fa fa-file-pdf-o"></i> Print PDF</button>
                <button class="btn  btn-primary "><i class="fa fa-file-excel-o"></i> Print Excel</button>
                <button class="btn btn-danger " id="clear-filter"><i class="fa fa-undo"></i> Reset Filter</button>
                <div class="lejen mt-3">
                    <h4>Filter Data</h4>
                </div>

                <div class="row filter-row mt-3">

                    <div class="col-sm-12 col-md-6 col-lg-4">
                        {{-- <input type="text" name="min" id="min" class="form-control"> --}}
                        <div class="form-group ">
                            <label class="">Provence</label>
                            <select data-column="1" id="filter_provinsi" name="filter_provinsi"
                                class=" select floating single-select-field min" style="width:100%;">
                                <option></option>
                                @foreach ($provinsi as $item)
                                    {{-- <option value="{{ $item->id }}">{{ $item->nama }}</option> --}}
                                    <option style="text-transform:uppercase">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                </div>
                <div class="devider"></div>
                <div class="table-responsive">
                    <table id="provinsitable" class="display ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Provence</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @push('style')
        <style>
            #provinsitable td {
                text-transform: uppercase
            }

            .dataTables_filter {
                display: none;
            }
        </style>
    @endpush
    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('.single-select-field').select2({
                    theme: "bootstrap-5",
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                        'style',
                    placeholder: $(this).data('placeholder'),
                    minimumInputLength: 1,
                    // allowClear: true,
                    placeholder: '',
                });
                let table = new DataTable('#provinsitable', {
                    "paging": true,
                    processing: true,
                    serverSide: true,
                    layout: {
                        topStart: 'pageLength',
                        topEnd: null,
                        bottom: '',
                        bottomStart: 'info',
                        bottomEnd: 'paging'
                    },
                    "bPaginate": true,
                    "ordering": true,
                    "bLengthChange": true,
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, 'All']
                    ],
                    responsive: true,
                    ajax: '{{ route('provinsi.index') }}',
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'nama',
                            name: 'nama'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]
                });
                $('#filter_provinsi').change(function() {
                    // table.column($(this).data('column'))
                    table.column(1).search($(this).val()).draw();
                    console.log(table);
                });
                $('#clear-filter').on('click', function() {
                    table.search('').columns().search('').draw();
                });
                // Order by the grouping
                $('#provinsitable tbody').on('click', 'tr.group', function() {
                    var currentOrder = table.order()[0];
                    if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
                        table.order([groupColumn, 'desc']).draw();
                    } else {
                        table.order([groupColumn, 'asc']).draw();
                    }
                });
                $('#createProvinsi').click(function() {
                    $('#savedata').html('Save');
                    $('#provinsimodal').modal('show');
                    $('#modalHeading').html('Add Provence');
                    $('#postForm').trigger('reset');
                    $('#id').val('');
                    $('.namaprovinsi_error').html('');

                });

                $('body').on('click', '.editPost', function(a) {
                    $('#savedata').html('Edit');
                    var id = $(this).data('id');
                    console.log(id);
                    $.ajax({
                        type: "get",
                        url: "{{ url('edit-provinsi') }}",
                        data: {
                            id: id
                        },
                        datatype: 'json',
                        success: function(data) {
                            $('#modalHeading').html('Edit Provence');
                            $('#provinsimodal').modal('show');
                            $('#id').val(data.id);
                            $('#nama').val(data.nama);
                            $('.nama_error').html('');
                        }
                    });
                });

                $('#savedata').click(function(e) {
                    e.preventDefault();
                    $.ajax({
                        data: $("#postForm").serialize(),
                        url: "{{ route('provinsi.store') }}",
                        type: 'POST',
                        dataType: 'JSON',
                        beforeSend: function(e) {
                            $('#savedata').html('<i class="fa fa-spin fa-spinner"></i> Sending...');
                        },
                        complete: function(e) {
                            $('#savedata').html('Save');
                        },
                        success: function(data) {
                            if (data.status == 0) {
                                console.log(data.error)
                                $.each(data.error, function(prefix, val) {
                                    $('span.' + prefix + '_error').text(val[0]);
                                });
                            } else {
                                $('#provinsimodal').modal('hide');
                                $('#postForm').trigger('reset');
                                $('.error-text').html('');
                                table.draw();
                                iziToast.success({
                                    title: 'success',
                                    message: 'Success',
                                    position: 'topRight'
                                });
                            }
                        },
                    })
                });

                $('body').on('click', '#deleteprovinsi', function() {

                    let id = $(this).data('id');
                    let name = $(this).data('name');
                    let token = $("meta[name='csrf-token']").attr("content");
                    swal({
                            title: 'Are You Sure?',
                            text: "Provence Data : " + name,
                            icon: 'warning',
                            buttons: true,
                            dangerMode: true,
                            showCancelButton: true,
                            cancelButtonText: 'TIDAK',
                        })
                        .then((willDelete) => {
                            if (willDelete) {
                                $.ajax({
                                    url: `/provinsi/${id}`,
                                    type: "DELETE",
                                    cache: false,
                                    data: {
                                        "_token": token
                                    },
                                    success: function(response) {
                                        iziToast.success({
                                            title: 'success',
                                            message: 'Deleted Successfully',
                                            position: 'topRight'
                                        });
                                        table.draw();
                                    },
                                    error: function(jqXHR, textStatus, errorThrown) {
                                        swal({
                                            position: 'center',
                                            icon: 'error',
                                            title: 'Error',
                                            showConfirmButton: false,
                                            timer: 5000
                                        });
                                    }

                                });
                                // swal('Poof! Your imaginary file has been deleted!', {
                                //     icon: 'success',
                                // });
                            } else {
                                table.draw();
                                // swal('Your imaginary file is safe!');
                            }
                        });



                });
            });

            // function loadTable(min) {
            //     let table = new DataTable('#provinsitable', {
            //         // "scrollY": "200px",
            //         "scrollCollapse": true,
            //         "paging": true,
            //         processing: true,
            //         serverSide: true,
            //         bFilter: true,
            //         "bInfo": true,
            //         "bPaginate": true,
            //         "ordering": true,
            //         "bLengthChange": true,
            //         responsive: true,
            //         buttons: [{
            //                 extend: 'colvis',
            //                 postfixButtons: ['colvisRestore']
            //             },
            //             {
            //                 extend: 'csv'
            //             },
            //             {
            //                 extend: 'pdf',
            //                 title: 'Contoh File PDF Datatables'
            //             },
            //             {
            //                 extend: 'excel',
            //                 title: 'Contoh File Excel Datatables'
            //             },
            //             {
            //                 extend: 'print',
            //                 title: 'Contoh Print Datatables'
            //             },
            //         ],
            //         ajax: '{{ route('provinsi.index') }}',
            //         data:{
            //             min:min
            //         },
            //         columns: [{
            //                 data: 'DT_RowIndex',
            //                 name: 'DT_RowIndex',
            //                 orderable: false,
            //                 searchable: false
            //             },
            //             {
            //                 data: 'nama',
            //                 name: 'nama'
            //             },
            //             {
            //                 data: 'action',
            //                 name: 'action',
            //                 orderable: false,
            //                 searchable: false
            //             },
            //         ]
            //     });
            // }
        </script>
    @endpush
    <div class="modal " id="provinsimodal">
        <div class="modal-dialog modal-md ">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title" id="modalHeading"></h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"> <i class="fa fa-times"></i> </button>
            </div>
            <div class="modal-body" style="height: 100%;">
                <form id="postForm" name="postForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div id="error"></div>
                    <input type="text" name="id" id="id" hidden>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Provence:</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="">
                        <span class="text-danger error-text nama_error"> </span>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button id="savedata" name="savedata" type="button" class="btn btn-success"></button>
                </div>
            </div>
        </div>
        
    </div>
@endsection
