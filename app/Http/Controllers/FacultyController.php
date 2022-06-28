<?php

namespace App\Http\Controllers;

use App\Repositories\Faculty\FacultyRepository;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $facultyRepo;

    public function __construct(FacultyRepository $facultyRepo)
    {
        $this->facultyRepo = $facultyRepo;
    }

    public function index()
    {

        $faculties = $this->facultyRepo->paginate(5);
        return view('faculties.index', compact('faculties'))->with('i');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('faculties.edit_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->facultyRepo->create($request->all());
        return redirect()->route('faculties.index');
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
        $faculty = $this -> facultyRepo->find($id);
        return view('faculties.edit_create',compact('faculty'));

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
        $faculty = $this ->facultyRepo->find($id);
        $faculty->update($request->all());
        return redirect()->route('faculties.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $faculty =$this ->facultyRepo->find($id);
        $faculty->delete();
        return redirect()->route('faculties.index');
    }
}
