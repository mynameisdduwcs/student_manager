@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h4>{{isset($faculty->id)? 'EDIT':'ADD'}} FACULTY</h4>
                </div>
                <div class="col-md-6">
                    <a href="{{route('faculties.index')}}" class="btn btn-primary float-end">Student list</a>
                </div>
            </div>

        </div>
    </div>
    <div class="card-body">
        @if(isset($faculty))
            {!! Form::model($faculty, ['route' => ['faculties.update', $faculty->id], 'method'=>'put', 'enctype'=>'multipart/form-data']) !!}
        @else
            {{ Form::open(array('route' => 'faculties.store','method' => 'post','enctype' => "multipart/form-data")) }}
        @endif

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Faculty</strong>
                    {!! Form::text('name',isset($faculty->name)?$faculty->name:null,['class'=>'form-control']) !!}
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success mt-2">Update</button>
        {!! Form::close() !!}
    </div>

@endsection()
