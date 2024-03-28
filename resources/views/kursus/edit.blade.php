@extends('layouts')
@section('konten')
    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline-block">Edit Data Course</h4>
                <a href="{{ route('kursus.index') }}"  type="button" class="btn  btn-secondary btn-rounded float-right">
                    <i class="fa fa-undo"></i> Back</a>
            </div>
         

        </div>

    </div>
@php
    
@endphp
    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-body">
                <form id="postForm" name="postForm" method="POST" action="{{ route('kursus.update') }}" enctype="multipart/form-data">
                    @csrf
                    <div id="error"></div>
                    <input type="text" name="id" id="id" value="{{ $id }}" hidden >
                    <div class="row">
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group ">
                                <label for="recipient-name" class="col-form-label">Registration Number:</label>
                                <input type="text" class="form-control"  value="{{ $regnumber }}"
                                readonly>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group ">
                                <label for="recipient-name" class="col-form-label">Student Name:</label>
                                <select name="studentname" id="studentname" class="form-select single-select-field1"
                                data-placeholder="Choose Student Name..." style="width:100%">
                                <option></option>
                                @foreach ($siswa as $item)
                                    <option value="{{ $item->id }}" {{ $sisw==$item->id ?'selected':'' }}>{{ $item->full_name }}</option>
                                @endforeach
                            </select>
                                <span class="text-danger error-text studentname_error"> </span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Registration Date:</label>
                                <div class="cal-icon">
                                    <input type="text" class="form-control datepicker" name="regdate" id="regdate" value="{{ $regdate }}"
                                        readonly>
                                </div>
                                <span class="text-danger error-text regdate_error"> </span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group ">
                                <label for="recipient-name" class="col-form-label">Receipt No:</label>
                                <input type="text" class="form-control" id="nopendaftaran" name="nopendaftaran"
                                    placeholder="Add Class ID" value="{{ $nopendaftaran }}">
                                <span class="text-danger error-text nopendaftaran_error"> </span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Start Date:</label>
                                <div class="cal-icon">
                                    <input type="text" class="form-control datepicker" name="startdate" id="startdate" value="{{ $startdate }}"
                                        readonly>
                                </div>
                                <span class="text-danger error-text startdate_error"> </span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group ">
                                <label>Class ID:</label>
                                <input type="text" class="form-control" id="idkelas" name="idkelas" value="{{ $classid }}"
                                    placeholder="Add Class ID">
                                <span class="text-danger error-text idkelas_error"> </span>
                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group ">
                                <label>Center:</label>
                                <select name="center" id="center" class="form-select single-select-field2"
                                    data-placeholder="Choose Center Office..." style="width:100%">
                                    <option></option>
                                    @foreach ($cabang as $item)
                                        <option value="{{ $item->id }}" {{ $center==$item->id ?'selected':'' }}>{{ $item->namacabang }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text center_error"> </span>

                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group ">
                                <label>Classroom:</label>
                                <select name="classroom" id="classroom" class="form-select single-select-field2"
                                    data-placeholder="Choose Classroom..." style="width:100%">
                                    <option></option>
                                    @foreach ($kelas as $item)
                                        <option value="{{ $item->id }}" {{ $classroom==$item->id ?'selected':'' }}>{{ $item->namakelas }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text classroom_error"> </span>

                            </div>
                        </div>

                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group ">
                                <label>Attended By:</label>
                                <select name="attended" id="attended" class="form-select single-select-field2"
                                    data-placeholder="Choose Attended By..." style="width:100%">
                                    <option></option>
                                    @foreach ($karyawan as $item)
                                        <option value="{{ $item->id }} " {{ $karyawans==$item->id ?'selected':'' }}>{{ $item->namalengkap }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger error-text attended_error"> </span>

                            </div>
                        </div>
                        <div class="col-lg-6 col-sm-12">
                            <div class="form-group ">
                                <label>Material Issued</label>
                                <div class=" checkbox-wrapper-2">
                                    <label>
                                        <input name="material_issued[]" type="checkbox" id="Course Material" value="Course Material"
                                            {{ in_array('Course Material',$material) ? 'checked' : '' }} class="sc-gJwTLC ikxBAC"/>
                                        <span>Course Material</span>
                                    </label>


                                </div>
                                <div class=" checkbox-wrapper-2">
                                    <label>
                                        <input name="material_issued[]" type="checkbox" id="Course Material" value="ICR Bag"
                                        {{ in_array('ICR Bag',$material) ? 'checked' : '' }} class="sc-gJwTLC ikxBAC"
                                           />
                                        <span>ICR Bag</span>
                                    </label>
                                </div>
                                <div class=" checkbox-wrapper-2">
                                    <label>
                                        <input name="material_issued[]" type="checkbox" id="Course Material" value="ICR Shirt"
                                        {{ in_array('ICR Shirt',$material) ? 'checked' : '' }} class="sc-gJwTLC ikxBAC"
                                           />
                                        <span>ICR Shirt</span>
                                    </label>
                                </div>
                                <div class=" checkbox-wrapper-2">
                                    <label>
                                        <input name="material_issued[]" type="checkbox" id="Course Material" value="ICR Pen and Sticker"
                                        {{ in_array('ICR Pen and Sticker',$material) ? 'checked' : '' }} class="sc-gJwTLC ikxBAC"
                                           />
                                        <span>ICR Pen and Sticker</span>
                                    </label>
                                </div>
                                <div class=" checkbox-wrapper-2">
                                    <label>
                                        <input name="material_issued[]" type="checkbox" id="Course Material" value="Pencil/Eraser/Ruler"
                                        {{ in_array('Pencil/Eraser/Ruler',$material) ? 'checked' : '' }} class="sc-gJwTLC ikxBAC"
                                           />
                                        <span>Pencil/Eraser/Ruler</span>
                                    </label>
                                </div>
                                <div class=" checkbox-wrapper-2">
                                    <label>
                                        <input name="material_issued[]" type="checkbox" id="Course Material" value="ICR Pencil Case"
                                        {{ in_array('ICR Pencil Case',$material) ? 'checked' : '' }} class="sc-gJwTLC ikxBAC"
                                           />
                                        <span>ICR Pencil Case</span>
                                    </label>
                                </div>
                                <span class="text-danger error-text medical_conditions_error"> </span>

                            </div>
                        </div>
                    </div>

                    <button id="savedata" name="savedata" type="button" class="btn btn-primary">Update</button>
                </form>
            </div>
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
                $('#savedata').click(function(e) {
                    e.preventDefault();
                    $.ajax({
                        data: $("#postForm").serialize(),
                        url: "{{ route('kursus.update') }}",
                        type: 'POST',
                        dataType: 'JSON',
                        beforeSend: function(e) {
                            $('#savedata').html('<i class="fa fa-spin fa-spinner"></i> Sending...');
                        },
                        complete: function(e) {
                            $('#savedata').html('Update');
                        },
                        success: function(data) {
                            if (data.status == 0) {
                                console.log(data.error)
                                $.each(data.error, function(prefix, val) {
                                    $('span.' + prefix + '_error').text(val[0]);
                                });
                            } else {
                                window.location.href = "{{ URL::to('kursus') }}"
                                iziToast.success({
                                    title: 'success',
                                    message: 'Data Berhasil',
                                    position: 'topRight'
                                });
                            }
                        },
                    })
                });

            });
        </script>
    @endpush
    
@endsection
