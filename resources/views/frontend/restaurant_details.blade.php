@extends('frontend.dashboard.dashboard')
@section('dashboard')


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    @php
        $products = \App\Models\Product::where('client_id', $restaurant->id)->limit(3)->get();
        $menu_items = $products->map(function($product){
            return $product->menu->menu_name ?? '';
        })->toArray();
        $menu_names_string = implode(' ', $menu_items);
    @endphp

    <section class="restaurant-detailed-banner">
        <div class="text-center" style="position:relative; overflow: hidden; width: 100%; height: 700px;">
            <img class="img-fluid cover" src="{{ asset('upload/client_images/'.$restaurant->cover_photo) }} " style="width: 100%; height: 100%; object-fit: cover">
        </div>
        <div class="restaurant-detailed-header">
            <div class="container">
                <div class="row d-flex align-items-end">
                    <div class="col-md-8">
                        <div class="restaurant-detailed-header-left">
                            <img class="img-fluid mr-3 float-left" alt="restaurant photo"
                                 src="{{ asset('upload/client_images/'.$restaurant->photo) }}" style="object-fit: cover; width: 200px; height: 150px">
                            <h2 class="text-white">{{ $restaurant->name }}</h2>
                            <p class="text-white mb-1"><i class="icofont-location-pin"></i>{{ $restaurant->address }}
                                <span class="badge badge-success">OPEN</span>
                            </p>

                        </div>
                    </div>

                    @php
                        $start = rand(20, 110);
                        $end = min($start + rand(15, 30), 160);
                    @endphp

                    <div class="col-md-4">
                        <div class="restaurant-detailed-header-right text-right">
                            <button class="btn btn-success" type="button"><i class="icofont-clock-time"></i> {{ $start }} - {{ $end }} min
                            </button>
{{--                            <h6 class="text-white mb-0 restaurant-detailed-ratings"><span--}}
{{--                                    class="generator-bg rounded text-white"><i class="icofont-star"></i> 3.1</span> 23--}}
{{--                                Ratings <i class="ml-3 icofont-speech-comments"></i> 91 reviews</h6>--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <section class="offer-dedicated-nav bg-white border-top-0 shadow-sm">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    {{--                  <span class="restaurant-detailed-action-btn float-right">--}}
                    {{--                  </span>--}}
                    <ul class="nav" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="pills-order-online-tab" data-toggle="pill"
                               href="#pills-order-online" role="tab" aria-controls="pills-order-online"
                               aria-selected="true">Order Online</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-gallery-tab" data-toggle="pill" href="#pills-gallery"
                               role="tab" aria-controls="pills-gallery" aria-selected="false">Gallery</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="pills-restaurant-info-tab" data-toggle="pill"
                               href="#pills-restaurant-info" role="tab" aria-controls="pills-restaurant-info"
                               aria-selected="false">Restaurant Info</a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="offer-dedicated-body pt-2 pb-2 mt-4 mb-4">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="offer-dedicated-body-left">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-order-online" role="tabpanel"
                                 aria-labelledby="pills-order-online-tab">

                                @php
                                    $popular = \App\Models\Product::where('status', '1')->where('client_id',  $restaurant->id)->where('most_popular', '1')->orderBy('id', 'desc')->limit(5)->get();
                                @endphp

                                <div id="#menu" class="bg-white rounded shadow-sm p-4 mb-4 explore-outlets">

                                    <h6 class="mb-3">Most Popular</h6>
                                    <div class="owl-carousel owl-theme owl-carousel-five offers-interested-carousel mb-3">

                                        @foreach( $popular as $item)
                                            <div class="item">
                                                <div class="mall-category-item">
                                                    <a href="#">
                                                        <img class="img-fluid" src="{{ asset($item->image) }}">
                                                        <h6>{{ $item->name  }}</h6>
                                                        @if($item->discount_price == NULL)
                                                            {{$item->price}} мкд
                                                        @else


                                                            <del>{{$item->price}}</del> ${{$item->discount_price}} мкд
                                                        @endif
                                                        <span class="float-right">
                                                    <a class="btn btn-outline-secondary btn-sm"
                                                       href="{{ route('add_to_cart', $item->id) }}">ADD</a>
                                                </span>
                                                    </a>
                                                </div>
                                            </div>

                                        @endforeach


                                    </div>
                                </div>

                                @php
                                    $bestsellers = \App\Models\Product::where('status', '1')->where('client_id',  $restaurant->id)->where('best_seller', '1')->orderBy('id', 'desc')->limit(3)->get();
                                @endphp


                                <div class="row">
                                    <h5 class="mb-4 mt-3 col-md-12">Best Sellers</h5>

                                    @foreach ($bestsellers as $bestseller )

                                        <div class="col-md-4 col-sm-6 mb-4">
                                            <div
                                                class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                                <div class="list-card-image">
{{--                                                   <div class="member-plan position-absolute"><span--}}
{{--                                                            class="badge badge-dark">Promoted</span></div>--}}
                                                    <a href="#">
                                                        <img src="{{ asset($bestseller->image) }}"
                                                             class="img-fluid item-img">
                                                    </a>
                                                </div>
                                                <div class="p-3 position-relative">
                                                    <div class="list-card-body">
                                                        <h6 class="mb-1"><a href="#"
                                                                            class="text-black">{{ $bestseller->name }}</a>
                                                        </h6>

                                                        <p class="text-gray time mb-0">
                                                            @if($bestseller->discount_price == NULL)
                                                                <a class="btn btn-link btn-sm text-black"
                                                                   href="#">{{$bestseller->price}} мкд</a>
                                                            @else
                                                                <del>{{$bestseller->price}} мкд</del>
                                                                <a class="btn btn-link btn-sm text-black"
                                                                   href="#">{{$bestseller->discount_price}} мкд</a>

                                                            @endif

                                                            <span class="float-right">
                                                    <a class="btn btn-outline-secondary btn-sm"
                                                       href="{{ route('add_to_cart', $bestseller->id) }}">ADD</a>
                                                </span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>


                                @foreach($menus as $menu)

                                    <div class="row">
                                        <h5 class="mb-4 mt-3 col-md-12">{{ $menu->menu_name }} <small
                                                class="h6 text-black-50">{{ $menu->products->count() }} ITEMS </small>
                                        </h5>
                                        <div class="col-md-12">
                                            <div class="bg-white rounded border shadow-sm mb-4">

                                                @foreach($menu->products as $product)
                                                    <div class="menu-list p-3 border-bottom">
                                                        <a class="btn btn-outline-secondary btn-sm  float-right"
                                                           href="{{ route('add_to_cart', $product->id) }}">ADD</a>

                                                        <div class="media">
                                                            <img class="mr-3 rounded-pill"
                                                                 src="{{ asset($product->image) }} "
                                                                 alt="Generic placeholder image">
                                                            <div class="media-body">
                                                                <h6 class="mb-1">{{ $product->name }}</h6>
                                                                <p class="text-gray mb-0">
                                                                    {{ $product->price }} мкд
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>


                            {{--                        gallery             --}}
                            <div class="tab-pane fade" id="pills-gallery" role="tabpanel"
                                 aria-labelledby="pills-gallery-tab">
                                <div id="gallery" class="bg-white rounded shadow-sm p-4 mb-4">
                                    <div class="restaurant-slider-main position-relative homepage-great-deals-carousel">
                                        <div class="owl-carousel owl-theme homepage-ad">
                                            @foreach($galleries as $index =>$gallery)

                                                <div class="item">
                                                    <img class="img-fluid" src="{{ asset($gallery->gallery_img) }}">
                                                    <div
                                                        class="position-absolute restaurant-slider-pics bg-dark text-white">{{ $index + 1 }}
                                                        of {{ $galleries->count() }} Photos
                                                    </div>

                                                </div>

                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>


                            {{--restaurant info--}}
                            <div class="tab-pane fade" id="pills-restaurant-info" role="tabpanel"
                                 aria-labelledby="pills-restaurant-info-tab">
                                <div id="restaurant-info" class="bg-white rounded shadow-sm p-4 mb-4">
                                    <div class="address-map float-right ml-5">
                                        <div class="mapouter">
                                            <div class="gmap_canvas">
                                                <iframe width="300" height="170" id="gmap_canvas"
                                                        src="https://maps.google.com/maps?q={{ urlencode($restaurant->address) }}&t=&z=9&ie=UTF8&iwloc=&output=embed"
                                                        frameborder="0" scrolling="no" marginheight="0"
                                                        marginwidth="0"></iframe>
                                            </div>
                                        </div>
                                    </div>
                                    <h5 class="mb-4">Restaurant Info</h5>
                                    <p class="mb-3">{{ $restaurant->address}}
                                    </p>
                                    <p class="mb-2 text-black"><i
                                            class="icofont-phone-circle text-primary mr-2"></i> {{ $restaurant->phone}}
                                    </p>
                                    <p class="mb-2 text-black"><i
                                            class="icofont-email text-primary mr-2"></i> {{ $restaurant->email}}</p>
                                    @if($restaurant->shop_info)
                                        <p class="mb-2 text-black"><i
                                                class="icofont-info text-primary mr-2"></i> {{ $restaurant->shop_info}}
                                        </p>
                                    @endif

                                    <p class="mb-2 text-black"><i
                                            class="icofont-clock-time text-primary mr-2">  {{ $restaurant->working_hours }}</i>
                                        <span class="badge badge-success"> OPEN EVERY DAY </span>
                                    </p>
                                    <hr class="clearfix">

                                </div>
                            </div>

                        </div>
                    </div>
                </div>


                {{--            order--}}
                <div class="col-md-4">
                    <div class="generator-bg rounded shadow-sm mb-4 p-4 osahan-cart-item">
                        <h5 class="mb-1 text-white">Your Order</h5>
                        <p class="mb-4 text-white">{{ count((array) session('cart')) }} ITEMS</p>
                        <div class="bg-white rounded shadow-sm mb-2">

                            @php $total = 0; @endphp

                            @if(session('cart'))
                                @foreach(session('cart') as $id=>$details)
                                    @php
                                        $total += $details['price'] * $details['quantity'];
                                    @endphp
                                    <div class="gold-members p-2 border-bottom">
                                        <p class="text-gray mb-0 float-right ml-2">
                                            {{ $details['price'] * $details['quantity'] }} мкд</p>
                                        <span class="count-number float-right">

                                            <button class="btn btn-outline-secondary  btn-sm left dec"
                                                    data-id="{{ $id }}"> <i
                                                    class="icofont-minus"></i> </button>

                                            <input class="count-number-input" type="text"
                                                   value="{{ $details['quantity'] }}" readonly="">

                                            <button class="btn btn-outline-secondary btn-sm right inc"
                                                    data-id="{{ $id }}"> <i
                                                    class="icofont-plus"></i> </button>
                                             <button class="btn btn-outline-danger btn-sm right rmv"
                                                     data-id="{{ $id }}"> <i
                                                     class="icofont-trash"></i> </button>
                                        </span>
                                        <div class="media">
                                            <div class="mr-2"><img src="{{ asset($details['image']) }}"
                                                                   style="width:25px;">
                                            </div>
                                            <div class="media-body">
                                                <p class="mt-1 mb-0 text-black">{{ $details['name'] }}</p>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach
                            @endif


                        </div>

                        <div class="mb-2 bg-white rounded p-2 clearfix">
                            <img class="img-fluid float-left" src="{{ asset('frontend/img/wallet-icon.png') }}">
                            <h6 class="font-weight-bold text-right mb-2">Subtotal : <span
                                    class="text-danger">{{ $total }} мкд</span></h6>
                            <p class="seven-color mb-1 text-right">Extra charges may apply</p>
                        </div>
                        <a href="{{ route('checkout') }}" class="btn btn-success btn-block btn-lg">Checkout <i
                                class="icofont-long-arrow-right"></i></a>
                    </div>

                </div>


            </div>
        </div>
    </section>



    <script>
        $(document).ready(function() {

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

            $('.inc').on('click', function() {
                var id = $(this).data('id');
                var input = $(this).closest('span').find('input');
                var newQuantity = parseInt(input.val()) + 1;
                updateQuantity(id,newQuantity);
            });

            $('.dec').on('click', function() {
                var id = $(this).data('id');
                var input = $(this).closest('span').find('input');
                var newQuantity = parseInt(input.val()) - 1;
                if (newQuantity >= 1) {
                    updateQuantity(id,newQuantity);
                }
            });

            $('.rmv').on('click', function() {
                var id = $(this).data('id');
                removeFromCart(id);
            });

            function updateQuantity(id,quantity){
                $.ajax({
                    url: '{{ route("cart.updateQuantity") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        quantity: quantity
                    },  success: function(response){
                        Toast.fire({
                            icon: 'success',
                            title: 'Quantity Updated'
                        }).then(() => {
                            location.reload();
                        });

                    }
                })
            }

            function removeFromCart(id){
                $.ajax({
                    url: '{{ route("cart.remove") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id
                    },
                    success: function(response){

                        Toast.fire({
                            icon: 'success',
                            title: 'Item Removed'
                        }).then(() => {
                            location.reload();
                        });

                    }
                });
            }



        })
    </script>

    <script>
        $(document).ready(function(){
            $('.owl-carousel-five').owlCarousel({
                loop:true,      // set to true if you want infinite scrolling
                margin:10,
                nav:true,
                dots:true,
                items:5,         // number of items you want visible
                autoplay:true   // change to true if you want auto sliding
            });
        });
    </script>


@endsection
