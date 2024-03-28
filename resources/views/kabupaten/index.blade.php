@extends('layouts')
@section('konten')
    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline-block">Distric</h4>
                <a href="javascript:void(0);" id="createProvinsi" type="button"
                class="btn  btn-primary btn-rounded float-right"> <i class="fa fa-plus"></i> Add Data</a>
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
                <button class="btn btn btn-primary "><i class="fa fa-file-pdf-o"></i> Print PDF</button>
                <button class="btn btn btn-primary "><i class="fa fa-file-excel-o"></i> Print Excel</button>
                <button class="btn btn btn-danger " id="clear-filter"><i class="fa fa-undo"></i> Reset Filter</button>
                <div class="lejen mt-3">
                    <h4>Filter Data</h4>
                </div>

                <div class="row filter-row mt-3">

                    <div class="col-sm-12 col-md-6 col-lg-4">
                        {{-- <input type="text" name="min" id="min" class="form-control"> --}}
                        <div class="form-group ">
                            <label class="">Provence</label>
                            <select data-column="1" id="filter_provinsi" name="filter_provinsi"
                                class=" select  single-select-field " style="width:100%;">
                                <option></option>
                                @foreach ($provinsi as $item)
                                    <option style="text-transform:uppercase" {{ $item->id }}>{{ $item->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        {{-- <input type="text" name="min" id="min" class="form-control"> --}}
                        <div class="form-group ">
                            <label class="">Distric</label>
                            <select data-column="1" id="filter_kabupaten" name="filter_kabupaten"
                                class=" select floating single-select-field " style="width:100%;">
                                <option></option>
                                @foreach ($kabupaten as $item)
                                    <option style="text-transform:uppercase" {{ $item->id }}>{{ $item->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="devider"></div>
                <div class="table-responsive">
                    <table id="kabupatentable" class="display ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Provence</th>
                                <th>Distric</th>
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
            #kabupatentable td {
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
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        minimumInputLength: 1,
        // allowClear: true,
    });
                var groupColumn = 1;
                let table = new DataTable('#kabupatentable', {
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
                    columnDefs: [{
                        visible: false,
                        targets: groupColumn
                    }],
                    order: [
                        [groupColumn, 'asc']
                    ],
                    drawCallback: function(settings) {
                        var api = this.api();
                        var rows = api.rows({
                            page: 'current'
                        }).nodes();
                        var last = null;

                        api.column(groupColumn, {
                                page: 'current'
                            })
                            .data()
                            .each(function(group, i) {
                                if (last !== group) {
                                    $(rows)
                                        .eq(i)
                                        .before(
                                            '<tr class="group"><td colspan="5">' +
                                            group +
                                            '</td></tr>'
                                        );

                                    last = group;
                                }
                            });
                    },
                    ajax: '{{ route('kabupaten.index') }}',
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'nama',
                        },
                        {
                            data: 'namakabupaten',
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
                    // $('#filter_kabupaten').val('').trigger('change');
                    table.column(1).search($(this).val()).draw();
                    console.log(table);
                });
                $('#filter_kabupaten').change(function() {
                    // table.column($(this).data('column'))
                    // $('#filter_provinsi').val('').trigger('change');
                    table.column(2).search($(this).val()).draw();
                    console.log(table);
                });
                $('#clear-filter').on('click', function() {
                    table.search('').columns().search('').draw();
                    $('#filter_provinsi').val('').trigger('change');
                    $('#filter_kabupaten').val('').trigger('change');
                });
                // Order by the grouping
                $('#kabupatentable tbody').on('click', 'tr.group', function() {
                    var currentOrder = table.order()[0];
                    if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
                        table.order([groupColumn, 'desc']).draw();
                    } else {
                        table.order([groupColumn, 'asc']).draw();
                    }
                });
                $('#createProvinsi').click(function() {
                    $('#savedata').html('Save');
                    $('#modal').modal('show');
                    $('#modalHeading').html('Add Distric');
                    $('#postForm').trigger('reset');
                    $('#id').val('');
                    $('#provinsi_id').val('').trigger('change');
                    $('.nama_error').html('');

                });

                $('body').on('click', '.editPost', function(a) {
                    $('#savedata').html('Edit');
                    var id = $(this).data('id');
                    console.log(id);
                    $.ajax({
                        type: "get",
                        url: "{{ url('edit-kabupaten') }}",
                        data: {
                            id: id
                        },
                        datatype: 'json',
                        success: function(data) {
                            $('#modalHeading').html('Edit Distric');
                            $('#modal').modal('show');
                            $('#id').val(data.id);
                            $('#nama').val(data.nama);
                            $('.nama_error').html('');
                            // $('#provinsi_id').val('').trigger('change');
                            $('#provinsi_id').val(data.provinsi_id);
                            $('#provinsi_id').trigger('change');
                            $('.provinsi_id_error').html('');
                        }
                    });
                });

                $('#savedata').click(function(e) {
                    e.preventDefault();
                    $.ajax({
                        data: $("#postForm").serialize(),
                        url: "{{ route('kabupaten.store') }}",
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
                                $('#modal').modal('hide');
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

                $('body').on('click', '#deletekabupaten', function() {

                    let id = $(this).data('id');
                    let name = $(this).data('name');
                    let token = $("meta[name='csrf-token']").attr("content");
                    swal({
                            title: 'Are You Sure?',
                            text: "Distric Data : " + name,
                            icon: 'warning',
                            buttons: true,
                            dangerMode: true,
                            showCancelButton: true,
                            cancelButtonText: 'TIDAK',
                        })
                        .then((willDelete) => {
                            if (willDelete) {
                                $.ajax({
                                    url: `/kabupaten/${id}`,
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
                                            title: 'Gagal Dihapus Karena Data sudah terpakai di tabel lain',
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
        </script>
    @endpush
    <div class="modal"  >
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Modal title</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Provence:</label>
                    <select name="provinsi_id" id="provinsi_id" class="form-select single-select-field1"
                        data-placeholder="Choose Provence..." style="width:100%">
                        <option></option>
                        @foreach ($provinsi as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger error-text provinsi_id_error"></span>
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Distric:</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="">
                    <span class="text-danger error-text nama_error"> </span>
                </div>
            </div>
        </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
      </div>
    <div class="modal lg-modal "  id="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalHeading"></h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="postForm" name="postForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div id="error"></div>
                    <input type="text" name="id" id="id" hidden>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Provence:</label>
                        <select name="provinsi_id" id="provinsi_id" class="form-select single-select-field"
                            data-placeholder="Choose Provence..." style="width:100%">
                            <option></option>
                            @foreach ($provinsi as $item)
                                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                            @endforeach
                        </select>
                        <span class="text-danger error-text provinsi_id_error"></span>
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Distric:</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="">
                        <span class="text-danger error-text nama_error"> </span>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn grey" data-dismiss="modal">Cancel</button>
            <button id="savedata" name="savedata" type="button" class="btn blue"></button>
        </div>
    </div>
@endsection
