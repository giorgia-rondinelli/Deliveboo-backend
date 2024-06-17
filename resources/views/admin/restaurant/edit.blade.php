@extends('layouts.admin')

@section('content')
    <div>

        <div>
            <p>restaurant edit</p>
        </div>

        <div>
            <form id="uploadForm" action="{{ route('admin.restaurants.update', $restaurant) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                {{-- dish name --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input value="{{ old('name', $restaurant->name) }}" name="name" type="text" class="form-control"
                        id="name" aria-describedby="emailHelp">

                    <p id="error_name" class="text-danger"></p>
                </div>

                {{-- description --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Address</label>
                    <input value="{{ old('address', $restaurant->address) }}" name="address" type="text"
                        class="form-control" id="address" aria-describedby="emailHelp">

                    <p id="error_address" class="text-danger"></p>
                </div>

                {{-- price --}}
                <div class="mb-3">
                    <label for="price" class="form-label">Partita iva</label>
                    <input value="{{ old('p_iva', $restaurant->p_iva) }}" name="p_iva" type="text" class="form-control"
                        id="p_iva">

                    <p id="error_p_iva_0" class="text-danger"></p>
                    <p id="error_p_iva_1" class="text-danger"></p>
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
                    <button class="btn btn-success" type="submit">Send</button>
                    <button type="reset" class="btn btn-warning">Reset</button>
                    <a href="{{route('admin.restaurants.index')}}" class="btn btn-primary">Back</a>
                </div>

            </form>
        </div>

    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Seleziona il form
        var form = document.getElementById('uploadForm');

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

        const errorName = document.getElementById('error_name');
        const errorAddress = document.getElementById('error_address');
        const errorPIvaLength = document.getElementById('error_p_iva_0');
        const errorPIvaNan = document.getElementById('error_p_iva_1');

        let validName = true;
        let validAddress = true;
        let validPIva = true;

        const errorNameText1 = 'Il nome deve contenere almeno 3 caratteri';
        const errorNameText2 = 'Il nome può contenere massimo 30 caratteri';

        const errorAddressText1 = 'L\'indirizzo deve contenere almeno 20 caratteri';
        const errorAddressText2 = 'L\'indirizzo può contenere massimo 100 caratteri';

        const errorPIvaText1 = 'La partita IVA deve contenere 11 caratteri';
        const errorPIvaText2 = 'La partita IVA deve contenere solo numeri';

        // Resetta i messaggi di errore
        errorName.innerHTML = '';
        errorAddress.innerHTML = '';
        errorPIvaLength.innerHTML = '';
        errorPIvaNan.innerHTML = '';

        if (name.length < 3 || name.length > 30) {
            validName = false;
            errorName.innerHTML = name.length < 3 ? errorNameText1 : errorNameText2;
        }

        if (address.length < 20 || address.length > 100) {
            validAddress = false;
            errorAddress.innerHTML = address.length < 20 ? errorAddressText1 : errorAddressText2;
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

        // Restituisci true solo se tutti i campi sono validi
        return validName && validAddress && validPIva;
    }
</script>

{{-- <script>
    function showimage(event) {

        const thumb = document.getElementById('thumb');
        thumb.src = URL.createObjectURL(event.target.files[0]);
        // console.log(thumb);
    }
</script> --}}
