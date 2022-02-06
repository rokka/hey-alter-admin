<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen bg-gray-100">
        <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2 py-4">
                <img src="https://web-service1.ix.dus.m-eshop.de/heyalter/heyalter_schwarz.png" width="20%">
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('consignments.store') }}">
                    @csrf
                    <div class="shadow overflow-hidden sm:rounded-md">

                        <div class="grid grid-cols-1">
                            <div class="px-4 py-3 bg-white sm:px-6 sm:py-3">
                                <h2 class="font-semibold text-4xl text-gray-800 leading-tight">
                                    EINLIEFERUNGSPROTOKOLL
                                </h2>
                            </div>
                        </div>

                        <div class="grid grid-cols-1">
                            <div class="px-4 py-3 bg-white sm:px-6 sm:py-3">
                                <h2 class="font-normal text-1xl text-gray-800 leading-tight">
                                    Bitte füllen Sie das Formular vollständig aus.<br>Nach dem Absenden des Formulars erhalten Sie Rechnernummern.<br>Diese können per Post-It an den Computern angebracht werden.
                                </h2>
                            </div>
                        </div>

                        <div class="grid grid-cols-1">
                            <div class="px-4 py-3 bg-white sm:px-6 sm:py-3">
                                <h2 class="font-bold text-1xl text-gray-800 leading-tight">
                                    Vielen Dank für Ihre Unterstützung!
                                </h2>
                            </div>
                        </div>

                        <div class="grid grid-cols-1">
                            <div class="px-4 py-3 bg-white sm:px-6 sm:py-3">
                                <table class="table-auto mt-10 w-full">
                                    <thead>
                                        <tr>
                                            <th colspan="2" class="text-2xl text-left">Kontaktdaten</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <label for="donor" class="block font-medium text-gray-700 pr-4 py-3">Firma, Organisation, Name</label>
                                            </td>
                                            <td>
                                                <input type="text" name="donor" id="donor" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('donor', '') }}" />
                                                @error('donor')
                                                <p class="text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="email" class="block font-medium text-gray-700 pr-4 py-3">E-Mail-Adresse</label>
                                            </td>
                                            <td>
                                                <input type="email" name="email" id="email" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('email', '') }}" />
                                                @error('email')
                                                <p class="text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="grid grid-cols-1">
                            <div class="px-4 py-3 bg-white sm:px-6 sm:py-3">
                                <table class="table-auto mt-10 w-full">
                                    <thead>
                                        <tr>
                                            <th colspan="5" class="text-2xl text-left">Angaben zu den Geräten</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="5">Bitte berücksichtigen Sie, dass die gespendeten Rechner mindestens einen 2 GHz Dual Core Prozessor, 4 GB RAM Arbeitsspeicher besitzen und grundsätzlich fiunktionsfähig sein sollten. Reparaturen an den Rechnern sind nur stark eingeschränkt möglich. Das vorhandene Betriebssystem und Software wird komplett durch lizenzfreie Produkte ersetzt.</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="desktop_count" class="block font-medium text-gray-700 pr-4 py-3">Eingelieferte Stückzahl</label>
                                            </td>
                                            <td class="w-20 px-2">
                                                <input type="number" max="99" name="desktop_count" id="desktop_count" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('desktop_count', '0') }}" />
                                            </td>
                                            <td>
                                                Computer
                                            </td>
                                            <td class="w-20 px-2">
                                                <input type="number" max="99" name="laptop_count" id="laptop_count" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('laptop_count', '0') }}" />
                                            </td>
                                            <td>
                                                Laptops
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">
                                                @error('laptop_count')
                                                <p class="text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                                @error('desktop_count')
                                                <p class="text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="grid grid-cols-1">
                            <div class="px-4 py-3 bg-white sm:px-6 sm:py-3">
                                <table class="table-auto mt-10 w-full">
                                    <thead>
                                        <tr>
                                            <th colspan="4" class="text-2xl text-left">Datenschutz</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="4">Gespendete Rechner sollten bereits auf Werkszustand zurückgesetzt, alle vorhandenen Daten gelöscht worden sein. Mit Abgabe der Rechner erteilen Sie die Zustimmung, dass sämtliche Daten auf dem Gerät unwiederbringlich vernichtet werden. Professionelle-Datenlöschung inkl. Löschprotokoll für Unternehmen und Institutionen nach Absprache.</td>
                                        </tr>
                                        <tr class="pb-0">
                                            <td>
                                                <input type="radio" name="is_deletion_required" id="deletetion_standard" class="form-input rounded-md shadow-sm" value="0" @if(old('is_deletion_required') == 0) checked @endif >
                                            </td>
                                            <td>
                                                <label for="deletetion_standard" class="block font-medium text-gray-700 pr-4 py-3 pb-3">Standard-Datenlöschung gewünscht.</label>
                                            </td>
                                            <td>
                                                <input type="radio" name="is_deletion_required" id="deletetion_professional" class="form-input rounded-md shadow-sm" value="1" @if(old('is_deletion_required') == 1) checked @endif >
                                            </td>
                                            <td>
                                                <label for="deletetion_professional" class="block font-medium text-gray-700 pr-4 py-3">Professionelle Datenlöschung gewünscht.</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="privacy" id="privacy" class="form-input rounded-md shadow-sm" value="1" @if(old('privacy')) checked @endif >
                                            </td>
                                            <td colspan="3">
                                                <label for="privacy" class="block font-medium text-gray-700 pr-4 py-3">Ich habe die <a href="" target="_blank">Datenschutzbestimmungen</a> gelesen.</label>
                                                
                                                @error('privacy')
                                                <p class="text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                Absenden
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>