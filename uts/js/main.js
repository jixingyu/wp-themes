
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