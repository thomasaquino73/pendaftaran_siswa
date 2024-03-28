@extends('layouts')
@section('konten')
    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline-block">Student Detail</h4>
                <a href="{{ route('siswa.index') }}" type="button" class="btn btn btn-secondary btn-rounded float-right"> <i
                        class="fa fa-undo"></i> Back</a>
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
                <div class="lejen mb-3">
                    <h3>STUDENT PROFILE</h3>
                </div>
                <form action="{{ url('siswa/update') }}" method="post">
                <div class="row">
                    <div class="col-sm-3">
                        @if (!empty($row->foto))
                            <img src="{{ asset('') . $siswa->foto }}" alt="" srcset="">
                        @else
                            <img width="100%" height="" src="{{ asset('') }}assets/img/user.jpg" class="p-3"
                                alt="">
                        @endif
                        <div class="row">
                            <div class="form-group  col-sm-12">
                                <label>Reg.Number</label>
                                <input class="form-control  " type="text" value="{{ $siswa->reg_number}} " disabled>
                            </div>
                            <div class="form-group  col-sm-12">
                                <label>Medical Conditions : {{ $siswa->medical_conditions }}</label>
                                <input class="form-control  " type="text" value="{{ $siswa->medical_note }}" disabled>
                            </div>
                            <div class="form-group  col-sm-12">
                                <label>Disability Conditions : {{ $siswa->disability_condition }}</label>
                                <input class="form-control  " type="text" value="{{ $siswa->disability_note }}" disabled>
                            </div>
                        </div>

                    </div>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="form-group  col-lg-6">
                                <label>Full Name</label>
                                <input class="form-control  " type="text" value="{{ $siswa->full_name }}" disabled>
                            </div>
                            <div class="form-group  col-lg-6">
                                <label>Family Name</label>
                                <input class="form-control  " type="text" value="{{ $siswa->family_name }}" disabled>
                            </div>
                            <div class="form-group  col-lg-6">
                                <label>Place Of Birth</label>
                                <input class="form-control " type="text" value="{{ $siswa->place_birth }}" disabled>
                            </div>
                            <div class="form-group  col-lg-6">
                                <label>Date Of Birth</label>
                                <input class="form-control  " type="text" value="{{ $siswa->date_birth }}" disabled>
                            </div>
                            <div class="form-group  col-lg-6">
                                <label>Gender</label>
                                <input class="form-control " type="text" value="{{ $siswa->gender }}" disabled>
                            </div>
                            <div class="form-group  col-lg-6">
                                <label>Nationality</label>
                                <input class="form-control  " type="text" value="{{ $siswa->nationality }}" disabled>
                            </div>
                            <div class="form-group  col-lg-12">
                                <label>Address</label>
                                <input class="form-control  " type="text" value="{{ $siswa->address }}" disabled>
                            </div>
                            <div class="form-group  col-lg-6">
                                <label>Distric</label>
                                <input class="form-control " type="text" value="{{ $siswa->kabupaten->nama }}" disabled>
                            </div>
                            <div class="form-group  col-lg-6">
                                <label>Provence</label>
                                <input class="form-control  " type="text" value="{{ $siswa->provinsi->nama }}" disabled>
                            </div>
                            <div class="form-group  col-lg-12">
                                <label>How did you get to know about I Can Read?</label>
                                <input class="form-control  " type="text" value="{{ $siswa->icr_info }}" disabled>
                            </div>
                        </div>
                    </div>
                    <a href="{{ url('siswa/'.$siswa->code.'/edit') }}"  type="button" class="btn btn btn-success ">
                    <i class="fa fa-edit"></i> Edit Data</a>
                </div>
            </form>
            </div>
        </div>
    </div>
    
@endsection
