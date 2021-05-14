<div>
    <x-jet-danger-button wire:click="$toggle('confirmingComputerDeletion')" wire:loading.attr="disabled">
        Computer löschen
    </x-jet-danger-button>

    <x-jet-confirmation-modal wire:model="confirmingComputerDeletion">
        <x-slot name="title">
            Computer löschen
        </x-slot>

        <x-slot name="content">
            Möchten Sie den Eintrag für diesen Computer wirklich löschen? Sobald ein Computer gelöscht wird, werden alle zugehörigen Daten dauerhaft entfernt.
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingComputerDeletion')" wire:loading.attr="disabled">
                Abbrechen
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="deleteComputer" wire:loading.attr="disabled">
                Computer löschen
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
</div>

