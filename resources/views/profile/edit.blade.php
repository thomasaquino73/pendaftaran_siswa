@extends('layouts')
@section('konten')
    <div class="content">
        <div class="card-box">
            @include('profile.partials.update-profile-information-form')
        </div>
        <div class="card-box">
            @include('profile.partials.update-password-form')
        </div>

    </div>

    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-body">

            </div>
        </div>
    </div>
    <div class="modal " id="deletemodal" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalHeading">Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('profile.destroy') }}" id="postForm">
                        @csrf
                        @method('delete')

                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Are you sure you want to delete your account?') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                        </p>

                        <div class="mt-6 ">
                            <input  placeholder="{{ __('Type Your Password') }}" id="password" name="password" type="password" class="form-control">
                            <span class="text-danger"></span>
                            <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                                <span class="text-danger error-text password_error"> </span>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn grey" data-dismiss="modal">Cancel</button>
                    {{-- <button id="savedata" name="savedata" type="button" class="btn btn-primary"></button> --}}
                    <button id="savedata" name="savedata" type="submit" class="btn btn-danger"></button>
                </div>
                </form>
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
                $('#delete').click(function() {
                    $('#savedata').html('Delete');
                    $('#deletemodal').modal('show');
                });
                $('#postForm').on('submit', function(e) {
                    e.preventDefault();
                    var form = this;
                    $.ajax({
                        url: $(form).attr('action'),
                        method: $(form).attr('method'),
                        data: new FormData(form),
                        processData: false,
                        datatype: 'json',
                        contentType: false,
                        beforeSend: function(e) {
                            $('#savedata').html('<i class="fa fa-spin fa-spinner"></i> Sending...');
                        },
                        complete: function(e) {
                            $('#savedata').html('Delete');
                        },
                        success: function(data) {
                            if (data.status == 0) {
                                console.log(data.error)
                                $.each(data.error, function(prefix, val) {
                                    $('span.' + prefix + '_error').text(val[0]);
                                });
                            } else {
                                $('#postForm').trigger('reset');
                                $('#deletemodal').modal('hide');
                                window.location.href = "{{ url('/')}}";
                                iziToast.success({
                                    title: 'success',
                                    message: 'Data Berhasil',
                                    position: 'topRight'
                                });
                            }
                       
                            // if (data.status == 0) {
                            //     console.log(data.error)
                            //     $.each(data.error, function(prefix, val) {
                            //         $('span.' + prefix + '_error').text(val[0]);
                            //     });
                            // } else {
                            //     $('#karyawanmodal').modal('hide');
                            //     table.draw();
                            //     iziToast.success({
                            //         title: 'success',
                            //         message: 'Data Berhasil',
                            //         position: 'topRight'
                            //     });
                            // }
                        },
                    });
                });
            });
        </script>
    @endpush
    
    @endsection
