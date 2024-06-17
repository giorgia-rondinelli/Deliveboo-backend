@extends('layouts.admin')

@section('content')
{{-- @dd($restaurant); --}}

@if(!$restaurant)
<p>non ci sono ristoranti</p>
@else
<h1>{{ $restaurant->name }}</h1>

<h2>address: {{ $restaurant->address }}</h2>

<h5>partita iva: {{ $restaurant->p_iva }}</h5>

@if ($restaurant->image != 0)
<img class="img-fluid w-50 " src="{{asset('storage/'.$restaurant->image)}}" alt="{{$restaurant->name}}" onerror="this.src='/img/placeholder.jpg'">

@else
<p>Non ci sono immagini</p>

@endif

<ul>
    @foreach ($restaurant->types as $type)
    <li>
        {{ $type->name }}
    </li>
    @endforeach

</ul>

<a href="{{ route('admin.restaurants.edit', $restaurant) }}" class="btn btn-warning">edit</a>
{{-- <a href="{{ route('admin.restaurants.delete', $restaurant) }}" class="btn btn-danger">delete</a> --}}

<form onsubmit="return confirm('sicuro di voler eliminare?')" class="mt-3" action="{{route('admin.restaurants.destroy', $restaurant)}}" method="post">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger ">elimina</button>

</form>
@endif
@endsection
