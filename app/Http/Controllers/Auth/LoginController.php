<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Providers\RouteServiceProvider;
use App\Repositories\Faculty\FacultyRepositoryInterface;
use App\Repositories\Student\StudentRepositoryInterface;
use App\Repositories\Subject\SubjectRepositoryInterface;
use App\Repositories\SubjectScore\SubjectScoreRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    protected $studentRepo;
    protected $facultyRepo;
    protected $subjectRepo;
    protected $pointRepo;
    protected $userRepo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        StudentRepositoryInterface      $studentRepo,
        FacultyRepositoryInterface      $facultyRepo,
        SubjectRepositoryInterface      $subjectRepo,
        SubjectScoreRepositoryInterface $pointRepo,
        UserRepositoryInterface         $userRepo,
    )
    {
        $this->middleware('guest')->except('logout');
        $this->studentRepo = $studentRepo;
        $this->facultyRepo = $facultyRepo;
        $this->subjectRepo = $subjectRepo;
        $this->pointRepo = $pointRepo;
        $this->userRepo = $userRepo;
    }

    public function customLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('home');
        }
        return redirect()->route('login');
    }


    public function loginSocial($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function socialCallback($provider)
    {
        try {

            $user = Socialite::driver($provider)->user();

            $finduser = User::where('social_id', $user->id)->first();

            if ($finduser) {

                Auth::login($finduser);
                return redirect()->route('profile',Auth::id());

            } else {
                $newUser = User::create([
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'social_id' => $user->getId(),
                    'social_type' => $provider,
                    'password' => encrypt('123456')
                ]);
                $student=Student::create([
                    'name' => $user->getName(),
                    'avatar' => $user->getAvatar(),
                    'gender' => null,
                    'birthdate' => Carbon::now(),
                    'hometown' => null,
                    'phone' => null,
                    'faculty_id' => null,
                    'email' => $user->getEmail(),
                ]);
                $this->userRepo->find($newUser->id)->update([
                    'student_id' => $student->id,
                ]);


                Auth::loginUsingId($newUser->id);

                return redirect('/home');
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }


}
