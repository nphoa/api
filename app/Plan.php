<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
	protected $table = 'plans';
    protected $fillable = ['name','start_Date','end_Date','createdBy','updatedBy'];
}
