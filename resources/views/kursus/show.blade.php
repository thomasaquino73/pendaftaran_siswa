@extends('layouts')
@section('konten')
    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline-block">Data Course Detail</h4>
                <a href="{{ route('kursus.index') }}" type="button" class="btn  btn-secondary btn-rounded float-right">
                    <i class="fa fa-undo"></i> Back</a>
            </div>


        </div>

    </div>
    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card-box profile-header">
            <div class="row">
                <div class="col-md-12">
                    <div class="profile-view">
                        <div class="profile-img-wrap">
                            <div class="profile-img">
                                @if (!empty($foto))
                                    <img src="{{ asset('') . $foto }}" class="avatar" alt="">
                                @else
                                    <img src="{{ asset('') }}assets/img/user.jpg" class=" " alt="">
                                @endif
                            </div>
                        </div>
                        <div class="profile-basic">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="profile-info-left">
                                        <h3 class="user-name m-t-0 mb-0">{{ $fullname }}</h3>
                                        <small class="text-muted"> Classroom : {{ $classroom  }} </small>
                                        <div class="staff-id">Class ID : {{ $classid }}</div>
                                        <div class="staff-msg"><a href="chat.html" class="btn btn-primary">Send Message</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <ul class="personal-info">
                                        <li>
                                            <span class="title">Place, Date Of Birth:</span>
                                            <span class="text">{{ $pob }}, {{ date('d-m-Y', strtotime($dob)) }}</span>
                                        </li>
                                        <li>
                                            <span class="title">Gender:</span>
                                            <span class="text" style="text-transform: capitalize">{{ $gender }}</span>
                                        </li>
                                        <li>
                                            <span class="title">Nationality:</span>
                                            <span class="text">{{ $nationality }}</span>
                                        </li>
                                        <li>
                                            <span class="title">Address:</span>
                                            <span class="text">{{ $address }}, {{ $kabupaten }}, {{ $propinsi }}</span>
                                        </li>
                                        <li>
                                            <span class="title">Status:</span>
                                            <span class="text">{{ $address }}, {{ $kabupaten }}, {{ $propinsi }}</span>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-body">
                <div id="error"></div>
                <input type="text" name="id" id="id" value="{{ $id }}" hidden>
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group ">
                            <label for="recipient-name" class="col-form-label">Registration Number:</label>
                            <input type="text" class="form-control" value="{{ $regnumber }}" disabled>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Registration Date:</label>
                            <div class="cal-icon">
                                <input type="text" class="form-control datepicker"
                                    value="{{ $regdate }}" disabled>
                            </div>
                            <span class="text-danger error-text regdate_error"> </span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group ">
                            <label for="recipient-name" class="col-form-label">Receipt No:</label>
                            <input type="text" class="form-control" 
                                placeholder="Add Class ID" value="{{ $nopendaftaran }}" disabled>
                            <span class="text-danger error-text nopendaftaran_error"> </span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Start Date:</label>
                            <div class="cal-icon">
                                <input type="text" class="form-control " 
                                    value="{{ $startdate }}" readonly>
                            </div>
                            <span class="text-danger error-text startdate_error"> </span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group ">
                            <label>Center:</label>
                            <select class="form-select single-select-field2"
                                data-placeholder="Choose Center Office..." style="width:100%" disabled>
                                <option></option>
                                @foreach ($cabang as $item)
                                    <option value="{{ $item->id }}" {{ $center === $item->id ? 'selected' : '' }}>
                                        {{ $item->namacabang }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger error-text center_error"> </span>

                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group ">
                            <label>Attended By:</label>
                            <select name="attended" id="attended" class="form-select single-select-field2"
                                data-placeholder="Choose Attended By..." style="width:100%" disabled>
                                <option></option>
                                @foreach ($karyawan as $item)
                                    <option value="{{ $item->id }} "
                                        {{ $karyawans === $item->id ? 'selected' : '' }}>
                                        {{ $item->namalengkap }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger error-text attended_error"> </span>

                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <label>Material Issued</label>
                        @foreach ($material as $material)
                            <li> <span style='margin-left:10px;padding:3px;'
                                    class='badge-success p-1'>{{ $material }}</span></li>
                        @endforeach
                    </div>
                </div>


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

            });
        </script>
    @endpush
@endsection
