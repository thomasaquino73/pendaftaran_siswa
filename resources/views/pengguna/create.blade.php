@extends('layouts')
@section('konten')
    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline-block">Create User</h4>
               
            </div>
            <div class="card-body">
                <form id="postForm" name="postForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div id="error"></div>
                    <input type="text" name="id" id="id" hidden>
                    <div class="form-group row">
                        <label for="recipient-name" class="col-sm-3  col-form-label">Username:</label>
                        <div class="col-sm-9">
                            {!! Form::text('username', '', [
                                'class' => 'form-control',
                                'placeholder' => 'Username',
                                'id' => 'username',
                            ]) !!}
                        <span class="text-danger error-text username_error"> </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="recipient-name" class="col-sm-3  col-form-label">Password:</label>
                        <div class="col-sm-9">
                            {!! Form::password('password', [
                                'class' => 'form-control',
                                'placeholder' => 'Password',
                                'id' => 'password',
                            ]) !!}
                            <span class="text-danger error-text password_error"> </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="recipient-name" class="col-sm-3  col-form-label">Confirm Password:</label>
                        <div class="col-sm-9">
                            {!! Form::password('confirm', [
                                'class' => 'form-control',
                                'placeholder' => 'Confirm Password',
                                'id' => 'confirm',
                            ]) !!}

                            <span class="text-danger error-text confirm_error"> </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Roles</label>
                        <div class="col-sm-9">
                            {{-- <select name="roles" id="roles" class="single-select-field2" style="width:100%">
                                <option value=""></option>
                                @foreach ($roles as $roles)
                                <option value="{{ $roles->id }}">{{ $roles->name }}</option>
                                @endforeach 
                                </select> --}}
                            {!! Form::select(
                                'roles[]',
                                $roles,
                                [],
                                ['class' => 'form-control single-select-field2', 'style' => 'width:100%', 'data-placeholder' => 'Pilih'],
                            ) !!}
                            <span class="text-danger error-text roles_error"> </span>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button id="savedata" name="savedata" type="button" class="btn btn-primary">Save</button>
            </div>
        </div>


    </div>

    </div>

    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-body">

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

                $('#savedata').click(function(e) {
                    e.preventDefault();
                    $.ajax({
                        data: $("#postForm").serialize(),
                        url: "{{ route('pengguna.store') }}",
                        type: 'POST',
                        dataType: 'JSON',
                        beforeSend: function(e) {
                            $('#savedata').html('<i class="fa fa-spin fa-spinner"></i> Sending...');
                        },
                        complete: function(e) {
                            $('#savedata').html('Save');
                        },
                        success: function(data) {
                            if (data.status == 0) {
                                console.log(data.error)
                                $.each(data.error, function(prefix, val) {
                                    $('span.' + prefix + '_error').text(val[0]);
                                });
                                $.each(data.error, function(key, value) {
                                var element = $('[name="'+key+'"]');
                                element.addClass('is-invalid');
                            });

                            } else {
                                $('#postForm').trigger('reset');
                                $('.error-text').html('');
                                table.draw();
                                iziToast.success({
                                    title: 'success',
                                    message: 'Data Berhasil',
                                    position: 'topRight'
                                });
                            }
                        },
                    })
                });


            });
        </script>
    @endpush
@endsection
