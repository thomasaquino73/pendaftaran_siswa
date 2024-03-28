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
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="#">STUDENT PERSONAL INFORMATION</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('siswa') }}">PARENT/GUARDIAN INFORMATION</a>
                    </li>
                  </ul>
                <div class="lejen mb-3 mt-3">
                    <h3>STUDENT PROFILE</h3>
                </div>
                    {{-- <a href="{{ url('siswa/'.$siswa->code.'/edit') }}"  type="button" class="btn btn btn-success btn-rounded float-right">
                        <i class="fa fa-edit"></i> Edit Data</a> --}}
                <div class="row">
                    <div class="col-sm-3">
                        @if (!empty($siswa->foto))
                        <img src="{{ asset('').$siswa->foto }}" alt="" srcset="">
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
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-12 col-lg-12 col-xl-12 ">
        <div class="card mb-5">
            <div class="card-body">
                <div class="lejen mb-3">
                    <h3>PARENT/GUARDIAN INFORMATION</h3> <span> (Please provide at least 2 contacts in case of
                        emergencies)</span>
                        <a href="javascript:void(0);" id="create" type="button" class="btn btn btn-primary btn-rounded float-right">
                            <i class="fa fa-plus"></i> Add Data</a>
                </div>
                <table class="table table-striped custom-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Family Name</th>
                            <th>Relationship</th>
                            <th>Email</th>
                            <th>Phone (Mobile/Home)</th>
                            <th>Phone Office</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no=1;
                            $where=[
                                'siswa.code' => $siswa->code
                            ];
                            $sis=DB::table('siswa')->join('parent','parent.code','=','siswa.code','')
                            ->where($where)->get();
                        @endphp
                        @foreach ( $sis as $sis )
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $sis->full_name_parent }}</td>
                            <td>{{ $sis->family_name }}</td>
                            <td>{{ $sis->relation }}</td>
                            <td>{{ $sis->email }}</td>
                            <td>{{ $sis->mobile_no }}</td>
                            <td>{{ $sis->office_no }}</td>
                        </tr>
                        @endforeach
                        
                      
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
