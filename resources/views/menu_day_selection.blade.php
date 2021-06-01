@section('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js" integrity="sha512-LGXaggshOkD/at6PFNcp2V2unf9LzFq6LE+sChH7ceMTDP0g2kn6Vxwgg7wkPP7AAtX+lmPqPdxB47A0Nz0cMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>

@endsection
<x-app-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Dashboard') }}
    </h2>
</x-slot>
<div class="py-12">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex">
            <div class="p-6 bg-white border-b border-gray-200 align-middle">
                <label class="block font-medium text-lg">
                    {{__('Choose a day')}}
                </label>
            </div>
            <div class="flex-1 p-6 flex content-center">
                <input type="text" id="datepicker" class="align-middle" autocomplete="off">
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
        console.log(document.location.href = window.location.href  + '/' + this.getMoment().format('YYYY-MM-DD'));
    }
});

document.getElementById('datepicker').click();

</script>
