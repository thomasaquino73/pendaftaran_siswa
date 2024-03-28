@extends('layouts')
@section('konten')
    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline-block">REGISTRATION STUDENT</h4>
            </div>


        </div>

    </div>

    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-body">
                <form action="" method="POST">
                    <div class="lejen mb-3">
                        <h3>STUDENT DETAILS</h3>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Full Name</label>
                                <input class="form-control" type="text">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Family Name</label>
                                <input class="form-control" type="text">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Place Of Birth</label>
                                <input class="form-control" type="text">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Date Of Birth</label>
                                <div class="cal-icon">
                                    <input type="text" class="form-control datepicker" name="date_birth" id="date_birth"
                                        readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="form-group ">
                                    <label>Gender</label>
                                    <select name="gender" id="gender" class="form-select single-select-field1"
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
                                <input type="text" class="form-control " name="nationality" id="nationality">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="form-group ">
                                    <label>Medical Conditions</label>
                                    <div class="form-check">
                                        <input type="radio" name="medical_condition" id="r1" value="Yes"
                                            onclick="checkmedical()" /> Yes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" name="medical_condition" id="r2" value="No"
                                            onclick="checkmedical()" /> No
                                        </label>
                                    </div>
                                    <span class="text-danger error-text medical_conditions_error"> </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Medical Conditions Specify</label>
                                <input type="text" class="form-control " name="medical_note" id="medical_note">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="form-group ">
                                    <label>Has your child been diagnosed with any learning disability </label>
                                    <div class="form-check">
                                        <input type="radio" name="learning_disability" id="r3" value="Yes"
                                            onclick="checklearning()" /> Yes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" name="learning_disability" id="r4" value="No"
                                            onclick="checklearning()" /> No
                                        </label>
                                    </div>
                                    <span class="text-danger error-text medical_conditions_error"> </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Learning Disability Specify</label>
                                <input type="text" class="form-control " name="disability_note" id="disability_note">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>How did you get to know about I Can Read? </label>
                                <select name="know" id="know" multiple style="width:100%"
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
                    </div>
                    <div class="lejen mb-3">
                        <h3>PARENT/GUARDIAN INFORMATION</h3> <span> (Please provide at least 2 contacts in case of
                            emergencies)</span>
                        <button id="add-input" type="button" class="btn btn btn-primary btn-rounded float-right">
                            <i class="fa fa-plus"></i> Add Contact</button>
                    </div>
                    <table>
                        <tbody id="data">

                            <tr>
                                <td >
                                    <div class="kontak" style="border-bottom: 2px dashed rgb(211, 211, 211); padding:20px">
                                        <h2>Kontak 1</h2>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Full Name</label>
                                                    <input class="form-control" type="text" name="full_name_parent"
                                                        id="full_name_parent">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Family Name</label>
                                                    <input class="form-control" type="text" name="family_name_parent"
                                                        id="family_name_parent">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <div class="form-group ">
                                                        <label>Relationship</label>
                                                        <select name="gender_parent" id="gender_parent"
                                                            class="form-select single-select-field1"
                                                            data-placeholder="Choose Relationship ..." style="width:100%">
                                                            <option></option>
                                                            <option value="Father">Father</option>
                                                            <option value="Mother">Mother</option>
                                                            <option value="Grandparent">Grandparent</option>
                                                            <option value="Guardian">Guardian</option>
                                                            <option value="Others">Others</option>
                                                        </select>
                                                        <span class="text-danger error-text gender_parent_error"> </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email" class="form-control " name="email_parent"
                                                        id="email_parent">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Phone (Mobile / Home)</label>
                                                    <input class="form-control" type="text" name="full_name_parent"
                                                        id="full_name_parent">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Phone Office</label>
                                                    <input class="form-control" type="text" name="family_name_parent"
                                                        id="family_name_parent">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-block" value="sAVE"><i class="fa fa-save"></i>
                            SAVE</button>
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
                $('#jeniskelamin').select2({
                    theme: "bootstrap-5",
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                        'style',
                    placeholder: $(this).data('placeholder'),
                    // allowClear: true,
                });
                $('#jeniskelamin').select2({
                    theme: "bootstrap-5",
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                        'style',
                    placeholder: $(this).data('placeholder'),
                    // allowClear: true,
                });
                $('#know').select2();
                $('.single-select-field2').select2({
                    theme: "bootstrap-5",
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                        'style',
                    placeholder: $(this).data('placeholder'),
                    // allowClear: true,
                });
                $('.single-select-field1').select2({
                    theme: "bootstrap-5",
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                        'style',
                    placeholder: $(this).data('placeholder'),
                    // allowClear: true,
                });

            });
            document.getElementById('medical_note').disabled = true;
            document.getElementById('disability_note').disabled = true;

            function checkmedical() {
                if (document.getElementById('r1').checked) {

                    document.getElementById('medical_note').disabled = false;
                } else {
                    document.getElementById('medical_note').disabled = true;
                }
            }

            function checklearning() {
                if (document.getElementById('r3').checked) {

                    document.getElementById('disability_note').disabled = false;
                } else {
                    document.getElementById('disability_note').disabled = true;
                }
            }

            let dataRow = 1
            $('#add-input').click(() => {
                dataRow++
                inputRow(dataRow)
            })

            inputRow = (i) => {

                let tr = `<tr id="input-tr-${i}">
                        <td style="border-bottom: 2px dashed rgb(211, 211, 211); padding:20px">
                            <div id="kontak">
                                <h2>Kontak ${i}</h2>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input class="form-control" type="text" name="full_name_parent"
                                        id="full_name_parent">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Family Name</label>
                                    <input class="form-control" type="text" name="family_name_parent"
                                        id="family_name_parent">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="form-group ">
                                        <label>Relationship</label>
                                        <select name="gender_parent" id="gender_parent"
                                            class="form-select single-select-field1"
                                            data-placeholder="Choose Relationship ..." style="width:100%">
                                            <option></option>
                                            <option value="Father">Father</option>
                                            <option value="Mother">Mother</option>
                                            <option value="Grandparent">Grandparent</option>
                                            <option value="Guardian">Guardian</option>
                                            <option value="Others">Others</option>
                                        </select>
                                        <span class="text-danger error-text gender_parent_error"> </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control " name="email_parent" id="email_parent">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Phone (Mobile / Home)</label>
                                    <input class="form-control" type="text" name="full_name_parent"
                                        id="full_name_parent">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Phone Office</label>
                                    <input class="form-control" type="text" name="family_name_parent"
                                        id="family_name_parent">
                                </div>
                            </div>

                        </div>
                    </div>
                            
                            </td>
                        <td><button class="btn btn-sm btn-danger delete-record float-end" data-id="${i}">Hapus</button></td>
                    </tr>`
                $('#data').append(tr)
            }

            $('#data').on('click', '.delete-record', function() {
                let id = $(this).attr('data-id')
                $('#input-tr-' + id).remove()
            })
        </script>
    @endpush
@endsection
