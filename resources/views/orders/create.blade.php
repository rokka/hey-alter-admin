<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Auftrag hinzufügen
        </h2>
    </x-slot>

    <div>
        <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('orders.store') }}">
                    @csrf
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="grid grid-cols-1 sm:grid-cols">
                            <div class="px-4 py-3 bg-white sm:px-6 sm:py-3">
                                <label for="school_id" class="block font-medium text-sm text-gray-700">Schule</label>
                                <select name="school_id" id="school_id" class="form-singleselect block rounded-md shadow-sm mt-1 block w-full" autofocus>
                                    @foreach ($schools as $school)
                                    <option value="{{ $school->id }}" {{ (old('school_id') == $school->id) ? ' selected' : '' }}>{{ $school->name }}</option>
                                    @endforeach
                                </select>
                                @error('school_id')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 sm:grid-cols">
                            <div class="px-4 py-3 bg-white sm:px-6 sm:py-3">
                                <label for="user_id" class="block font-medium text-sm text-gray-700">Ansprechpartner</label>
                                <select name="user_id" id="user_id" class="form-singleselect block rounded-md shadow-sm mt-1 block w-full">
                                    @foreach ($users as $user)
                                    <option value="{{ $user->id }}" {{ (old('user_id') == $user->id) ? ' selected' : '' }}>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-4">
                            <div class="px-4 py-3 bg-white sm:px-6 sm:py-3">
                                <label class="block font-medium text-sm text-gray-700">Desktops</label>
                                <input type="number" min="0" max="65535" name="desktop_count" id="desktop_count" class="form-checkbox rounded-md" value="{{ (old('desktop_count', 0)) }}" />
                                @error('desktop_count')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="px-4 py-3 bg-white sm:px-6 sm:py-3">
                                <label class="block font-medium text-sm text-gray-700">Laptops</label>
                                <input type="number" min="0" max="65535" name="laptop_count" id="laptop_count" class="form-checkbox rounded-md" value="{{ (old('laptop_count', 0)) }}" />
                                @error('laptop_count')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="px-4 py-3 bg-white sm:px-6 sm:py-3">
                                <label class="block font-medium text-sm text-gray-700">Small Form Factor</label>
                                <input type="number" min="0" max="65535" name="sff_count" id="sff_count" class="form-checkbox rounded-md" value="{{ (old('sff_count', 0)) }}" />
                                @error('sff_count')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="px-4 py-3 bg-white sm:px-6 sm:py-3">
                                <label class="block font-medium text-sm text-gray-700">Tablets</label>
                                <input type="number" min="0" max="65535" name="tablet_count" id="tablet_count" class="form-checkbox rounded-md" value="{{ (old('tablet_count', 0)) }}" />
                                @error('tablet_count')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="px-4 py-3 bg-white sm:px-6 sm:py-3">
                            <label for="comment" class="block font-medium text-sm text-gray-700">Kommentar</label>
                            <textarea type="text" name="comment" id="comment" class="form-input rounded-md shadow-sm mt-1 block w-full">{{ old('comment') }}</textarea>
                            @error('comment')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

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
</x-app-layout>