@extends('layouts.admin')

@section('content')
    <div class="m-3">
        <div>
            <h2 class="fw-bold">{{$dish->name}}</h2>
        </div>

        @if($dish->image)
        <div class="mt-4 thumb_img">
            <img src="{{asset('storage/'.$dish->image)}}" alt="">
        </div>
        @else
        <div class="mt-4 thumb_img">
            <img src="{{asset('storage/img/placeholder.png')}}" alt="">
        </div>
        @endif

        @if ($dish->description)
        <div class="mt-3">
            <h4>Description</h4>
            <p>{{$dish->description}}</p>
        </div>
        @endif

        <div class="mt-3 d-flex align-items-end">
            <h3 class="fw-bold me-1">Price:</h3>
            <h4>{{$dish->price}} &euro;</h4>
        </div>

        <div class="mt-3">
            <h3><span class="badge text-bg-primary">{{ $dish->is_visible ? 'Visible' : 'Unvisible' }}</span></h3>
        </div>

        <a href="{{route('admin.dishes.edit', $dish)}}" class="btn btn-warning mt-3">Edit</a>
        <a href="{{route('admin.dishes.index')}}" class="btn btn-primary mt-3">Back</a>
        <form class="d-inline-block mt-3" onsubmit="return confirm('Are you sure you want delete this dish \'{{$dish->name}}\' ?')" action="{{route('admin.dishes.destroy', $dish)}}" method="post">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger mt-3" type="submit">Delete</button>
        </form>

    </div>
@endsection
