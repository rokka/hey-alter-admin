<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Computer {{ $computer->identifier }} bearbeiten
        </h2>
    </x-slot>

    <div>
        <div class="max-w-4xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="post" action="{{ route('computers.update', $computer->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="donor" class="block font-medium text-sm text-gray-700">Spender</label>
                            <input type="text" name="donor" id="donor" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('donor', $computer->donor) }}" />
                            @error('donor')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="email" class="block font-medium text-sm text-gray-700">E-Mail-Adresse</label>
                            <input type="email" name="email" id="email" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('email', $computer->email) }}" />
                            @error('email')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="is_deletion_required" id="is_deletion_required" 
                                class="form-checkbox rounded-md" value="1" @if(old('is_deletion_required',$computer->is_deletion_required)=="1") checked @endif />
                                <span class="ml-2">Professionelle Löschung gewünscht</span>
                            </label>                            
                            @error('is_deletion_required')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="needs_donation_receipt" id="needs_donation_receipt"
                                      class="form-checkbox rounded-md" value="1" @if(old('needs_donation_receipt',$computer->needs_donation_receipt)=="1") checked @endif />
                                <span class="ml-2">Spendenquittung gewünscht</span>
                            </label>                            
                            @error('needs_donation_receipt')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="model" class="block font-medium text-sm text-gray-700">Modell</label>
                            <input type="text" name="model" id="model" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('model', $computer->model) }}" />
                            @error('model')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="has_webcam" id="has_webcam" 
                                       class="form-checkbox rounded-md" value="1" @if(old('has_webcam',$computer->has_webcam)=="1") checked @endif />
                                <span class="ml-2">Web-Cam integriert</span>
                            </label>                            
                            @error('has_webcam')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="required_equipment" class="block font-medium text-sm text-gray-700">Benötigtes Zubehör (komma-getrennt)</label>
                            <input type="text" name="required_equipment" id="required_equipment" type="text" class="form-input rounded-md shadow-sm mt-1 block w-full"
                                   value="{{ old('required_equipment', $computer->required_equipment) }}" />
                            @error('has_webcam')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="state" class="block font-medium text-sm text-gray-700">Status</label>
                            <select name="state" id="state" class="form-singleselect block rounded-md shadow-sm mt-1 block w-full">
                                <option value="new" {{ (old('roles', $computer->state) == 'new') ? ' selected' : '' }}>{{ __('xcomputer.state_new') }}</option>
                                <option value="in_progress" {{ (old('roles', $computer->state) == 'in_progress') ? ' selected' : '' }}>{{ __('xcomputer.state_in_progress') }}</option>
                                <option value="refurbished" {{ (old('roles', $computer->state) == 'refurbished') ? ' selected' : '' }}>{{ __('xcomputer.state_refurbished') }}</option>
                                <option value="delivered" {{ (old('roles', $computer->state) == 'delivered') ? ' selected' : '' }}>{{ __('xcomputer.state_delivered') }}</option>
                                <option value="destroyed" {{ (old('roles', $computer->state) == 'destroyed') ? ' selected' : '' }}>{{ __('xcomputer.state_destroyed') }}</option>
                            </select>
                            @error('state')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-5 bg-white sm:p-6">
                            <label for="comment" class="block font-medium text-sm text-gray-700">Kommentar</label>
                            <textarea type="text" name="comment" id="comment" class="form-input rounded-md shadow-sm mt-1 block w-full">{{ old('comment', $computer->comment) }}</textarea>
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