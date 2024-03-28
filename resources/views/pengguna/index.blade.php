@extends('layouts')
@section('konten')
    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline-block">User</h4>
                @php
                $user = Auth()->user();
            @endphp
            @if ($user->can('user-create')) 
                <a href="{{ route('pengguna.create') }}"  type="button" class="btn btn-primary btn-rounded float-right">
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
                    <table id="pengguna" class="display ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Roles</th>
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
                let table = new DataTable('#pengguna', {
                    processing: true,
                    searching: false,
                    serverSide: true,
                    ajax: '{{ route('pengguna.index') }}',
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'username',
                        },
                        {
                            data: 'namalengkap',
                            name: 'namalengkap',
                        },
                        {
                            data: 'roles',
                            name: 'roles',
                        },

                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]
                });
                $('body').on('click', '.editPost', function(a) {
                    $('#savedata').html('Edit');
                    var id = $(this).data('id');
                    console.log(id);
                    $.ajax({
                        type: "get",
                        // url: '{{ url('pengguna') }}' + '/' + a + '/edit',
                        url: "{{ url('edit-pengguna') }}",
                        data: {
                            id: id
                        },
                        datatype: 'json',
                        success: function(data) {
                            $('#modalHeading').html('Edit User');
                            $('#modaledit').modal('show');
                            // $('#namakelas').val(data.result.namakelas);
                            $('#idedit').val(data.id);
                            $('#usernameedit').val(data.email);
                            $('#fullnameedit').val(data.idkaryawan);
                            $('#fullnameedit').trigger('change');

                        }
                    });
                });

                $('#savedata').click(function(e) {
                    e.preventDefault();
                    $.ajax({
                        data: $("#postForm").serialize(),
                        url: "{{ route('pengguna.store') }}",
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

                $('body').on('click', '#delete', function() {

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
                                    url: `/pengguna/${id}`,
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
                        <div class="form-group row">
                            <label for="recipient-name" class="col-sm-3  col-form-label">Teacher Name:</label>
                            <div class="col-sm-9">
                                <select name="fullname" id="fullname" class="single-select-field2" style="width:100%" data-placeholder="Choose Teacher Name">
                                    <option value=""></option>
                                    @foreach ($karyawan as $item)
                                        <option value="{{ $item->id }}" >{{ $item->namalengkap }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="text-danger error-text username_error"> </span>
                        </div>
                        <div class="form-group row">
                            <label for="recipient-name" class="col-sm-3  col-form-label">Username:</label>
                            <div class="col-sm-9">
                                {!! Form::text('username', '', [
                                    'class' => 'form-control',
                                    'placeholder' => 'Please Input Your Username',
                                    'id' => 'username',
                                ]) !!}
                            </div>
                            <span class="text-danger error-text username_error"> </span>
                        </div>
                        <div class="form-group row">
                            <label for="recipient-name" class="col-sm-3  col-form-label">Password:</label>
                            <div class="col-sm-9">
                                {!! Form::password('password', [
                                    'class' => 'form-control',
                                    'placeholder' => '',
                                    'id' => 'password',
                                ]) !!}
                                <span class="text-danger error-text username_error"> </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="recipient-name" class="col-sm-3  col-form-label">Confirm Password:</label>
                            <div class="col-sm-9">
                                {!! Form::password('confirm', [
                                    'class' => 'form-control',
                                    'placeholder' => '',
                                    'id' => 'confirm',
                                ]) !!}

                                <span class="text-danger error-text confirm_error"> </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Hak Akses</label>
                            <div class="col-sm-9">
                                {{-- <select name="roles" id="roles" class="single-select-field2" style="width:100%">
                                <option value=""></option>
                                @foreach ($roles as $roles)
                                <option value="{{ $roles->id }}">{{ $roles->name }}</option>
                                @endforeach 
                                </select>--}}
                                {!! Form::select(
                                    'roles[]',
                                    $roles,
                                    [],
                                    ['class' => 'form-control single-select-field2', 'style' => 'width:100%', 'data-placeholder' => 'Pilih'],
                                ) !!}
                            </div>
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

    {{-- modal edit --}}
    <div class="modal " id="modaledit">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalHeading">Modal Edit</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="postForm" name="postForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div id="error"></div>
                        <input type="text" name="idedit" id="idedit" >
                        <div class="form-group row">
                            <label for="recipient-name" class="col-sm-3  col-form-label">Teacher Name:</label>
                            <div class="col-sm-9">
                                <select name="fullnameedit" id="fullnameedit" class="single-select-field2" style="width:100%" data-placeholder="Choose Teacher Name">
                                    <option value=""></option>
                                    @foreach ($karyawan as $item)
                                        <option value="{{ $item->id }}" >{{ $item->namalengkap }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <span class="text-danger error-text username_error"> </span>
                        </div>
                        <div class="form-group row">
                            <label for="recipient-name" class="col-sm-3  col-form-label">Username:</label>
                            <div class="col-sm-9">
                                {!! Form::text('usernameedit', '', [
                                    'class' => 'form-control',
                                    'placeholder' => 'Please Input Your Username',
                                    'id' => 'usernameedit',
                                ]) !!}
                            </div>
                            <span class="text-danger error-text username_error"> </span>
                        </div>
                        <div class="form-group row">
                            <label for="recipient-name" class="col-sm-3  col-form-label">Password:</label>
                            <div class="col-sm-9">
                                {!! Form::password('password', [
                                    'class' => 'form-control',
                                    'placeholder' => '',
                                    'id' => 'password',
                                ]) !!}
                                <span class="text-danger error-text username_error"> </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="recipient-name" class="col-sm-3  col-form-label">Confirm Password:</label>
                            <div class="col-sm-9">
                                {!! Form::password('confirm', [
                                    'class' => 'form-control',
                                    'placeholder' => '',
                                    'id' => 'confirm',
                                ]) !!}

                                <span class="text-danger error-text confirm_error"> </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-3 col-form-label">Hak Akses</label>
                            <div class="col-sm-9">
                                {{-- <select name="roles" id="roles" class="single-select-field2" style="width:100%">
                                <option value=""></option>
                                @foreach ($roles as $roles)
                                <option value="{{ $roles->id }}">{{ $roles->name }}</option>
                                @endforeach 
                                </select>--}}
                                {!! Form::select(
                                    'roles[]',
                                    $roles,
                                    [],
                                    ['class' => 'form-control single-select-field2', 'style' => 'width:100%', 'data-placeholder' => 'Pilih'],
                                ) !!}
                            </div>
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
