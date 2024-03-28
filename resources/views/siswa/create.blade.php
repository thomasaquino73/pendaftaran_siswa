@extends('layouts')
@section('konten')
    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline-block">REGISTRATION STUDENT</h4>
                <a href="{{ route('siswa.index') }}" type="button" class="btn btn btn-secondary btn-rounded float-right">
                    <i class="fa fa-undo"></i> Back</a>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('siswa.store') }}" id="postForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <div class="lejen mb-3">
                        <h3>STUDENT PERSONAL INFO</h3>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Full Name</label>
                                <input class="form-control  @error('full_name') is-invalid : is-valid @enderror"
                                    type="text" name="full_name" value="{{ old('full_name') }}">
                                    <span class="text-danger error-text full_name_error"> {{$errors->first('full_name') }}</span>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Family Name</label>
                                <input class="form-control @error('familynamestudent') is-invalid @enderror" type="text"
                                    name="familynamestudent" value="{{ old('familynamestudent') }}">
                                <span class="text-danger error-text familynamestudent_error"> </span>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Place Of Birth</label>
                                <input class="form-control @error('pobstudent') is-invalid @enderror" type="text"
                                    name="pobstudent" value="{{ old('pobstudent') }}">
                                <span class="text-danger error-text pobstudent_error"> </span>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Date Of Birth</label>
                                <div class="form-group">
                                    <div class="cal-icon">
                                        <input value="{{ old('dobstudent') }}" name="dobstudent" type="text"
                                            class="form-control datepicker" readonly>
                                        <span class="text-danger error-text dobstudent_error"> </span>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="form-group ">
                                    <label>Gender</label>
                                    <select name="gender" id="gender"
                                        class="form-select single-select-field1 @error('gender') is-invalid @enderror"
                                        data-placeholder="Choose Gender..." style="width:100%">
                                        <option></option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                    <span class="text-danger error-text gender_error"> </span>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Nationality</label>
                                <input type="text" class="form-control  @error('nationality') is-invalid @enderror"
                                    name="nationality" id="nationality" value="{{ old('nationality') }}">
                                <span class="text-danger error-text nationality_error"> </span>

                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control  @error('address') is-invalid @enderror"
                                    name="address" id="address" value="{{ old('address') }}">
                                <span class="text-danger error-text address_error"> </span>

                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="form-group ">
                                    <label>Provence</label>
                                    <select name="provinsi" id="provinsi"
                                        class="form-select single-select-field @error('provinsi') is-invalid @enderror"
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
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="form-group ">
                                    <label>Distric</label>
                                    <select name="kabupaten" id="kabupaten" class="form-select single-select-field1"
                                        style="width:100%" data-placeholder="Choose Disctric...">
                                        @foreach ($kabupaten as $kab)
                                            <option value="{{ $kab->id }}">{{ $kab->nama }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger error-text kabupaten_error"> </span>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="form-group ">
                                    <label>Medical Conditions</label>
                                    <div class="form-check">
                                        <label>
                                            <input name="medical_conditions" type="radio" id="r1" value="Yes"
                                                {{ old('medical_conditions') == 'Yes' ? 'checked' : '' }}
                                                onclick="checkmedical()" />
                                            <span>Yes</span>
                                        </label>


                                    </div>
                                    <div class="form-check">
                                        <label>
                                            <input name="medical_conditions" type="radio" id="r2"
                                                value="No" {{ old('medical_conditions') == 'No' ? 'checked' : '' }}
                                                onclick="checkmedical()" />
                                            <span>No</span>
                                        </label>

                                    </div>
                                    <span class="text-danger error-text medical_conditions_error"> </span>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Medical Conditions Specify</label>
                                <input type="text" class="form-control " name="medical_note" id="medical_note"
                                    value="{{ old('medical_note') }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="form-group ">
                                    <label>Has your child been diagnosed with any learning disability </label>
                                    <div class="form-check">
                                        <label>
                                            <input name="disability_condition" type="radio" id="r3"
                                                value="Yes" {{ old('medical_conditions') == 'Yes' ? 'checked' : '' }}
                                                onclick="checklearning()" />
                                            <span>Yes</span>
                                        </label>

                                    </div>
                                    <div class="form-check">
                                        <label>
                                            <input name="disability_condition" type="radio" id="r4"
                                                value="No" {{ old('medical_conditions') == 'No' ? 'checked' : '' }}
                                                onclick="checklearning()" />
                                            <span>No</span>
                                        </label>

                                    </div>
                                    <span class="text-danger error-text disability_condition_error"> </span>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Learning Disability Specify</label>
                                <input type="text" class="form-control " name="disability_note" id="disability_note"
                                    value="{{ old('disability_note') }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>How did you get to know about I Can Read? </label>
                                <select name="info[]" multiple style="width:100%" class="form-select info "
                                    data-placeholder="Choose....">
                                    <option value="Mail Drop">Mail Drop</option>
                                    <option value="Advertisement">Advertisement</option>
                                    <option value="Roadshow/Event">Roadshow/Event</option>
                                    <option value="Family and Friends">Family and Friends</option>
                                    <option value="I Can Read Website">I Can Read Website</option>
                                    <option value="Social Media">Social Media</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Photo</label>
                                <input type="file" class="form-control " name="foto" id="foto">
                            </div>
                        </div>
                    </div>
                    <div class="lejen mb-3 mt-5">
                        <h3>PARENT/GUARDIAN INFORMATION</h3> <span> (Please provide at least 2 contacts in case of
                            emergencies)</span>

                    </div>
                    @if ($errors->any())
                        <div class="alert alert danger">
                            <ul>
                                @foreach ($errors->all() as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="block" style="border-bottom: 2px dashed rgb(211, 211, 211); padding:20px">
                        <h2>Contact </h2>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input class="form-control" type="text" name="inputs[0][full_name_parent]"
                                        id="full_name_parent">
                                        <span class="text-danger error-text full_name_parent_error"> </span>
                                        @error('full_name_parent')
                        <span class="text-danger">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Family Name</label>
                                    <input class="form-control" type="text" name="inputs[0][family_name_parent]">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="form-group ">
                                        <label>Relationship</label>
                                        <select name="inputs[0][relation]" id="relation"
                                            class="form-select single-select-field"
                                            data-placeholder="Choose Relationship ..." style="width:100%">
                                            <option></option>
                                            <option value="Father">Father</option>
                                            <option value="Mother">Mother</option>
                                            <option value="Grandparent">Grandparent</option>
                                            <option value="Guardian">Guardian</option>
                                            <option value="Others">Others</option>
                                        </select>
                                        <span class="text-danger error-text relation_error"> </span>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control " name="inputs[0][email]"
                                        id="email_parent">
                                    <span class="text-danger error-text email_error"> </span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Phone (Mobile / Home)</label>
                                    <input class="form-control" type="text" name="inputs[0][mobile_no]"
                                        id="mobile_no">
                                    <span class="text-danger error-text mobile_no_error"> </span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Phone Office</label>
                                    <input class="form-control" type="text" name="inputs[0][office_no]"
                                        id="office_no">
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="contact"></div>
                    <button id="add" name="add" type="button" class="addcontact btn btn-primary  mt-3 ">Add
                        Contact</button>
                    <div class="devider"></div>
                    <div class="modal-footer">
                        {{-- <button type="submit" class="btn btn-primary btn-block">Save</button> --}}
                        <button id="savedata" name="savedata" type="submit"
                            class="btn btn-primary btn-block">Save</button>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
    @push('scripts')
        <script type="text/javascript">
            var idkab = '';
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var i = 0;
                $('.addcontact').click(function() {
                    ++i;
                    // $('.block:last').after(
                    //     '<div class="block" style="border-bottom: 2px dashed rgb(211, 211, 211); padding:20px">' +
                    //     '<h2>Contact </h2><button type = "button"class = "btn btn-danger btn-rounded float-right remove">' +
                    //     '<i class = "fa fa-trash" > </i> Delete</button > <div class = "row" > <div class ="col-lg-6" > ' +
                    //     '<div class = "form-group" ><label> Full Name </label> <input class = "form-control" type = "text" name="inputs['+i+'][full_name_parent]" id="full_name_parent" ></div> </div > <div class = "col-lg-6" ><div class = "form-group" >' +
                    //     '<label> Family Name </label> <input class ="form-control" type ="text" name="inputs['+i+'][family_name_parent]" id="family_name_parent" > </div> </div> <div class="col-lg-6" ><div class = "form-group" ><div class = "form-group " ><label> Relationship </label> <select name="inputs['+i+'][relation]" id="relation'+i+'" class="form-select single-select-field" data-placeholder = "Choose Relationship ..."style = "width:100%" >' +
                    //     '<option> </option> <option value ="Father"> Father </option> <option value = "Mother" > Mother </option> <option value = "Grandparent" > Grandparent </option> <option value = "Guardian" > Guardian </option> <option value = "Others" > Others </option> </select > <span class = "text-danger error-text gender_parent_error" > </span> </div > </div> </div > <div class = "col-lg-6" ><div class = "form-group" ><label> Email </label> <input type="email" class ="form-control " name="inputs['+i+'][email]" id="email_parent" ></div> </div> <div class = "col-lg-6" ><div class = "form-group" ><label> Phone(Mobile / Home) </label> <input class = "form-control"type = "text" name="inputs['+i+'][mobile_no]" id = "mobilephone" ></div> </div > <div class = "col-lg-6" ><div class = "form-group" > <label> Phone Office </label> <input class = "form-control"type = "text" name="inputs['+i+'][office_no]" id="officephone" > </div> </div ></div> </div > '
                    //     );
                    $('.block:last').after(
                        `<div class="block" style="border-bottom: 2px dashed rgb(211, 211, 211); padding:20px">
                        <span class="mb-3" style="font-size:30px">Contact </span><button type = "button"class = "btn btn-danger btn-rounded  remove"><i class = "fa fa-trash" > </i> Delete</button > 
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input class="form-control" type="text" name="inputs[` + i + `][full_name_parent]"
                                        id="full_name_parent">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Family Name</label>
                                    <input class="form-control" type="text" name="inputs[` + i + `][family_name_parent]">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="form-group ">
                                        <label>Relationship</label>
                                        <select name="inputs[` + i + `][relation]" id="relation` + i + `"
                                            class="form-select single-select-field"
                                            data-placeholder="Choose Relationship ..." style="width:100%">
                                            <option></option>
                                            <option value="Father">Father</option>
                                            <option value="Mother">Mother</option>
                                            <option value="Grandparent">Grandparent</option>
                                            <option value="Guardian">Guardian</option>
                                            <option value="Others">Others</option>
                                        </select>
                                        <span class="text-danger error-text relation_error"> </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control " name="inputs[` + i + `][email]" id="email_parent">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Phone (Mobile / Home)</label>
                                    <input class="form-control" type="text" name="inputs[` + i + `][mobile_no]"
                                        id="mobilephone">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Phone Office</label>
                                    <input class="form-control" type="text" name="inputs[` + i + `][office_no]"
                                        id="officephone">
                                </div>
                            </div>

                        </div>
                    </div>`
                    );
                    $('#relation' + i).select2({
                        theme: "bootstrap-5",
                        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass(
                            'w-100') ? '100%' : 'style',
                        placeholder: $(this).data('placeholder'),
                    });

                });
                $('.single-select-field').select2({
                    theme: "bootstrap-5",
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass(
                        'w-100') ? '100%' : 'style',
                    placeholder: $(this).data('placeholder'),
                    // allowClear: true,
                });
                $('body').on('click', '.remove', function() { // use event delegation because you're adding to the DOM
                    $(this).parent('.block').remove();
                });
                @if (Session::has('message'))
                    iziToast.{{ Session::get('alert') }}({
                        title: '{{ Session::get('alert') }}',
                        message: '{{ Session::get('pesan') }}',
                        position: 'topRight'
                    });
                @endif
                $('#jeniskelamin').select2({
                    theme: "bootstrap-5",
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                        'style',
                    placeholder: $(this).data('placeholder'),
                    // allowClear: true,
                });

                $('#know').select2();


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
                            $.each(data.error, function(prefix, val) {
                                $('span.' + prefix + '_error').text(val[0]);
                             
                            });
                            $.each(data.error, function(key, value) {
                                var element = $('[name="'+key+'"]');
                                element.addClass('is-invalid');
                            });
                            iziToast.error({
                                title: 'Error',
                                message: 'Please Check Your Data',
                                position: 'topRight'
                            });
                        } else {
                            window.location.href = "{{ URL::to('siswa') }}"
                            // var element = $('[name="'+key+'"]');
                            //     element.removeClass('is-invalid');
                            //     element.addClass('isvalid');
                            iziToast.success({
                                title: 'success',
                                message: 'Add Data Successfully',
                                position: 'topRight'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        // var responseJson = json.parse(Xhr.responseText);
                        // var message = responseJson.message;
                        // var errors = responseJson.errors;
                        // $.each(errors, function(key, value) {
                        //     var element = $('[name="'+key+'"]');
                        //     element.addClass('is-invalid');
                        // });
                    },
                });
            });
            // document.getElementById('medical_note').disabled = true;
            // document.getElementById('disability_note').disabled = true;
            $("#disability_note").hide();
            $("#medical_note").hide();

            function checkmedical() {
                if (document.getElementById('r1').checked) {
                    $("#medical_note").show();

                    // document.getElementById('medical_note').disabled = false;
                } else {
                    $("#medical_note").hide();
                    $('#medical_note').val('');
                    // document.getElementById('medical_note').disabled = true;
                }
            }


            function checklearning() {
                if (document.getElementById('r3').checked) {
                    // document.getElementById('disability_note').hide() ;
                    $("#disability_note").show();
                } else {
                    $("#disability_note").hide();
                    $('#disability_note').val('');
                    // document.getElementById('disability_note').removeClass('none') = true;
                }
            }
            // dropdown
            $('#kabupaten').prop('disabled', true);

            function onChangeSelect(url, id, name) {
                $.ajax({
                    url: url + '/' + id,
                    type: 'GET',
                    success: function(data) {
                        console.log(data);
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
        </script>
    @endpush
@endsection
