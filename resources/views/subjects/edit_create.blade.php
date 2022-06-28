@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h3>{{isset($subject->id)? 'EDIT':'ADD'}} SUBJETC </h3>
                </div>
                <div class="col-md-6">
                    <a href="{{route('subjects.index')}}" class="btn btn-primary float-end">List subject </a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">

        @if(isset($subject))
            {!! Form::model($subject, ['route' => ['subjects.update', $subject->id], 'method'=>'put', 'enctype'=>'multipart/form-data']) !!}
        @else
            {{ Form::open(array('route' => 'subjects.store','method' => 'post','enctype' => "multipart/form-data")) }}
        @endif

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <strong>Subject title</strong>

                    {!! Form::text('name',isset($subject->name)?$subject->name:null,['class'=>'form-control']) !!}
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success mt-2">{{isset($subject)? 'UPDATE':'ADD'}}</button>
        {!! Form::close() !!}
    </div>

@endsection()
