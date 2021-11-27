<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Auftrag {{ $order->id }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-6xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="block mb-8">
                <a href="{{ route('orders.edit', $order->id) }}" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-600 disabled:opacity-25 transition inline-block">Auftrag bearbeiten</a>
                <div class="float-right inline-block">
                    @livewire('orders.delete', ['order' => $order])
                </div>
            </div>
            <div class="flex flex-col">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200 w-full table-fixed">
                                <thead>
                                    <tr>
                                        <th class="w-1/3"></th>
                                        <th class="w-2/3"></th>
                                    </tr>
                                </thead>
                                <tr class="border-b">
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Schule
                                    </th>
                                    <td class="px-6 py-4 text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                        {{ $order->school->name }}
                                    </td>
                                </tr>
                                <tr class="border-b">
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Ansprechpartner
                                    </th>
                                    <td class="px-6 py-4 text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                        {{ $order->user->name }}
                                    </td>
                                </tr>
                                <tr class="border-b">
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Lehrer
                                    </th>
                                    <td class="px-6 py-4 text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                        {{ $order->teacher }}
                                    </td>
                                </tr>
                                <tr class="border-b">
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
                                    </th>
                                    <td class="px-6 py-4 text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                        {{ __('order.state_' . $order->state) }}
                                    </td>
                                </tr>
                                <tr class="border-b">
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Computer
                                    </th>
                                    <td class="px-6 py-4 text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                        @if ($order->desktop_count > 0){{ $order->desktop_count }}x <i class="fas fa-desktop" title="Desktop"></i> &nbsp;&nbsp;&nbsp;@endif
                                        @if ($order->laptop_count > 0){{ $order->laptop_count }}x <i class="fas fa-laptop" title="Laptop"></i> &nbsp;&nbsp;&nbsp;@endif
                                        @if ($order->sff_count > 0){{ $order->sff_count }}x <i class="fas fa-hdd" title="Small Form Factor"></i> &nbsp;&nbsp;&nbsp;@endif
                                        @if ($order->tablet_count > 0){{ $order->tablet_count }}x <i class="fas fa-tablet-alt" title="Tablet"></i>@endif
                                        @if ($order->desktop_count == 0 && $order->laptop_count == 0 && $order->sff_count == 0 && $order->tablet_count == 0)
                                        Noch nicht festgelegt
                                        @endif
                                    </td>
                                </tr>
                                @if (!empty($order->comment))
                                <tr class="border-b">
                                    <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Kommentar
                                    </th>
                                    <td class="px-6 py-4 text-sm text-gray-900 bg-white divide-y divide-gray-200">
                                        {{ $order->comment }}
                                    </td>
                                </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="block mt-8">
                <a href="{{ route('orders.index') }}" class="inline-flex items-center justify-center px-4 py-2 bg-gray-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-500 focus:outline-none focus:border-gray-700 focus:shadow-outline-gray active:bg-gray-600 disabled:opacity-25 transition inline-block">Zurück zur Liste</a>
            </div>
        </div>
    </div>

    @if ($order->desktop_count > 0)
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
                                                Desktop (Soll: {{ $order->desktop_count }} Ist: {{ count($order->desktops) }})
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Benötigtes Zubehör
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Status
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Kommentar
                                            </th>
                                            <th scope="col">
                                            </th>
                                        </tr>
                                    </thead>
                                    @foreach ($order->desktops as $computer)
                                        <tr class="clickable-row hover:bg-gray-100 cursor-pointer" data-url="{{ route('computers.show', $computer->id) }}">
                                            <td class="px-4 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    @if ($computer->type == 1)
                                                    <i class="fas fa-desktop" title="Desktop"></i>
                                                    @elseif ($computer->type == 2)
                                                    <i class="fas fa-laptop" title="Laptop"></i>
                                                    @elseif ($computer->type == 3)
                                                    <i class="fas fa-tablet-alt" title="Tablet"></i>
                                                    @elseif ($computer->type == 4)
                                                    <i class="fas fa-hdd" title="Small Form Factor"></i>
                                                    @endif
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ $computer->identifier }}
                                                        </div>
                                                        <div class="text-sm text-gray-500">
                                                            {{ $computer->model }}
                                                        </div>
                                                    </div>
                                                    <!--</div>-->
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900">
                                                    @if ($computer->has_webcam == 0)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                        Web-Cam
                                                    </span>
                                                    @endif
                                                    @if ($computer->has_wlan == 0)
                                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                        WLAN
                                                    </span>
                                                    @endif
                                                    {{ $computer->required_equipment }}
                                                    @if ($computer->has_webcam == 1 && $computer->has_wlan == 1 && empty($computer->required_equipment))
                                                    -
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if ($computer->state == 'new')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                    {{ __('xcomputer.state_' . $computer->state) }}
                                                </span>
                                                @elseif ($computer->state == 'in_progress')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    {{ __('xcomputer.state_' . $computer->state) }}
                                                </span>
                                                @elseif ($computer->state == 'destroyed')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                    {{ __('xcomputer.state_' . $computer->state) }}
                                                </span>
                                                @elseif ($computer->state == 'picked')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-pink-100 text-pink-800">
                                                    {{ __('xcomputer.state_' . $computer->state) }}
                                                </span>
                                                @elseif ($computer->state == 'delivered')
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                    {{ __('xcomputer.state_' . $computer->state) }}
                                                </span>
                                                @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    {{ __('xcomputer.state_' . $computer->state) }}
                                                </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="text-sm text-gray-900">{!! nl2br(e($computer->comment)) !!}</div>
                                            </td>
                                            <td scope="col">
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @endif
    
</x-app-layout>
