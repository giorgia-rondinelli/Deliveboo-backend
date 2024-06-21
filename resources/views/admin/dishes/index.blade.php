@extends('layouts.admin')

@section('content')

    <div class="mt-4 ms-4">
        <div class="d-flex">
            <h1 class="mb-4">Dishes</h1>

        </div>
        <a href="{{route('admin.dishes.create')}}" class="btn btn-success">Create</a>

        <div>
            <table class="table">
                <thead>
                    <tr>

                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Price</th>
                        <th scope="col">Is Visible</th>
                        <th scope="col">Image</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dishes as $dish)
                    <tr>

                        <td scope="row">{{$dish->name}}</td>
                        <td> <p class="description_size">{{$dish->description}}</p></td>
                        <td>&euro;{{$dish->price}}</td>
                        <td><h5><span class="badge text-bg-primary">{{ $dish->is_visible ? 'Visible' : 'Unvisible' }}</span></h5></td>
                        <td> <img class="image_size" src="{{$dish->image?asset('storage/'. $dish->image):asset('storage/img/placeholder.jpg') }}"> </td>
                        <td>
                            <a href="{{route('admin.dishes.show', $dish)}}" class="btn btn-primary ">Show</a>
                            {{-- {{ route('admin.dishes.show') }} --}}
                            <a href="{{route('admin.dishes.edit', $dish)}}" class="btn btn-warning">Edit</a>
                            <form onsubmit="return confirm('Are you sure you want delete this dish \'{{$dish->name}}\' ?')" class="d-inline-block" action="{{route('admin.dishes.destroy', $dish)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
