<x-jet-action-section>
    <x-slot name="title">
        Team löschen
    </x-slot>

    <x-slot name="description">
        Team dauerhaft löschen
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl text-sm text-gray-600">
            Sobald ein Team gelöscht wird, werden alle seine Ressourcen und Daten dauerhaft gelöscht. Laden Sie vor dem Löschen dieses Teams alle Daten oder Informationen zu diesem Team herunter, die Sie behalten möchten.
        </div>

        <div class="mt-5">
            <x-jet-danger-button wire:click="$toggle('confirmingTeamDeletion')" wire:loading.attr="disabled">
                Team löschen
            </x-jet-danger-button>
        </div>

        <!-- Delete Team Confirmation Modal -->
        <x-jet-confirmation-modal wire:model="confirmingTeamDeletion">
            <x-slot name="title">
                Team löschen
            </x-slot>

            <x-slot name="content">
                Möchten Sie dieses Team wirklich löschen? Sobald ein Team gelöscht wird, werden alle seine Ressourcen und Daten dauerhaft gelöscht.
            </x-slot>

            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('confirmingTeamDeletion')" wire:loading.attr="disabled">
                    Abbrechen
                </x-jet-secondary-button>

                <x-jet-danger-button class="ml-2" wire:click="deleteTeam" wire:loading.attr="disabled">
                    Team löschen
                </x-jet-danger-button>
            </x-slot>
        </x-jet-confirmation-modal>
    </x-slot>
</x-jet-action-section>
