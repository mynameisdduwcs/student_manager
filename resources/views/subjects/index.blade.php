@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h3>Subject Management</h3>
                </div>

                <div class="col-md-6">
                    <a href="{{route('subjects.create')}}" class="btn btn-primary float-end">ADD</a>
                </div>

            </div>

        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th style="text-align: center;width:100px">#</th>
                    <th style="text-align: center;">Subjects</th>
                    <th style="width: 180px;text-align: center;">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($subjects as $subject)
                    <tr>
                        <td> {{++$i}}</td>
                        <td>{{$subject->name}}</td>
                        <td>
                            {!! Form::model($subject, ['route'=>['subjects.destroy', $subject->id], 'method'=>'DELETE'] ) !!}
                            <a href="{{route('subjects.edit', $subject->id)}}" class="btn btn-info"> Edit</a>
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
        {{$subjects->links("pagination::bootstrap-5")}}
    </div>

@endsection
