<x-app-layout>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
        setTimeout(function() {
            location.reload(1);
        }, 60000);
    </script>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Computer') }}

            @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="block mb-8">
                <a href="{{ route('computers.create') }}" class="inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-600 disabled:opacity-25 transition inline-block">Computer hinzufügen</a>
                <a href="{{ route('consignments.create') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded inline-block float-right">Einlieferungsprotokoll</a>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Gerät
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Benötigtes Zubehör
                                            </th>
                                            @if (Auth::user()->currentTeam->use_donor_information)
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Spender
                                            </th>
                                            @endif
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Status
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Kommentar
                                            </th>
                                            <th scope="col">
                                            </th>
                                            <th scope="col">
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach ($computers as $computer)
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
                                            @if (Auth::user()->currentTeam->use_donor_information)
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">{{ $computer->donor ?? 'Unbekannt' }}</div>
                                                <div class="text-sm text-gray-500">{{ $computer->email ?? '' }}</div>
                                            </td>
                                            @endif
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
                                            <td>
                                                @if ($computer->is_deletion_required)
                                                <i class="fa fa-eraser" title="Professionelle Löschung gewünscht"></i>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($computer->needs_donation_receipt)
                                                <i class="fa fa-file px-2" title="Spendenquittung gewünscht"></i>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(function() {
            $(".clickable-row").click(function() {
                window.location = $(this).data("url");
            });
        });
    </script>
</x-app-layout>
