@extends('frontend.dashboard.dashboard')
@section('dashboard')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <section class="section pt-5 pb-5 osahan-not-found-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center pt-5 pb-5">
                    <img class="img-fluid" src="{{ asset('upload/pngtree-boy-deliver-food-with-scooter-bike-png-image_17150286.png') }}" style="width: 400px; height: 400px" alt="404">
                    <h1 class="mt-2 mb-2">THANK YOU FOR YOUR ORDER</h1>
                    <p>Your order has been placed and is being processed. You will receive an email shortly.</p>
                    <a class="btn btn-primary btn-lg" href="{{route('index')}}">GO HOME</a>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>


@endsection
