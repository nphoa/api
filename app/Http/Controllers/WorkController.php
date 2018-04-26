<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Work;
USE App\WorkType;
use DB;
class WorkController extends Controller
{
    public function getAllWork()
    {
    	return Work::all();
    }
    public function getAllWorkType()
    {
    	return WorkType::all();
    }
    public function save(Request $req)
    {
        $data = $req->json()->all();
        try {
            if($data['id']===0){
                Work::create($data);
            }else{
                $work = Work::find($data['id']);

                $work->name = $data['name'];
                $work->work_type_id = $data['work_type_id'];
                $work->plan_id = $data['plan_id'];
                $work->start_Date = $data['start_Date'];
                $work->end_Date = $data['end_Date'];
                $work->save();
                // Plan::where('id',$data['id'])
                // ->update([
                //     'name'=>$data['name'],
                //     'start_Date'=>$data['start_Date'],
                //     'end_Date =>'$data['end_Date'],

                // ]);
            }
            $res = response()->json(['status'=>'success']);

        } catch (Exception $e) {
          $res = response()->json(['status'=>'Error']);
      }
      return $res;
  }
  public function deleteWork(Request $req)
  {

    $idWork =  $req->get('idWork');
    //print_r($idWork);
    DB::table('works')->where('id', $idWork)->delete();
    return response()->json(['status'=>'success']);
    }

   public function getWorkById(Request $req)
    {
        $idWork =  $req->get('idWork');
        $work = new Work();
        if($idWork==='0'){
            $work = $work->initFields();
        }else{
            $work = $work::find($idWork);
        }
        //print_r($work);
        return response()->json(['result'=>$work]);
    } 
}
