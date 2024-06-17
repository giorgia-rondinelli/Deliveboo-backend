@extends('layouts.admin')

@section('content')
    <div>
        <div>
            <p>dish edit</p>
        </div>

        <div>
              <form id="uploadForm" action="{{ route('admin.dishes.update', $dish)}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                {{-- nome del piatto --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input name="name" type="text" class="form-control" id="name" value="{{ old('name', $dish->name) }}" >
                    <p id="error_name" class="text-danger"></p>
                </div>

                {{-- descrizione --}}
                <div class="mb-3">
                    <label for="description" class="form-label">Descrizione</label>
                    <textarea name="description" class="form-control me-2" id="description" value="{{$dish->description}}">{{$dish->description}}</textarea>
                    <p id="error_description" class="text-danger"></p>
                </div>

                {{-- prezzo --}}
                <div class="mb-3">
                    <label for="price" class="form-label">Prezzo</label>
                    <input name="price" type="text" class="form-control" id="price"  value="{{ old('name', $dish->price) }}">
                    <p id="error_price" class="text-danger"></p>
                </div>

                {{-- visibilità --}}
                <div class="mb-3">
                    <label class="form-label">Visibilità</label>
                    <div class="btn-group btn-group-sm" role="group">
                        <input type="radio" class="btn-check" id="btncheck1" value="1" name="is_visible" {{ $dish->is_visible ? 'checked' : '' }}>
                        <label class="btn btn-outline-primary" for="btncheck1">Visibile</label>

                        <input type="radio" class="btn-check" id="btncheck2" value="0" name="is_visible" {{ !$dish->is_visible ? 'checked' : '' }}>
                        <label class="btn btn-outline-primary" for="btncheck2">Non visibile</label>
                    </div>
                </div>

                {{-- immagine --}}
                <div class="mb-3">
                    <label for="image" class="form-label">Immagine</label>
                    <input type="file" class="form-control" id="image" name="image" onchange="showimage(event)">
                </div>
                <img id="thumb" alt="Anteprima Immagine"src="{{$dish->image?asset('storage/'. $dish->image):asset('storage/img/placeholder.png') }}" style="max-width: 100%; height: auto;">

                {{-- messaggio di errore --}}
                <div id="error-message" class="alert alert-danger d-none" role="alert">
                    Si sono verificati errori nei dati inseriti. Per favore, controlla e correggi i campi evidenziati.
                </div>

                {{-- pulsante di invio --}}
                <button type="submit" class="btn btn-warning">modifica</button>
            </form>
              <form action="{{route('admin.dish.destroy', $dish)}}" method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger" type="submit">delete</button>
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
        const description = document.getElementById('description').value.trim();
        const price = document.getElementById('price').value.trim();

        const errorName = document.getElementById('error_name');
        const errorDescription = document.getElementById('error_description');
        const errorPrice = document.getElementById('error_price');

        let validName = true;
        let validDescription = true;
        let validPrice = true;

        const errorNameText1 = 'Il nome deve contenere almeno 3 caratteri';
        const errorDescriptionText = 'La descrizione non è valida';
        const errorPriceText1 = 'Il prezzo deve essere un numero valido';

        // Reset error messages
        errorName.innerHTML = '';
        errorDescription.innerHTML = '';
        errorPrice.innerHTML = '';

        if (name.length < 3 || name.length > 30) {
            validName = false;
            errorName.innerHTML = name.length < 3 ? errorNameText1 : '';
        }

        if (description === '') {
            validDescription = false;
            errorDescription.innerHTML = errorDescriptionText;
        }

        if (isNaN(parseFloat(price)) || !isFinite(price)) {
            validPrice = false;
            errorPrice.innerHTML = errorPriceText1;
        }
        // You can add more validation rules for other fields like price if needed

        // Return true only if all fields are valid
        return validName && validDescription && validPrice;
    }
</script>
