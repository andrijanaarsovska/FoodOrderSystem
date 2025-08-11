@extends('client.client_dashboard')
@section('client')

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Order Details</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

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

            <div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-1">
                <div class="col-12">
                    <div class="card">
                        <div class="table-responsive table-bordered">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="col-md-1">Image:</th>
                                    <th class="col-md-1">Product Name:</th>
                                    <th class="col-md-1">Restaurant Name:</th>
                                    <th class="col-md-1">Product Code:</th>
                                    <th class="col-md-1">Quantity:</th>
                                    <th class="col-md-1">Price:</th>
                                </tr>

                                </thead>
                                <tbody>
                                @foreach($orderItem as $item)
                                    <tr>
                                        <td class="col-md-1"> <img src="{{ asset($item->product->image) }}" style="width: 50px; height: 50px"></td>
                                        <td class="col-md-2">{{ $item->product->name }}</td>
                                        @if($item->client_id == NUll)
                                            <td class="col-md-2">OWNER</td>
                                        @else
                                            <td class="col-md-2">{{ $item->product->client->name }}</td>
                                        @endif
                                        <td class="col-md-1">{{ $item->product->code }}</td>
                                        <td class="col-md-1">{{ $item->qty }}</td>
                                        <td class="col-md-1">{{ $item->price}} мкд
                                            <br> Total = {{ $item->price * $item->qty }} мкд</td>

                                    </tr>
                                @endforeach
                                <tr>

                                </tr>
                                </tbody>

                            </table>
                            <div class="p-2">
                                <h4>Total Price: {{ $totalPrice }} мкд</h4>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div> <!-- container-fluid -->
    </div>

@endsection
