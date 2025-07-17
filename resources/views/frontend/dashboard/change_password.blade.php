@extends('frontend.dashboard.dashboard')
@section('dashboard')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >
@php
    $id = \Illuminate\Support\Facades\Auth::user()->id;
    $profile_data = App\Models\User::find($id);
@endphp
<section class="section pt-4 pb-4 osahan-account-page">
    <div class="container">
        <div class="row">

            @include('frontend.dashboard.sidebar')

            <div class="col-md-9">
                <div class="osahan-account-page-right rounded shadow-sm bg-white p-4 h-100">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                            <h4 class="font-weight-bold mt-0 mb-4">User Profile</h4>


                            <div class="bg-white card mb-4 order-list shadow-sm">
                                <div class="gold-members p-4">
                                    <form action="{{ route('user.password.update') }}" method="post" enctype="multipart/form-data">
                                        @csrf


                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div>
                                                    <div class="mb-3">
                                                        <label for="example-text-input" class="form-label">Old Password</label>
                                                        <input class="form-control @error('old_password') is-invalid @enderror"
                                                               name="old_password" type="password" id="old_password">
                                                        @error('old_password')
                                                        <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="mb-3">
                                                        <label for="example-text-input" class="form-label">New Password</label>
                                                        <input class="form-control @error('new_password') is-invalid @enderror"
                                                               name="new_password" type="password" id="new_password">
                                                        @error('new_password')
                                                        <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="mb-3">
                                                        <label for="example-text-input" class="form-label">Confirm New Password</label>
                                                        <input class="form-control"
                                                               name="new_password_confirmation" type="password" id="new_password_confirmation">
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="mt-4">
                                                        <button type="submit" class="btn btn-primary waves-effect waves-light">Save Changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script type="text/javascript">
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        })
    })
</script>



<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


@endsection
