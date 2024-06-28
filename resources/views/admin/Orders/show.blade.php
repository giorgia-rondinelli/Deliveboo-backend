@extends('layouts.admin')

@section('content')
    <div class="m-3">
        <div>
            <h3 class="fw-bold">{{ $orderOne->name }} / {{ $orderOne->created_at }}</h3>
        </div>

        <div>
            <p class="fs-4"><strong>Total ammount order:</strong> &euro;{{ $orderOne->total_price }}</p>
        </div>

        <div>
            <p><strong>Ordered at:</strong> {{ $orderOne->created_at }}</p>
        </div>

        <div>
            <p><strong>Contact for delivery:</strong> {{ $orderOne->phone_number }}</p>
        </div>

        <div>
            <p><strong>Deliver in:</strong> {{ $orderOne->address }}</p>
        </div>

        <div>
            <h5 class="fw-bold">Ordered dishes:</h5>


            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Dish name</th>
                    <th scope="col">price</th>
                    <th scope="col">Quantity</th>

                  </tr>
                </thead>
                <tbody>
                @foreach ($orderOne->dishes as $dish)
                  <tr>
                    <td>{{ $dish->name }}</td>
                    <td>{{ $dish->price }}</td>
                    <td>{{ $dish->pivot->dish_quantity }}</td>
                  </tr>
                @endforeach


                </tbody>
              </table>
        </div>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-primary">Back</a>
    </div>
@endsection
