<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkType extends Model
{
	protected $table = 'worktypes';
    protected $fillable = ['name', 'createdBy','updatedBy'];
}
