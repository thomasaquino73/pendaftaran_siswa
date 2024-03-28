@extends('layouts')
@section('konten')

<div class="col-12 col-md-12 col-lg-12 col-xl-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title d-inline-block">Kabupaten / Kota</h4>
            <a href="javascript:void(0);" id="createProvinsi" type="button"
                class="btn btn btn-primary btn-rounded float-right"> <i class="fa fa-plus"></i> Tambah Data</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">

            </div>

        </div>

    </div>

</div>




    {{-- <div class="content">
        <div class="card-box">
            @include('profile.partials.update-profile-information-form')
        </div>
        <div class="card-box">
            @include('profile.partials.update-password-form')
        </div>
        <div class="card-box">
            @include('profile.partials.delete-user-form')
        </div>
    
    </div> --}}
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Launch demo modal
  </button>
  <div class="modal fade" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalHeading"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button id="savedata" name="savedata" type="button" class="btn btn-primary"></button>
                    </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
        <script type="text/javascript">
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('#createProvinsi').click(function() {
                    $('#savedata').html('Simpan');
                    $('#provinsimodal').modal('show');
                    $('#modalHeading').html('Tambah Data Kabupaten / Kota');
                    $('#postForm').trigger('reset');
                    $('#id').val('');
                    $('#provinsi_id').val('').trigger('change');
                    $('.nama_error').html('');

                });
                });

        </script>
    @endpush