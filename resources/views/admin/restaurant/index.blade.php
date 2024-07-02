@extends('layouts.admin')

@section('content')
{{-- @dd($restaurant); --}}

@if(!$restaurant)
    <h1 class="m-3">Restaurant Registration</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    <form id="uploadForm" class="m-3 w-75" action="{{route('admin.restaurants.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <h6 class="my-3"><i class='fa-solid fa-star-of-life text-danger'></i> Required field</h6>

        <div class="mb-3">
            <label for="name" class="form-label">Name <i class='fa-solid fa-star-of-life text-danger'></i></label>
            <input value="{{ old('name') }}" name="name" id="name" type="text" class="form-control"
                aria-describedby="emailHelp" >

                <p id="error_name" class="text-danger"></p>

        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Address <i class='fa-solid fa-star-of-life text-danger'></i></label>
            <input value="{{ old('address') }}" name="address" type="text"
                class="form-control" id="address" aria-describedby="emailHelp" >

                <p id="error_address" class="text-danger"></p>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">P. IVA <i class='fa-solid fa-star-of-life text-danger'></i></label>
            <input value="{{ old('p_iva') }}" name="p_iva" type="text" class="form-control"
            id="p_iva" >

            <p id="error_p_iva_0" class="text-danger"></p>
            <p id="error_p_iva_1" class="text-danger"></p>
        </div>

        <lable class="mb-2 d-block">Types <i class='fa-solid fa-star-of-life text-danger'></i></lable>
        <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
            @foreach ($types as $type)
                <input type="checkbox" value="{{ $type->id }}" name="types[]"
                    @if (($errors->any() && in_array($type->id, old('types', []))))
                    checked
                    @endif

                    class="btn-check type-checkbox"

                    id="type{{ $type->id }}"
                    autocomplete="off">
                <label class="btn btn-outline-primary" for="type{{ $type->id }}">{{ $type->name }}</label>
            @endforeach
        </div>
        <p id="error_type" class="text-danger"></p>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" placeholder="Another input placeholder"
                name="image" onchange="showimage(event)">
        </div>

        <div class="thumb_img">
            <img id="thumb" class="d-none" alt="Thumb Image">
        </div>


        <div class="mt-3">
            <button class="btn btn-success" type="submit">Register</button>
        </div>
    </form>
@else
<div class="m-3">
    <h1 class="fw-bold">{{ $restaurant->name }}</h1>

    <h2>Address: {{ $restaurant->address }}</h2>

    <h5 class="mt-3">P. IVA: {{ $restaurant->p_iva }}</h5>

    @if ($restaurant->image)
    <div class="thumb_img mt-3">
        <img class="img-fluid" src="{{asset('storage/'.$restaurant->image)}}" alt="{{$restaurant->name}}" onerror="this.src='/img/placeholder.jpg'">
    </div>
    @else
    <p class="mt-3">No image</p>
    @endif

    @if($restaurant->types)
    <h4 class="mt-3">Types</h4>
    <ul>
        @foreach ($restaurant->types as $type)
        <li>
            {{ $type->name }}
        </li>
        @endforeach
    </ul>


    @endif


    <a href="{{ route('admin.restaurants.edit', $restaurant) }}" class="btn btn-warning">Edit</a>

    <form onsubmit="return confirm('Are you sure you want delete your restaurant?')" class="mt-3 d-inline-block" action="{{route('admin.restaurants.destroy', $restaurant)}}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger ">Delete</button>
    </form>
</div>
@endif
@endsection

<script>

    function showimage(event) {
            const thumb = document.getElementById('thumb');
            thumb.classList.remove('d-none');
            thumb.src = URL.createObjectURL(event.target.files[0]);
        }

    document.addEventListener('DOMContentLoaded', function() {
        // Seleziona il form
        const form = document.getElementById('uploadForm');

        // Aggiungi un event listener per l'evento submit
        form.addEventListener('submit', function(event) {
            // Esegui la tua funzione JavaScript di validazione
            if (!validateForm()) {
                // Se la validazione non è passata, previeni l'invio del form
                event.preventDefault();
            }
        });
    });


    document.addEventListener('DOMContentLoaded', (event) => {
        const checkboxes = document.querySelectorAll('.type-checkbox');

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('click', () => {
                checkbox.classList.toggle('type_checked', checkbox.checked);
            });
        });
    });

    function validateForm() {
        const name = document.getElementById('name').value.trim();
        const address = document.getElementById('address').value.trim();
        const pIva = document.getElementById('p_iva').value.trim();
        const typeChecked = document.querySelectorAll('.type_checked').length;



        const errorName = document.getElementById('error_name');
        const errorAddress = document.getElementById('error_address');
        const errorPIvaLength = document.getElementById('error_p_iva_0');
        const errorPIvaNan = document.getElementById('error_p_iva_1');
        const errorType =document.getElementById('error_type');

        let validName = true;
        let validAddress = true;
        let validPIva = true;
        let valideType = true;


        const errorNameText1 = 'The name must contain at least 3 characters';
        const errorNameText2 = 'The name can contain a maximum of 30 characters';

        const errorAddressText1 = 'The address must contain at least 5 characters';
        const errorAddressText2 = 'The address can contain a maximum of 100 characters';

        const errorPIvaText1 = 'The VAT number must contain 11 characters';
        const errorPIvaText2 = 'The VAT number must contain only numbers';

        const errorTypeText = 'At least one type must be selected';


        // Resetta i messaggi di errore
        errorName.innerHTML = '';
        errorAddress.innerHTML = '';
        errorPIvaLength.innerHTML = '';
        errorPIvaNan.innerHTML = '';
        errorType.innerHTML = '';


        if (name.length < 3 || name.length > 30) {
            validName = false;
            errorName.innerHTML = name.length < 3 ? errorNameText1 : errorNameText2;
        }

        if (address.length < 5 || address.length > 100) {
            validAddress = false;
            errorAddress.innerHTML = address.length < 5 ? errorAddressText1 : errorAddressText2;
        }

        if (pIva.length !== 11 || isNaN(pIva)) {
            validPIva = false;

            if (pIva.length !== 11) {
                errorPIvaLength.innerHTML = errorPIvaText1;
            }

            if (isNaN(pIva)) {
                errorPIvaNan.innerHTML = errorPIvaText2;
            }
        }

        if(typeChecked === 0 ){
            valideType = false;
            errorType.innerHTML=errorTypeText;
        }

        // Restituisci true solo se tutti i campi sono validi
        return validName && validAddress && validPIva && valideType;
    }
</script>
