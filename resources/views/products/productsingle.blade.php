@extends('layouts.app')

@section('content')
    <section class="home-slider owl-carousel">

        <div class="slider-item" style="background-image: url({{ asset('assets/images/bg_3.jpg') }});">
            <div class="overlay"></div>
            <div class="container">
                <div class="row slider-text justify-content-center align-items-center">

                    <div class="col-md-7 col-sm-12 text-center ftco-animate">
                        <h1 class="mb-3 mt-5 bread">Product Detail</h1>
                        <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home</a></span> <span>Product
                                Detail</span></p>
                    </div>

                </div>
            </div>
        </div>
    </section>

    {{-- Success Message --}}
    @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> {{ Session::get('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <section class="ftco-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-5 ftco-animate">
                    <a href="{{ asset('assets/images/' . $product->image . '') }}" class="image-popup"><img
                            src="{{ asset('assets/images/' . $product->image . '') }}" class="img-fluid"
                            alt="Colorlib Template"></a>
                </div>
                <div class="col-lg-6 product-details pl-md-5 ftco-animate">
                    <h3 class="text-white">{{ $product->name }}</h3>

                    <p class="price"><span>₱{{ $product->price }}</span></p>

                    <p>{{ $product->description }}</p>

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="form-group d-flex">
                                {{-- <div class="select-wrap">
	                  <div class="icon"><span class="ion-ios-arrow-down"></span></div>
	                  <select name="" id="" class="form-control">
	                  	<option value="">Small</option>
	                    <option value="">Medium</option>
	                    <option value="">Large</option>
	                    <option value="">Extra Large</option>
	                  </select>
	                </div>
		            </div> --}}
                            </div>
                            {{-- <div class="w-100"></div>
							<div class="input-group col-md-6 d-flex mb-3">
	             	<span class="input-group-btn mr-2">
	                	<button type="button" class="quantity-left-minus btn"  data-type="minus" data-field="">
	                   <i class="icon-minus"></i>
	                	</button>
	            		</span>
	             	<input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
	             	<span class="input-group-btn ml-2">
	                	<button type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
	                     <i class="icon-plus"></i>
	                 </button> --}}
                            </span>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('add.cart', $product->id) }}">
                        @csrf
                        <input type="hidden" value="{{ $product->id }}" name="product_id" id="">
                        <input type="hidden" value="{{ $product->name }}" name="name" id="">
                        <input type="hidden" value="{{ $product->price }}" name="price" id="">
                        <input type="hidden" value="{{ $product->image }}" name="image" id="">

                        @if(isset(Auth::user()->id))
                             @if($checkingInCart == 0)
                                <button type="submit" name="submit" class="btn btn-primary py-3 px-5">Add to Cart</button>
                            @else
                                <button type="button" class="btn btn-secondary py-3 px-5" disabled>Already in Cart</button>
                            @endif
                        @endif



                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center mb-5 pb-3">
                <div class="col-md-7 heading-section ftco-animate text-center">
                    <span class="subheading">Discover</span>
                    <h2 class="mb-4">Related products</h2>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live
                        the blind texts.</p>
                </div>
            </div>
            <div class="row">
                @foreach ($relatedProducts as $relatedProduct)
                    <div class="col-md-3">
                        <div class="menu-entry">
                            <a href="{{ route('product.single', $relatedProduct->id) }}" class="img"
                                style="background-image: url({{ asset('assets/images/' . $relatedProduct->image . '') }});"></a>
                            <div class="text text-center pt-4">
                                <h3><a
                                        href="{{ route('product.single', $relatedProduct->id) }}">{{ $relatedProduct->name }}</a>
                                </h3>
                                <p>{{ $relatedProduct->description }}</p>
                                <p class="price"><span>₱{{ $relatedProduct->price }}</span></p>
                                <p><a href="{{ route('product.single', $relatedProduct->id) }}"
                                        class="btn btn-primary btn-outline-primary">Show</a></p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
@endsection
