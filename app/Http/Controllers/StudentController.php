<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmail;
use App\Models\Student;
use App\Repositories\Faculty\FacultyRepositoryInterface;
use App\Repositories\Student\StudentRepositoryInterface;
use App\Repositories\Subject\SubjectRepositoryInterface;
use App\Repositories\SubjectScore\SubjectScoreRepositoryInterface;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $studentRepo;
    protected $facultyRepo;
    protected $subjectRepo;
    protected $pointRepo;

    public function __construct(
        StudentRepositoryInterface      $studentRepo,
        FacultyRepositoryInterface      $facultyRepo,
        SubjectRepositoryInterface      $subjectRepo,
        SubjectScoreRepositoryInterface $pointRepo,
    )
    {
        $this->studentRepo = $studentRepo;
        $this->facultyRepo = $facultyRepo;
        $this->subjectRepo = $subjectRepo;
        $this->pointRepo = $pointRepo;
    }


    public function index()
    {

        $students = $this->studentRepo->paginate(5);

        return view('students.index', compact('students'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $faculties = $this->facultyRepo->pluck('name', 'id');
        $students = $this->studentRepo->getAll();

        return view('students.edit_create', compact('students', 'faculties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $getAll = $request->all();
        if ($request->has('avatar')) {
            $file_name = $request->file('avatar');
            //dd($file_name);
            $post_file = $file_name->move('images', $file_name->getClientOriginalName());
        }
        $getAll['avatar'] = $post_file;
        $this->studentRepo->create($getAll);
        return redirect()->route('students.index')->with('success', 'Item created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $faculties = $this->facultyRepo->pluck('name', 'id');
        $student = $this->studentRepo->find($id);
        return view('students.edit_create', compact('student', 'faculties'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $getAll = $request->all();
        if ($request->has('avatar')) {
            $file_name = $request->file('avatar');
            $post_file = $file_name->move('images', $file_name->getClientOriginalName());
        }
        $getAll['avatar'] = $post_file;
        $student = $this->studentRepo->find($id);
        $student->update($getAll);

        return redirect()->route('students.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $this->studentRepo->find($id)->delete();

        return redirect()->route('students.index');
    }

    public function addPoint($id)
    {

//        $student = $this->studentsRepo->find($id);
//        $subject = $student->subjects->pluck('name', 'id')->toArray();
//        $subjects = $this->subjectsRepo->getAll();
        $getSubjects = $this->subjectRepo->getAll();
        $findStudentId = $this->studentRepo->find($id);
        $getSubjectsById = $findStudentId->subjects;
//        dd($getSubjectsById);
//        $getUnnsubjects = $getSubjects->diff($getSubjectsById)->pluck('name', 'id')->toArray();
//        dd($getSubjectsById);

        return view('students.addPointSubject', compact('getSubjects', 'findStudentId', 'getSubjectsById',));
    }

    public function savePoint(Request $request, $id)
    {


        $data = [];
        foreach ($request->subject_id as $item => $value) {
            array_push($data, [
                'subject_id' => $request->subject_id[$item],
                'point' => $request->point[$item],
            ]);
        }

        $point = [];
        foreach ($data as $key => $value) {
            $point[$value['subject_id']] = ['point' => $value['point']];
        }

        $this->studentRepo->find($id)->subjects()->sync($point);
//        $this->studentsRepo->find($student_id)->subjects()->sync($request->subject_id);

        return redirect()->route('students.index');
    }

    public function search(Request $request)
    {
        $students = $this->studentRepo->search($request->all());
        return view('students.index', compact('students'))->with('i');
    }

    public function badstudent(Request $request){
        $badstudents=$this->studentRepo->badStudent();

        SendEmail::dispatch($badstudents);
        return redirect()->back();
    }

}
