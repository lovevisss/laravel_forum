



  var navbtn = document.getElementsByClassName('dropdown-toggle');
  if(navbtn[0] != null)
  {

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

  }
 
