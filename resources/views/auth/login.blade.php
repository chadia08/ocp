    <style>
        .btn-primary{
            background-color: #9dd75e;
            color: white;
            padding-left: 9px;
            padding-right: 9px;
            padding-top: 5px;
            padding-bottom: 5px;
            border-radius: 5px;
        }
        .btn-primary:hover{
            background-color: yellow;
        }

        body{
            background-color: white;
        }
       
    </style>
    <x-guest-layout>
        <x-authentication-card>
            <x-slot name="logo">
                <x-authentication-card-logo />
            </x-slot>
    
            <x-validation-errors class="mb-4" />
    
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif
    
            <div class="form">
                <x-slot name="logo">
                    <x-authentication-card-logo />
                </x-slot>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
        
                    <div>
                        <x-label for="matricule" value="{{ __('Matricule') }}" />
                        <x-input id="matricule" class="block mt-1 w-full" type="text" name="matricule" :value="old('matricule')" required autofocus autocomplete="username" />
                    </div>
        
                    <div class="mt-4">
                        <x-label for="password" value="{{ __('Mot de passe') }}" />
                        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                    </div>
        
                    <br>
        
                    <div class="flex items-center justify-end mt-4">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                {{ __('Mot de passe oublié?') }}
                            </a>
                        @endif
        
                        <button class="btn btn-primary ml-4">
                            {{ __('Se Connecter') }}
                        </button>
                    </div>
                </form>
            </div>
        </x-authentication-card>
    </x-guest-layout>
 