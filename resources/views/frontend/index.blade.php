@extends('frontend.master')
@section('content')

<section class="section pt-5 pb-5 products-section">
    <div class="container">
        <div class="section-header text-center">
            <h2>Popular Restaurants</h2>
{{--            <p>Top restaurants, cafes, pubs, and bars in Macedonia, based on trends</p>--}}
            <span class="line"></span>
        </div>

        @php
            $clients = \App\Models\Client::latest()->where('status' , '1')->get();
        @endphp

        <div class="row">

            @foreach($clients as $client)
                @php
                $products = \App\Models\Product::where('client_id', $client->id)->limit(3)->get();
                $menu_items = $products->map(function($product){
                    return $product->menu->menu_name ?? '';
                })->toArray();
                $menu_names_string = implode(' ', $menu_items);
                @endphp



            <div class="col-md-3 d-flex">
                    <div class="item pb-3">
                        <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                            <div class="list-card-image">
                                <a href="{{ route('restaurant.details', $client->id) }}">
                                    <img src="{{asset('upload/client_images/'.$client->photo)}}" class="img-fluid item-img" style="width: 300px; height: 200px;">
                                </a>
                            </div>
                            <div class="p-3 position-relative">
                                <div class="list-card-body">
                                    <h6 class="mb-1 mb-3"><a href="{{ route('restaurant.details', $client->id) }}" class="text-black">{{ $client->name }}</a></h6>
                                    <p class="text-gray mb-3 time"><span class="bg-light text-dark rounded-sm pl-2 pb-1 pt-1 pr-2"><i class="icofont-wall-clock"></i> 20–25 min</span> </p>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>



        @endforeach
        </div>


    </div>
</section>

@endsection
