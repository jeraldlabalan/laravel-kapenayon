@extends('layouts.app')

@section('content')

    <section class="home-slider owl-carousel">

        <div class="slider-item" style="background-image: url({{ asset('assets/images/bg_3.jpg') }});"
            data-stellar-background-ratio="0.5">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center">

                    <div class="col-md-7 col-sm-12 text-center ftco-animate">
                        <h1 class="mb-3 mt-5 bread">My Orders</h1>
                        <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>My Orders</span>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </section>

<section class="ftco-section ftco-cart">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="cart-list" style="overflow-x: auto;">
                        <table class="table" style="background: white;">
                            <thead class="thead-primary">
                                <tr class="text-center">
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>City</th>
                                    <th>Email</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @if ($orders->count() > 0)
                                    @foreach ($orders as $order)
                                        <tr class="text-center">
                                            <td class="">
                                                {{ $order->first_name }}
                                            </td>

                                            <td class="">
                                                {{ $order->last_name }}
                                            </td>

                                            <td class="">
                                                {{ $order->city }}
                                            </td>

                                            <td>
                                                {{ $order->email }}
                                            </td>

                                            <td class="">
                                                {{ $order->price }}
                                            </td>

                                            <td class="">
                                                {{ $order->status }}
                                            </td>

                                            <td class="">
                                                @if ($order->status == "Delivered")
                                                    <a class="btn btn-primary" href="{{ route('write.reviews') }}">Review</a>
                                                @else
                                                    <p class="text-black">Can't review yet.</p>
                                                @endif
                                            </td>
                                        </tr><!-- END TR-->
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" class="text-center text-white">Your order is empty.</td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
