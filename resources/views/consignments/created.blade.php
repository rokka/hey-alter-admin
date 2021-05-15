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
                @csrf
                <div class="shadow overflow-hidden sm:rounded-md">

                    <div class="grid grid-cols-1">
                        <div class="px-4 py-3 bg-white sm:px-6 sm:py-3">
                            <h2 class="font-semibold text-4xl text-gray-800 leading-tight">
                                EINLIEFERUNGSPROTOKOLL
                            </h2>
                        </div>
                    </div>

                    @if (is_array($desktop_numbers) && count($desktop_numbers) > 0)
                    <div class="grid grid-cols-1">
                        <div class="px-4 py-3 bg-white sm:px-6 sm:py-3">
                            <table class="table-auto mt-10 w-full">
                                <thead>
                                    <tr>
                                        <th class="text-2xl text-left">Computer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($desktop_numbers as $nr)
                                    <tr>
                                        <td>
                                            {{ $nr }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif

                    @if (is_array($laptop_numbers) && count($laptop_numbers) > 0)
                    <div class="grid grid-cols-1">
                        <div class="px-4 py-3 bg-white sm:px-6 sm:py-3">
                            <table class="table-auto mt-10 w-full">
                                <thead>
                                    <tr>
                                        <th class="text-2xl text-left">Laptops</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($laptop_numbers as $nr)
                                    <tr>
                                        <td>
                                            {{ $nr }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif

                    <div class="grid grid-cols-1">
                        <div class="px-4 py-10 bg-white sm:px-6 sm:py-10">
                            <h2 class="font-bold text-1xl text-gray-800 leading-tight">
                                Vielen Dank für Ihre Unterstützung!
                            </h2>
                        </div>
                    </div>

                    <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                        <a href="{{ route('consignments.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray">Weiteres Einlieferungsprotokoll erstellen</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>