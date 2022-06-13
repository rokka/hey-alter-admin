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
        </h2>
        @if (session('message'))
            <div class="bg-green-50 border-l-4 border-green-600 rounded-b px-4 py-3 shadow-md mt-4">
                <p>{{ session('message') }}</p>
            </div>
        @endif
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-wrap justify-between mb-8">
                <a href="{{ route('computers.create') }}" class="inline-flex items-center justify-center px-4 py-2 mx-2 lg:mx-0 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green active:bg-green-600 disabled:opacity-25 transition inline-block">Computer hinzufügen</a>
                <div class="mx-2 lg:mx-0 mt-2 lg:mt-0 inline-block">
                    <input type="text" class="mr-2 pr-24 py-2 placeholder-blueGray-300 text-blueGray-600 rounded text-sm shadow outline-none hover:ring" placeholder="Computer durchsuchen.." id="searchTerm">
                </div>
            </div>
            <div class="overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <div id="computers_table"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            searchResults();


            $('#searchTerm').on('keyup', function() {
                $value = $(this).val();
                searchResults(searchTerm);
            });


            var href = window.location.href.search(/=/);

            if (href > 0) {
                var state = window.location.href.substring(href + 1);
                filterResults();
            }

            function searchResults(searchTerm = '') {
                var searchTerm = $('#searchTerm').val();

                $.ajax({
                    type: "GET",
                    data: {
                        'searchTerm': searchTerm
                    },
                    url: "{{ route('computers.table') }}" + "?search=" + searchTerm,
                    success: function (data) {
                        $('#computers_table').html(data);
                    }
                });

            }

            function filterResults() {
                $.ajax({
                    type: "GET",
                    url: "{{ route('computers.table') }}" + "?state=" + state,
                    success: function (data) {
                        $('#computers_table').html(data);
                    }
                });

            }

        });
    </script>
</x-app-layout>
