<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;

    public function type()
    {
    	return $this->belongsTo(DishType::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function scopeListable($query)
    {
        return $query->where('hu_name', '!=', '')->where('en_name', '!=', '');
    }

    public function getType($locale = null)
    {
    	$locale ??= config('app.locale');

    	if($locale === 'hu') return $this->type->hu_name;
    	else return $this->type->en_name;
    }

    public function getTypeNameAttribute()
    {
        return $this->getType();
    }

    public function getNameTextAttribute()
    {
        if(config('app.locale') === 'hu') return $this->hu_name;
        else return $this->en_name;
    }

    public function getTagNamesAttribute()
    {
        return $this->tags->implode('name', ', ');
    }
}
