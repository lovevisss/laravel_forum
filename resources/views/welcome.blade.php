@extends('layouts.app')

{{Html::style('css/main.css')}}
{{Html::script('js/item.js')}}
@section('content')
<div class="container">
  <div class="row">
        <div class="col-md-2 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="{{url('/publish')}}">发布宝贝</a></div>
            </div>
        </div>
         <div class="col-md-2">
            <div class="panel panel-default">
                <div class="panel-heading"><a href="{{url('/publish')}}">出售中的宝贝</a></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">全部宝贝列表</div>
                <?php
                    $id = Auth::user()->id;
                    $name =  Auth::user()->name;
                ?>
                <div class="panel-body">
                    @foreach($items as $item)
                        <div class="item clearfix">
                            <a class="close" href="javascript:;">x</a>
                            <img src="{{$item->author->avatar}}" alt="" class="icon">
                            <div class="content">
                              
                                <div class="price fa fa-jpy"> {{$item->price}} <br><div class="btn btn-danger btn_buy">购买</div></div>  
                                <span><a href="#">{{$item->author->name}}:</a></span>
                                <br>
                               
                                <p> <span>{{$item->name}}:</span>
                                描述:{{$item->desc}}</p>
                                <img src="{{$item->picture}}" alt="" class="item_pic">
                                <div class="info clearfix">
                                    <span class="fa fa-globe">{{$item->created_at}}</span>
                                    <?php
                                        $dezan = json_decode($item->zan,true);
                                        if(is_null($dezan))  //如果为空
                                        {
                                            $num = 0;
                                            $flag = 0;
                                        }
                                        else{ 
                                            if(array_key_exists($name, $dezan)){
                                                    $flag = 1;
                                                 }
                                            else{
                                                $flag = 0;
                                            }
                                            $num = count($dezan);
                                        }
                                    ?>
                                    @if ($flag == 0)
                                        <a href="javascript:;" class="fa fa-thumbs-o-up zan" data-id="{{$item->id}}"> {{$num}}</a>
                                    @else
                                        <a href="javascript:;" class="fa fa-thumbs-up zan" data-id="{{$item->id}}"> {{$num}}</a>
                                    @endif
                                </div>
                                <ul class="zanlist clearfix" data-id="{{$item->id}}">
                                    <?php

                                    if(!is_null($dezan))
                                    {
                                         foreach(array_reverse($dezan) as $item_user){
                                             $user = App\User::find($item_user);
                                             if(!is_null($user))
                                             {
                                                ?>
                                                <li  data-id="{{$user->id}}"><a href="#"><img src="{{$user->avatar}}" class="zan_icon"></a></li>
                                                <?php
                                             }
                                         }
                                    }
                                   
                                    ?>
                                </ul>
                                <ul class="comment_list clearfix">
                                    @foreach($item->comments as $single_comment)
                                        <li class="comment_li"><a href="#"><img src="{{App\User::find($single_comment->uid)->avatar}}" alt="" class="comment_icon">
                                            @if(Auth::user()->id == App\User::find($single_comment->uid)->id)
                                                我:
                                            @else
                                                {{App\User::find($single_comment->uid)->name}}:
                                            @endif
                                        </a>{{$single_comment->comment}}<br><span class="time">{{$single_comment->created_at}}</span></li>
                                    @endforeach
                                </ul>
                                <div class="comment">
                                    
                                    <textarea name="" id="" cols="30" rows="10" class="comment_box">评论…</textarea>
                                    <button class="btn btn-primary btn_comment" data-id="{{$item->id}}">回复</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
  
</div>
@endsection
