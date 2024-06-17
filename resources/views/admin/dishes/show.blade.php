@extends('layouts.admin')

@section('content')
    <div>
        <div>
            <h5>{{$dish->name}}</h5>
        </div>

        @if($dish->image)
        <div class="mt-4">
            <img src="{{asset('storage/'.$dish->image)}}" alt="">
        </div>
        @endif
        <div>
            <p>Description</p>
        </div>

        <div>
            <p>Price</p>
        </div>
    </div>
@endsection
