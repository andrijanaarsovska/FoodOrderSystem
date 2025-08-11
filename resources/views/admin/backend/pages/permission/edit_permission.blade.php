@extends('admin.admin_dashboard')
@section('admin')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Edit Permission</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Permission</a></li>
                                <li class="breadcrumb-item active">Edit Permission</li>
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
                            <form id="myForm" action="{{ route('permission.update') }}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $permission->id }}">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div>
                                            <div class="form-group mb-3">
                                                <label for="example-text-input" class="form-label">Permission
                                                    Name</label>
                                                <input class="form-control" name="name" type="text"
                                                       id="example-text-input" value="{{ $permission->name }}">
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="example-text-input" class="form-label">Permission
                                                    Group Name</label>
                                                <select name="group_name" class="form-select">
                                                    <option selected disabled>Select</option>
                                                    <option value="Category" {{ $permission->group_name == 'Category' ? 'selected' : '' }}>Category</option>
                                                    <option value="City" {{ $permission->group_name == 'City' ? 'selected' : '' }}>City</option>
                                                    <option value="Product"  {{ $permission->group_name == 'Product' ? 'selected' : '' }}>Product</option>
                                                    <option value="Restaurant" {{ $permission->group_name == 'Restaurant' ? 'selected' : '' }}>Restaurant</option>
                                                    <option value="Banner" {{ $permission->group_name == 'Banner' ? 'selected' : '' }}>Banner</option>
                                                    <option value="Order" {{ $permission->group_name == 'Order' ? 'selected' : '' }}>Order</option>
                                                    <option value="Report" {{ $permission->group_name == 'Report' ? 'selected' : '' }}>Report</option>
                                                </select>
                                            </div>
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


    <script type="text/javascript">
        $(function() {
            $('.toggle-class').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var product_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/changeStatus',
                    data: {'status': status, 'product_id': product_id},
                    success: function(data){
                        // console.log(data.success)

                        // Start Message

                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 3000
                        })
                        if ($.isEmptyObject(data.error)) {

                            Toast.fire({
                                type: 'success',
                                title: data.success,
                            })

                        }else{

                            Toast.fire({
                                type: 'error',
                                title: data.error,
                            })
                        }

                        // End Message


                    }
                });
            })
        })
    </script>


@endsection
