@extends('layouts.admin')

@section('content')

    <div class="mt-4 ms-4">
        <div class="d-flex">
            <h1 class="mb-4">Dishes</h1>
            <a href="{{route('admin.dishes.create')}}" class="btn btn-success">create</a>

        </div>

        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">nome</th>
                        <th scope="col">descrizione</th>
                        <th scope="col">prezzo</th>
                        <th scope="col">image</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dishes as $dish)
                    <tr>
                        <th scope="row">{{$dish->id}}</th>
                        <td>{{$dish->name}}</td>
                        <td>{{$dish->description}}</td>
                        <td>{{$dish->price}}</td>
                        <td> <img src="{{$dish->image?asset('storage/'. $dish->image):asset('storage/img/placeholder.png') }}" style="height: 100px" </td>
                        <td>
                            <a href="{{route('admin.dish.show', $dish)}}" class="btn btn-primary">show</a>
                            {{-- {{ route('admin.dishes.show') }} --}}
                            <a href="#" class="btn btn-warning">edit</a>
                            <a href="#" class="btn btn-danger">delete</a>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
