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

<div class="py-12 my-3" x-data="{ edit_mode: @if($order) false @else true @endif }">

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
                    <label class="inline-flex items-center mt-3 text-xl">
                        <h2>{{ $type}}</h2>
                    </label>
                    <hr>
                </div>
                @foreach($dishes as $dish)
                <div class="py-2">
                    <div class="px-6 content-center w-full">
                        <label class="inline-flex items-center mt-3">
                            <input type="checkbox" name="dishes[]" value="{{ $dish->id }}" x-show="edit_mode" class="js_dish_checkbox form-checkbox h-5 w-5 text-green-600"
                            @if($order && $order->includes($dish)) checked @endif
                            >
                            <span class="ml-2 text-lg text-gray-700 text-bold">{{ $dish->nameText }}</span>

                            @if($order && $order->includes($dish))
                                <span class="text-green-800 ml-4" x-show="!edit_mode">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </span>
                                <span class="text-green-800 ml-2" x-show="!edit_mode">
                                    {{ __('Selected') }}                                
                                </span>
                            @endif

                        </label>
                    </div>
                    <div class="px-6 content-center w-full">
                        <span class="ml-2 text-gray-600">{{ $dish->tagNames }}</span>                            
                    </div>
                </div>
                @endforeach
            @endforeach
        </div>
        <div class="p-6 my-2 bg-white border-b border-gray-200 flex justify-content">
            @if($order)
                <button class="inline-flex items-center px-4 py-2 bg-yellow-800 border border-transparent rounded-md font-0bold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:border-green-900 focus:ring focus:ring-green-300 disabled:opacity-25 transition" x-show="!edit_mode" @click.prevent="edit_mode = true">
                    {{ __('Edit order') }}
                </button>
                <button type="submit" x-show="edit_mode" class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-0bold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring focus:ring-green-300 disabled:opacity-25 transition">
                    {{ __('Save order') }}
                </button>
            @else
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-800 border border-transparent rounded-md font-0bold text-xs text-white uppercase tracking-widest hover:bg-green-700 active:bg-green-900 focus:outline-none focus:border-green-900 focus:ring focus:ring-green-300 disabled:opacity-25 transition">
                    {{ __('Submit order') }}

                </button>
            @endif
        </div>
    </div>
</div>


</form>

</x-guest-user-layout>
