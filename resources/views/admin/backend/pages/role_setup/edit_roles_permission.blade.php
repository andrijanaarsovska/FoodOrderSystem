@php use App\Models\Admin; @endphp
@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <style>
        .form-check-label {
            text-transform: capitalize;
        }
    </style>

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Edit Role In Permission</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Role & Permission</a></li>
                                <li class="breadcrumb-item active">Edit Role Permission</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-9 col-lg-8">
                    <!-- end card -->

                    <div class="card">


                        <div class="card-body p-4">
                            <form id="myForm" action="{{ route('admin.roles.update', $role->id) }}" method="post"
                                  enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div>
                                            <div class="form-group mb-3">
                                                <label for="example-text-input" class="form-label">Role
                                                    Name</label>
                                                <h4>{{ $role->name }}</h4>
                                            </div>

                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" id="formCheck">
                                                <label class="form-check-label" for="formCheck">
                                                    All Permissions
                                                </label>
                                            </div>

                                            <hr>

                                            @foreach($permission_group as $group)
                                                <div class="row">
                                                    <div class="col-3">
                                                        @php  $permissions = Admin::getPermissionByGroupName($group->group_name); @endphp

                                                        <div class="form-check mb-3">
                                                            <input class="form-check-input" value="" type="checkbox"
                                                                   id="flexCheckDefault" {{ Admin::roleHasPermissions($role, $permissions) ? 'checked' : ''}}>
                                                            <label class="form-check-label" for="flexCheckDefault">
                                                                {{ $group->group_name }}
                                                            </label>
                                                        </div>
                                                    </div>


                                                    <div class="col-9">

                                                        @foreach( $permissions as $permission)
                                                            <div class="form-check mb-3">
                                                                <input class="form-check-input" name="permission[]"
                                                                       value="{{$permission->id}}" type="checkbox"
                                                                       id="flexCheckDefault{{$permission->id}}" {{ $role->hasPermissionTo($permission->name) ? 'checked' : ''}}>
                                                                <label class="form-check-label"
                                                                       for="flexCheckDefault{{$permission->id}}">
                                                                    {{ $permission->name }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                        <br>

                                                    </div>

                                                </div>
                                            @endforeach

                                            <div class="mt-4">
                                                <button type="submit" class="btn btn-primary waves-effect waves-light">
                                                    Save
                                                    Changes
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        $('#formCheck').click(function () {
            if ($(this).is(':checked')) {
                $('input[type=checkbox]').prop('checked', true)
            } else {
                $('input[type=checkbox]').prop('checked', false)
            }
        });
    </script>

@endsection
