@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4 d-inline">Admins</h5>
                    <a href="create-admins.html" class="btn btn-primary mb-4 text-center float-right">Create Admins</a>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Admin Name</th>
                                <th scope="col">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allAdmins as $admin)
                                <tr>
                                    <td scope="row">{{ $admin->id }}</td>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->email }}</td>

                                </tr>
                            @endforeach ()




                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
