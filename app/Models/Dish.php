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

    public function getType($locale = null)
    {
    	$locale ??= config('app.locale');

    	if($locale === 'hu') return $this->type->hu_name;
    	else return $this->type->en_name;
    }
}
