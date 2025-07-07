@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col">
            {{-- Success Message --}}
            @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{ Session::get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif


            {{-- Success Message --}}
            @if (Session::has('delete'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{ Session::get('delete') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4 d-inline">Kapenayon Products</h5>
                    <a href="{{ route('create.product') }}" class="btn btn-primary mb-4 text-center float-right">Create Products</a>

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">name</th>
                                <th scope="col">image</th>
                                <th scope="col">price</th>
                                <th scope="col">type</th>
                                <th scope="col">delete</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($products as $product)
                                <tr>
                                    <th scope="row">{{ $product->id }}</th>
                                    <td>{{ $product->name }}</td>
                                    <td><img src="{{ asset('assets/images/'. $product->image . '') }}" alt="{{ $product->name }}" width="70" height="50" ></td>
                                    <td>${{ $product->price }}</td>
                                    <td>{{ $product->type }}</td>
                                    <td><a href="{{ route('delete.product', $product->id) }}" class="btn btn-danger  text-center ">delete</a></td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
