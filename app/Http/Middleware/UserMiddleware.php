<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserMiddleware {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$activation = DB::table('student_activations')
			->where('user_id', Auth::user()->id)
			->where('status', 1)
			->first();

		if(sizeof($activation) == 0){
			return redirect('student/activate-email');
		}
		return $next($request);	
		
	}

}
