@extends('layouts.app')

{{Html::style('css/main.css')}}
@section('content')
<div class="container">
  <div class="row">
        <div class="col-md-2 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="{{url('/publish')}}">发布宝贝</a></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">宝贝列表</div>

                <div class="panel-body">
                   {!! Form::open(array('url' => '/publish' ,'enctype' => "multipart/form-data")) !!}
                        {!! Form::label('name','宝贝名称:') !!}
                        {!! Form::text('name','',array('class'=>'form-control inputform'))  !!}
                        <br/><br/>
                        {!! Form::label('image','图片:') !!}
                        {!! Form::file('item_pic') !!}
                        <br/><br/>
                        {!! Form::label('type','价格:') !!}
                        {!! Form::text('price','',array('class'=>'form-control inputform'))  !!}
                        <br/><br/>
                        {!! Form::label('spec','描述:') !!}
                        {!! Form::textarea('desc','',array('class'=>'form-control inputform'))  !!}
                        <br/><br/>
                       
                    {!! Form::submit('提交',array('class'=>'btn btn-danger', 'name'=>'add'))  !!}
                        <a href="{{url('/home')}}" class="btn btn-danger">取消</a>
                        {{-- {!! Form::button('取消',array('class'=>'btn btn-danger'))  !!} --}}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
  
</div>
@endsection
