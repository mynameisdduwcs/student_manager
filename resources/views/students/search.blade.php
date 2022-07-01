{{Form::open(['method' => 'GET', 'route' => 'students.search', 'class' => 'form-inline'])}}
<div class="form-group" style="margin-right: 20px">
    {{Form::label('min_age','Age: ')}}
    {{Form::text('min_age',isset($data['min_age']) ? $data['min_age'] : null, ['class' => 'form-control','style' => 'width: 45px'])}}
    {{Form::label('max_age','To ')}}
    {{Form::text('max_age',isset($data['max_age']) ? $data['max_age'] : null, ['class' => 'form-control','style' => 'width: 45px'])}}
</div>

<div class="form-group" style="margin-right: 20px">
    {{Form::label('min_point','Point: ')}}
    {{Form::text('min_point',isset($data['min_point']) ? $data['min_point'] : null, ['class' => 'form-control','style' => 'width: 45px'])}}
    {{Form::label('max_point','To ')}}
    {{Form::text('max_point',isset($data['max_point']) ? $data['max_point'] : null, ['class' => 'form-control','style' => 'width: 45px'])}}
</div>
<div class="form-group" style="margin-right: 15px">
    {{Form::label('phone','Phone: ')}}
    &nbsp;{{Form::checkbox('viettel', 'Viettel', '',['id' => 'viettel'])}} &nbsp; {{Form::label('viettel', 'Viettel')}}
    &nbsp;{{Form::checkbox('mobifone', 'Mobifone', '',['id' => 'mobifone'])}} &nbsp; {{Form::label('mobifone', 'Mobifone')}}
    &nbsp;{{Form::checkbox('vinaphone', 'Vinaphone', '',['id' => 'vinaphone'])}} &nbsp; {{Form::label('vinaphone', 'Vinaphone')}}
{{--    {{ Html::image('images/picture.jpg', 'a picture', ['class' => 'thumb']) }}--}}
{{--    {!! Form::checkbox('subject_id[]',$item->id,$student->subjects->contains($item->id)?'checked':'',['class' => 'form-check-input']) !!}--}}
</div>
<div class="form-group" style="margin-right: 15px">
    {{Form::label('learn_status','Finished: ')}}
    {{Form::select('learn_status',['all'=> 'All','finished'=>'Finished', 'unfinished'=>'Unfinished'], request('learn_status'))}}
</div>


<div>
{{--    {!! Form::submit('Search', ['class' => 'fa-solid fa-magnifying-glass']) !!}--}}
    {!! Form::button('<i class="fa-solid fa-magnifying-glass"></i>', ['class' => 'btn btn-info btn-sm', 'type' => 'submit']) !!}
</div>
{!! Form::close() !!}
