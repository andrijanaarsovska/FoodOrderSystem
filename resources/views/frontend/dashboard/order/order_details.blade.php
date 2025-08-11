@extends('frontend.dashboard.dashboard')
@section('dashboard')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
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
                            <div class="tab-pane fade show active" id="orders" role="tabpanel"
                                 aria-labelledby="orders-tab">
                                <h4 class="font-weight-bold mt-0 mb-4">Order Details</h4>


                                <div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-2">
                                    <div class="col">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4>Shipping Details</h4>
                                                <br>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered border-success mb-0">

                                                        <tbody>
                                                        <tr>
                                                            <th width="50%">Name:</th>
                                                            <td>{{ $order->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Phone:</th>
                                                            <td>{{ $order->phone }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Email:</th>
                                                            <td>{{ $order->email }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Address:</th>
                                                            <td>{{ $order->address }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Order Date:</th>
                                                            <td>{{ $order->order_date }}</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                    </div> <!-- end col -->

                                    <div class="col">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4>Order Details</h4>
                                                <span class="text-danger">Invoice: {{ $order->invoice_no }}</span>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered border-success mb-0">

                                                        <tbody>
                                                        <tr>
                                                            <th>Name:</th>
                                                            <td>{{ $order->user->name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Phone:</th>
                                                            <td>{{ $order->user->phone }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Email:</th>
                                                            <td>{{ $order->user->email }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Payment Type:</th>
                                                            <td>{{ $order->payment_method }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Transaction Id:</th>
                                                            <td>{{ $order->transaction_id }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Order Total:</th>
                                                            <td>{{ $order->amount }} мкд</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Order Status:</th>
                                                            <td>
                                                                @php
                                                                    $class = match($order->status) {
                                                                        'pending' => 'badge bg-danger',
                                                                        'confirmed' => 'badge bg-info',
                                                                        'processing' => 'badge bg-warning',
                                                                        default => 'badge bg-success',
                                                                    };
                                                                @endphp
                                                                <span class="{{ $class }}">{{ $order->status }}</span>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>

                                            </div>
                                        </div>
                                    </div> <!-- end col -->

                                </div> <!-- end row -->
                                <br>
                                <div class="row ">
                                    <div class="col-12">
                                        <div class="">
                                            <div class="table-responsive table-bordered">
                                                <table class="table table-bordered text-center align-middle">
                                                    <thead>
                                                    <tr>
                                                        <th style="width: 150px;">Image</th>
                                                        <th style="width: 150px;">Product Name</th>
                                                        <th style="width: 150px;">Restaurant Name</th>
                                                        <th style="width: 150px;">Product Code</th>
                                                        <th style="width: 150px;">Quantity</th>
                                                        <th style="width: 150px;">Price</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($orderItem as $item)
                                                        <tr>
                                                            <td>
                                                                <img src="{{ asset($item->product->image) }}"
                                                                     style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;"
                                                                     alt="Product Image">
                                                            </td>
                                                            <td>{{ $item->product->name }}</td>
                                                            @if($item->client_id == null)
                                                                <td>OWNER</td>
                                                            @else
                                                                <td>{{ $item->product->client->name }}</td>
                                                            @endif
                                                            <td>{{ $item->product->code }}</td>
                                                            <td>{{ $item->qty }}</td>
                                                            <td>
                                                                {{ $item->price }} мкд<br>
                                                                <strong>Total = {{ $item->price * $item->qty }} мкд</strong>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>

                                                <div class="p-2">
                                                    <h4>Total Price: {{ $totalPrice }} мкд</h4>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
