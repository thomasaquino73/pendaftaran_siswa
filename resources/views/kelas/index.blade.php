@extends('layouts')
@section('konten')
    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline-block">Classroom</h4>
                @php
                     $user = Auth()->user();
                @endphp
                @if ($user->can('classroom-create'))
                    <a href="javascript:void(0);" id="createCategory" type="button"
                        class="btn btn-primary btn-rounded float-right">
                        <i class="fa fa-plus"></i> Add Data</a>
                @endif
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
                <button class="btn btn btn-primary "><i class="fa fa-file-pdf-o"></i> PDF</button>
                <button class="btn btn btn-primary "><i class="fa fa-file-excel-o"></i> Excel</button>
                <button class="btn btn btn-primary "><i class="fa fa-print"></i> Print</button>
                <div class="table-responsive">
                    <table id="kelas" class="display ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Classroom</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                let table = new DataTable('#kelas', {
                    processing: true,
                    searching: false,
                    serverSide: true,
                    ajax: '{{ route('kelas.index') }}',
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'namakelas',
                            name: 'namakelas'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]
                });
                $('#createCategory').click(function() {
                    $('#savedata').html('Save');
                    $('#modal').modal('show');
                    $('#modalHeading').html('Add Classroom');
                    $('#postForm').trigger('reset');
                    $('#id').val('');
                    $('#namakelas').removeClass('is-invalid');
                    $('.namasatuan_error').html('');

                });

                $('body').on('click', '.editPost', function(a) {
                    $('#savedata').html('Edit');
                    var id = $(this).data('id');
                    console.log(id);
                    $.ajax({
                        type: "get",
                        // url: '{{ url('kelas') }}' + '/' + a + '/edit',
                        url: "{{ url('edit-kelas') }}",
                        data: {
                            id: id
                        },
                        datatype: 'json',
                        success: function(data) {
                            $('#modalHeading').html('Edit Classroom');
                            $('#modal').modal('show');
                            // $('#namakelas').val(data.result.namakelas);
                            $('#id').val(data.id);
                            $('#namakelas').val(data.namakelas);
                            $('#namakelas').removeClass('is-invalid');
                            $('.namasatuan_error').html('');
                        }
                    });
                });

                $('#savedata').click(function(e) {
                    e.preventDefault();
                    $.ajax({
                        data: $("#postForm").serialize(),
                        url: "{{ route('kelas.store') }}",
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
                                $('#namakelas').addClass('is-invalid');
                            } else {
                                $('#modal').modal('hide');
                                $('#postForm').trigger('reset');
                                $('.error-text').html('');
                                table.draw();
                                iziToast.success({
                                    title: 'success',
                                    message: 'Data Berhasil',
                                    position: 'topRight'
                                });
                            }
                        },
                    })
                });

                $('body').on('click', '#deletecategory', function() {

                    let id = $(this).data('id');
                    let name = $(this).data('name');
                    let token = $("meta[name='csrf-token']").attr("content");
                    swal({
                            title: 'Are You Sure?',
                            text: "Want to delete Classroom : " + name + " ?",
                            icon: 'warning',
                            buttons: true,
                            dangerMode: true,
                            showCancelButton: true,
                            cancelButtonText: 'TIDAK',
                        })
                        .then((willDelete) => {
                            if (willDelete) {
                                $.ajax({
                                    url: `/kelas/${id}`,
                                    type: "DELETE",
                                    cache: false,
                                    data: {
                                        "_token": token
                                    },
                                    success: function(response) {
                                        iziToast.success({
                                            title: 'success',
                                            message: 'Data Satuan : ' + name +
                                                ' Berhasil Dihapus',
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
    <div class="modal " id="modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalHeading"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>


                <div class="modal-body">
                    <form id="postForm" name="postForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div id="error"></div>
                        <input type="text" name="id" id="id" hidden>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Classroom:</label>
                            <input type="text" class="form-control is-invalid" id="namakelas" name="namakelas"
                                placeholder="Add Classroom">
                            <span class="text-danger error-text namakelas_error"> </span>
                        </div>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button id="savedata" name="savedata" type="button" class="btn btn-primary"></button>
                </div>
            </div>
        </div>
    </div>
@endsection
