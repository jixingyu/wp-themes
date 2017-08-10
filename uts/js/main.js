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

(function(){
    // totop
    $(window).scroll(function(){
        var sc=$(window).scrollTop();
        var rwidth=$(window).width()
        if(sc>500){
            $("#totop").show();
        }else{
            $("#totop").hide();
        }
    });
    $("#totop").click(function(){
        var sc=$(window).scrollTop();console.log(sc);
        $('body,html').animate({scrollTop:0},500);
    });
})();