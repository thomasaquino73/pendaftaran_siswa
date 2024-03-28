@extends('layouts')
@section('konten')
    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline-block">Student</h4>
                @php
                    $user = Auth()->user();
                @endphp
                @if ($user->can('student-create')) 
                    <a href="{{ route('siswa.create') }}" type="button" class="btn btn btn-primary btn-rounded float-right">
                        <i class="fa fa-plus"></i> Add Data</a>
                @endif
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
                <button class="btn btn btn-primary "><i class="fa fa-file-pdf-o"></i> PDF</button>
                <button class="btn btn btn-primary "><i class="fa fa-file-excel-o"></i> Excel</button>
                <button class="btn btn btn-primary "><i class="fa fa-print"></i> Print</button>
                <div class="table-responsive">
                    <table id="siswatable" class="display ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Photo</th>
                                <th>Full Name</th>
                                <th>Place, Date Of Birth</th>
                                <th>Gender</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
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

                let table = new DataTable('#siswatable', {
                    processing: true,
                    searching: false,
                    serverSide: true,
                    ajax: '{{ route('siswa.index') }}',
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'foto',
                            name: 'foto'
                        },
                        {
                            "data": null,
                            render: function(data, type, row) {
                                var details = data.full_name + ",<br>Family Name : " + data.family_name;
                                return details;
                            }
                        },
                        {
                            "data": null,
                            render: function(data, type, row) {
                                var details = data.place_birth + ", " + data.date_birth;
                                return details;
                            }
                        },
                        {
                            data: 'gender',
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ]
                });



                $('body').on('click', '#delete', function() {

                    let id = $(this).data('id');
                    let name = $(this).data('name');
                    let token = $("meta[name='csrf-token']").attr("content");
                    swal({
                            title: 'Are You Sure?',
                            text: "Student Name : " + name,
                            icon: 'warning',
                            buttons: true,
                            dangerMode: true,
                            showCancelButton: true,
                            cancelButtonText: 'TIDAK',
                        })
                        .then((willDelete) => {
                            if (willDelete) {
                                $.ajax({
                                    url: `/siswa/${id}`,
                                    type: "DELETE",
                                    cache: false,
                                    data: {
                                        "_token": token
                                    },
                                    success: function(response) {
                                        iziToast.success({
                                            title: 'success',
                                            message: ' Deleted Successfully',
                                            position: 'topRight'
                                        });
                                        table.draw();
                                    },
                                    error: function(Xhr, status, error) {



                                        iziToast.danger({
                                            title: 'error',
                                            message: ' Deleted Errors',
                                            position: 'topRight'
                                        });
                                        // swal({
                                        //     position: 'center',
                                        //     icon: 'error',
                                        //     title: 'Failed',
                                        //     showConfirmButton: false,
                                        //     timer: 5000
                                        // });
                                    }

                                });

                            } else {
                                table.draw();
                            }
                        });

                });
            });
        </script>
    @endpush
@endsection
