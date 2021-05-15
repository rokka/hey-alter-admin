<x-app-layout>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
        setTimeout(function() {
            location.reload(1);
        }, 60000);
    </script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Statistiken

            @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif
        </h2>
    </x-slot>

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
                                                Status
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                <i class="fas fa-desktop" title="Desktop"></i>
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                <i class="fas fa-laptop" title="Laptop"></i>
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                <i class="fas fa-tablet-alt" title="Tablet"></i>
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                <i class="fas fa-hdd" title="Small Form Factor"></i>
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                <i class="fas fa-question" title="Unbekannt"></i>
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Summe
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($stats as $s)
                                        <tr>
                                            <td class="px-6 py-4">
                                                {{ __('xcomputer.state_' . $s->state) }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $s->sum_type_desktop }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $s->sum_type_laptop }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $s->sum_type_tablet }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $s->sum_type_small_form_factor }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $s->sum_type_unkown }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $s->sum_total }}
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td class="px-6 py-4">
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $totals['type_desktop'] }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $totals['type_laptop'] }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $totals['type_tablet'] }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $totals['type_small_form_factor'] }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $totals['type_unkown'] }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $totals['all'] }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

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
                                                Auslieferbar
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                <i class="fas fa-desktop" title="Desktop"></i>
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                <i class="fas fa-laptop" title="Laptop"></i>
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                <i class="fas fa-tablet-alt" title="Tablet"></i>
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                <i class="fas fa-hdd" title="Small Form Factor"></i>
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                <i class="fas fa-question" title="Unbekannt"></i>
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Summe
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($deliverable_stats as $s)
                                        <tr>
                                            <td class="px-6 py-4">
                                                {{ __('xcomputer.' . $s->state) }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $s->sum_type_desktop }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $s->sum_type_laptop }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $s->sum_type_tablet }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $s->sum_type_small_form_factor }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $s->sum_type_unkown }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $s->sum_total }}
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td class="px-6 py-4">
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $deliverable_totals['type_desktop'] }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $deliverable_totals['type_laptop'] }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $deliverable_totals['type_tablet'] }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $deliverable_totals['type_small_form_factor'] }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $deliverable_totals['type_unkown'] }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $deliverable_totals['all'] }}
                                            </td>
                                        </tr>
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
