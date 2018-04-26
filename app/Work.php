<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
	protected $table = 'works';
    protected $fillable = ['name', 'work_type_id','plan_id','status','start_Date','end_Date','completed','createdBy','updatedBy'];

    public function initFields()
    {
        $this->id = 0;
        $this->name = "";
        $this->work_type_id =0;
        $this->plan_id =0;
        $this->status =0;
        $this->start_Date ="";
        $this->end_Date ="";
        $this->completed =0;
        return $this;
    }
}
