@extends('layouts')
@section('konten')
<div class="content">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title">Edit Company Profile</h4>
        </div>
    </div>
    <form action="{{ url('perusahaan/' . $dataperusahaan->id) }}" class="form-horizontal form-label-left"
        method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-box">
            <h3 class="card-title">Company Data</h3>
            <div class="row">
                <div class="col-md-12">
                    <div class="profile-img-wrap">
                        <img class="inline-block" src="{{ asset('').$dataperusahaan->logo }}" alt="logogue">
                        <div class="fileupload btn">
                            <span class="btn-text">edit</span>
                            <input class="upload" type="file" id="logo" name="logo">
                        </div>
                    </div>
                    <div class="profile-basic">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="focus-label">Company Name</label>
                                    <input type="text" class="form-control floating" name="namaperusahaan" value="{{ $dataperusahaan->namaperusahaan }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="focus-label">Address</label>
                                    <input type="text" class="form-control floating" name="alamat" value="{{ $dataperusahaan->alamat }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="focus-label">Email</label>
                                    <input type="text" class="form-control floating" name="email" value="{{ $dataperusahaan->email }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="focus-label">Phone Number</label>
                                    <input type="text" class="form-control floating" name="notel" value="{{ $dataperusahaan->notel }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="card-box">
            <h3 class="card-title">Contact Informations</h3>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group form-focus">
                        <label class="focus-label">Address</label>
                        <input type="text" class="form-control floating" value="4487 Snowbird Lane">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group form-focus">
                        <label class="focus-label">State</label>
                        <input type="text" class="form-control floating" value="New York">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group form-focus">
                        <label class="focus-label">Country</label>
                        <input type="text" class="form-control floating" value="United States">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group form-focus">
                        <label class="focus-label">Pin Code</label>
                        <input type="text" class="form-control floating" value="10523">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group form-focus">
                        <label class="focus-label">Phone Number</label>
                        <input type="text" class="form-control floating" value="631-889-3206">
                    </div>
                </div>
            </div>
        </div> --}}
        
        <div class="text-center m-t-20">
            <a href="{{ route('perusahaan.index') }}" class="btn btn-secondary submit-btn" type="button">Cancel</a>
            <button class="btn btn-primary submit-btn" type="submit">Save</button>
        </div>
    </form>
</div>
@endsection