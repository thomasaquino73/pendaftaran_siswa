@extends('layouts')
@section('konten')
    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline-block">Course Registration</h4>
                @php
                    $user = Auth()->user();
                @endphp
                @if ($user->can('course-create')) 
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
                {{-- <button class="btn btn btn-primary "><i class="fa fa-file-pdf-o"></i> PDF</button>
                <button class="btn btn btn-primary "><i class="fa fa-file-excel-o"></i> Excel</button>
                <button class="btn btn btn-primary "><i class="fa fa-print"></i> Print</button> --}}
                <div class="row filter-row">
                    <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                        <div class="form-group form-focus select-focus focused">
                            <label class="focus-label">Classroom</label>
                            <select class="select floating select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                <option> -- Select -- </option>
                                @foreach ($kelas as $item)
                                    <option value="{{ $item->id }}">{{ $item->namakelas }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                        <div class="form-group form-focus select-focus focused">
                            <label class="focus-label">Center Office</label>
                            <select class="select floating select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                                <option> -- Select -- </option>
                                @foreach ($cabang as $item)
                                    <option value="{{ $item->id }}">{{ $item->namacabang }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                        <div class="form-group form-focus focused">
                            <label class="focus-label">Registration</label>
                            <div class="cal-icon">
                                <input class="form-control floating datetimepicker" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                        <div class="form-group form-focus focused">
                            <label class="focus-label">Start Date</label>
                            <div class="cal-icon">
                                <input class="form-control floating datetimepicker" type="text">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
                        <a href="#" class="btn btn-success btn-block"> Search </a>
                    </div>
                </div>
                <div class="table-responsive">

                    <table id="kursus" class="display ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Receipt Number</th>
                                <th>Registration Date</th>
                                <th>Start Date</th>
                                <th>Student Name</th>
                                <th>Center</th>
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
            label {
                font-size: 14px;
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
                $('.single-select-field1').select2({
                    theme: "bootstrap-5",
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                        'style',
                    placeholder: $(this).data('placeholder'),
                    minimumInputLength: 1,
                    // allowClear: true,
                });
                $('.single-select-field2').select2({
                    theme: "bootstrap-5",
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                        'style',
                    placeholder: $(this).data('placeholder'),
                    // allowClear: true,
                });


                let table = new DataTable('#kursus', {
                    processing: true,
                    searching: false,
                    serverSide: true,
                    ajax: '{{ route('kursus.index') }}',
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'nopendaftaran',
                        },
                        {
                            data: 'regdate',
                        },
                        {
                            data: 'startdate',
                        },
                        {
                            data: 'full_name',
                        },
                        {
                            data: 'namacabang',
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
                    $('#modalHeading').html('Add Course Data');
                    $('#postForm').trigger('reset');
                    $('#id').val('');
                    $('#classroom').val('').trigger('change');

                });

                $('body').on('click', '.editPost', function(a) {
                    $('#savedata').html('Ubah');
                    var id = $(this).data('id');
                    console.log(id);
                    $.ajax({
                        type: "get",
                        // url: '{{ url('kursus') }}' + '/' + a + '/edit',
                        url: "{{ url('edit-kursus') }}",
                        data: {
                            id: id
                        },
                        datatype: 'json',
                        success: function(data) {
                            // datax = JSON.parse(data);
                            // console.log(data);
                            $('#modalHeading').html('Edit Course');
                            $('#modal').modal('show');
                            $('#id').val(data.id);
                            $('#nopendaftaran').val(data.nopendaftaran);
                            $('#regdate').val(data.regdate);

                            $('#center').val(data.idcabang);
                            $('#center').trigger('change');

                            $('#idkelas').val(data.idkelas);
                            $('#startdate').val(data.startdate);

                            $('#classroom').val(data.idkelas);
                            $('#classroom').trigger('change');


                            $('#attended').val(data.karyawanid);
                            $('#attended').trigger('change');
                            console.log(data.materialissued);
                            // $('.nopendaftaran_error').html('');
                        }
                    });
                });

                $('#savedata').click(function(e) {
                    e.preventDefault();
                    $.ajax({
                        data: $("#postForm").serialize(),
                        url: "{{ route('kursus.store') }}",
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
                                    url: `/kursus/${id}`,
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
    <div class="modal fade" id="modal" data-backdrop="static" data-keyboard="false"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalHeading"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="postForm" name="postForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div id="error"></div>
                        <input type="text" name="id" id="id" hidden>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group ">
                                    <label for="recipient-name" class="col-form-label">Student Name:</label>
                                    <select name="studentname" id="studentname" class="form-select single-select-field1"
                                        data-placeholder="Choose Student Name..." style="width:100%">
                                        <option></option>
                                        @foreach ($siswa as $item)
                                            <option value="{{ $item->id }}">{{ $item->full_name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-text studentname_error"> </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Registration Date:</label>
                                    <div class="cal-icon">
                                        <input type="text" class="form-control datepicker" name="regdate" id="regdate"
                                            readonly>
                                    </div>
                                    <span class="text-danger error-text regdate_error"> </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group ">
                                    <label for="recipient-name" class="col-form-label">Receipt No:</label>
                                    <input type="text" class="form-control" id="nopendaftaran" name="nopendaftaran"
                                        placeholder="Add Receipt No">
                                    <span class="text-danger error-text nopendaftaran_error"> </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Start Date:</label>
                                    <div class="cal-icon">
                                        <input type="text" class="form-control datepicker" name="startdate"
                                            id="startdate" readonly>
                                    </div>
                                    <span class="text-danger error-text startdate_error"> </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group ">
                                    <label>Class ID:</label>
                                    <input type="text" class="form-control" id="idkelas" name="idkelas"
                                        placeholder="Add Class ID">
                                    <span class="text-danger error-text idkelas_error"> </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group ">
                                    <label>Center:</label>
                                    <select name="center" id="center" class="form-select single-select-field2"
                                        data-placeholder="Choose Center Office..." style="width:100%">
                                        <option></option>
                                        @foreach ($cabang as $item)
                                            <option value="{{ $item->id }}">{{ $item->namacabang }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-text center_error"> </span>

                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group ">
                                    <label>Classroom:</label>
                                    <select name="classroom" id="classroom" class="form-select single-select-field2"
                                        data-placeholder="Choose Classroom..." style="width:100%">
                                        <option></option>
                                        @foreach ($kelas as $item)
                                            <option value="{{ $item->id }}">{{ $item->namakelas }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-text classroom_error"> </span>

                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group ">
                                    <label>Attended By:</label>
                                    <select name="attended" id="attended" class="form-select single-select-field2"
                                        data-placeholder="Choose Attended By..." style="width:100%">
                                        <option></option>
                                        @foreach ($karyawan as $item)
                                            <option value="{{ $item->id }}">{{ $item->namalengkap }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-text attended_error"> </span>

                                </div>
                            </div>
                            <div class="col-sm-12">
                                    <fieldset>

                                    <legend>Material Issued</legend>
                                    <div class="form-check checkbox-wrapper-2">
                                        <label>
                                            <input name="material_issued[]" type="checkbox" id="Course_Material"
                                                value="Course Material" class="sc-gJwTLC ikxBAC" />
                                            <span>Course Material</span>
                                        </label>
                                    </div>
                                    <div class="form-check checkbox-wrapper-2">
                                        <label>
                                            <input name="material_issued[]" type="checkbox" id="Course_Material"
                                                value="ICR Bag" class="sc-gJwTLC ikxBAC"  />
                                            <span>ICR Bag</span>
                                        </label>
                                    </div>
                                    <div class="form-check checkbox-wrapper-2">
                                        <label>
                                            <input name="material_issued[]" type="checkbox" id="Course_Material"
                                                value="ICR Shirt" class="sc-gJwTLC ikxBAC" />
                                            <span>ICR Shirt</span>
                                        </label>
                                    </div>
                                    <div class="form-check checkbox-wrapper-2">
                                        <label>
                                            <input name="material_issued[]" type="checkbox" id="Course_Material"
                                                value="ICR Pen and Sticker" class="sc-gJwTLC ikxBAC" />
                                            <span>ICR Pen and Sticker</span>
                                        </label>
                                    </div>
                                    <div class="form-check checkbox-wrapper-2">
                                        <label>
                                            <input name="material_issued[]" type="checkbox" id="Course_Material"
                                                value="Pencil/Eraser/Ruler" class="sc-gJwTLC ikxBAC" />
                                            <span>Pencil/Eraser/Ruler</span>
                                        </label>
                                    </div>
                                    <div class="form-check checkbox-wrapper-2">
                                        <label>
                                            <input name="material_issued[]" type="checkbox" id="Course_Material"
                                                value="ICR Pencil Case" class="sc-gJwTLC ikxBAC" />
                                            <span>ICR Pencil Case</span>
                                        </label>
                                    </div>
                                    <span class="text-danger error-text medical_conditions_error"> </span>

                                </fieldset>

                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button id="savedata" name="savedata" type="button" class="btn btn-success"></button>
                </div>
                </form>
            </div>
        </div>

    </div>
    @push('style')
        <style>
            legend {
                font-weight: 100;
            }

            fieldset>*+* {
                margin-top: 0.5rem;
             
            }

            input[type="checkbox"],
            input[type="radio"] {
                width: 1.2em;
                height: 1.2em;
                margin-right: 0.65rem;
            }

            input[type="range"],
            progress {
                margin-left: auto;
                flex: 0 1 50%;
            }

            form {
                border:1px solid rgb(213, 213, 213);
                padding: 1.5rem;
                /* background-color: rgb(243, 243, 243); */
                border-radius: 0.5rem;
            }
            * {
	box-sizing: border-box;
}
        </style>
    @endpush
@endsection
