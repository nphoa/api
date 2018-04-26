<?php

namespace App\Http\Controllers;
use Hash;
use Illuminate\Http\Request;
use App\User;
use DB;
use Auth;

class UserController extends Controller
{
	public function register(Request $req)
	{
		print_r($req->get('name'));
		$user = User::create([
			'name' => $req->get('name'),
			'email' => $req->get('email'),
			'password' => Hash::make($req->get('password'))
		]);
		$user->save();
		return response()->json([
			'status'=> 200,
			'message'=> 'User created successfully',
			'data'=>$user
		]);
	}
	public function updateUser(Request $req)
	{
		$user = User::where('email',$req->get('email')) -> first();
		if($user){
			$user->name = $req->get('name');
			$user->email = $req->get('email');
			$user->password = Hash::make($req->get('password'));
			$user->save();
		}
		return response()->json([
			'status'=> 200,
			'message'=> 'User updated successfully',
			'data'=>$user
		]);
	}
	public function login(Request $request)
	{
		$data =  $request->json()->all();
		  //$data = $request->only('email','password');
		  //print_r($data['email']);
		// $jwt = '';

		// try {
		// 	$jwt = JWTAuth::attempt($credentials);
		// 	JWTAuth::setToken($jwt);
		// } catch (JWTAuthException $e) {
		// 	return response()->json([
		// 		'response' => 'error',
		// 		'message' => 'failed_to_create_token',
		// 	], 500);
		// }
		if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']])){
			$user = Auth::user();
			$token = $user->createToken('Token Name')->accessToken;
			return response()->json([
				'status' => 'success',
				'result' => ['token' => $token,'user'=>$user]
			]);
		}else{
			return response()->json(['status'=>'Unauthorised'],401);
		}
		

	}

	public function refresh()
	{
		$token = JWTAuth::getToken();
		
		try{
			$token = JWTAuth::refresh($token);
			return response()->json(['token'=>$token]);
		}catch(TokenExpiredException $e){

		}	
	}
	public function getUserInfo()
	{
		$user = Auth::user();
		print_r($user);
	}
}
