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

                        @if (Auth::user()->currentTeam->use_donor_information)
                        <div class="grid grid-cols-1 sm:grid-cols-2">
                            <div class="px-4 py-3 bg-white sm:px-6 sm:py-3">
                                <label for="donor" class="block font-medium text-sm text-gray-700">Spender</label>
                                <input type="text" name="donor" id="donor" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('donor', '') }}" placeholder="Nicht angegeben" autofocus />
                                @error('donor')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="px-4 py-3 bg-white sm:px-6 sm:py-3">
                                <label for="email" class="block font-medium text-sm text-gray-700">E-Mail-Adresse</label>
                                <input type="email" name="email" id="email" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('email', '') }}" placeholder="Nicht angegeben" />
                                @error('email')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        @endif

                        <div class="grid grid-cols-1 sm:grid-cols-2">
                            <div class="px-4 py-3 bg-white sm:px-6 sm:py-3">
                                <label for="type" class="block font-medium text-sm text-gray-700">Geräteklasse</label>
                                <select name="type" id="type" class="form-singleselect block rounded-md shadow-sm mt-1 block w-full">
                                    <option value="0" {{ (old('type', $type) == '0') ? ' selected' : '' }}>Unbekannt</option>
                                    <option value="1" {{ (old('type', $type) == '1') ? ' selected' : '' }}>Desktop</option>
                                    <option value="2" {{ (old('type', $type) == '2') ? ' selected' : '' }}>Laptop</option>
                                    <option value="3" {{ (old('type', $type) == '3') ? ' selected' : '' }}>Tablet</option>
                                    <option value="4" {{ (old('type', $type) == '4') ? ' selected' : '' }}>Small Form Factor</option>
                                </select>
                                @error('type')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="px-4 py-3 bg-white sm:px-6 sm:py-3">
                                <label for="model" class="block font-medium text-sm text-gray-700">Modell</label>
                                <input type="text" name="model" id="model" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('model', $model) }}" />
                                @error('model')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2">
                            <div class="px-4 py-3 bg-white sm:px-6 sm:py-3">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="has_webcam" id="has_webcam" class="form-checkbox rounded-md" value="1" />
                                    <span class="ml-2">Web-Cam integriert</span>
                                </label>
                                @error('has_webcam')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="px-4 py-3 bg-white sm:px-6 sm:py-3">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="has_wlan" id="has_wlan" class="form-checkbox rounded-md" value="1" />
                                    <span class="ml-2">WLAN integriert</span>
                                </label>
                                @error('has_wlan')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="px-4 py-3 bg-white sm:px-6 sm:py-3">
                            <label for="required_equipment" class="block font-medium text-sm text-gray-700">Benötigtes Zubehör (außer Web-Cam und WLAN)</label>
                            <input type="text" name="required_equipment" id="required_equipment" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('model', '') }}" />
                            @error('required_equipment')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-3 bg-white sm:px-6 sm:py-3">
                            <label for="state" class="block font-medium text-sm text-gray-700">Status</label>
                            <select name="state" id="state" class="form-singleselect block rounded-md shadow-sm mt-1 block w-full">
                                <option value="new" {{ old('state', '') ? ' selected' : '' }}>{{ __('xcomputer.state_new') }}</option>
                                <option value="in_progress" {{ (old('state', '') == 'in_progress') ? ' selected' : '' }}>{{ __('xcomputer.state_in_progress') }}</option>
                                <option value="refurbished" {{ (old('state', '') == 'refurbished') ? ' selected' : '' }}>{{ __('xcomputer.state_refurbished') }}</option>
                                <option value="picked" {{ (old('state', '') == 'picked') ? ' selected' : '' }}>{{ __('xcomputer.state_picked') }}</option>
                                <option value="delivered" {{ (old('state', '') == 'delivered') ? ' selected' : '' }}>{{ __('xcomputer.state_delivered') }}</option>
                                <option value="destroyed" {{ (old('state', '') == 'destroyed') ? ' selected' : '' }}>{{ __('xcomputer.state_destroyed') }}</option>
                            </select>
                            @error('state')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="px-4 py-3 bg-white sm:px-6 sm:py-3">
                            <label for="comment" class="block font-medium text-sm text-gray-700">Kommentar</label>
                            <textarea type="text" name="comment" id="comment" class="form-input rounded-md shadow-sm mt-1 block w-full">{{ old('comment', '') }}</textarea>
                            @error('comment')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-1">
                        <!--<div class="grid grid-cols-1 sm:grid-cols-2">-->
                            <div class="px-4 py-3 bg-white sm:px-6 sm:py-3">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="is_deletion_required" id="is_deletion_required" class="form-checkbox rounded-md" value="1" />
                                    <span class="ml-2">Professionelle Löschung gewünscht</span>
                                </label>
                                @error('is_deletion_required')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!--
                            <div class="px-4 py-3 bg-white sm:px-6 sm:py-3">
                                <label class="inline-flex items-center">
                                    <input type="checkbox" name="needs_donation_receipt" id="needs_donation_receipt" class="form-checkbox rounded-md" value="1" />
                                    <span class="ml-2">Spendenquittung gewünscht</span>
                                </label>
                                @error('needs_donation_receipt')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            -->
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2">
                            <div class="px-4 py-3 bg-white sm:px-6 sm:py-3">
                                <label for="cpu" class="block font-medium text-sm text-gray-700">CPU Modell</label>
                                <input type="text" name="cpu" id="cpu" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('cpu', $cpu) }}" placeholder="Unbekannt" />
                                @error('cpu')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="px-4 py-3 bg-white sm:px-6 sm:py-3">
                                <label for="memory_in_gb" class="block font-medium text-sm text-gray-700">Arbeitsspeicher in GB</label>
                                <input type="text" name="memory_in_gb" id="memory_in_gb" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('memory_in_gb', $memory_in_gb) }}" placeholder="Unbekannt" />
                                @error('memory_in_gb')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2">
                            <div class="px-4 py-3 bg-white sm:px-6 sm:py-3">
                                <label for="hard_drive_type" class="block font-medium text-sm text-gray-700">Festplattentyp</label>

                                <select name="hard_drive_type" id="hard_drive_type" class="form-singleselect block rounded-md shadow-sm mt-1 block w-full">
                                    <option value="0" {{ (old('hard_drive_type', $hard_drive_type) == 0) ? ' selected' : '' }}>Unbekannt</option>
                                    <option value="1" {{ (old('hard_drive_type', $hard_drive_type) == 1) ? ' selected' : '' }}>HDD</option>
                                    <option value="2" {{ (old('hard_drive_type', $hard_drive_type) == 2) ? ' selected' : '' }}>SSD</option>
                                </select>
                                @error('hard_drive_type')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="px-4 py-3 bg-white sm:px-6 sm:py-3">
                                <label for="hard_drive_space_in_gb" class="block font-medium text-sm text-gray-700">Festplattengröße in GB</label>
                                <input type="text" name="hard_drive_space_in_gb" id="hard_drive_space_in_gb" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('hard_drive_space_in_gb', $hard_drive_space_in_gb) }}" placeholder="Unbekannt" />
                                @error('hard_drive_space_in_gb')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-1">
                            <div class="px-4 py-3 bg-white sm:px-6 sm:py-3">
                                <span class="block font-medium text-sm text-gray-700">Videoausgang</span>
                                <input type="checkbox" name="has_vga_videoport" id="has_vga_videoport" class="form-checkbox rounded-md" value="1" @if(old('has_vga_videoport',$has_vga_videoport)=="1") checked @endif />
                                <label for="has_vga_videoport" class="mr-3">VGA</label>
                                <input type="checkbox" name="has_dvi_videoport" id="has_dvi_videoport" class="form-checkbox rounded-md" value="1" @if(old('has_dvi_videoport',$has_dvi_videoport)=="1") checked @endif />
                                <label for="has_dvi_videoport" class="mr-3">DVI</label>
                                <input type="checkbox" name="has_hdmi_videoport" id="has_hdmi_videoport" class="form-checkbox rounded-md" value="1" @if(old('has_hdmi_videoport',$has_hdmi_videoport)=="1") checked @endif />
                                <label for="has_hdmi_videoport" class="mr-3">HDMI</label>
                                <input type="checkbox" name="has_displayport_videoport" id="has_displayport_videoport" class="form-checkbox rounded-md" value="1" @if(old('has_displayport_videoport',$has_displayport_videoport)=="1") checked @endif />
                                <label for="has_displayport_videoport" class="mr-3">DisplayPort</label>
                                @error('required_equipment')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
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