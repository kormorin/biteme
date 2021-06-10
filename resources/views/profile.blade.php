<x-app-layout>
<x-slot name="header">
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
{{ __('My Profile') }}
</h2>
</x-slot>
<div class="py-10 max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
    <div class="md:grid md:grid-cols-3 md:gap-6 py-6">
        <div class="md:col-span-1 flex justify-between">
            <div class="px-4 sm:px-0">
                <h3 class="text-lg font-medium text-gray-900">{{ __('Profile Information') }}</h3>
                <p class="mt-1 text-sm text-gray-600">
                    {{--Update your account's profile information and email address.--}}
                </p>
            </div>
            <div class="px-4 sm:px-0">
                
            </div>
        </div>
        <div class="mt-5 md:mt-0 md:col-span-2">
            <form method="POST" action="{{ route('update_profile') }}">
                {{ csrf_field() }}
                <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                    <div class="grid grid-cols-6 gap-6">
                        
                        <!-- Name -->
                        <div class="col-span-6 sm:col-span-4">
                            <label class="block font-medium text-sm text-gray-700" for="name">
                                Name
                            </label>
                            <input name="name" value="{{ $user->name }}"
                            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"
                            id="name"
                            type="text"
                            autocomplete="name">
                            @if($errors->has('name'))
                                <div class="font-medium text-red-600">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                        </div>

                        <!-- Email -->
                        <div class="col-span-6 sm:col-span-4">
                            <label class="block font-medium text-sm text-gray-700" for="email">
                                Email
                            </label>
                            <input name="email" value="{{ $user->email }}"
                            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" id="email" type="email">
                            @if($errors->has('email'))
                                <div class="font-medium text-red-600">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                    @if(session()->has('profile_update_message'))
                        <div class="text-md text-green-600 mr-3 font-bold">
                            {{ session('profile_update_message')}}
                        </div>
                    @endif
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                    Save
                    </button>
                </div>
            </form>
        </div>
    </div>
    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1 flex justify-between">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium text-gray-900">{{__('Update Password')}}</h3>
                    <p class="mt-1 text-sm text-gray-600">
                        {{--__('Here is where you can change your password.')--}}
                    </p>
                </div>
                <div class="px-4 sm:px-0">
                    
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form method="POST" action="{{ route('update_password') }}">
                    {{ csrf_field() }}
                    <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                        <div class="grid grid-cols-6 gap-6">
                            {{--
                            <div class="col-span-6 sm:col-span-4">
                                <label class="block font-medium text-sm text-gray-700" for="current_password">
                                    Current Password
                                </label>
                                <input class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" id="current_password" name="current_password" type="password" autocomplete="current-password">
                                @if($errors->has('current_password'))
                                    <div class="font-medium text-red-600">
                                        {{ $errors->first('current_password') }}
                                    </div>
                                @endif
                            </div>
                            --}}
                            <div class="col-span-6 sm:col-span-4">
                                <label class="block font-medium text-sm text-gray-700" for="password">
                                    {{__('New Password')}}
                                </label>
                                <input class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" id="password" name="password" type="password" autocomplete="new-password">
                                @if($errors->has('password'))
                                    <div class="font-medium text-red-600">
                                        {{ $errors->first('password') }}
                                    </div>
                                @endif
                            </div>
                            <div class="col-span-6 sm:col-span-4">
                                <label class="block font-medium text-sm text-gray-700" for="password_confirmation">
                                    {{ __('Confirm Password')}}
                                </label>
                                <input class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full" id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password">
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                        @if(session()->has('password_update_message'))
                            <div class="text-md text-green-600 mr-3 font-bold">
                                {{ session('password_update_message')}}
                            </div>
                        @endif
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                        Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</x-app-layout>