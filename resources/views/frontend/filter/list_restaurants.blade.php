@extends('frontend.dashboard.dashboard')
@section('dashboard')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <section class="breadcrumb-osahan pt-5 pb-5 bg-dark position-relative text-center">
        <h1 class="text-white">Offers Near You</h1>
        <h6 class="text-white-50">Best deals at your favourite restaurants</h6>
    </section>
    <section class="section pt-5 pb-5 products-listing">
        <div class="container">
            <div class="row d-none-m">
                <div class="col-md-12">
                    <h4 class="font-weight-bold mt-0 mb-3">OFFERS <small class="h6 mb-0 ml-2">
                        </small>
                    </h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="filters shadow-sm rounded bg-white mb-4">
                        <div class="filters-header border-bottom pl-4 pr-4 pt-3 pb-3">
                            <h5 class="m-0">Filter By</h5>
                        </div>

                        @php
                            $categories = App\Models\Category::orderBy('id','desc')->limit(10)->get();
                        @endphp
                        <div class="filters-body">
                            <div id="accordion">
                                <div class="filters-card border-bottom p-4">
                                    <div class="filters-card-header" id="headingOne">
                                        <h6 class="mb-0">
                                            <a href="#" class="btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                Category <i class="icofont-arrow-down float-right"></i>
                                            </a>
                                        </h6>
                                    </div>


                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="filters-card-body card-shop-filters">
                                            @foreach ($categories as $category)
                                                @php
                                                    $categoryProductCount = $products->where('category_id',$category->id)->count();
                                                @endphp
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input filter-checkbox" id="category-{{$category->id}}" data-type="category" data-id="{{$category->id}}">
                                                    <label class="custom-control-label" for="category-{{$category->id}}">{{$category->category_name}} <small class="text-black-50">({{$categoryProductCount}})</small>
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>



                        @php
                        $cities = App\Models\City::orderBy('id', 'desc')->limit(10)->get();
                        @endphp
                        <div class="filters-body">
                            <div id="accordion">
                                <div class="filters-card border-bottom p-4">
                                    <div class="filters-card-header" id="headingOnecity">
                                        <h6 class="mb-0">
                                            <a href="#" class="btn-link" data-toggle="collapse" data-target="#collapseOnecity" aria-expanded="true" aria-controls="collapseOnecity">
                                                City <i class="icofont-arrow-down float-right"></i>
                                            </a>
                                        </h6>
                                    </div>


                                    <div id="collapseOnecity" class="collapse show" aria-labelledby="headingOnecity" data-parent="#accordion">
                                        <div class="filters-card-body card-shop-filters">
                                            @foreach ($cities as $city)
                                                @php
                                                    $cityProductCount = $products->where('city_id',$city->id)->count();
                                                @endphp
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input filter-checkbox" id="city-{{$city->id}}" data-type="city" data-id="{{$city->id}}">
                                                    <label class="custom-control-label" for="city-{{$city->id}}">{{$city->city_name}} <small class="text-black-50">({{$cityProductCount}})</small>
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>



                        @php
                            $menus = App\Models\Menu::orderBy('id','desc')->limit(10)->get();
                        @endphp
                        <div class="filters-body">
                            <div id="accordion">
                                <div class="filters-card border-bottom p-4">
                                    <div class="filters-card-header" id="headingOnemenu">
                                        <h6 class="mb-0">
                                            <a href="#" class="btn-link" data-toggle="collapse" data-target="#collapseOnemenu" aria-expanded="true" aria-controls="collapseOnemenu">
                                                Menu <i class="icofont-arrow-down float-right"></i>
                                            </a>
                                        </h6>
                                    </div>


                                    <div id="collapseOnemenu" class="collapse show" aria-labelledby="headingOnemenu" data-parent="#accordion">
                                        <div class="filters-card-body card-shop-filters">
                                            @foreach ($menus as $menu)
                                                @php
                                                    $menuProductCount = $products->where('menu_id',$menu->id)->count();
                                                @endphp
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input filter-checkbox" id="menu-{{$menu->id}}" data-type="menu" data-id="{{$menu->id}}">
                                                    <label class="custom-control-label" for="menu-{{$menu->id}}">{{$menu->menu_name}} <small class="text-black-50">({{$menuProductCount}})</small>
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="col-md-9">

                    <div class="row" id="product-list">

                        @foreach ($products as $product)
                            <div class="col-md-4 col-sm-6 mb-4 pb-2">
                                <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
                                    <div class="list-card-image">
                                        <div class="favourite-heart text-danger position-absolute"><a href="{{ route('restaurant.details',$product->client_id) }}"></a></div>
                                        <a href="{{ route('restaurant.details',$product->client_id) }}">
                                            <img src="{{ asset($product->image) }}" class="img-fluid item-img">
                                        </a>
                                    </div>

                                    @php
                                        $start = rand(20, 110);
                                        $end = min($start + rand(15, 30), 160);
                                    @endphp
                                    <div class="p-3 position-relative">
                                        <div class="list-card-body">
                                            <h6 class="mb-1"><a href="{{ route('restaurant.details',$product->client_id) }}" class="text-black"> {{ $product->name}}</a></h6>
<div class="float-right text-black-50 pb-2" > {{ $product->price }} мкд</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach



                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    <script>
        $(document).ready(function(){
            $('.filter-checkbox').on('change',function(){
                var filters = {
                    categories: [],
                    cities: [],
                    menus: []
                };
                console.log(filters);
                let typeMap = {
                    category: 'categories',
                    city: 'cities',
                    menu: 'menus'
                };
                $('.filter-checkbox:checked').each(function(){
                    var type = $(this).data('type');
                    var id = $(this).data('id');

                    let pluralType = typeMap[type];

                    if (!filters[pluralType]) {
                        filters[pluralType] = [];
                    }

                    filters[pluralType].push(id);
                });

                $.ajax({
                    url: '{{ route('filter.products') }}',
                    method: 'GET',
                    data: filters,
                    success: function(response){
                        $('#product-list').html(response);

                        let noFiltersSelected = document.querySelectorAll('.filter-checkbox:checked').length === 0;

                        if (noFiltersSelected) {
                            document.querySelectorAll('.matched-text').forEach(el => el.remove());
                        }
                    }
                });

            });
        })
    </script>


@endsection

