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
                        <th scope="col">Name</th>
                        <th scope="col">date</th>

                        <th scope="col">Ammount</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Delivery in</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($auht_orders as $order)
                    <tr>
                        <th scope="row">{{ $order->name }} </th>
                        <td>{{ $order->formatted_created_at }} </th>

                        <td>&euro;{{ $order->total_price }}</td>
                        <td>{{ $order->phone_number }}</td>
                        <td>{{ $order->address }}</td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-primary">Show Details</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
