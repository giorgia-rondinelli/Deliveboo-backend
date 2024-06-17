@extends('layouts.admin')
@section('content')
    <div>
        <div>
            <p>Crea piatto</p>
        </div>

        <div>
            <form id="dishForm" action="{{ route('admin.dishes.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                {{-- @method('POST') --}}
                {{-- nome del piatto --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input name="name" type="text" class="form-control" id="name" required>
                    <div class="invalid-feedback">Il nome è obbligatorio.</div>
                </div>

                {{-- descrizione --}}
                <div class="mb-3">
                    <label for="description" class="form-label">Descrizione</label>
                    <textarea name="description" class="form-control me-2" id="description">Descrizione</textarea>
                    <div class="invalid-feedback">La descrizione è obbligatoria.</div>
                </div>

                {{-- prezzo --}}
                <div class="mb-3">
                    <label for="price" class="form-label">Prezzo</label>
                    <input name="price" type="text" class="form-control" id="price">
                    <div class="invalid-feedback">Il prezzo è obbligatorio e deve essere un numero valido.</div>
                </div>

                {{-- visibilità --}}
                <div class="mb-3 checkbox">
                    <label class="form-label">È visibile</label>
                    <div class="btn-group btn-group-sm" role="group">
                        <input type="checkbox" class="btn-check" id="btncheck1" value="1" name="is_visible">
                        <label class="btn btn-outline-primary" for="btncheck1">È visibile</label>
                    </div>
                </div>

                {{-- immagine --}}
                <div class="mb-3">
                    <label for="image" class="form-label">Immagine</label>
                    <input type="file" class="form-control" id="image" name="image" onchange="showimage(event)">
                </div>
                <img id="thumb" alt="Anteprima Immagine" style="max-width: 100%; height: auto;">

                {{-- messaggio di errore --}}
                <div id="error-message" class="alert alert-danger d-none" role="alert">
                    Si sono verificati errori nei dati inseriti. Per favore, controlla e correggi i campi evidenziati.
                </div>

                {{-- pulsante di invio --}}
                <button type="submit" class="btn btn-primary">Crea</button>
            </form>
        </div>
    </div>
@endsection




<script>

        function showimage(event) {
            const thumb = document.getElementById('thumb');
            thumb.src = URL.createObjectURL(event.target.files[0]);
            console.log(thumb);
        }

</script>
