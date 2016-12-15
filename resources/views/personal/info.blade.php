@extends('layouts.app')

{{Html::style('css/main.css')}}
@section('content')
<div class="container">
 
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">个人信息</div>

                <div class="panel-body">
                   {!! Form::open(array('url' => 'info', 'enctype' => "multipart/form-data")) !!}
                        <img src="{{$avatar}}" alt=""  class="avatar">
                        {!! Form::label('image','上传头像') !!}
                        {!! Form::file('image') !!}
                        <br/><br/>
                        {!! Form::label('password','原始密码') !!}
                        {!! Form::text('password','',array('class'=>'form-control inputform'))  !!}

                        {!! Form::label('new_password','新密码') !!}
                        {!! Form::text('new_password','',array('class'=>'form-control inputform'))  !!}
                        {!! Form::label('confirm_new','确认新密码') !!}
                        {!! Form::text('confirm_new','',array('class'=>'form-control inputform'))  !!}
                        <br/><br/>
                        {!! Form::submit('提交',array('class'=>'btn btn-danger'))  !!}
                        <a href="{{url('/home')}}" class="btn btn-danger">取消</a>
                        {{-- {!! Form::button('取消',array('class'=>'btn btn-danger'))  !!} --}}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
  
</div>
@endsection
