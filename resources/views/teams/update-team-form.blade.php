<x-jet-form-section submit="updateTeam">
    <x-slot name="title">
        Team Details
    </x-slot>

    <x-slot name="description">
        Die Details des Teams und Informationen zum Besitzer.
    </x-slot>

    <x-slot name="form">
        <!-- Team Owner Information -->
        <div class="col-span-6">
            <x-jet-label value="Teambesitzer" />

            <div class="flex items-center mt-2">
                <img class="w-12 h-12 rounded-full object-cover" src="{{ $team->owner->profile_photo_url }}" alt="{{ $team->owner->name }}">

                <div class="ml-4 leading-tight">
                    <div>{{ $team->owner->name }}</div>
                    <div class="text-gray-700 text-sm">{{ $team->owner->email }}</div>
                </div>
            </div>
        </div>

        <!-- Team Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="Teamname" />

            <x-jet-input id="name"
                        type="text"
                        class="mt-1 block w-full"
                        wire:model.defer="state.name"
                        :disabled="! Gate::check('update', $team)" />

            <x-jet-input-error for="name" class="mt-2" />
        </div>

        <!-- Team Abbreviation -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="abbreviation" value="Team Abkürzung" />

            <x-jet-input id="abbreviation"
                        type="text"
                        class="mt-1 block w-full"
                        wire:model.defer="state.abbreviation"
                        :disabled="! Gate::check('update', $team)" />

            <x-jet-input-error for="abbreviation" class="mt-2" />
        </div>
    </x-slot>

    @if (Gate::check('update', $team))
        <x-slot name="actions">
            <x-jet-action-message class="mr-3" on="saved">
                Änderung erfolgreich
            </x-jet-action-message>

            <x-jet-button>
                Speichern
            </x-jet-button>
        </x-slot>
    @endif
</x-jet-form-section>
