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
        @else
         <div class="mt-4">
            <img src="{{asset('storage/img/placeholder.png')}}" alt="">
        </div>
        @endif
        <div>
            <p>{{$dish->description}}</p>
        </div>

        <div>
            <p>{{$dish->price}} &euro;</p>
        </div>

        <div>
           <p>Is available: {{ $dish->is_visible ? 'È visibile' : 'Non è disponibile' }}</p>

        </div>
    </div>
@endsection
