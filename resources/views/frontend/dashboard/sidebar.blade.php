@php
    $id = \Illuminate\Support\Facades\Auth::user()->id;
    $profile_data = App\Models\User::find($id);
@endphp

<div class="col-md-3">
    <div class="osahan-account-page-left shadow-sm rounded bg-white h-70">
        <div class="border-bottom p-5">
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
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() === 'dashboard' ? 'active' : '' }}"
                   href="{{ route('dashboard') }}"
                   role="tab" aria-controls="profile" aria-selected="false">
                    <i class="icofont-food-cart"></i> Profile
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() === 'user.change.password' ? 'active' : '' }}"
                   href="{{ route('user.change.password') }}">
                    <i class="icofont-lock"></i> Change Password
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() === 'user.order.list' ? 'active' : '' }}"
                   href="{{ route('user.order.list') }}">
                    <i class="icofont-credit-card"></i> Orders
                </a>
            </li>
        </ul>
    </div>
</div>
