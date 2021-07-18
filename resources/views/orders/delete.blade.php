<div>
    <x-jet-danger-button wire:click="$toggle('confirmingOrderDeletion')" wire:loading.attr="disabled">
    Auftrag löschen
    </x-jet-danger-button>

    <x-jet-confirmation-modal wire:model="confirmingOrderDeletion">
        <x-slot name="title">
            Auftrag löschen
        </x-slot>

        <x-slot name="content">
            Möchten Sie den Eintrag für diesen Auftrag wirklich löschen? Sobald ein Auftrag gelöscht wird, werden alle zugehörigen Daten dauerhaft entfernt.
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('confirmingOrderDeletion')" wire:loading.attr="disabled">
                Abbrechen
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="deleteOrder" wire:loading.attr="disabled">
                Auftrag löschen
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>
</div>

