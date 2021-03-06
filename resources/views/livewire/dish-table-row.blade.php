<tr>
	@if($edit)
 	    <td class="px-6 py-4 whitespace-nowrap">
 	    	<select wire:model="dish_type">
	 	    	@foreach(\App\Models\DishType::all() as $type)
	 	    		<option value="{{$type->id}}" @if($dish->type_id === $type->id) selected="selected" @endif>
	 	    			{{ $type->name }}
	 	    		</option>
	 	    	@endforeach
 	    	</select>
 	    </td>
	    <td class="px-6 py-4 whitespace-nowrap">
	    	<input type="text" value="{{ $dish->hu_name }}" wire:model="hu_name" />
	    </td>
	    <td class="px-6 py-4 whitespace-nowrap">
	    	<input type="text" value="{{ $dish->en_name }}" wire:model="en_name" />
	    </td>
	    @foreach(\App\Models\Tag::all() as $tag)
		    <td class="px-6 py-4 whitespace-nowrap">
                <input type="checkbox" wire:model="tag_ids" value="{{ $tag->id }}" class="form-checkbox h-5 w-5 text-green-600"
			        @if($dish->tags->contains($tag)) checked @endif

                 />
		    </td>
	    @endforeach
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
	    @foreach(\App\Models\Tag::all() as $tag)
		    <td class="px-6 py-4 whitespace-nowrap">
		        @if($dish->tags->contains($tag))
					<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
					  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
					</svg>
				@else
					-
		        @endif
		    </td>
	    @endforeach
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
