<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Jobs\SendEmail;
use App\Models\Student;
use App\Models\User;
use App\Repositories\Faculty\FacultyRepositoryInterface;
use App\Repositories\Student\StudentRepositoryInterface;
use App\Repositories\Subject\SubjectRepositoryInterface;
use App\Repositories\SubjectScore\SubjectScoreRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\Mail\MailNotify;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Psy\Util\Str;

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
    protected $userRepo;

    public function __construct(
        StudentRepositoryInterface      $studentRepo,
        FacultyRepositoryInterface      $facultyRepo,
        SubjectRepositoryInterface      $subjectRepo,
        SubjectScoreRepositoryInterface $pointRepo,
        UserRepositoryInterface         $userRepo,
    )
    {
        $this->studentRepo = $studentRepo;
        $this->facultyRepo = $facultyRepo;
        $this->subjectRepo = $subjectRepo;
        $this->pointRepo = $pointRepo;
        $this->userRepo = $userRepo;
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
        $faculties = $this->facultyRepo->pluck('name', 'id');
        $students = $this->studentRepo->getAll();
        $users = $this->userRepo->getAll();

        return view('students.edit_create', compact('students', 'faculties', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentRequest $request)
    {
        $getAll = $request->all();
        if ($request->has('avatar')) {
            $file_name = $request->file('avatar');
            $getAll['avatar'] = $file_name->move('images', time() . '_' . $file_name->getClientOriginalName());
        }
        $getAll['password'] = Hash::make('123456789');
        $student = $this->studentRepo->create($getAll);
        $getAll['name'] = $student->name;
        $getAll['student_id'] = $student->id;
        $this->userRepo->create($getAll);

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
    public function update(StudentRequest $request, $id)
    {
        $getAll = $request->all();

        if ($request->has('avatar')) {
            $file_name = $request->file('avatar');
            $getAll['avatar']  = $file_name->move('images', time() . '_' . $file_name->getClientOriginalName());
        }else{
            unset($getAll['avatar']);
        }

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
        $students = $this->studentRepo->find($id);
        $user = User::where('student_id',$id)->first();
        if(isset($user->social_type))
        {
            $this->studentRepo->delete($id);
        }
        else{
            unlink($students->avatar);
        }
        $this->userRepo->query()->where('student_id',$id)->delete();
        return redirect()->route('students.index');
    }

    public function addPoint($id)
    {
        $getSubjects = $this->subjectRepo->getAll();
        $findStudentId = $this->studentRepo->find($id);
        $getSubjectsById = $findStudentId->subjects;

        return view('students.addPointSubject', compact('getSubjects', 'findStudentId', 'getSubjectsById',));
    }

    public function savePoint(StudentRequest $request, $id)
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

        return redirect()->route('students.index');
    }

    public function search(StudentRequest $request)
    {
        $students = $this->studentRepo->search($request->all());

        return view('students.index', compact('students'))->with('i');
    }

    public function sendMail(StudentRequest $request)
    {
        $badstudents = $this->studentRepo->badStudent();
        SendEmail::dispatch($badstudents);

        return redirect()->back();
    }

    public function showProfile($id)
    {
        $user = $this->userRepo->find($id);
        $student=$this->studentRepo->query()->where('id',$user->student_id)->first();

        return view('students.profile', compact('user','student'));
    }


}
