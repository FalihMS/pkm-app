<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Lecturer;
use App\AcademicYear;
use App\Region;
use App\ClassLecturer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LecturerController extends Controller {

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
		$lecturers = Lecturer::all();
		return view('admin.lecturer',['lecturers' => $lecturers]);

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
		echo $request->action;
		if($request->action == 'add_class'){
			ClassLecturer::create([
				'academic_years_id' => AcademicYear::where('status','1')->first()->id,
				'lecturers_id' => $request->input('lecturer'),
				'class' => $request->input('class')
			]);
			return redirect()->back()->with('success', 'New Lecturer Has been Added'); 
		}else{
			Lecturer::create([
				'name' => $request->input('name'),
				'code' => $request->input('code'),
				'nidn' => $request->input('nidn'),
			]);
			return redirect()->back()->with('success', 'New Lecturer Has been Added'); 
		}
		
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
		$lecturer = Lecturer::find($id);
		$year = AcademicYear::where('status','1')->first();
		$regions = Region::where('status','1')->get();
		$class = ClassLecturer::where('lecturers_id',$id)->get();
		return view('admin.lecturer-detail',['lecturer' => $lecturer, 'year' => $year, 'regions' => $regions, 'classes' => $class]);
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
		$lecturer = Lecturer::find($id);
		$lecturer->status = 0;
		$lecturer->save();
		return redirect()->back()->with('success', $lecturer->name. ' is set to inactive'); 
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
		ClassLecturer::destroy($id);
		return redirect()->back()->with('success', 'Assigned Class is deleted'); 
	}

}
