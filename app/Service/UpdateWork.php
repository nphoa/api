<?php

namespace App\Service;
use DB;
use App\Work;


class UpdateWork 
{
	public function update()
	{
		$today = date('Y-m-d');
		DB::table('works')
			->whereDate('end_Date',$today)
			->orWhere('end_Date','<',$today)
			->update(['status'=>1,'completed'=>1]);
		
	}	
}
