<tr>
	@if($edit)
 	    <td class="px-6 py-4 whitespace-nowrap">
 	    	<select wire:model="dish_type">
	 	    	@foreach(\App\Models\DishType::all() as $type)
	 	    		<option value="{{$type->id}}" @if($dish->type_id === $type->id)selected="selected"@endif>
	 	    			{{ $type->name }}
	 	    		</option>
	 	    	@endforeach
	 	    	{{ $dish_type }}
 	    	</select>	    </td>
	    <td class="px-6 py-4 whitespace-nowrap">
	    	<input type="text" value="{{ $dish->hu_name }}" wire:model="hu_name" />
	    </td>
	    <td class="px-6 py-4 whitespace-nowrap">
	    	<input type="text" value="{{ $dish->en_name }}" wire:model="en_name" />
	    </td>
	    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
	        <a href="#" wire:click.prevent="save" class="text-indigo-600 hover:text-indigo-900">{{ __('Save') }}</a>
	    </td>
   @else
	    <td class="px-6 py-4 whitespace-nowrap">
	        {{ $dish->getType() }}
	    </td>
	    <td class="px-6 py-4 whitespace-nowrap">
	        {{ $dish->hu_name }}
	    </td>
	    <td class="px-6 py-4 whitespace-nowrap">
	        {{ $dish->en_name }}
	    </td>
	    {{--
	    <td class="px-6 py-4 whitespace-nowrap">
	        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
	            Active
	        </span>
	    </td>
	    --}}
	    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
	        <a href="#" wire:click.prevent="edit" class="text-indigo-600 hover:text-indigo-900">{{ __('Edit') }}</a>
	    </td>
    @endif
</tr>
