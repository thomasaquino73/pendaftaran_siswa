@extends('layouts')
@section('konten')
    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline-block">Company Info</h4>
                <a href="{{ url("/perusahaan/$dataperusahaan->id/edit") }}"type="button"
                    class="btn btn btn-primary btn-rounded float-right">
                    <i class="fa fa-edit"></i> Edit Data</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">

                </div>

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
                                <a href="#"><img class="avatar" src="{{ $dataperusahaan->logo }}" alt=""></a>
                            </div>
                        </div>
                        <div class="profile-basic">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="profile-info-left">
                                        <h3 class="user-name m-t-0 mb-0">{{ $dataperusahaan->namaperusahaan }}</h3>
                                        <small class="text-muted">{{ $dataperusahaan->notel }}</small>
                                        <div class="staff-id">{{ $dataperusahaan->alamat }}</div>
                                        <div class="staff-msg"><a
                                                href="https://wa.me/{{ $dataperusahaan->notel }}?text=Halo, {{ $dataperusahaan->namaperusahaan }}"
                                                class="btn btn-primary">Send Message</a></div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <ul class="personal-info">
                                        <li>
                                            <span class="title">Phone Number:</span>
                                            <span class="text"><a href="https://wa.me/{{ $dataperusahaan->notel }}?text=Halo, {{ $dataperusahaan->namaperusahaan }}">{{ $dataperusahaan->notel }}</a></span>
                                        </li>
                                        <li>
                                            <span class="title">Email:</span>
                                            <span class="text"><a href="mailto:{{ $dataperusahaan->email }}">{{ $dataperusahaan->email }}</a></span>
                                        </li>
                                        <li>
                                            <span class="title">Address:</span>
                                            <span class="text">{{ $dataperusahaan->alamat }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="profile-tabs">
            <ul class="nav nav-tabs nav-tabs-bottom">
                <li class="nav-item"><a class="nav-link " href="#karyawan" data-toggle="tab">Employee</a></li>
                <li class="nav-item"><a class="nav-link active" href="#guru" data-toggle="tab">Teacher</a></li>
                <li class="nav-item"><a class="nav-link" href="#murid" data-toggle="tab">Student</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane show active" id="produk">

                </div>

                <div class="tab-pane " id="karyawan">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                @foreach ($datakaryawan as $karyawan)
                                    <div class="col-md-4 col-sm-4  col-lg-3">
                                        <div class="profile-widget">
                                            <div class="doctor-img">
                                                @if (!empty($karyawan->avatar))
                                                    <a class="avatar" href="profile.html"><img
                                                            alt=""src="{{ asset('') . $karyawan->avatar }}"></a>
                                                @else
                                                    <a class="avatar" href="profile.html"><img
                                                            alt=""src="assets/img/user.jpg"></a>
                                                @endif
                                            </div>
                                            
                                            <h4 class="doctor-name text-ellipsis"><a
                                                    href="profile.html">{{ $karyawan->namalengkap }}</a></h4>
                                            <div class="doc-prof">{{ $karyawan->notel }}</div>
                                            <div class="user-country">
                                                <i class="fa fa-map-marker"></i> {{ $karyawan->alamat }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="transaksi">
                    <div class="col-md-12">
                        Tab Conten 3
                    </div>
                </div>
                <div class="tab-pane" id="logtransaksi">
                    <div class="col-md-12">
                        Tab Conten 4
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        });
        @if (Session::has('pesan'))
            iziToast.{{ Session::get('alert') }}({
                title: '{{ Session::get('alert') }}',
                message: '{{ Session::get('pesan') }}',
                position: 'topRight'
            });
        @endif
    </script>
    <style>
        blockquote:before,
        blockquote:after,
        q:before,
        q:after {
            content: ’’;
            content: none;
        }

        label {
            color: #666;
            font-size: 10px;
            font-weight: 500;
            line-height: 2em;
            text-transform: uppercase;
        }

        .product-card {
            margin: 0 2% 5% 2%;
            padding: 2%;
            background-color: #FFF;
            box-shadow: 0px 0px 1px 0px rgba(0, 0, 0, 0.25);
        }

        .product-image img {
            width: 100%;
            height: 200px;
        }

        .product-info {
            margin-top: auto;
            padding-top: 20px;
            text-align: center;
        }
    </style>
@endpush
