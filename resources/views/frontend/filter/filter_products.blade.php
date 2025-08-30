@foreach ($filteredProducts as $product)
    <div class="col-md-4 col-sm-6 mb-4 pb-2">
        <div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm">
            <div class="list-card-image">
                <div class="favourite-heart text-danger position-absolute"><a href="{{ route('restaurant.details',$product->client_id) }}"></a></div>
                <a href="{{ route('restaurant.details',$product->client_id) }}">
                    <img src="{{ asset($product->image) }}" class="img-fluid item-img">
                </a>
            </div>
            <div class="p-3 position-relative">
                <p>Matched</p>
                <div class="list-card-body">
                    <h6 class="mb-1"><a href="{{ route('restaurant.details',$product->client_id) }}" class="text-black"> {{ $product->name}}</a></h6>
<span class="float-right text-black-50 pb-2"> {{ $product->price }} мкд</span>
                </div>
            </div>
        </div>
    </div>
@endforeach

