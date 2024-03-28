@extends('layouts')
@section('konten')
    <div class="col-12 col-md-12 col-lg-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title d-inline-block">Create Roles List</h4>

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
                <div class="table-responsive">
                    {!! Form::open(['route' => 'roles.store', 'method' => 'POST']) !!}
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Roles Name:</label>
                        {!! Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) !!}
                        @error('name')
                            <span class="text-danger">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <h5>Permission</h5>

                    <table class="table">

                        <thead>
                            <tr>
                                <th>Menu</th>
                                <th>Create</th>
                                <th>Delete</th>
                                <th>Edit</th>
                                <th>List</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="7" style="background-color: rgb(210, 210, 210)">SETTING</td>
                            </tr>
                            <tr>

                                <td>
                                    Role & Permission
                                </td>
                                @foreach ($role as $role)
                                    <td>
                                        <div class="checkbox-wrapper-2"><input type="checkbox" name="permission[]"
                                                class="sc-gJwTLC ikxBAC" value={{ $role->id }} {{  $role->ket == 'disabled' ? 'disabled':'' ;}}>
                                        </div>
                                    </td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>
                                    User
                                </td>
                                @foreach ($user as $user)
                                    <td>
                                        <div class="checkbox-wrapper-2"><input type="checkbox" name="permission[]"
                                                class="sc-gJwTLC ikxBAC" value={{ $user->id }} {{  $user->ket == 'disabled' ? 'disabled':'' ;}}>
                                        </div>
                                    </td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>
                                    Area
                                </td>
                                @foreach ($area as $area)
                                    <td>
                                        <div class="checkbox-wrapper-2"><input type="checkbox" name="permission[]"
                                                class="sc-gJwTLC ikxBAC" value={{ $area->id }} {{  $area->ket == 'disabled' ? 'disabled':'' ;}}>
                                        </div>
                                    </td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>
                                    Company
                                </td>
                                @foreach ($company as $company)
                                    <td>
                                        <div class="checkbox-wrapper-2"><input type="checkbox" name="permission[]"
                                                class="sc-gJwTLC ikxBAC" value={{ $company->id }} {{  $company->ket == 'disabled' ? 'disabled':'' ;}}>
                                        </div>
                                    </td>
                                @endforeach
                            </tr>
                            <tr>
                                <td colspan="7" style="background-color: rgb(210, 210, 210)">MASTER DATA</td>
                            </tr>
                            <tr>
                                <td>
                                    Classroom
                                </td>
                                @foreach ($classroom as $classroom)
                                    <td>
                                        <div class="checkbox-wrapper-2"><input type="checkbox" name="permission[]"
                                                class="sc-gJwTLC ikxBAC" {{  $classroom->ket == 'disabled' ? 'disabled':'' ;}} 
                                                value={{ $classroom->id }}>
                                        </div>
                                    </td>
                                @endforeach


                            </tr>
                            <tr>
                                <td>
                                    Center Office
                                </td>
                                @foreach ($center as $center)
                                    <td>
                                        <div class="checkbox-wrapper-2"><input type="checkbox" name="permission[]"
                                                class="sc-gJwTLC ikxBAC" value={{ $center->id }} {{  $center->ket == 'disabled' ? 'disabled':'' ;}}>
                                        </div>
                                    </td>
                                @endforeach
                            </tr>
                            <tr>
                                <td colspan="7" style="background-color: rgb(210, 210, 210)">REGISTRATION</td>
                            </tr>
                            <tr>
                                <td>
                                    Teacher
                                </td>
                                @foreach ($teacher as $teacher)
                                    <td>
                                        <div class="checkbox-wrapper-2"><input type="checkbox" name="permission[]"
                                                class="sc-gJwTLC ikxBAC" value={{ $teacher->id }} {{  $teacher->ket == 'disabled' ? 'disabled':'' ;}}>
                                        </div>
                                    </td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>
                                    Student
                                </td>
                                @foreach ($student as $student)
                                    <td>
                                        <div class="checkbox-wrapper-2"><input type="checkbox" name="permission[]"
                                                class="sc-gJwTLC ikxBAC" value={{ $student->id }} {{  $student->ket == 'disabled' ? 'disabled':'' ;}}>
                                        </div>
                                    </td>
                                @endforeach
                            </tr>
                            <tr>
                                <td>
                                    Course
                                </td>
                                @foreach ($course as $course)
                                    <td>
                                        <div class="checkbox-wrapper-2"><input type="checkbox" name="permission[]"
                                                class="sc-gJwTLC ikxBAC" value={{ $course->id }} {{  $course->ket == 'disabled' ? 'disabled':'' ;}}>
                                        </div>
                                    </td>
                                @endforeach
                            </tr>

                        </tbody>
                    </table>
                    @error('permission')
                        <span class="text-danger">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="modal-footer">
                        <a href="{{ route('roles.index') }}" type="button"
                            class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">Cancel</a>
                        <button id="savedata" name="savedata" type="submit" class="btn btn-success ">Save</button>
                        {!! Form::close() !!}
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


            });
        </script>
    @endpush

    @push('style')
        </style>
    @endpush
@endsection
