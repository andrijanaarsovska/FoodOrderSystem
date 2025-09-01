@extends('frontend.dashboard.dashboard')
@section('dashboard')

    <link rel="stylesheet" type="text/css" href="{{ asset('css/payment.css') }}" >

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://js.stripe.com/v3/"></script>


    <section class="offer-dedicated-body mt-4 mb-4 pt-2 pb-2">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="offer-dedicated-body-left">
                        @php
                            $id = Auth::user()->id;
                            $profile_data = App\Models\User::find($id);
                        @endphp

                        <div class="pt-2"></div>
                        <div class="bg-white rounded shadow-sm p-4 mb-4">
                            <h4 class="mb-1">Choose a delivery address</h4>
                            <h6 class="mb-3 text-black-50">Multiple addresses in this location</h6>
                            <div class="row d-flex">
                                <div class="col-md-6 d-flex">
                                    <div class="bg-white card addresses-item mb-4 border home-address">
                                        <div class="gold-members p-4 d-flex flex-column h-100">
                                            <div class="media flex-grow-1">
                                                <div class="mr-3"><i class="icofont-ui-home icofont-3x"></i></div>
                                                <div class="media-body">
                                                    <h6 class="mb-1 text-black">Home</h6>
                                                    <p class="text-black mb-0">{{ Auth::user()->address }}</p>
                                                    <p class="mb-0 text-black font-weight-bold">
                                                        <button type="button"
                                                                class="btn btn-sm btn-success mr-2 deliver-btn"
                                                                data-address="{{ Auth::user()->address }}"
                                                                onclick="selectAddress(this, 'home')">DELIVER HERE
                                                        </button>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex">
                                    <div class="bg-white card addresses-item mb-4 border other-address">
                                        <div class="gold-members p-4 d-flex flex-column h-100">
                                            <div class="media flex-grow-1">
                                                <div class="mr-3"><i class="icofont-briefcase icofont-3x"></i></div>
                                                <div class="media-body">
                                                    <h6 class="mb-1 text-secondary">Other</h6>
                                                    <input type="text" name="work_address"
                                                           class="form-control mb-2 mt-4 other-address-input"
                                                           placeholder="Enter your address">
                                                    <p class="mb-0 text-black font-weight-bold">
                                                        <button type="button"
                                                                class="btn btn-sm btn-secondary mr-2 deliver-btn"
                                                                data-address="" onclick="selectAddress(this, 'other')"
                                                                disabled>DELIVER HERE
                                                        </button>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pt-2"></div>
                        <div class="bg-white rounded shadow-sm p-4 osahan-payment">
                            <h4 class="mb-1">Choose payment method</h4>
                            <h6 class="mb-3 text-black-50">Credit/Debit Cards</h6>
                            <div class="row">
                                <div class="col-sm-4 pr-0">
                                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                                         aria-orientation="vertical">
                                        <a class="nav-link active" id="v-pills-cash-tab" data-toggle="pill"
                                           href="#v-pills-cash" role="tab" aria-controls="v-pills-cash"
                                           aria-selected="true"><i class="icofont-money"></i> Pay on Delivery</a>
                                        <a class="nav-link" id="v-pills-home-tab" data-toggle="pill"
                                           href="#v-pills-home" role="tab" aria-controls="v-pills-home"
                                           aria-selected="false"><i class="icofont-credit-card"></i> Credit/Debit Cards</a>
                                    </div>
                                </div>
                                <div class="col-sm-8 pl-0">
                                    <div class="tab-content h-100" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active" id="v-pills-cash" role="tabpanel"
                                             aria-labelledby="v-pills-cash-tab">
                                            <h6 class="mb-3 mt-0">Cash</h6>
                                            <p>Please keep exact change handy to help us serve you better</p>
                                            <hr>
                                            <form action="{{ route('cash_order') }}" method="post"
                                                  class="payment-form cash-form">
                                                @csrf
                                                <input type="hidden" name="name" value="{{ Auth::user()->name }}">
                                                <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                                                <input type="hidden" name="phone" value="{{ Auth::user()->phone }}">
                                                <input type="hidden" name="address" class="selected-address"
                                                       value="{{ Auth::user()->address }}">
                                                <button type="submit" class="btn btn-success btn-block btn-lg">PAY <i
                                                        class="icofont-long-arrow-right"></i></button>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-home" role="tabpanel"
                                             aria-labelledby="v-pills-home-tab">
                                            <h6 class="mb-3 mt-0">Add new card</h6>
                                            <p>WE ACCEPT <span class="osahan-card">
                                                <i class="icofont-visa-alt"></i> <i class="icofont-mastercard-alt"></i> <i
                                                        class="icofont-american-express-alt"></i> <i
                                                        class="icofont-payoneer-alt"></i> <i
                                                        class="icofont-apple-pay-alt"></i> <i
                                                        class="icofont-bank-transfer-alt"></i> <i
                                                        class="icofont-discover-alt"></i> <i
                                                        class="icofont-jcb-alt"></i>
                                            </span></p>
                                            <form action="{{ route('cash_order') }}" method="post"
                                                  class="payment-form card-form">
                                                @csrf
                                                <input type="hidden" name="name" value="{{ Auth::user()->name }}">
                                                <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                                                <input type="hidden" name="phone" value="{{ Auth::user()->phone }}">
                                                <input type="hidden" name="address" class="selected-address"
                                                       value="{{ Auth::user()->address }}">
                                                <div class="card-element"></div>
                                                <div class="card-errors" role="alert"></div>
                                                <br>
                                                <button type="submit" class="btn btn-success btn-block btn-lg " disabled>PAY <i
                                                        class="icofont-long-arrow-right"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-2">
                    <div class="generator-bg rounded shadow-sm mb-4 p-4 osahan-cart-item">
                        <form action="{{ route('cash_order') }}" method="post" class="payment-form cart-form">
                            @csrf
                            <input type="hidden" name="name" value="{{ Auth::user()->name }}">
                            <input type="hidden" name="email" value="{{ Auth::user()->email }}">
                            <input type="hidden" name="phone" value="{{ Auth::user()->phone }}">
                            <input type="hidden" name="address" class="selected-address"
                                   value="{{ Auth::user()->address }}">
                            <div class="d-flex mb-4 osahan-cart-item-profile">
                                <img class="img-fluid mr-3 rounded-pill" alt="user"
                                     src="{{ (!empty($profile_data->photo)) ? url('upload/user_images/' . $profile_data->photo) : url('upload/no_image.jpg') }}">
                                <div class="d-flex flex-column">
                                    <h6 class="mb-1 text-white">{{ $profile_data->name }}</h6>
                                    <p class="mb-0 text-white"><i
                                            class="icofont-location-pin"></i> {{ $profile_data->address }}</p>
                                </div>
                            </div>
                            <div class="bg-white rounded shadow-sm mb-2">
                                @php $total = 0; @endphp
                                @if(session('cart'))
                                    @foreach(session('cart') as $id => $details)
                                        @php $total += $details['price'] * $details['quantity']; @endphp
                                        <div class="gold-members p-2 border-bottom">
                                            <p class="text-gray mb-0 float-right ml-2">{{ $details['price'] * $details['quantity'] }}
                                                мкд</p>
                                            <span class="count-number float-right">
                                                <button type="button" class="btn btn-outline-secondary btn-sm left dec"
                                                        data-id="{{ $id }}"><i class="icofont-minus"></i></button>
                                                <input class="count-number-input" type="text"
                                                       value="{{ $details['quantity'] }}" readonly>
                                                <button type="button" class="btn btn-outline-secondary btn-sm right inc"
                                                        data-id="{{ $id }}"><i class="icofont-plus"></i></button>
                                                <button type="button" class="btn btn-outline-danger btn-sm right rmv"
                                                        data-id="{{ $id }}"><i class="icofont-trash"></i></button>
                                            </span>
                                            <div class="media">
                                                <div class="mr-2"><img src="{{ asset($details['image']) }}"
                                                                       style="width:25px;"></div>
                                                <div class="media-body">
                                                    <p class="mt-1 mb-0 text-black">{{ $details['name'] }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="mb-2 bg-white rounded p-2 clearfix">
                                <h6 class="font-weight-bold mb-0">TO PAY <span
                                        class="float-right">{{ $total }} мкд</span></h6>
                            </div>
                            <button type="submit" class="btn btn-success btn-block btn-lg">PAY <i
                                    class="icofont-long-arrow-right"></i></button>
                        </form>
                        <div class="pt-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function selectAddress(button, type) {
            console.log(`selectAddress called with type: ${type}`);
            const homeAddressDiv = document.querySelector('.home-address');
            const otherAddressDiv = document.querySelector('.other-address');
            const otherAddressInput = document.querySelector('.other-address-input');
            const selectedAddressInputs = document.querySelectorAll('.selected-address');
            const homeDeliverBtn = homeAddressDiv.querySelector('.deliver-btn');
            const otherDeliverBtn = otherAddressDiv.querySelector('.deliver-btn');

            if (!homeAddressDiv || !otherAddressDiv || !otherAddressInput || !selectedAddressInputs.length) {
                console.error('Required address elements not found');
                return;
            }

            if (type === 'home') {
                homeAddressDiv.classList.add('border-success');
                otherAddressDiv.classList.remove('border-success');
                homeDeliverBtn.classList.remove('btn-secondary');
                homeDeliverBtn.classList.add('btn-success');
                otherDeliverBtn.classList.remove('btn-success');
                otherDeliverBtn.classList.add('btn-secondary');
                selectedAddressInputs.forEach(input => {
                    input.value = homeDeliverBtn.dataset.address;
                    console.log(`Set address to Home: ${input.value}`);
                });
            } else if (type === 'other' && otherAddressInput.value.trim() !== '') {
                otherAddressDiv.classList.add('border-success');
                homeAddressDiv.classList.remove('border-success');
                otherDeliverBtn.classList.remove('btn-secondary');
                otherDeliverBtn.classList.add('btn-success');
                homeDeliverBtn.classList.remove('btn-success');
                homeDeliverBtn.classList.add('btn-secondary');
                selectedAddressInputs.forEach(input => {
                    input.value = otherAddressInput.value.trim();
                    console.log(`Set address to Other: ${input.value}`);
                });
                otherDeliverBtn.dataset.address = otherAddressInput.value.trim();
            } else {
                console.warn('Other button clicked but input is empty');
            }
        }

        document.querySelectorAll('.other-address-input').forEach(input => {
            input.addEventListener('input', function () {
                const otherDeliverBtn = document.querySelector('.other-address .deliver-btn');
                otherDeliverBtn.disabled = this.value.trim() === '';
                console.log(`Other input changed, button disabled: ${otherDeliverBtn.disabled}`);
            });
        });

        document.querySelector('.home-address').classList.add('border-success');
    </script>



    <script>
        $(document).ready(function () {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                }
            });

            $('.inc').on('click', function (event) {
                event.preventDefault();
                var id = $(this).data('id');
                var input = $(this).closest('span').find('input');
                var newQuantity = parseInt(input.val()) + 1;
                updateQuantity(id, newQuantity);
            });

            $('.dec').on('click', function (event) {
                event.preventDefault();
                var id = $(this).data('id');
                var input = $(this).closest('span').find('input');
                var newQuantity = parseInt(input.val()) - 1;
                if (newQuantity >= 1) {
                    updateQuantity(id, newQuantity);
                }
            });

            $('.rmv').on('click', function (event) {
                event.preventDefault();
                var id = $(this).data('id');
                removeFromCart(id);
            });

            function updateQuantity(id, quantity) {
                $.ajax({
                    url: '{{ route("cart.updateQuantity") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        quantity: quantity
                    },
                    success: function (response) {
                        Toast.fire({
                            icon: 'success',
                            title: 'Quantity Updated'
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function (xhr) {
                        console.error('Quantity update failed:', xhr.responseText);
                        Toast.fire({
                            icon: 'error',
                            title: 'Failed to update quantity'
                        });
                    }
                });
            }

            function removeFromCart(id) {
                $.ajax({
                    url: '{{ route("cart.remove") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id
                    },
                    success: function (response) {
                        Toast.fire({
                            icon: 'success',
                            title: 'Item Removed'
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function (xhr) {
                        console.error('Item removal failed:', xhr.responseText);
                        Toast.fire({
                            icon: 'error',
                            title: 'Failed to remove item'
                        });
                    }
                });
            }
        });
    </script>
@endsection
