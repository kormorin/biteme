@section('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js" integrity="sha512-LGXaggshOkD/at6PFNcp2V2unf9LzFq6LE+sChH7ceMTDP0g2kn6Vxwgg7wkPP7AAtX+lmPqPdxB47A0Nz0cMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>

@endsection
<x-guest-user-layout>
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
    {{ __('Choose your menu for ') . $day }}
    </h2>
</x-slot>

<div class="py-12 my-3">

@if(!$errors->isEmpty())
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-3">
        <div class="bg-red-500 overflow-hidden shadow-sm sm:rounded-lg flex py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <span class="text-md mx-3 text-white font-semibold">
                    {{ $errors->first() }}
                </span>
            </div>
        </div>
    </div>
@endif

@if(session('success'))
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-3">
        <div class="bg-green-500 overflow-hidden shadow-sm sm:rounded-lg flex py-5">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <span class="text-md mx-3 text-white font-semibold">
                    {{ session('success') }}
                </span>
            </div>
        </div>
    </div>
@endif

<form method="POST">
    {{ csrf_field() }}
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        {{--
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex">
            <div class="p-6 bg-white border-b border-gray-200 align-middle">
                <label class="block font-medium text-lg">
                    {{__('Choose a day')}}
                </label>
            </div>
            <div class="flex-1 p-6 flex content-center">
            </div>
        </div>
        --}}

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            @foreach($dish_groups as $type => $dishes)
                <div class="p-6 content-center w-full">
                    <label class="inline-flex items-center mt-3">
                        <h2>{{ $type}}</h2>
                    </label>
                    <hr>
                </div>
                @foreach($dishes as $dish)
                    <div class="px-6 py-2 content-center w-full">
                        <label class="inline-flex items-center mt-3">
                            <input type="checkbox" name="dishes[]" value="{{ $dish->id }}" class="js_dish_checkbox form-checkbox h-5 w-5 text-green-600"
                            @if($order && $order->includes($dish)) checked @endif
                            ><span class="ml-2 text-gray-700">{{ $dish->nameText }}</span>
                        </label>
                    </div>
                @endforeach
            @endforeach
        </div>
        <div class="p-6 my-2 bg-white border-b border-gray-200 align-middle">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-0bold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring focus:ring-green-300 disabled:opacity-25 transition">
            {{ __('Save order') }}
            </button>
        </div>
    </div>
</div>


</form>

</x-guest-user-layout>
