<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="E-Mail-Adresse" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="Passwort" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="flex justify-between mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">Angemeldet bleiben</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        Passwort vergessen?
                    </a>
                @endif
            </div>

            <div class="flex items-center mt-4 justify-between">
                <a href="/register" class="inline-block right-0 px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 disabled:opacity-25 transition inline-block">Registieren</a>
                <x-jet-button id="login_submit" class="ml-4 flex bg-green-600 hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-600">
                    Anmelden
                </x-jet-button>
            </div>
            <div class="flex items-center mt-4">
                <a class="inline-block items-center right-0 font-bold text-sm text-500 hover:text-indigo-200" href="#" onClick="autoFill('Testzugang'); return false;" >Testzugang verwenden</a>
            </div>
        </form>
    </x-jet-authentication-card>

    <script>
        function autoFill() {

            document.getElementById('email').value = 'test@heyalter.com';
            document.getElementById('password').value = 'testtest';

            var testaccount = document.getElementById('login_submit');
            testaccount.click();
        }
    </script>
</x-guest-layout>
