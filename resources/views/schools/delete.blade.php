<div>
    <x-jet-danger-button wire:click="$toggle('confirmingSchoolDeletion')" wire:loading.attr="disabled">
        Schule löschen
    </x-jet-danger-button>

    <x-jet-confirmation-modal wire:model="confirmingSchoolDeletion">
        <x-slot name="title">
            Schule löschen
        </x-slot>

        <x-slot name="content">
            Möchten Sie den Eintrag für diese Schule wirklich löschen? Sobald eine Schule gelöscht wird, werden alle zugehörigen Daten dauerhaft entfernt.
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingSchoolDeletion')" wire:loading.attr="disabled">
                Abbrechen
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="deleteSchool" wire:loading.attr="disabled">
                Schule löschen
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
</div>

