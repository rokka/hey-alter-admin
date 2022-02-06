<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ausgabe') }}
        </h2>
    </x-slot>
    
    <div class="pt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('distributions.store') }}">
                    @csrf
                    <div class="shadow overflow-hidden sm:rounded-md">
                    
                        <div class="grid grid-cols-1 sm:grid-cols-4">
                            <div class="px-4 py-3 bg-white sm:px-6 sm:py-3">
                                <label for="firstname" class="block font-medium text-sm text-gray-700">Vorname</label>
                                <input type="text" name="firstname" id="firstname" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('firstname') }}" />
                                @error('firstname')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="px-4 py-3 bg-white sm:px-6 sm:py-3">
                                <label for="lastname" class="block font-medium text-sm text-gray-700">Nachname</label>
                                <input type="text" name="lastname" id="lastname" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('lastname') }}" />
                                @error('lastname')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="px-4 py-3 bg-white sm:px-6 sm:py-3">
                                <label for="birthday" class="block font-medium text-sm text-gray-700">Geburtsdatum</label>
                                <input type="date" name="birthday" id="birthday" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('birthday') }}" />
                                @error('birthday')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="px-4 py-3 bg-white sm:px-6 sm:py-3">
                                <label for="computer_number" class="block font-medium text-sm text-gray-700">Computernummer</label>
                                <input type="text" name="computer_number" id="computer_number" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('computer_number') }}" />
                                @error('computer_number')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        @if (session('message'))
                        <div class="flex items-center px-4 py-3 bg-white text-right sm:px-6">
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        </div>
                        @endif

                        <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                Speichern
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Gerät
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Benötigtes Zubehör
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Kommentar
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Datum der Ausgabe
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Hash
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($distributions as $distribution)
                                        <tr class="clickable-row hover:bg-gray-100 cursor-pointer">
                                            <td class="px-4 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    @if ($distribution->computer->type == 1)
                                                    <i class="fas fa-desktop" title="Desktop"></i>
                                                    @elseif ($distribution->computer->type == 2)
                                                    <i class="fas fa-laptop" title="Laptop"></i>
                                                    @elseif ($distribution->computer->type == 3)
                                                    <i class="fas fa-tablet-alt" title="Tablet"></i>
                                                    @elseif ($distribution->computer->type == 4)
                                                    <i class="fas fa-hdd" title="Small Form Factor"></i>
                                                    @endif
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ $distribution->computer->identifier }}
                                                        </div>
                                                        <div class="text-sm text-gray-500">
                                                            {{ \Illuminate\Support\Str::limit($distribution->computer->model, 30, $end='...') }}
                                                        </div>
                                                    </div>
                                                    <!--</div>-->
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">
                                                    @if ($distribution->computer->has_webcam == 0)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                        Web-Cam
                                                    </span>
                                                    @endif
                                                    @if ($distribution->computer->has_wlan == 0)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                        WLAN
                                                    </span>
                                                    @endif
                                                    {{ $distribution->computer->required_equipment }}
                                                    @if ($distribution->computer->has_webcam == 1 && $distribution->computer->has_wlan == 1 && empty($distribution->computer->required_equipment))
                                                    -
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-gray-900">
                                                    {!! nl2br(e($distribution->computer->comment)) !!}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-gray-900">
                                                    {{ \Carbon\Carbon::parse($distribution->created_at)->format('d.m.Y H:i')}}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-gray-900">
                                                    {{ \Illuminate\Support\Str::limit($distribution->hash, 30, $end='...') }}
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</x-app-layout>