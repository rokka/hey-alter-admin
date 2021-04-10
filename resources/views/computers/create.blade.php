<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Computer hinzufügen
        </h2>
    </x-slot>

    <div>
        <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('computers.store') }}">
                    @csrf
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="donor" class="block font-medium text-sm text-gray-700">Spender</label>
                            <input type="text" name="donor" id="donor" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('donor', '') }}" placeholder="Nicht angegeben" autofocus />
                            @error('donor')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="email" class="block font-medium text-sm text-gray-700">E-Mail-Adresse</label>
                            <input type="email" name="email" id="email" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('email', '') }}" placeholder="Nicht angegeben" />
                            @error('email')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="is_deletion_required" id="is_deletion_required" class="form-checkbox rounded-md" value="1" />
                                <span class="ml-2">Professionelle Löschung gewünscht</span>
                            </label>                            
                            @error('is_deletion_required')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="needs_donation_receipt" id="needs_donation_receipt" class="form-checkbox rounded-md" value="1" />
                                <span class="ml-2">Spendenquittung gewünscht</span>
                            </label>                            
                            @error('needs_donation_receipt')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="model" class="block font-medium text-sm text-gray-700">Modell</label>
                            <input type="text" name="model" id="model" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('model', '') }}" />
                            @error('model')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="has_webcam" id="has_webcam" class="form-checkbox rounded-md" value="1" />
                                <span class="ml-2">Web-Cam integriert</span>
                            </label>                            
                            @error('has_webcam')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="required_equipment" class="block font-medium text-sm text-gray-700">Benötigtes Zubehör (komma-getrennt)</label>
                            <input type="text" name="required_equipment" id="required_equipment" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('model', '') }}" />
                            @error('required_equipment')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="comment" class="block font-medium text-sm text-gray-700">Kommentar</label>
                            <textarea type="text" name="comment" id="comment" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('comment', '') }}"></textarea>
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