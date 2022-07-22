<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Student;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Repositories\Faculty\FacultyRepositoryInterface;
use App\Repositories\Student\StudentRepositoryInterface;
use App\Repositories\Subject\SubjectRepositoryInterface;
use App\Repositories\SubjectScore\SubjectScoreRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    protected $studentRepo;
    protected $userRepo;
    protected $facutyRepo;

    /**
     * Create a new controller instance.
     *
     * @param StudentRepositoryInterface $studentRepo
     * @param UserRepositoryInterface $userRepo
     */
    public function __construct(StudentRepositoryInterface $studentRepo, UserRepositoryInterface $userRepo, FacultyRepositoryInterface $facutyRepo)
    {
        $this->middleware('guest');
        $this->studentRepo = $studentRepo;
        $this->facutyRepo = $facutyRepo;
        $this->userRepo = $userRepo;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getData()
    {
        $faculties = $this->facutyRepo->getAll()->pluck('name', 'id');

        return view('auth.register', compact('faculties'));
    }

    public function customRegister(RegisterRequest $request)
    {
        $data = $request->all();
        $newuser = $this->userRepo->create($data);
        if ($request->has('avatar')) {
            $file = $request->file('avatar');
            $data['avatar'] = $file->move('images', time() . '_' . $file->getClientOriginalName());
        }
        $students = $this->studentRepo->create($data);
        $this->userRepo->find($newuser->id)->update([
            'student_id' => $students->id,
        ]);
        Auth::login($newuser);

        return redirect()->route('profile',Auth::id());
    }

}
