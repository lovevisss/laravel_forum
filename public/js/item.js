var index = 0;
var timer;
window.onload = function () {
	$(".zan").click(function() {
     $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
    });
		 // $.post('/base/public/home', {add: '1'}, function(data, textStatus) {
   //     /*optional stuff to do after success */
   //     alert('1');
   //   });  
    $container = $(this);
    $id = $(this).attr("data-id");
    var uls = $container.parent().next();
    // alert($(uls).attr('data-id'));
    var li_list = $(uls).find('li');
    // $my_li = $(li_list[1]);
    // alert(li_list.length);
   
    // alert($container.siblings('ul').attr('data-id'));
    $.ajax({

           method : 'POST' ,
           url : 'home' ,
           data: { data_id: $id, action:'1'  }})

          .done(function(msg) {


             for (var i = 0; i < li_list.length; i++) {

              if($(li_list[i]).attr('data-id') == msg['uid'])
              {
                $my_li = $(li_list[i]);
                // alert($(li_list[i]).attr('data-id'));
                break;
              }

            }
            // console.log(msg['message']);
            // alert(msg['avatar']);
            if(msg['action'] == 'active')   //点赞后处理
            {
              // alert($(this).attr('data-id'));
              // alert(msg['count']);
              $container.html(" "+msg['count']);
              $container.addClass('fa-thumbs-up');
              $container.removeClass('fa-thumbs-o-up');
              $(uls).prepend("<li  data-id="+msg['uid']+"><a href='#'><img src="+msg['avatar']+" class='zan_icon'></a></li>");
              // alert(msg['action']);
            }
            else if(msg['action'] == 'close')   //取消点赞处理
            {
              // alert(msg['count']);
              $container.html(" "+msg['count']);
              $container.addClass('fa-thumbs-o-up');
              $container.removeClass('fa-thumbs-up');
              $my_li.remove();
              // alert(msg['action']);
            }


              });
      	}
);

  var navbtn = document.getElementsByClassName('dropdown-toggle');

  navbtn[0].onclick = function () {
    $flag = $(this).attr("aria-expanded");
    if($flag == "false")
    {
      $(this).parent().addClass('open');
      $(this).attr("aria-expanded","true");

    }
    else
    {
      $(this).parent().removeClass('open');
      $(this).attr("aria-expanded","false");
    }
  }


 $(".btn_comment").click(function(event) {
    /* Act on the event */
    $commentbox = $(this).parent();
    text = $commentbox.find('textarea');
    content = $commentbox.parent();
    comment_list = content.find('.comment_list');

    $id = $(this).attr("data-id");
    $to_user = $(this).attr("data-to-user");
    if($.trim($(text[0]).val()) == "")
    {
      alert("内容不能为空");
      return;
    }
    // alert($(text[0]).val());
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
    });
    $.ajax(
          {
            url: 'comment',
            method : 'POST' ,
            data: { data_id: $id, comment:$(text[0]).val(), to_user: $to_user}})
    .done(function(msg) {

      console.log("success");
      text.val("评论…");
      // $(".comment_box").focus();
      // $(".comment_box").blur();
      $commentbox.removeClass('text-box-on');
      $(comment_list[0]).append("<li class='comment_li'><a href='#'><img src=" + msg['avatar'] + " class='comment_icon'>"+"我:" + "</a>" + "<a href='javascript:;' class='reply' comment-id="+ msg['comment_id']+">删除</a>"+msg['comment'] + "<br><span class='time'>" + msg['time'] +"</span></li>");
    })
    .fail(function() {
      console.log("error");
    })
    .always(function() {
      console.log("complete");
    });
    
  });


 $(".comment_box").focus(function(event) {
        // alert("fl");
        $(this).select();
        $(this).parent().addClass('text-box-on');
        $(this).next().next().html($(this).val().length + "/140"); //获取文字节点
        $(this).next().removeAttr('disabled');
 });
 $(".comment_box").blur(function(event) {
        $val = $(this).val();
        $comment_box = $(this);
        if($val == '评论…' || $.trim($val) == "")
        {
          timer = setTimeout(function () {
                    $comment_box.val('评论…');
                    $comment_box.parent().removeClass('text-box-on');
                }, 200);

        }
 });

 $(".comment_box").keyup(function(event) {
   $val = $(this).val();
   var len = $val.length;
   var els = $(this).parent().children();
   var btn = els[1];
   var word = els[2];
   if(len <= 0 || len > 140)
   {
    $(btn).addClass('btn-off');
    $(btn).attr('disabled', 'true');
   }
   else{
    $(btn).removeClass('btn-off');
    $(btn).removeAttr('disabled');
   }
   $(word).html(len + '/140');
 });

 $(".close").click(function(event) {
   $(this).parent().remove();
 });

 $(".comment_list").on('click', '.reply', function(event) {
    comment_li = $(this).parent();

    $user_id = $(this).attr("user-id");
    $user_name = $(this).attr("user-name");
    if($(this).html() == "删除")  //删除
    {
     $comment_id = $(this).attr("comment-id");
     $.ajaxSetup({
         headers: { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
     });
     $.ajax(
           {
             url: 'delete_comment',
             method : 'POST' ,
             data: { comment_id: $comment_id}})
     .done(function(msg) {
       $(comment_li).remove();
     });
    }
    else{
        comment = $(comment_li).parent().next();  
        $(comment).addClass('text-box-on');        //回复
        comment_box = $(comment).find('.comment_box');
        $(comment_box[0]).val("回复"+$user_name+":").focus();
        btn_comment = $(comment).find('.btn_comment');
        $(btn_comment[0]).attr('data-to-user', $user_id);
    }
  });

}




