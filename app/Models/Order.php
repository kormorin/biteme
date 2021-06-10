<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function department()
    {
    	return $this->belongsTo(Department::class);
    }

    public function user()    
	{
		return $this->belongsTo(GuestUser::class);    	
    }

    public function items()
    {
    	return $this->hasMany(OrderItem::class);
    }

    public function includes(Dish $dish)
    {
    	return !$this->items->where('dish_id', $dish->id)->isEmpty();
    }

    public function getDepartmentNameAttribute()
    {
    	return $this->department->nameText;
    }
}
