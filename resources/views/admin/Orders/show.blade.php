@extends('layouts.admin')

@section('content')
    <div>
        <div>
            <h5>{{ $orderOne->id }}</h5>
        </div>

        <div>
            <p>{{ $orderOne->total_price }}</p>
        </div>

        <div>
            <p>{{ $orderOne->created_at }}</p>
        </div>

        <div>
            <p>{{ $orderOne->name }}</p>
        </div>

        <div>
            <p>
                @foreach ($orderOne->dishes as $dish)
                |{{ $dish->name }} x {{ $dish->pivot->dish_quantity }}|
                @endforeach
            </p>
        </div>

        <div>
            <p>{{ $orderOne->id }}</p>
        </div>

        <a href="{{ route('admin.orders.index') }}">Back</a>
    </div>
@endsection
