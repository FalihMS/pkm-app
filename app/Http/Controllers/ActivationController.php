<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ActivationController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function confirmEmail(){
		$activation = DB::table('student_activations')->where('user_id', Auth::user()->id)->first();

		if(sizeof($activation) == 0){
			$this->sendConfirmation();
		}
		return view('student.confirm-activation');
	}

	public function resendConfirmation(){
		$activation = DB::table('student_activations')->where('user_id', Auth::user()->id)->first();
		$date = date('m/d/Y h:i:s a', time());
		if($activation->date < $date){
			sendConfirmation();
			return redirect()->back();
		}else{
			return redirect()->back();			
		}
	}
	public function sendConfirmation(){
		$num_str = sprintf("%06d", mt_rand(1, 99999999));
		$activation = DB::table('student_activations')->where('user_id', Auth::user()->id)->first();
		$encrypted = bcrypt($num_str);
		if(sizeof($activation) > 0){
			DB::table('student_activations')
            ->where('user_id', $activation->user_id)
            ->update(['activation_code' => $encrypted]);
		}else{
			DB::table('student_activations')
            ->insert(
				['user_id' => Auth::user()->id, 'activation_code' => $encrypted]
			);
		}
		if (Hash::check($num_str, $encrypted))
		{
			Mail::send('emails.confirm-email', ['key' => $num_str], function($message)
			{
				$message->to(Auth::user()->email, 'user')->subject('Welcome! Please Confirm Your Email!');
			});
			
		}		
	}

	public function validateEmail(Request $request){
		$activation = DB::table('student_activations')->where('user_id', Auth::user()->id)->first();
		if (Hash::check($request->activation, $activation->activation_code))
		{
			// The passwords match...
			DB::table('student_activations')
            ->where('user_id', $activation->user_id)
            ->update(['status' => 1]);
			echo 'updated';
			return redirect('home');
		}else{
			echo 'password doesnt match';
			return view('student.confirm-activation', ['error', 'Something wrong']);
		}
	}

	public function validateEmailViaURL($key){
		$id = substr($key,6);
		$key = substr($key,0,6);
		$activation = DB::table('student_activations')->where('user_id', Auth::user()->id)->first();
		if (Hash::check($key, $activation->activation_code))
		{
			// The passwords match...
			DB::table('student_activations')
            ->where('user_id', $activation->user_id)
            ->update(['status' => 1]);
			echo 'updated';
			// return redirect('home');
		}else{
			echo 'password doesnt match';
			// return view('student.confirm-activation', ['error', 'Something wrong']);
		}
	}

}
