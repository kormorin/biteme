<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;

class DishTableRow extends Component
{
	public $dish;
	public $edit = false;

	public $dish_type;
	public $hu_name;
	public $en_name;
    public $tag_ids = [];

    public function mount()
    {
        $this->dish_type = $this->dish->type_id;
        $this->hu_name = $this->dish->hu_name;
        $this->en_name = $this->dish->en_name;
        $this->tags_ids = $this->dish->tags->map->id->toArray();
    }

    public function render()
    {
        return view('livewire.dish-table-row', ['edit' => true]);
    }

    public function edit()
    {
    	$this->edit = true;
    }

    public function save()
    {
    	$this->dish->hu_name = $this->hu_name;
    	$this->dish->en_name = $this->en_name;
    	$this->dish->type_id = $this->dish_type;
    	$this->dish->save();

        $this->dish->tags()->sync($this->tag_ids);

    	$this->edit = false;
    	$this->dish = $this->dish->fresh();
    }
}
