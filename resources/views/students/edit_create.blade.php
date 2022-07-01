@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h4>{{isset($student->id)? 'EDIT':'ADD'}} STUDENT</h4>
                </div>
                <div class="col-md-6">
                    <a href="{{route('students.index')}}" class="btn btn-primary float-end">Student list</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        @if(isset($student))
            {!! Form::model($student, ['route' => ['students.update', $student->id], 'method'=>'put', 'enctype'=>'multipart/form-data']) !!}
        @else
            {{ Form::open(array('route' => 'students.store','method' => 'post','enctype' => "multipart/form-data")) }}
        @endif

        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <strong>Student name</strong>
                    <div class="row g-3">
                        <div class="col">
                            {!! Form::text('first_name',isset($student->first_name)?$student->first_name:null, ['class'=>'form-control', 'placeholder' => 'First Name']) !!}
                        </div>
                        <div class="col">
                            {!! Form::text('last_name',isset($student->last_name)?$student->last_name:null, ['class'=>'form-control','placeholder' => 'Last Name']) !!}
                        </div>
                    </div>
                </div>

                <div class=" form-group">
                    <strong> Avatar </strong>
                    {!! Form::file('avatar', ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    <strong> Gender </strong>
                    <div class="col-lg-10">
                        <label class="radio-inline">
                            {{Form::radio('gender', '1', true)}} Nam
                        </label>
                        <label class="radio-inline">
                            {{Form::radio('gender', '0', true)}} Nữ
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <strong> Birthday </strong>
                    {!! Form::date('birthdate',isset($student->birthdate)?$student->birthdate:null, ['class'=>'form-control']) !!}
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <strong> Home town </strong>
                    {!! Form::text('hometown',isset($student->hometown)?$student->hometown:null, ['class'=>'form-control','placeholder' => 'Enter Home town']) !!}
                </div>

                <div class="form-group">
                    <strong> Phone number </strong>
                    {!! Form::text('phone',isset($student->phone)?$student->phone:null, ['class'=>'form-control','placeholder' => 'Enter Phone number']) !!}
                </div>

                <div class="form-group">
                    <strong> Email </strong>
                    {!! Form::text('email',isset($student->email)?$student->email:null, ['class'=>'form-control','placeholder' => 'Enter Email']) !!}
                </div>

                <div class="form-group">
                    <strong> Faculty </strong>
                    {!! Form::select('faculty_id', $faculties, isset($student->id)?$student->id:null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    <strong> Descripttion </strong>
                    {!! Form::textarea('description', isset($student->description)?$student->description:null,['class'=>"form-control",'placeholder' => 'Description']) !!}
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-success mt-2">Submit</button>
        {!! Form::close() !!}
    </div>

@endsection()
