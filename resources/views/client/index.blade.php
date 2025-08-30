@extends('client.client_dashboard')
@section('client')

    @php
        use Illuminate\Support\Facades\Auth;$id = Auth::guard('client')->id();
        $client = App\Models\Client::find($id);
        $status = $client->status;
    @endphp

    <div class="page-content">
        <div class="container-fluid">

            @if($status === '1')
                <h4>Restaurant Account is <span class="text-success">Active</span></h4>
            @else
                <h4>Restaurant Account is <span class="text-danger">InActive</span></h4>
                <p class="text-danger"><b>Please wait for approve!</b></p>
            @endif

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Dashboard</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

                <div class="row">
                    <div class="col-xl-6 col-md-12">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-12">
                                        <span class="text-muted mb-3 lh-1 d-block text-truncate">My Wallet</span>
                                        <h4 class="mb-3">
                                            <span class="counter-value" data-target="15256">0</span>mkd
                                        </h4>
                                    </div>

                                    <div class="col-12">
                                        <div id="mini-chart1" data-colors='["#5156be"]' class="apex-charts mb-2"></div>
                                    </div>
                                </div>
                                <div class="text-nowrap">
                                    <span class="badge bg-success-subtle text-success">+4500mkd</span>
                                    <span class="ms-1 text-muted font-size-13">Since last week</span>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                </div><!-- end row-->

        </div>
        <!-- container-fluid -->
    </div>

@endsection
