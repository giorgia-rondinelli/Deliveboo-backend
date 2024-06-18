@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <h1>ciaos</h1>
                    <form method="POST" action="{{ route('register') }}" id="uploadForm">
                        @csrf

                        <div class="mb-4 row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <p id="error_name" class="text-danger"></p>
                        </div>

                        <div class="mb-4 row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  >

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <p id="error_email" class="text-danger"></p>
                        </div>

                        <div class="mb-4 row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                             <p id="error_password" class="text-danger"></p>
                        </div>

                        <div class="mb-4 row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                            </div>
                             <p id="error_password2" class="text-danger"></p>
                        </div>

                        <div class="mb-4 row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
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
        const email = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value.trim();
        const passwordConfirm = document.getElementById('password-confirm').value.trim();

        const errorName = document.getElementById('error_name');
        const errorEmail = document.getElementById('error_email');
        const errorPassword = document.getElementById('error_password');
        const errorPassword2 = document.getElementById('error_password2');

        let validName = true;
        let validEmail = true;
        let validPassword = true;
        let validPasswordConfirm = true;


        const errorNameText1 = 'Il nome deve contenere almeno un carattere';
        const errorNameText2 = 'Il nome può contenere massimo 30 caratteri';

        const errorEmailText1 = 'L\'email deve contenere almeno 5 caratteri';
        const errorEmailText2 = 'L\'email può contenere massimo 100 caratteri';
        const errorEmailText3 = 'L\'email deve contenere il carattere @';

        const errorPasswordText = 'La password deve contenere almeno 8 caratteri';
        const errorPasswordText2 = 'La password deve contenere massimo 22 caratteri';

        const errorPasswordConfirmText = 'Le password non corrispondono';


        // Resetta i messaggi di errore
        errorName.innerHTML = '';
        errorEmail.innerHTML = '';
        errorPassword.innerHTML = '';
        errorPassword2.innerHTML = '';

        // name
        if (name.length < 1 || name.length > 30) {
            validName = false;
            errorName.innerHTML = name.length < 1 ? errorNameText1 : errorNameText2;
        }


        // password
        if (password.length < 8 || password.length > 22) {
            validPassword = false;
            errorPassword.innerHTML = password.length <8? errorPasswordText:errorPasswordText2;
        }

        if (passwordConfirm !== password) {
            validPasswordConfirm = false;
            errorPassword2.innerHTML = errorPasswordConfirmText;
        }


        // Restituisci true solo se tutti i campi sono validi
        return validName && validEmail && validPassword && validPasswordConfirm;
    }
</script>
