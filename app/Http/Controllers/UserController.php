<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
class UserController extends Controller
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
    // public function index()
    // {
    //     return view('home');
    // }

    // public function welcome()
    // {
    //    return view('welcome');
    // }

    public function personal_info()
    {
       $uid = Auth::user()->id;
       $url = User::find($uid)->avatar;
       return view('personal.info')->with(array('avatar' => $url));
    }

    public function getinfo(Request $request)
    {
        $uid = Auth::user()->id;
        $user = User::find($uid);
        // dd($user);
        $image = $request->file('image');
        $filename = $uid."-Avatar_".date('Y-m-d.').$image->getClientOriginalExtension();
        $filepath = 'img/personal';
        $path = $image->move('img/personal/',$filename);
        // Image::make($image->getRealPath())->resize(468,249)->save('public/i
        // mg/personal'.$filename);
        $user->avatar = $path;
        $user->save();
        return view('personal.info')->with(array('avatar' => $path));

    }

    public function test(Request $request)
    {
        // $item = User::find(1)->items()->get();
        // echo $item;
        // 
        $array = array(
            'touser'=>'o4s0awoGuRl40KH6nLcXD2jsQVI4',
            'text'=> array(
                'content'=>urlencode('这是一个文本'),
                ),
            'msgtype'=>'text',
            );

        $string = "0,1";
        $array = explode(",", $string);
        $postJson = urldecode(json_encode($array));
        $deJson = json_decode($postJson);
        // $id = $request->input('postid');
        foreach ($array as $key => $value) {
            if(intval($value) == 1)
                return 'exist';
        }
        return 'not';
      //   if(Request::ajax()) {
      // $data = Input::all();
      // print_r($data);die;
    
      //   }
    }



}
