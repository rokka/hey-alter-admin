<x-app-layout>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

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
                <a href="{{ route('computers.create') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Computer hinzufügen</a>
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
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Spender
                                </th>
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
                            <tr class="clickable-row hover:bg-gray-100" data-url="{{ route('computers.show', $computer->id) }}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <!--<div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60" alt="">
                                </div>
                                -->
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
                                WebCam
                                </span>
                                @endif
                                @if ($computer->has_wlan == 0)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                WLAN
                                </span>
                                @endif
                                {{ $computer->required_equipment }}
                                @if ($computer->has_webcam == 1 && $computer->has_wlan == 1)
                                -
                                @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $computer->donor ?? 'Unbekannt' }}</div>
                                <div class="text-sm text-gray-500">{{ $computer->email ?? '' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                {{ __('xcomputer.state_' . $computer->state) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">                            
                                <div class="text-sm text-gray-900">{!! nl2br(e($computer->comment)) !!}</div>
                            </td>
                            <td>
                                @if ($computer->is_deletion_required)
                                <img src="https://img.icons8.com/ios/452/shredder.png" width="30" height="30" title="Professionelle Löschung gewünscht">
                                @endif
                            </td>
                            <td>
                                @if ($computer->needs_donation_receipt)
                                <img src="https://image.flaticon.com/icons/png/512/1950/1950312.png" width="30" height="30" title="Spendenquittung gewünscht">
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