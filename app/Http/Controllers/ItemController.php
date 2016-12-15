<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
class ItemController extends Controller
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
   

    public function get_add_item()
    {
       return view('publish');
    }


    public function post_add_item(Request $request)
    {

      
        $uid = Auth::user()->id;
        $desc = Input::get('desc');
        $item_name = Input::get('name');
        $price = Input:: get('price');
        // $str = Input::get('add');
        // echo $str;
        // echo $item_name.$desc.$price;
        //store in database
        $item =  Item::create(
            array(
                'name'=>$item_name,
                'price'=>$price,
                'desc'=>$desc,
                'seller'=>$uid,
                )
            );

        $image = $request->file('item_pic');
        $filename = "Item_".$item_name.date('Y-m-d.').$image->getClientOriginalExtension();
        $filepath = 'img/personal';
        $path = $image->move('img/item/'.$uid.'/',$filename);
        $item->picture = $path;
        $item->save();
        $items = Item::with('author')->get();
        return view('welcome')->with(array('items' => $items));
    }

    public function get_item_list()
    {


        $items = Item::with('author','comments')->get();
        // foreach ($items as $item) {
           
        // // echo $item->comments;
        // if($item->comments)
        // {
        //      foreach ($item->comments as $cp) {
        //         echo $cp->comment;
        //         }
        // }
        // }
        return view('welcome')->with(array('items' => $items));
    }


    public function getinfo(Request $request)
    {
        $uid = Auth::user()->id;
        $user = User::find($uid);
        // dd($user);
        $image = $request->file('image');
        $filename = $uid."-Avatar_".date('Y-m-d.').$image->getClientOriginalExtension();
        $filepath = 'img/personal';
        // $file = fopen($filepath.$filename,"w");//打开文件准备写入

        // fwrite($file,$image);//写入

        // fclose($file);//关闭
        $path = $image->move('img/personal/',$filename);
        // Image::make($image->getRealPath())->resize(468,249)->save('public/i
        // mg/personal'.$filename);
        $user->avatar = $path;
        $user->save();
        return view('personal.info')->with(array('avatar' => $path));

    }

    public function zan(Request $request)
    {
        $item_id = $request->input('data_id');
        // return $item_id;
        $item = Item::find($item_id);
        $zan = $item->zan;
        // echo $zan;
        $deJson_zan = array();
        if($zan != null)
            {
                $deJson_zan = json_decode($zan,true);
            }

        $uid = Auth::user()->id;
        $name = Auth::user()->name;
        $avatar = Auth::user()->avatar;
        // if($uid == $item->seller)
        // {
        //     return '不能给自己点赞';
        // }
        // 
        // $array2 = array('2'=>'test');

        // $array = array(
        //     $uid=>$name
        //     );
        
        if(!array_key_exists($name,$deJson_zan) || is_null($deJson_zan))  //如果不存在则添加记录
        {
            $deJson_zan[$name] = $uid; 
            $post  = json_encode($deJson_zan);
            $item->zan = $post;
            $item->save();
            $ret = array(
                "action" => 'active',
                "uid" => $uid,
                "count" => count($deJson_zan),
                "avatar" => $avatar
                );
        }
        else{
            // echo 'exits';
            unset($deJson_zan[$name]);
            $post  = json_encode($deJson_zan);
            $item->zan = $post;
            $item->save();
            $ret = array(
                "action" => 'close',
                "uid" => $uid,
                "count" => count($deJson_zan),
                "avatar" => $avatar
                );
        }
        return $ret;

       
        // return $post;
    }

}
