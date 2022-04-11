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
                <img src="{{ asset('heyalter_schwarz.png') }}" width="20%">
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('inquiries.store') }}">
                    @csrf
                    <div class="shadow overflow-hidden sm:rounded-md">

                        <div class="grid grid-cols-1">
                            <div class="px-4 py-3 bg-white sm:px-6 sm:py-3">
                                <h2 class="font-semibold text-4xl text-gray-800 leading-tight">
                                    BEDARFSLISTE SCHULE
                                </h2>
                            </div>
                        </div>

                        <div class="grid grid-cols-1">
                            <div class="px-4 py-3 bg-white sm:px-6 sm:py-3">
                                <h2 class="font-normal text-1xl text-gray-800 leading-tight">
                                    Bitte füllen Sie das Formular vollständig aus. <br>Wir melden uns im Anschluss telefonisch oder per E-Mail bei Ihnen.
                                </h2>
                            </div>
                        </div>

                        <div class="grid grid-cols-1">
                            <div class="px-4 py-3 bg-white sm:px-6 sm:py-3">
                                <h2 class="font-normal text-1xl text-gray-800 leading-tight">
                                    Weiteres Informationsmaterial zum Download:
                                </h2>
                                <ul class="list-disc leading-tight px-4 py-3">
                                    <li><a href="https://heyneuer.com/files/Bedarfsliste_Klasse.pdf" target="_blank">Bedarfsliste Klasse</a></li>
                                    <li><a href="https://heyneuer.com/files/Hey_FAQ.pdf" target="_blank">Häufige Frage</a></li>
                                    <li><a href="https://heyneuer.com/files/Hey_Schule_Infos für Lehrer.pdf" target="_blank">Infos für Lehrer</a></li>
                                </ul>
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
                                            <th colspan="2" class="text-2xl text-left">Kontaktdaten für Rückfragen</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <label for="school" class="block font-medium text-sm text-gray-700 pr-4 py-3">Schule</label>
                                            </td>
                                            <td>
                                                <input type="text" name="school" id="school" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('school', '') }}" />
                                                @error('school')
                                                <p class="text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="contact_person" class="block font-medium text-sm text-gray-700 pr-4 py-3">Ansprechpartner</label>
                                            </td>
                                            <td>
                                                <input type="text" name="contact_person" id="contact_person" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('contact_person', '') }}" />
                                                @error('contact_person')
                                                <p class="text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="telephone" class="block font-medium text-sm text-gray-700 pr-4 py-3">Telefonnummer</label>
                                            </td>
                                            <td>
                                                <input type="text" name="telephone" id="telephone" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('telephone', '') }}" />
                                                @error('telephone')
                                                <p class="text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="email" class="block font-medium text-sm text-gray-700 pr-4 py-3">E-Mail-Adresse</label>
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
                                            <th colspan="2" class="text-2xl text-left">Kontaktdaten für die Geräteübergabe (falls abweichend)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <label for="contact_person2" class="block font-medium text-sm text-gray-700 pr-4 py-3">Ansprechpartner</label>
                                            </td>
                                            <td>
                                                <input type="text" name="contact_person2" id="contact_person2" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('contact_person2', '') }}" />
                                                @error('contact_person2')
                                                <p class="text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="telephone2" class="block font-medium text-sm text-gray-700 pr-4 py-3">Telefonnummer</label>
                                            </td>
                                            <td>
                                                <input type="text" name="telephone2" id="telephone2" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('telephone2', '') }}" />
                                                @error('telephone2')
                                                <p class="text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="email2" class="block font-medium text-sm text-gray-700 pr-4 py-3">E-Mail-Adresse</label>
                                            </td>
                                            <td>
                                                <input type="email" name="email2" id="email2" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('email2', '') }}" />
                                                @error('email2')
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
                                            <th colspan="2" class="text-2xl text-left">Gesamtbedarf Ihrer Schule</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <label for="desktop_prio1" class="block font-medium text-sm text-gray-700 pr-4 py-3">Priorität 1</label>
                                            </td>
                                            <td class="w-20 px-2">
                                                <input type="number" max="99" name="desktop_prio1" id="desktop_prio1" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('desktop_prio1', '') }}" />
                                                @error('desktop_prio1')
                                                <p class="text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </td>
                                            <td>
                                                Computer
                                            </td>
                                            <td class="w-20 px-2">
                                                <input type="number" max="99" name="laptop_prio1" id="laptop_prio1" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('laptop_prio1', '') }}" />
                                                @error('laptop_prio1')
                                                <p class="text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </td>
                                            <td>
                                                Laptops
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="desktop_prio2" class="block font-medium text-sm text-gray-700 pr-4 py-3">Priorität 2</label>
                                            </td>
                                            <td class="w-20 px-2">
                                                <input type="number" max="99" name="desktop_prio2" id="desktop_prio2" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('desktop_prio2', '') }}" />
                                                @error('desktop_prio2')
                                                <p class="text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </td>
                                            <td>
                                                Computer
                                            </td>
                                            <td class="w-20 px-2">
                                                <input type="number" max="99" name="laptop_prio2" id="laptop_prio2" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('laptop_prio2', '') }}" />
                                                @error('laptop_prio2')
                                                <p class="text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </td>
                                            <td>
                                                Laptops
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label for="desktop_prio3" class="block font-medium text-sm text-gray-700 pr-4 py-3">Priorität 3</label>
                                            </td>
                                            <td class="w-20 px-2">
                                                <input type="number" max="99" name="desktop_prio3" id="desktop_prio3" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('desktop_prio3', '') }}" />
                                                @error('desktop_prio3')
                                                <p class="text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </td>
                                            <td>
                                                Computer
                                            </td>
                                            <td class="w-20 px-2">
                                                <input type="number" max="99" name="laptop_prio3" id="laptop_prio3" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('laptop_prio3', '') }}" />
                                                @error('laptop_prio3')
                                                <p class="text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </td>
                                            <td>
                                                Laptops
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                Abschicken
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>