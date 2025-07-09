@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col">
            {{-- Success Message --}}
            @if (Session::has('update'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{ Session::get('update') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            {{-- Success Delete Message --}}
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
              <h5 class="card-title mb-4 d-inline">Bookings</h5>

              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">first_name</th>
                    <th scope="col">last_name</th>
                    <th scope="col">date</th>
                    <th scope="col">time</th>
                    <th scope="col">phone</th>
                    <th scope="col">message</th>
                    <th scope="col">status</th>
                    <th scope="col">created_at</th>
                    <th scope="col">action</th>
                    <th scope="col">delete</th>
                  </tr>
                </thead>
                <tbody>

                    @foreach ($bookings as $booking)
                      <tr>
                        <th scope="row">{{ $booking->id }}</th>
                        <td>{{ $booking->first_name }}</td>
                        <td>{{ $booking->last_name }}</td>
                        <td>{{ $booking->date }}</td>
                        <td>{{ $booking->time }}</td>
                        <td>{{ $booking->phone }}</td>
                        <td>{{ $booking->message }}</td>
                        <td>{{ $booking->status }}</td>
                        <td>{{ $booking->created_at }}</td>
                        <td><a href="{{ route('edit.booking', $booking->id) }}" class="btn btn-warning  text-center ">change status</a></td>

                        <td><a href="{{ route('delete.booking', $booking->id) }}" class="btn btn-danger  text-center ">delete</a></td>
                      </tr>
                    @endforeach



                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
@endsection
