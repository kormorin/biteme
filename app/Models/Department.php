<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    public function getNameTextAttribute()
    {
    	if(config('app.locale') === 'hu') return $this->hu_name;
    	else return $this->en_name;
    }
}
