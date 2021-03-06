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
                    <a href="{{route('send-mail')}}" class="btn btn-warning float-end"><i
                            class="fa-solid fa-triangle-exclamation"></i></a>
                </div>
                <div class="col-md-1">
                    <a href="{{route('students.create')}}" class="btn btn-success float-end"><i
                            class="fa-solid fa-plus"></i></a>
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
                        <td>{{$student->name}}</td>
                        <td><img style="width:60px; height:80px ;" src="{{$student->avatar}}"></td>
                        <td>{{$student->gender===1 ? "Nam" : "N???"}}</td>
                        <td>{{$student->birthdate}}</td>
                        <td>{{$student->phone}}</td>
                        <td>{{$student->email}}</td>
                        <td>{{$student->faculty_id}}</td>
                        <td>{{$student->description}}</td>
                        <td>
                            {!! Form::model($student, ['route' => ['students.destroy', $student->id], 'method' => 'DELETE']) !!}
                            {{--                            {!! Html::linkRoute('students.edit','da', [$student->id,'class'=>'fa-solid fa-pen-to-square']) !!}--}}
                            {{--                            <a href="{{route('students.edit', $student->id)}}" class="btn btn-info"> <i class="fa-solid fa-pen-to-square"></i></a>--}}
                            {{--                            <a href="{{route('students.addpoint.index', $student->id)}}" class="btn btn-dark"><i class="fa-solid fa-book-open"></i></a>--}}
                            {!! Html::decode(link_to_route('students.edit', '<i class="fa-solid fa-pen-to-square"></i>',[$student->id ], ['class' => 'btn btn-info'])) !!}
                            {!! Html::decode(link_to_route('students.addpoint.index', '<i class="fa-solid fa-book-open"></i>',[$student->id ], ['class' => 'btn btn-dark'])) !!}
                            {!!  Form::button('<i class="fa-solid fa-trash-can"></i>', ['class' => 'fa-solid btn btn-danger', 'type' => 'submit'])  !!}
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
