@extends('layouts.admin')

@section('content')
{{-- @dd($restaurant); --}}

@if(!$restaurant)
    <h1 class="m-3">Registrazione Ristorante</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    <form id="uploadForm" class="m-3" action="{{route('admin.restaurants.store')}}" method="post" enctype="multipart/form-data">
        @csrf

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
            <label for="price" class="form-label">Partita iva <i class='fa-solid fa-star-of-life text-danger'></i></label>
            <input value="{{ old('p_iva') }}" name="p_iva" type="text" class="form-control"
            id="p_iva" >

            <p id="error_p_iva_0" class="text-danger"></p>
            <p id="error_p_iva_1" class="text-danger"></p>
        </div>

        <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
            @foreach ($types as $type)
                <input type="checkbox" value="{{ $type->id }}" name="types[]"
                    @if (($errors->any() && in_array($type->id, old('types', []))))
                    checked
                    @endif class="btn-check myType " id="type{{ $type->id }}"
                    autocomplete="off">
                <label class="btn btn-outline-primary" for="type{{ $type->id }}">{{ $type->name }}</label>
            @endforeach
            <p id="error_type" class="text-danger"></p>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">immagine</label>
            <input type="file" class="form-control" id="image" placeholder="Another input placeholder"
                name="image" onchange="showimage(event)">
        </div>

        <div class="mb-3">
            <button class="btn btn-success" type="submit">Send</button>
            <button type="reset" class="btn btn-warning">Reset</button>
        </div>
    </form>
@else
<div class="m-3">
    <h1>{{ $restaurant->name }}</h1>

    <h2>address: {{ $restaurant->address }}</h2>

    <h5>partita iva: {{ $restaurant->p_iva }}</h5>

    @if ($restaurant->image)
    <img class="img-fluid w-50 " src="{{asset('storage/'.$restaurant->image)}}" alt="{{$restaurant->name}}" onerror="this.src='/img/placeholder.jpg'">
    @else
    <p>Non ci sono immagini</p>
    @endif

    @if($restaurant->types)
    <ul>
        @foreach ($restaurant->types as $type)
        <li>
            {{ $type->name }}
        </li>
        @endforeach
    </ul>
    @else
    <p>Questo ristoraante è fuori dal comune!!!</p>

    @endif


    <a href="{{ route('admin.restaurants.edit', $restaurant) }}" class="btn btn-warning">Edit</a>

    <form onsubmit="return confirm('sicuro di voler eliminare?')" class="mt-3 d-inline-block" action="{{route('admin.restaurants.destroy', $restaurant)}}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger ">Delete</button>
    </form>
</div>
@endif
@endsection

 <script>
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

    function validateForm() {
        const name = document.getElementById('name').value.trim();
        const address = document.getElementById('address').value.trim();
        const pIva = document.getElementById('p_iva').value.trim();
        const type = document.querySelectorAll('.myType').checked;
        console.log(type);


        const errorName = document.getElementById('error_name');
        const errorAddress = document.getElementById('error_address');
        const errorPIvaLength = document.getElementById('error_p_iva_0');
        const errorPIvaNan = document.getElementById('error_p_iva_1');
        // const errorType =document.getElementById('error_type');

        let validName = true;
        let validAddress = true;
        let validPIva = true;
        // let valideType = true;


        const errorNameText1 = 'Il nome deve contenere almeno un carattere';
        const errorNameText2 = 'Il nome può contenere massimo 30 caratteri';

        const errorAddressText1 = 'L\'indirizzo deve contenere almeno 5 caratteri';
        const errorAddressText2 = 'L\'indirizzo può contenere massimo 100 caratteri';

        const errorPIvaText1 = 'La partita IVA deve contenere 11 caratteri';
        const errorPIvaText2 = 'La partita IVA deve contenere solo numeri';

        // const errorTypeText = 'Deve esserci almeno un type selezionato';


        // Resetta i messaggi di errore
        errorName.innerHTML = '';
        errorAddress.innerHTML = '';
        errorPIvaLength.innerHTML = '';
        errorPIvaNan.innerHTML = '';

        // errorType.innerHTML = '';


        if (name.length < 1 || name.length > 30) {
            validName = false;
            errorName.innerHTML = name.length < 1 ? errorNameText1 : errorNameText2;
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

        // if(type.length <1 ){
        //     valideType = false;
        //     errorType.innerHTML=errorTypeText;

        // }

        // Restituisci true solo se tutti i campi sono validi
        return validName && validAddress && validPIva;
    }
</script>
