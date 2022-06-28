@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h3>Faculty Management</h3>
                </div>

                <div class="col-md-6">
                    <a href="{{route('faculties.create')}}" class="btn btn-primary float-end">ADD</a>
                </div>

            </div>

        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <thead>
                <tr>
                    <th style="text-align: center;width:100px">#</th>
                    <th style="text-align: center;">Faculty</th>
                    <th style="width: 180px;text-align: center;">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($faculties as $faculty)
                    <tr>

                        <td> {{++$i}}</td>
                        <td>{{$faculty->name}}</td>
                        <td>
                            {!! Form::model($faculty, ['route'=>['faculties.destroy', $faculty->id], 'method'=>'DELETE'] ) !!}
                            <a href="{{route('faculties.edit', $faculty->id)}}" class="btn btn-info"> Edit</a>
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
        {{$faculties   ->links("pagination::bootstrap-5")}}
    </div>

@endsection
