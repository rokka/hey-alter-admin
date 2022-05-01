<table class="min-w-full divide-y divide-gray-200">
    <thead class="bg-gray-50">
    <tr>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Name
        </th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Typ
        </th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Telefonnummer
        </th>
        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
            Kontaktperson
        </th>
    </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
    @foreach ($schools as $school)
        <tr class="bg-white clickable-row hover:bg-gray-100 cursor-pointer" data-url="{{ route('schools.show', $school->id) }}">
            <td data-label="Name" class="px-6 py-4 whitespace-nowrap">
                <!--<div class="flex items-center">
                <div class="flex-shrink-0 h-10 w-10">
                    <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=4&w=256&h=256&q=60" alt="">
                </div>-->
                <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">
                        {{ \Illuminate\Support\Str::limit($school->name, 70, $end='...') }}
                    </div>
                    <div class="text-sm text-gray-500">
                        {{ $school->zip }} {{ $school->city }} {{ $school->street }}
                    </div>
                </div>
                <!--</div>-->
                </div>
            </td>
            <td data-label="Typ" class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">{{ $school->type }}</div>
            </td>
            <td data-label="Telefonnummer" class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">{{ $school->phone }}</div>
            </td>
            <td data-label="Kontaktperson" class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">{{ $school->contact_person }}</div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<script type="text/javascript">
    $(function() {
        $(".clickable-row").click(function() {
            window.location = $(this).data("url");
        });
    });
</script>
