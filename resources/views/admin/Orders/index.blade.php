@extends('layouts.admin')

@section('content')
    <div class="mt-4 ms-4">
        <div>
            <h1 class="mb-4">Orders</h1>
        </div>

        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td>
                            <a href="#" class="btn btn-primary">show</a>
                            {{-- <button class="btn btn-warning">edit</button>
                        <button class="btn btn-danger">delete</button> --}}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection