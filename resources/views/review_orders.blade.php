@section('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js" integrity="sha512-LGXaggshOkD/at6PFNcp2V2unf9LzFq6LE+sChH7ceMTDP0g2kn6Vxwgg7wkPP7AAtX+lmPqPdxB47A0Nz0cMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>


@endsection
<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Menu') . " - $day" }}
    </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <!-- This example requires Tailwind CSS v2.0+ -->
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                &nbsp;
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                {{ __('Dish') }}
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                {{ __('Department') }}
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                {{ __('# of orders') }}
                                            </th>
                                        </tr>
                                    </thead>
                                        @foreach($rows as $row)
                                            <tbody class="bg-white divide-y divide-gray-200" x-data="{ visible: false}">
                                            <tr>
                                                <td class="p-2 font-l bg-red-500" @click="visible = !visible;" x-text="visible ? '-' : '+'"></td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ $row['dish_name'] }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    &nbsp;
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    {{ $row['count'] }}
                                                </td>
                                            </tr>

                                            @foreach($row['sub_rows'] as $sub_row)
                                                <tr class="bg-gray-200" x-show="visible">
                                                    <td class="p-2 font-l">&nbsp;</td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        &nbsp;
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        {{ $sub_row['department_name'] }}
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        {{ $sub_row['count'] }}
                                                    </td>
                                                </tr>
                                            @endforeach

                                            </tbody>
                                        @endforeach
                                        <!-- More people... -->
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
    <script>
        var picker = new Pikaday({
        field: document.getElementById('datepicker'),
        format: 'YYYY-DD-MM',
        onSelect: function() {
            console.log(this.getMoment().format('Do MMMM YYYY'));
        }
    });

    </script>
