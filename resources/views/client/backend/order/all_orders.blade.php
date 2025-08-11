@extends('client.client_dashboard')
@section('client')

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">All Orders</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                <thead>
                                <tr>
                                    <th>Serial Number</th>
                                    <th>Date</th>
                                    <th>Invoice</th>
                                    <th>Amount</th>
                                    <th>Payment</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach( $orderItemGroupedData as $key=>$orderItem)
                                    @php
                                        $firstItem = $orderItem->first();
                                        $order = $firstItem->order;
                                    @endphp
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $order->order_date }}</td>
                                        <td>{{ $order->invoice_no}}</td>
                                        <td>{{ $order->amount }} мкд</td>
                                        <td>{{ $order->payment_method }}</td>
                                        <td>
                                            @if($order->status == 'pending')
                                                <span class="badge bg-danger">Pending</span>
                                            @elseif($order->status == 'confirmed')
                                                 <span class="badge bg-info">Confirmed</span>
                                            @elseif($order->status == 'processing')
                                                <span class="badge bg-warning">Processing</span>
                                            @elseif($order->status == 'delivered')
                                                <span class="badge bg-success">Delivered</span>
                                            @endif
                                        </td>

                                        <td><a href="{{ route('client.order_details', $order->id) }}"
                                               class="btn btn-info waves-effect waves-light"><i class="fas fa-eye"></i></a>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

        </div> <!-- container-fluid -->
    </div>

@endsection
