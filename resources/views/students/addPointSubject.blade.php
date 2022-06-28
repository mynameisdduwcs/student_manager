@extends('layouts.app')

@section('content')

        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4>ADD POINT</h4>
                    </div>
                    <div class="col-md-6">
                        <a href="{{route('students.index')}}" class="btn btn-primary float-end">Student list</a>
                        {!! Form::button('Add Subject', ['class'=>['btn2','btn btn-danger float-end'],'style'=>'margin-right: 10px']) !!}

                        <p id="count-subject" hidden>{{count($getSubjects)}} </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            {{Form::open(['route'=>['students.savePoint',$findStudentId->id], 'method'=>'POST','enctype' => "multipart/form-data" ])}}
            <table class="table table-bordered">
                <thead>
                <tr>

                    <th style="text-align: center">Subject</th>
                    <th style="text-align: center">Point</th>
                    <th style="text-align: center">#</th>
                </tr>
                </thead>

                <tbody id="formadd">
                @foreach($getSubjectsById as $subject)
                    <tr>
                        <td>

                            {!! Form::select('subject_id[]', [$subject->id => $subject->name], null, ['class'=>'form-select']) !!}
                        </td>
                        <td>
                            {!! Form::text('point[]', $subject->pivot->point, ['class' => 'form-control']) !!}
                        </td>
                        <td>
                            {!! Form::button('DELETE', ['class'=>['delete','btn btn-danger']]) !!}
                        </td>
                    </tr>
                @endforeach
                <tr class= "addform" style="display: none">
                    <td>
                        {!! Form::select('subject_id[]' , $getSubjects->pluck('name','id'),null, ['class'=>'form-select']) !!}
                    </td>
                    <td>
                        {!! Form::text('point[]','0', ['class' => 'form-control']) !!}
                    </td>
                    <td>
                        {!! Form::button('DELETE', ['class'=>['delete','btn btn-danger']]) !!}
                    </td>
                </tr>
                </tbody>
            </table>
            {!! Form::submit('Submit', ['class' => 'btn btn-info','id'=>'saveform']) !!}
            {!! Form::close() !!}
        </div>


@endsection
