@extends('layouts.admin')

@section('content')
    <div>

          @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <div>
              <form id="uploadForm" class="m-3 w-75" action="{{ route('admin.dishes.update', $dish)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                {{-- nome del piatto --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Name <i class='fa-solid fa-star-of-life text-danger'></i></label>
                    <input name="name" type="text" class="form-control" id="name" value="{{ old('name', $dish->name) }}" >
                    <p id="error_name" class="text-danger"></p>
                </div>

                {{-- descrizione --}}
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" class="form-control me-2" id="description" value="{{$dish->description}}">{{$dish->description}}</textarea>

                </div>

                {{-- prezzo --}}
                <div class="mb-3">
                    <label for="price" class="form-label">Price<i class='fa-solid fa-star-of-life text-danger'></i></label>
                    <input name="price" type="number" class="form-control" id="price"  value="{{ old('name', $dish->price) }}">
                    <p id="error_price" class="text-danger"></p>
                </div>

                {{-- visibilità --}}
                <div class="mb-3">
                    <label class="form-label me-1">Is Visible:</label>
                    <div class="btn-group btn-group-sm" role="group">
                        <input type="radio" class="btn-check" id="btncheck1" value="1" name="is_visible" {{ $dish->is_visible ? 'checked' : '' }}>
                        <label class="btn btn-outline-primary" for="btncheck1">Visible</label>

                        <input type="radio" class="btn-check" id="btncheck2" value="0" name="is_visible" {{ !$dish->is_visible ? 'checked' : '' }}>
                        <label class="btn btn-outline-primary" for="btncheck2">Unvisible</label>
                    </div>
                </div>

                {{-- immagine --}}
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="image" name="image" onchange="showimage(event)">
                </div>
                <div class="thumb_img">
                    <img id="thumb" alt="Thumb Image"src="{{$dish->image?asset('storage/'. $dish->image):asset('storage/img/placeholder.png') }}">
                </div>

                {{-- pulsante di invio --}}
                <button type="submit" class="btn btn-warning mt-3">Modify</button>
                <a href="{{route('admin.dishes.index')}}" class="btn btn-primary mt-3">Back</a>
                <button type="button" id="delete_btn" class="btn btn-danger mt-3">Delete</button>
            </form>
            <form id="delete_form" class="d-inline-block mt-3" action="{{route('admin.dish.destroy', $dish)}}" method="post">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
@endsection
<script>
    // Function to show selected image preview
    function showimage(event) {
        const thumb = document.getElementById('thumb');
        thumb.src = URL.createObjectURL(event.target.files[0]);
    }

    document.addEventListener('DOMContentLoaded', function() {
        const btn = document.getElementById('delete_btn');
        const form = document.getElementById('delete_form');

        btn.addEventListener('click', function(event) {
            confirm('Are you sure you whant delete this dish?')
            form.submit();
        });
    });

    // Wait for the DOM content to be fully loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Select the form
        let form = document.getElementById('uploadForm');

        // Add an event listener for the submit event
        form.addEventListener('submit', function(event) {
            // Execute your form validation function
            if (!validateForm()) {
                // Prevent the form from being submitted if validation fails
                event.preventDefault();
            }
        });
    });

    // Function to validate form fields
    function validateForm() {
        const name = document.getElementById('name').value.trim();

        const price = document.getElementById('price').value.trim();

        const errorName = document.getElementById('error_name');

        const errorPrice = document.getElementById('error_price');

        let validName = true;

        let validPrice = true;

        const errorNameText1 = 'Il nome deve contenere almeno 3 caratteri';

        const errorPriceText1 = 'Il prezzo deve essere un numero valido';

        // Reset error messages
        errorName.innerHTML = '';

        errorPrice.innerHTML = '';

        if (name.length < 3 || name.length > 30) {
            validName = false;
            errorName.innerHTML = name.length < 3 ? errorNameText1 : '';
        }


        if (isNaN(parseFloat(price)) || !isFinite(price)) {
            validPrice = false;
            errorPrice.innerHTML = errorPriceText1;
        }
        // You can add more validation rules for other fields like price if needed

        // Return true only if all fields are valid
        return validName  && validPrice;
    }
</script>
