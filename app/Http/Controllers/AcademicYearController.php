<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\AcademicYear;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AcademicYearController extends Controller {

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
		//
		$years = AcademicYear::all()->sortBy("semester")->sortByDesc("year");
		return view('admin.academic-year',['years' => $years]);
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
		AcademicYear::create([
			'year' => $request->input('odd-year') . '/' . $request->input('even-year'),
			'semester' => 1
		]);

		AcademicYear::create([
			'year' => $request->input('odd-year') . '/' . $request->input('even-year'),
			'semester' => 2
		]);

		return redirect()->back()->with('success', 'New Academic Year, '. $request->input('odd-year') .'/' . $request->input('even-year') .' Has been Added'); 
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
		$active_year = AcademicYear::where('status', '=', 1);
		if($active_year->first()){
			$active_year = $active_year->first();
			$active_year->status = 0;
			$active_year->save();
		}

		$year = AcademicYear::find($id);
		$year->status = 1;
		$year->save();

		$semester = $year->semester == 1 ? 'ganjil' : 'genap';
		return redirect()->back()->with('success', $year->year . ' - ' . $semester . ' is set to inactive'); 
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
