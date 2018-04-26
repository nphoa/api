<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plan;
use DB;

class PlanController extends Controller
{
    public function getAll()
    {
        return Plan::all();
    }
    public function save(Request $req)
    {

    	$data = $req->json()->all();
        print_r($data);
    	try {
            if($data['id']===0){
                Plan::create($req->json()->all());
            }else{
                $plan = Plan::find($data['id']);

                $plan->name = $data['name'];
                $plan->start_Date = $data['start_Date'];
                $plan->end_Date = $data['end_Date'];
                $plan->save();
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
  public function checkDuplicatePlan(Request $req)
  {
    $name = $req->get('namePlan');

    try {
        $plan = Plan::where('name',$name)->first();
        if($plan===null){
            $res = response()->json(['status'=>'True']);
        }else{
           $res = response()->json(['status'=>'False']);
       }
   } catch (Exception $e) {
    $res = response()->json(['status'=>'Error']);
}
return $res;
}
public function getNamePlans()
{
    $plans =  Plan::select('name')->get();
    $arrayNew = array();
    foreach ($plans as $value) {
            //print_r($value['name']);
        array_push($arrayNew, $value['name']);
    }
    return $arrayNew;
}
public function deletePlan(Request $req)
{

    $idPlan =  $req->get('id');
    DB::table('plans')->where('id', $idPlan)->delete();
    return response()->json(['status'=>'success']);
}
}
