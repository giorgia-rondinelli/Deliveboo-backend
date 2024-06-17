@extends('layouts.admin')

@section('content')
    <div>

        <div>
            <p>dish edit</p>
        </div>

        <div>
            <form action="{{ route('admin.restaurants.update', $restaurant) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                {{-- dish name --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input value="{{ old('name', $restaurant->name) }}" name="name" type="text" class="form-control"
                        id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>

                {{-- description --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Address</label>
                    <input value="{{ old('address', $restaurant->address) }}" name="address" type="text"
                        class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>

                {{-- price --}}
                <div class="mb-3">
                    <label for="price" class="form-label">Partita iva</label>
                    <input value="{{ old('p_iva', $restaurant->p_iva) }}" name="p_iva" type="text" class="form-control"
                        id="price">
                </div>

                <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                    @foreach ($types as $type)
                        <input type="checkbox" value="{{ $type->id }}" name="types[]"
                            @if (
                                ($errors->any() && in_array($type->id, old('types', []))) ||
                                    (!$errors->any() && $restaurant->types->contains($type))) checked @endif class="btn-check" id="type{{ $type->id }}"
                            autocomplete="off">
                        <label class="btn btn-outline-primary" for="type{{ $type->id }}">{{ $type->name }}</label>
                    @endforeach
                </div>

                {{-- img --}}
                <div class="mb-3">
                    <label for="image" class="form-label">immagine</label>
                    <input type="file" class="form-control" id="image" placeholder="Another input placeholder"
                        name="image" onchange="showimage(event)">
                </div>
                {{-- <img class="thumb w-25" style="height: 350px" id="thumb" alt=""
                    onerror="src='/img/placeholder.jpg'"> --}}

                <div class="mb-3">
                    <button class="btn btn-outline-success" type="submit">Send</button>
                    <button class="btn my_bgr">Reset</button>
                </div>

            </form>
        </div>

    </div>
@endsection

{{-- <script>
    function showimage(event) {

        const thumb = document.getElementById('thumb');
        thumb.src = URL.createObjectURL(event.target.files[0]);
        // console.log(thumb);
    }
</script> --}}
