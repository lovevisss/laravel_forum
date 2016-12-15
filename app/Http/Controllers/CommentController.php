<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
class CommentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
   

    public function post_comment(Request $request)
    {
       $comment = $request->input('comment');
       $id = $request->input('data_id');
       $to_user = $request->input('data-to-user');
       $uid = Auth::user()->id;
       if(is_null($to_user))
       {
            $com = Comment::create(['itemid' => $id,
                                'comment' => $comment,
                                'uid' => $uid

                ]);

       }
       else{


       }

       $ret = array(
                "comment" => $comment,
                "to_user" => $to_user,
                "id" => $id,
                "avatar" => Auth::user()->avatar,
                "time" => date('Y-m-d H:i:s',time())
        );
       return $ret;
    }


    

}
