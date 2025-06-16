@php
    $id = \Illuminate\Support\Facades\Auth::user()->id;
    $profile_data = App\Models\User::find($id);
@endphp

<div class="col-md-3">
    <div class="osahan-account-page-left shadow-sm rounded bg-white h-100">
        <div class="border-bottom p-4">
            <div class="osahan-user text-center">
                <div class="osahan-user-media">
                    <img class="mb-3 rounded-pill shadow-sm mt-1" src="{{ (!empty($profile_data->photo )) ? url('upload/user_images/'.$profile_data->photo) : url('upload/no_image.jpg') }}" alt="gurdeep singh osahan">
                    <div class="osahan-user-media-body">
                        <h6 class="mb-2">{{ $profile_data->name}}</h6>
                        <p>{{ $profile_data->email}}</p>
                    </div>
                </div>
            </div>
        </div>
        <ul class="nav nav-tabs flex-column border-0 pt-4 pl-4 pb-4" id="myTab" role="tablist">
            <li class="nav-item" href="{{ route('dashboard') }}" >
                <a class="nav-link {{ Route::currentRouteName() ==='dashboard' ? 'active' : ''}}" data-toggle="tab" href="{{ route('dashboard') }}" role="tab" aria-controls="profile" aria-selected="false"><i class="icofont-food-cart"></i> Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() ==='user.change.password' ? 'active' : ''}}"  href="{{ route('user.change.password') }}" ><i class="icofont-lock"></i>Change Password</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="orders-tab" data-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="false"><i class="icofont-food-cart"></i> Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="favourites-tab" data-toggle="tab" href="#favourites" role="tab" aria-controls="favourites" aria-selected="false"><i class="icofont-heart"></i> Favourites</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="payments-tab" data-toggle="tab" href="#payments" role="tab" aria-controls="payments" aria-selected="false"><i class="icofont-credit-card"></i> Payments</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="addresses-tab" data-toggle="tab" href="#addresses" role="tab" aria-controls="addresses" aria-selected="false"><i class="icofont-location-pin"></i> Addresses</a>
            </li>
        </ul>
    </div>
</div>
