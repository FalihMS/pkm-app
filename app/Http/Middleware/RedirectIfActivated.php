<?php namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class RedirectIfActivated {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$activation = DB::table('student_activations')->where('user_id', Auth::user()->id)->first();

		if(sizeof($activation) > 0){
			if($activation->status == 1){
				return redirect('/student');
			}	
		}
		return $next($request);
	}

}
