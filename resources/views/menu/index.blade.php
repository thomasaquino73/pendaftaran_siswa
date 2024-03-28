@php
    $user = Auth()->user();
@endphp
<style>
    .hide {
        display: none;
    }
</style>
@if ((Request::segment(1) == 'area') | (Request::segment(1) == 'provinsi') | (Request::segment(1) == 'kabupaten'))
    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div class="sidebar-menu">
                <ul>
                    <li>
                        <a href="{{ url('/dashboard') }}"><i class="fa fa-home back-icon"></i> <span>Back To
                                Home</span></a>
                    </li>
                    <li class="menu-title">Area</li>
                    <li
                        @if (Request::segment(1) == 'provinsi') @php echo 'class="active"' @endphp
            @else
            @php echo 'class=""' @endphp @endif>
                        <a href="{{ route('provinsi.index') }}"><i class="fa fa-map"></i> <span>Provence</span></a>
                    </li>
                    <li
                        @if (Request::segment(1) == 'kabupaten') @php echo 'class="active"' @endphp
            @else
            @php echo 'class=""' @endphp @endif>
                        <a href="{{ route('kabupaten.index') }}"><i class="fa fa-map"></i> <span>Distric</span></a>
                    </li>


                    </li>
                </ul>
            </div>
        </div>
    </div>
@elseif (Request::segment(1) == 'perusahaan')
    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div class="sidebar-menu">
                <ul>
                    <li>
                        <a href="{{ url('/dashboard') }}"><i class="fa fa-home back-icon"></i> <span>Back To
                                Home</span></a>
                    </li>
                    <li class="menu-title">Settings</li>
                    <li
                        @if (Request::segment(1) == 'perusahaan') @php echo 'class="active"' @endphp
                @else
                @php echo 'class=""' @endphp @endif>
                        <a href="{{ route('perusahaan.index') }}"><i class="fa fa-building"></i> <span>Info
                                Perusahaan</span></a>
                    </li>
                    <li>
                        <a href="{{ url('Pengaturan-invoice') }}"><i class="fa fa-pencil-square-o"></i> <span>Pengaturan
                                Invoice</span></a>
                    </li>

                    </li>
                </ul>
            </div>
        </div>
    </div>
@else
    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                    <li class="submenu ">
                        <a href="#"><i class="fa fa-cog"></i><span>Setting</span> <span
                                class="menu-arrow"></span></a>
                        <ul style="display: none;">
                            <li
                                @if ($user->can('role-list')) @php echo 'class=""' @endphp
                                @else
                                @php echo 'class="hide"' @endphp @endif>
                                <a href="{{ route('roles.index') }}"
                                    @if (Request::segment(1) == 'roles') @php echo 'class="active"' @endphp
                                @else
                                @php echo 'class="hide"' @endphp @endif><i
                                        class="fa fa-lock"></i> {{ __('Role & Permission') }}</a>
                            </li>
                            <li
                                @if ($user->can('user-list')) @php echo 'class=""' @endphp
                                @else
                                @php echo 'class="hide"' @endphp @endif>
                                <a href="{{ route('pengguna.index') }}"
                                    @if (Request::segment(1) == 'pengguna') @php echo 'class="active"' @endphp
                                @else
                                @php echo 'class="hide"' @endphp @endif><i
                                        class="fa fa-user"></i> {{ __('User') }}</a>
                            </li>
                            <li
                                @if ($user->can('area-list')) @php echo 'class=""' @endphp
                                @else
                                @php echo 'class="hide"' @endphp @endif>
                                <a href="{{ route('area.index') }}"><i class="fa fa-map"></i> {{ __('Area') }}</a>
                            </li>
                            <li
                                @if ($user->can('company-list')) @php echo 'class=""' @endphp
                                @else
                                @php echo 'class="hide"' @endphp @endif>
                                <a href="{{ route('perusahaan.index') }}"
                                    @if (Request::segment(1) == 'perusahaan') @php echo 'class="active"' @endphp
                            @else
                            @php echo 'class="hide"' @endphp @endif><i
                                        class="fa fa-building"></i> {{ __('Company') }}</a>
                            </li>

                        </ul>
                    </li>
                    <li
                        @if (Request::segment(1) == 'dashboard') @php echo 'class="active"' @endphp
                @else
                
                @php echo 'class=""' @endphp @endif>
                        <a href="{{ url('/dashboard') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                    </li>
                    <li class="menu-title">Master Data</li>
                    @if ($user->can('classroom-list'))
                        <li
                            @if (Request::segment(1) == 'kelas') @php echo 'class="active"' @endphp
                    @else
                    @php echo 'class=""' @endphp @endif>
                            <a href="{{ url('/kelas') }}"><i class="fa fa-building"></i> <span>Classroom</span></a>
                        </li>
                    @endif
                    @if ($user->can('center-list'))
                        <li
                            @if (Request::segment(1) == 'cabang') @php echo 'class="active"' @endphp
                @else
                @php echo 'class=""' @endphp @endif>
                            <a href="{{ url('/cabang') }}"><i class="fa fa-building"></i> <span>Center
                                    Office</span></a>
                        </li>
                    @endif

                    <li class="menu-title">Registration</li>
                    @if ($user->can('teacher-list'))
                        <li
                            @if (Request::segment(1) == 'karyawan') @php echo 'class="active"' @endphp
            @else
            @php echo 'class=""' @endphp @endif>
                            <a href="{{ url('/karyawan') }}"><i class="fa fa-user"></i> <span>Teacher</span></a>
                        </li>
                    @endif
                    @if ($user->can('student-list'))
                        <li
                            @if (Request::segment(1) == 'siswa') @php echo 'class="active"' @endphp
                @else
                @php echo 'class=""' @endphp @endif>
                            <a href="{{ url('/siswa') }}"><i class="fa fa-user"></i> <span>Student</span></a>
                        </li>
                    @endif
                    @if ($user->can('course-list'))
                        <li
                            @if (Request::segment(1) == 'kursus') @php echo 'class="active"' @endphp
                @else
                @php echo 'class=""' @endphp @endif>
                            {{-- <a href="{{ url('/kursus') }}"><i class="fa fa-user"></i> <span>Course</span></a> --}}
                            <a href="{{ route('kursus.index') }}"><i class="fa fa-user"></i> <span>Course</span></a>
                        </li>
                    @endif

                    <li class="menu-title">Report</li>


                </ul>
            </div>
        </div>
    </div>
@endif
