@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-3">
                    <h4>Student Management</h4>
                </div>
                <div class="col-md-7">
                    @include('students.search')
                </div>
                <div class="col-md-1">
                    <a href="{{route('badstudents')}}" class="btn btn-primary float-end">Bad Student</a>
                </div>
                <div class="col-md-1">
                    <a href="{{route('students.create')}}" class="btn btn-primary float-end">ADD</a>
                </div>

            </div>

        </div>


        <div class="card-body">


            <table class="table table-bordered">

                <thead>
                <tr>
                    <th style="text-align: center;width:10px;font-size: 70%">#</th>
                    <th style="text-align: center;width:65px;font-size: 70%">Name student</th>
                    <th style="text-align: center;width:65px;font-size: 70%">Avatar</th>
                    <th style="text-align: center;width:65px;font-size: 70%">Gender</th>
                    <th style="text-align: center;width:65px;font-size: 70%">Birthday</th>
                    <th style="text-align: center;width:65px;font-size: 70%">Home town</th>
                    <th style="text-align: center;width:65px;font-size: 70%">Phone number</th>
                    <th style="text-align: center;width:65px;font-size: 70%">Email</th>
                    <th style="text-align: center;width:65px;font-size: 70%">Faculty</th>
                    <th style="text-align: center;width:65px;font-size: 70%">Description</th>
                    <th style="text-align: center;width:65px;font-size: 70%">Action</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($students as $student)
                    <tr>
                        <td> {{++$i}}</td>
                        <td>{{$student->fullName}}</td>
                        <td><img style="width:60px; height:80px ;" src="{{$student->avatar}}"></td>
                        <td>{{$student->gender===1 ? "Nam" : "Nữ"}}</td>
                        <td>{{$student->birthdate}}</td>
                        <td>{{$student->hometown}}</td>
                        <td>{{$student->phone}}</td>
                        <td>{{$student->email}}</td>
                        <td>{{$student->id}}</td>
                        <td>{{$student->description}}</td>
                        <td>
                            {!! Form::model($student, ['route' => ['students.destroy', $student->id], 'method' => 'DELETE']) !!}
                            <a href="{{route('students.edit', $student->id)}}" class="btn btn-info"> Edit</a>
                            {{--                            <a href="{{route('students.subjects.index', $student->id)}}" class="btn btn-success">--}}
                            {{--                                Subject</a>--}}
                            <a href="{{route('students.addpoint.index', $student->id)}}" class="btn btn-dark">
                                Point</a>
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div style="margin-left: auto;margin-right: auto;width: 100%;">
        {{$students->links("pagination::bootstrap-5")}}
    </div>

@endsection
