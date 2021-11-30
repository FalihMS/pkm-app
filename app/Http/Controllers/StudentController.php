<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use App\CollectionSession;
use App\StudentInfo;
use App\Region;
use App\Major;

use App\AcademicYear;

use App\PkmType;
use App\PkmFile;
use App\PkmStudent;
use App\PkmUpload;

class StudentController extends Controller {
	public function __construct()
	{
		$this->middleware('student');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$student = StudentInfo::where('user_id',Auth::user()->id)->first();
		if(sizeof($student) == 0){
			return redirect('student/complete-registration');		
		}else{
			return redirect('student/upload');
		}
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

	public function completeRegister(){
		$regions = Region::all();
		$pkmTypes = PkmType::where('status', 1)->get();
		$academicYear = AcademicYear::where('status', 1)->first();
		$majors = Major::where('status', 1)->get();
		
		foreach($regions as $region){
			foreach($region->classes as $class){
				$class_lecturer = $class->class_lecturer->where('academic_years_id', $academicYear->id)->first();
				if(sizeof($class_lecturer) > 0){
					$class_lecturer->lecturer;
				}
			
			}			
		}

		$student = StudentInfo::where('user_id',Auth::user()->id)->first();

		$pkm = 0;
		$leader = 0;
		$member = [0,0];
		if(sizeof($student)){
			$member1 = PkmStudent::where('pkm_file_id', $student->pkm_student()->where('roles', 1)->first()->pkm_file_id)->where('roles', 2)->first();
			$member2 = PkmStudent::where('pkm_file_id', $student->pkm_student()->where('roles', 1)->first()->pkm_file_id)->where('roles', 3)->first();

			if($student->pkm_student()->where('roles', 1)->first()->pkm_file_id > 0)
				$pkm = 1;
			if(!is_null($student->nim))
				$leader = 1;
			if(sizeOf($member1))
				$member[0] = 1;
			if(sizeOf($member2))
				$member[1] = 1;
		}
		return view('student.pre-app', ['member'=>$member,'regions' => $regions,'majors' => $majors,'pkmTypes' => $pkmTypes, 'pkm' => $pkm, 'leader' => $leader]);
	}

	public function insertPkm(Request $request)
	{
		$pkm = PkmFile::create([
			'title'=> $request->title,
			'pkm_type_id' => $request->type,
			'class_lecturer_id' => $request->class_lecturer
		]);

		$student = StudentInfo::where('user_id',Auth::user()->id)->first();
		
		if(sizeof($student) == 0){
			$student = StudentInfo::create([
				'user_id' => Auth::user()->id,
			]);
		}

		$student_id = $student->id;
		$pkm_id = $pkm->id;

		if(sizeof($student->pkm_student()->where('roles', 1)->first())){
			PkmStudent::where('pkm_file_id', 0 - $student->id)->update(['pkm_file_id'=> $pkm_id]);
		}else{
			PkmStudent::create([
				'student_info_id'=> $student_id,
				'pkm_file_id' => $pkm_id,
				'roles' => 1
			]);	
		}


		return redirect()->back()->with('pkm',1);
	}

	public function insertLeader(Request $request)
	{
		$student = StudentInfo::where('user_id',Auth::user()->id)->first();
		if(sizeof($student) == 0){
			$student = new StudentInfo();			
		}

		$student->nim = $request->nim;
		$student->name = $request->name;
		$student->major_id = $request->major;
		$student->phone_no = $request->phone;
		$student->address = $request->address;
		$student->email = Auth::user()->email;			
		$student->save();

		return redirect()->back();
	}

	public function insertMember(Request $request)
	{
		$student = new StudentInfo();			
		$student->nim = $request->nim;
		$student->name = $request->name;
		$student->major_id = $request->major;
		$student->phone_no = $request->phone;
		$student->email = $request->email;			
		$student->save();

		$leader = StudentInfo::where('user_id',Auth::user()->id)->first();
		
		if(!sizeof($leader)){
			$leader = StudentInfo::create([
				'user_id' => Auth::user()->id,
			]);
		}

		if(sizeof($leader->pkm_student()->where('roles', '1')->first())){
			PkmStudent::create([
				'student_info_id'=> $student->id,
				'pkm_file_id' => $leader->pkm_student()->where('roles', '1')->first()->pkm_file_id,
				'roles' => $request->roles
			]);
		}else{
			$leader_id = 0 - $leader->id;
			PkmStudent::create([
				'student_info_id'=> 0 - $leader_id,
				'pkm_file_id' => $leader_id,
				'roles' => 1
			]);

			PkmStudent::create([
				'student_info_id'=> $student->id,
				'pkm_file_id' => $leader_id,
				'roles' => $request->roles
			]);
			
		}
		return redirect()->back();
	}

	public function uploadFile(){
		$leader = StudentInfo::where('user_id',Auth::user()->id)->first();
		$pkm_file = $leader->pkm_student()->first()->pkm_file()->first();
		$class_lecturer = $pkm_file->class_lecturer()->first();
		// echo $class_lecturer;
		$collection_sessions = CollectionSession::where('pkm_type_id', $pkm_file->pkm_type_id)->get();
		return view('student.app')->with([
			'collection_sessions' => $collection_sessions,
			'leader' => $leader, 
			'pkm_file' => $pkm_file, 
			'class_lecturer' => $class_lecturer
		]);
	}

	public function addUploadFile(Request $request){
		
		// menyimpan data file yang diupload ke variabel $file
		$file = $request->file('file');
 
		// nama file
		echo 'File Name: '.$file->getClientOriginalName();
		echo '<br>';

		// ekstensi file
		echo 'File Extension: '.$file->getClientOriginalExtension();
		echo '<br>';

		// real path
		echo 'File Real Path: '.$file->getRealPath();
		echo '<br>';

		// ukuran file
		echo 'File Size: '.$file->getSize();
		echo '<br>';

		$leader = json_decode($request->leader);
		$pkm_file = json_decode($request->title);
		$tujuan_upload = 'data_file';
		$filename = $leader->nim . '-'. $leader->name . '-'. $pkm_file->title;

		$upload = PkmUpload::where('pkm_file_id', $pkm_file->id)->first();
		if(sizeof($upload)){
			$upload->file_location = '/' . $tujuan_upload. '/' . $filename;
			$upload->upload_count = $upload->upload_count + 1;
			$upload->save();
			
		}else{
			PkmUpload::create([
				'pkm_file_id' => $pkm_file->id,
				'collection_session_id' => '1',
				'file_location' => '/' . $tujuan_upload. '/' . $filename,
				'upload_count' => 1,
			]);
		}


		// // isi dengan nama folder tempat kemana file diupload
		$file->move($tujuan_upload, $filename);
	}

	public function renameFile(Request $request){
		$leader = StudentInfo::where('user_id',Auth::user()->id)->first();
		$pkm_file = $leader->pkm_student()->first()->pkm_file()->first();

		$pkm_file->title = $request->title;
		$pkm_file->save();
		return redirect()->back();
	}
}
