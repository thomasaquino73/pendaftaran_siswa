@extends('layouts')
@section('konten')
    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline-block">Teacher List</h4>
                @php
                    $user = Auth()->user();
                @endphp
                @if ($user->can('teacher-create'))
                    <a href="javascript:void(0);" id="create" type="button" class="btn btn-primary btn-rounded float-right">
                        <i class="fa fa-plus"></i> Add Teacher</a>
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
                <a href="{{ route('karyawan.pdf') }}" class="btn btn btn-primary "><i class="fa fa-file-pdf-o"></i> PDF</a>
                <button class="btn btn btn-primary "><i class="fa fa-file-excel-o"></i> Excel</button>
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
                    <div class="col-sm-12">
                        <div class="row">
                            @foreach ($data as $karyawan)
                                <div class="col-md-4 col-sm-4  col-lg-3">
                                    <div class="profile-widget"
                                        style="border:1px solid rgb(175, 178, 195);box-shadow: 3px 2px 1px rgb(230, 230, 230);">
                                        <div class="doctor-img">
                                            @if (!empty($karyawan->avatar))
                                                <a class="avatar" href="profile.html"><img
                                                        alt=""src="{{ asset('') . $karyawan->avatar }}"></a>
                                            @else
                                                <a class="avatar" href="profile.html"><img
                                                        alt=""src="assets/img/user.jpg"></a>
                                            @endif
                                        </div>
                                        <div class="dropdown profile-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                @if ($user->can('teacher-edit'))
                                                <a href="javascript:void(0);" id="ubah"
                                                    data-id="{{ $karyawan->karyawanid }}"
                                                    class="btn btn-primary btn-sm dropdown-item editPost" title="Ubah"><i
                                                        class="fa fa-edit"></i> Edit </a>
                                                @endif
                                                @if ($user->can('teacher-view'))
                                                <a href="{{ url('karyawan/' . $karyawan->karyawanid) }}"
                                                    class="dropdown-item btn btn-success"><i class="fa fa-eye m-r-5"></i>
                                                    Detail</a>
                                                @endif
                                                @if ($user->can('teacher-delete'))
                                                <a href="javascript:void(0)" id="delete" data-toggle="tooltip"
                                                    data-placement="bottom" title="Hapus"
                                                    data-id="{{ $karyawan->karyawanid }}"
                                                    data-name="{{ $karyawan->namalengkap }}"
                                                    class="btn btn-danger btn-sm dropdown-item"><i class="fa fa-trash"></i>
                                                    Delete</a>
                                                @endif
                                            </div>
                                        </div>
                                        <h4 class="doctor-name text-ellipsis"><a
                                                href="profile.html">{{ $karyawan->namalengkap }}</a></h4>
                                        <div class="doc-prof">{{ $karyawan->notel }}</div>
                                        <div class="user-country">
                                            <i class="fa fa-map-marker"></i>
                                            {{ $karyawan->namakabupaten }},{{ $karyawan->namaprovinsi }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div style="  display: flex; justify-content: center;">
                            {{ $data->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <div class="modal " id="karyawanmodal">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalHeading"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('karyawan.store') }}" id="postForm" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <div id="error"></div>
                            <input type="text" name="id" id="id" hidden>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">ID Number</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="nip" id="nip">
                                            <span class="text-danger error-text nip_error"> </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Full Name</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="namalengkap" id="namalengkap">
                                            <span class="text-danger error-text namalengkap_error"> </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Gender</label>
                                        <div class="col-md-9">
                                            <select name="jeniskelamin" id="jeniskelamin"
                                                class="form-select single-select-field1" data-placeholder="Choose Gender..."
                                                style="width:100%">
                                                <option></option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                            <span class="text-danger error-text jeniskelamin_error"> </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Place Of Birth</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="tempatlahir" id="tempatlahir">
                                            <span class="text-danger error-text tempatlahir_error"> </span>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Date Of Birth</label>
                                        <div class="col-md-9">
                                            <div class="cal-icon">
                                                <input type="text" class="form-control datepicker" name="tanggallahir"
                                                    id="tanggallahir" readonly>
                                            </div>
                                            <span class="text-danger error-text tanggallahir_error"> </span>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Phone Number</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="notel" id="notel">
                                            <span class="text-danger error-text notel_error"> </span>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Email</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="email" id="email">
                                            <span class="text-danger error-text email_error"> </span>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Address</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="alamat" id="alamat">
                                            <span class="text-danger error-text alamat_error"> </span>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label"></label>
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class=" col-form-label">Provence</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <select name="provinsi" id="provinsi"
                                                        class="form-select single-select-field"
                                                        data-placeholder="Choose Provence..." style="width:100%">
                                                        <option></option>
                                                        @foreach ($provinsi as $item)
                                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger error-text provinsi_error"> </span>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label"></label>
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label class=" col-form-label">Disctric</label>
                                                </div>
                                                <div class="col-md-9">
                                                    <select name="kabupaten" id="kabupaten"
                                                        class="form-select single-select-field" style="width:100%"
                                                        data-placeholder="Choose Disctric...">
                                                        <option></option>
                                                        @foreach ($kabupaten as $item)
                                                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger error-text kabupaten_error"> </span>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Photo</label>
                                        <div class="col-md-9">
                                            <input type="file" class="form-control" name="avatar" id="avatar">

                                        </div>
                                    </div>
                                </div>

                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        {{-- <button id="savedata" name="savedata" type="button" class="btn btn-primary"></button> --}}
                        <button id="savedata" name="savedata" type="submit" class="btn btn-primary"></button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            var idkab = '';
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
                });
                $('.single-select-field1').select2({
                    theme: "bootstrap-5",
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                        'style',
                    placeholder: $(this).data('placeholder'),
                    // allowClear: true,
                });
                //filter table
                $('#filter_provinsi').change(function() {
                    // table.column($(this).data('column'))
                    table.column(1).search($(this).val()).draw();
                    console.log(table);
                });
                $('#clear-filter').on('click', function() {
                    table.search('').columns().search('').draw();
                });


                let table = new DataTable('#karyawan', {
                    processing: true,
                    searching: false,
                    serverSide: true,
                    "bLengthChange": false,
                    ajax: '{{ route('karyawan.index') }}',
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'avatar',
                            name: 'avatar'
                        },
                        {
                            data: 'nip',
                        },
                        {
                            data: 'namalengkap',
                        },
                        {
                            data: 'jeniskelamin',
                        },
                        {
                            data: 'tempatlahir',
                        },
                        {
                            data: 'tanggallahir',
                        },

                        {
                            "data": null,
                            render: function(data, type, row) {
                                var details = data.alamat + ",<br>Distric : " + data.namakabupaten +
                                    ",<br>Provence : " + data
                                    .namaprovinsi;
                                return details;
                            }
                        },
                        {
                            data: 'notel',
                        },
                        {
                            data: 'email',
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
                    $('#savedata').html('Save');
                    $('#karyawanmodal').modal('show');
                    $('#modalHeading').html('Add Teacher');
                    $('#postForm').trigger('reset');
                    $('#kategori').val('').trigger('change');
                    $('#satuan').val('').trigger('change');
                    $('#id').val('');
                    $('#namabarang').removeClass('is-invalid');
                    $('#nosku').removeClass('is-invalid');
                    $("#kategori + span").removeClass("is-invalid");
                    $("#satuan + span").removeClass("is-invalid");
                    $('.namalengkap_error').html('');
                    $('.notel_error').html('');
                    $('.alamat_error').html('');
                    $('.provinsi_error').html('');
                    $('.kabupaten_error').html('');
                    $('.kontak_error').html('');
                    $('#provinsi').val('').trigger('change');
                    $('#kabupaten').val('').trigger('change');
                    $('#jeniskelamin').val('').trigger('change');

                });

                $('body').on('click', '.editPost', function(a) {
                    $('#savedata').html('Edit');
                    $('.namalengkap_error').html('');
                    $('.notel_error').html('');
                    $('.alamat_error').html('');
                    $('.provinsi_error').html('');
                    $('.kabupaten_error').html('');
                    var id = $(this).data('id');

                    $.ajax({
                        type: "get",
                        url: "{{ url('edit-karyawan') }}",
                        data: {
                            id: id
                        },
                        datatype: 'json',
                        success: function(data) {
                            $('#modalHeading').html('Edit Teacher');
                            $('#karyawanmodal').modal('show');
                            $('#id').val(data.id);
                            $('#nip').val(data.nip);
                            $('#namalengkap').val(data.namalengkap);
                            $('#notel').val(data.notel);
                            $('#alamat').val(data.alamat);
                            $('#email').val(data.email);
                            $('#tempatlahir').val(data.tempatlahir);
                            $('#tanggallahir').val(data.tanggallahir);
                            $('#provinsi').val(data.idprovinsi);
                            idkab = data.idkabupaten;
                            $('#provinsi').trigger('change');
                            $('#jeniskelamin').val(data.jeniskelamin);
                            $('#jeniskelamin').trigger('change');
                            $('.namalengkap_error').html('');
                            $('.notel_error').html('');
                            $('.alamat_error').html('');
                            $('.provinsi_error').html('');
                            $('.kabupaten_error').html('');
                            $('.kontak_error').html('');

                        }
                    });
                });

                $('#postForm').on('submit', function(e) {
                    e.preventDefault();
                    var form = this;
                    $.ajax({
                        url: $(form).attr('action'),
                        method: $(form).attr('method'),
                        data: new FormData(form),
                        processData: false,
                        datatype: 'json',
                        contentType: false,
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
                                if (document.getElementById("id").value.trim() == "") {
                                    $('#karyawanmodal').modal('hide');
                                    // table.draw();
                                    window.location.reload();
                                    iziToast.success({
                                        title: 'success',
                                        message: 'Add Data Successfully',
                                        position: 'topRight'
                                    });
                                } else {
                                    $('#karyawanmodal').modal('hide');
                                    window.location.reload();
                                    // table.draw();
                                    iziToast.success({
                                        title: 'success',
                                        message: 'Edit Data Successfully',
                                        position: 'topRight'
                                    });
                                };

                            }
                        },
                    });
                });
                $('body').on('click', '#delete', function() {
                    let id = $(this).data('id');
                    let name = $(this).data('name');
                    let token = $("meta[name='csrf-token']").attr("content");
                    swal({
                            title: 'Are You Sure?',
                            text: "Deleted Data : " + name,
                            icon: 'warning',
                            buttons: true,
                            dangerMode: true,
                            showCancelButton: true,
                            cancelButtonText: 'TIDAK',
                        })
                        .then((willDelete) => {
                            if (willDelete) {
                                $.ajax({
                                    url: `/karyawan/${id}`,
                                    type: "DELETE",
                                    cache: false,
                                    data: {
                                        "_token": token
                                    },
                                    success: function(response) {
                                        iziToast.success({
                                            title: 'success',
                                            message: 'Data Barang : ' + name +
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

                // dropdown
                $('#kabupaten').prop('disabled', true);

                function onChangeSelect(url, id, name) {
                    $.ajax({
                        url: url + '/' + id,
                        type: 'GET',
                        success: function(data) {
                            let target = $('#' + name);
                            target.attr('disabled', false);
                            target.empty()
                            target.attr('placeholder', target.data('placeholder'))
                            target.append(`<option> ${target.data('placeholder')} </option>`)
                            $.each(data, function(key, value) {
                                if (key == idkab) {
                                    target.append(
                                        `<option value="${key}" selected  >${value}</option>`)
                                } else {
                                    target.append(`<option value="${key}"  >${value}</option>`)
                                }
                            });
                            idkab = '';
                        }
                    });
                }
                $('#provinsi').on('change', function() {
                    var id = $(this).val();
                    var url = `{{ URL::to('kabupaten-dropdown') }}`;
                    $('#kabupaten').empty().prop('disabled', false);
                    onChangeSelect(url, id, 'kabupaten');
                });


            });
        </script>
    @endpush
@endsection
