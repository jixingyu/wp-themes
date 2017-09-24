
if (navigator.userAgent.toLowerCase().indexOf("chrome") >= 0) {
  $(window).load(function(){
    $('input:-webkit-autofill').each(function(){
      var text = $(this).val();
      var name = $(this).attr('name');
      $(this).after(this.outerHTML).remove();
      $('input[name=' + name + ']').val(text);
    });
  });
}


function addFavorite() {
	var url = window.location;
    var title = "优通供应链";
    var ua = navigator.userAgent.toLowerCase();
    if (ua.indexOf("360se") > -1) {
        alert("由于360浏览器功能限制，请按 Ctrl+D 手动收藏！");
    } else if (ua.indexOf("msie 8") > -1) {
        window.external.AddToFavoritesBar(url, title); //IE8
	} else if (document.all) {
    	try{
    		window.external.addFavorite(url, title);
    	}catch(e){
		  alert('您的浏览器不支持,请按 Ctrl+D 手动收藏!');
    	}
    } else if (window.sidebar) {
        window.sidebar.addPanel(title, url, "");
    } else {
    	alert('您的浏览器不支持,请按 Ctrl+D 手动收藏!');
    }
}

// toggle and href
$('.dropdown-toggle').on("click",".dropdown-toggle",function(){
  // if( $(window).width() > 767 ){
    console.log($(this));
    if($(this).attr('href')) window.location = $(this).attr('href');
  // }
});


(function(){
  // 企业用户登录
  // $('#qiyeuser').on('click',function(e){
  //   $('#frombg02').show();
  //   $('body').css({'overflow':'hidden'});
  // });
  $('#closefrom2').on('click',function(e){
    $('#frombg02').hide();
    $('body').css({'overflow':'auto'});
    restuserlogin();
  });
  function restuserlogin(){
    $('#form2-js input').val('').blur();;
    $('.errorlog').css({'z-index':'-1'}).text('');
  }

  var isqiyeuser=0,islogin = true,textareaway='';

  var $from2inputs = $('#form2-js').find('label');
  $from2inputs.on('click',function(e){
    $(this).find('.errorlog').hide().css({'z-index':'-1'});
    $(this).find('input').focus();
  });

  // 企业用户登录
  var username='',password='';
  $('#loginBtn').on('click',function(){
    var data={};
    // 首先判断用户名密码是否非空，如果非空，则去空格后提交
    username = $.trim($('input[name="username"]').val());
    password = $.trim($('input[name="password"]').val());
    console.log(username);
    console.log(password);

    if(!username||!password){
      !username && $('input[name="username"]').next().text('请输入用户名').show().css({'z-index':'2'});
      !password && $('input[name="password"]').next().text('请输入密码').show().css({'z-index':'2'});
      return false;
    }
    
    data.username = username;
    data.password = password;
    // 提交到后台

    // $.ajax({
    //  type: "POST",
    //  url: "#",
    //  data: data,
    //  dataType: "json",
    //  success: function(data){
    //     restwaybill();
    // $('input[name="username"]').next().text('用户名不存在').show().css({'z-index':'2'});
    // $('input[name="password"]').next().text('密码不正确').show().css({'z-index':'2'});
        
    //   }
    // });
  });

  // totop
  $(window).scroll(function(){
      var sc=$(window).scrollTop();
      var rheight=$(window).height();
      // if(rheight<768) return false;
      if(sc>500){
          $("#totop").fadeIn();
      }else{
          $("#totop").fadeOut();
      }
  })
  $("#totop").click(function(){
      var sc=$(window).scrollTop();
      $('body,html').animate({scrollTop:0},600);
  });
})();