@extends('layouts')
@section('konten')
    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline-block">Roles List</h4>
                <a href="{{ route('roles.create') }}"  type="button"
                class="btn btn btn-primary btn-rounded float-right"> <i class="fa fa-plus"></i> Add Data</a>
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
                <div class="table-responsive">
                    <table id="role" class="display ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
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
                @if (Session::has('pesan'))
                iziToast.{{ Session::get('alert') }}({
                    title: '{{ Session::get('alert') }}',
                    message: '{{ Session::get('pesan') }}',
                    position: 'topRight'
                });
            @endif
                let table = new DataTable('#role', {
                    processing: true,
                    searching: true,
                    serverSide: true,
                    ajax: '{{ route('roles.index') }}',
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'name',
                        },
                       
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]
                });
                $('#create').click(function() {
                    $('#savedata').html('Simpan');
                    $('#modal').modal('show');
                    $('#modalHeading').html('Add Roles Name');
                    $('#postForm').trigger('reset');
                    $('#id').val('');
                    $('#namacabang').removeClass('is-invalid');
                    $('.namasatuan_error').html('');

                });

                $('body').on('click', '.editPost', function(a) {
                    $('#savedata').html('Edit');
                    var id = $(this).data('id');
                    console.log(id);
                    $.ajax({
                        type: "get",
                        // url: '{{ url('role') }}' + '/' + a + '/edit',
                        url: "{{ url('edit-roles') }}",
                        data: {
                            id: id
                        },
                        datatype: 'json',
                        success: function(data) {
                            $('#modalHeading').html('Edit Roles Name');
                            $('#modal').modal('show');
                            // $('#namacabang').val(data.result.namacabang);
                            $('#id').val(data.id);
                            $('#namacabang').val(data.namacabang);
                            $('#namacabang').removeClass('is-invalid');
                            $('.namasatuan_error').html('');
                            $('#kategori').val(data.kategori);
                            $('#kategori').trigger('change');
                        }
                    });
                });

                $('#savedata').click(function(e) {
                    e.preventDefault();
                    $.ajax({
                        data: $("#postForm").serialize(),
                        url: "{{ route('roles.store') }}",
                        type: 'POST',
                        dataType: 'JSON',
                        beforeSend: function(e) {
                            $('#savedata').html('<i class="fa fa-spin fa-spinner"></i> Sending...');
                        },
                        complete: function(e) {
                            $('#savedata').html('Simpan');
                        },
                        success: function(data) {
                            if (data.status == 0) {
                                console.log(data.error)
                                $.each(data.error, function(prefix, val) {
                                    $('span.' + prefix + '_error').text(val[0]);
                                });
                                $('#namacabang').addClass('is-invalid');
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

                $('body').on('click', '#delete', function() {

                    let id = $(this).data('id');
                    let name = $(this).data('name');
                    let token = $("meta[name='csrf-token']").attr("content");
                    swal({
                            title: 'Are You Sure?',
                            text: "Want to delete Center Name : " + name + " ?",
                            icon: 'warning',
                            buttons: true,
                            dangerMode: true,
                            showCancelButton: true,
                            cancelButtonText: 'TIDAK',
                        })
                        .then((willDelete) => {
                            if (willDelete) {
                                $.ajax({
                                    url: `/roles/${id}`,
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
    <div class="modal " id="modal"  aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
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
                            <label for="recipient-name" class="col-form-label">Roles Name:</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Add Center Name">
                            <span class="text-danger error-text name_error"> </span>
                        </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">Cancel</button>
                <button id="savedata" name="savedata" type="button" class="btn btn-success "></button>
            </div>
            </form>
            </div>
        </div>
               
    </div>
@endsection
