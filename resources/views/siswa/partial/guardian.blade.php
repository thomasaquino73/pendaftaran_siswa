<div class="col-12 col-md-12 col-lg-12 col-xl-12 ">
    <div class="card mb-5">
        <div class="card-body">
            <div class="lejen mb-3">
                <h3>PARENT/GUARDIAN INFORMATION</h3> <span> (Please provide at least 2 contacts in case of
                    emergencies)</span>
                    <a href="javascript:void(0);" id="create" type="button" class="btn btn btn-primary btn-rounded float-right">
                        <i class="fa fa-plus"></i> Add Data</a>
            </div>
            <table class="table table-striped custom-table" id="parent" width=100%>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Full Name</th>
                        <th>Family Name</th>
                        <th>Relationship</th>
                        <th>Email</th>
                        <th>Phone (Mobile/Home)</th>
                        <th>Phone Office</th>
                        <th>Action</th>
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
                        <td></td>
                    </tr>
                    @endforeach
                    
                  
                </tbody>
            </table>
        </div>
    </div>
</div>
@push('scripts')
    <script>
              $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                let table = new DataTable('#parent');
                
                
            });
    </script>
@endpush