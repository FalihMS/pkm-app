<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\CollectionSession;
use App\AcademicYear;
use App\PkmType;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use DateTime;
use DateInterval;

class CollectionSessionController extends Controller {

	public function __construct()
	{
		$this->middleware('admin');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$sessions = CollectionSession::all();
		$pkmTypes = PkmType::where('status',1)->get();
		return view('admin.collection-session',['sessions' => $sessions, 'pkmTypes' => $pkmTypes]);
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
	public function store(Request $request)
	{
		//
		$year = AcademicYear::where('status',1)->first()->id;
		
		$date = new DateTime($request->input('deadline'));
		$datetime = $date->add(new DateInterval('PT23H59M59S'));
		
		CollectionSession::create([
			'title' => $request->input('title'),
			'deadline' => $datetime,
			'pkm_type_id' => $request->input('type'),
			'academic_years_id' => $year,
		]);
		return redirect()->back()->with('success', 'New Deadline Has been Added'); 
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
	public function update($id, Request $request)
	{
		//
		$session = CollectionSession::find($id);
		$session->deadline = $request->input('deadline');
		$session->save();
		return redirect()->back()->with('success', 'Deadline Extended'); 
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

}
