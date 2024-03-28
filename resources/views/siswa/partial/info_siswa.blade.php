<div class="lejen mb-3 mt-3">
    <h3>STUDENT PROFILE</h3>
</div>
{{-- <a href="{{ url('siswa/'.$siswa->code.'/edit') }}"  type="button" class="btn btn btn-success btn-rounded float-right">
        <i class="fa fa-edit"></i> Edit Data</a> --}}
<div class="row">
    <div class="col-sm-3">
        @if (!empty($siswa->foto))
            <img width="150px" src="{{ asset('') . $siswa->foto }}" alt="" srcset="">
        @else
            <img width="120px" height="" src="{{ asset('') }}assets/img/user.jpg" class="p-3" alt="">
        @endif
        <div class="row mt-3">
            <div class="form-group  col-sm-12">
                <label>Reg.Number :</label>
                <span>{{ $siswa->reg_number }}</span>
            </div>
            <div class="form-group  col-sm-12">
                <label>Status :</label>
                <span></span>
                {{-- <a href="{{ route('status.update', [
                    'model' => 'siswa',
                    'id' => $siswa->id,
                    'status' => 'non-aktif',
                ]) }}"
                    class="btn btn-primary">
                    {{ $siswa->status == 'aktif' ? 'Non Aktifkan' : 'Aktifkan' }}
                </a> --}}

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
            <div class="form-group  col-lg-6">
                <label>Medical Conditions : {{ $siswa->medical_conditions }}</label>
                <input class="form-control  " type="text" value="{{ $siswa->medical_note }}" disabled>
            </div>
            <div class="form-group  col-lg-6">
                <label>Disability Conditions : {{ $siswa->disability_condition }}</label>
                <input class="form-control  " type="text" value="{{ $siswa->disability_note }}" disabled>
            </div>
            <div class="form-group  col-lg-12">
                <label>How did you get to know about I Can Read?</label>
                <input class="form-control  " type="text" value="{{ $siswa->icr_info }}" disabled>
            </div>
        </div>



    </div>
</div>
