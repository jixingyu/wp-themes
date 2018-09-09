$().ready(function() {

	/*首页轮播*/
	var swiper = new Swiper('.swiper-container', {
		pagination: '.swiper-pagination',
		paginationClickable: true,
		autoplay: 5000,
		observer: true,   //false,
		loop:true,
		onInit: function(swiper) {
			// swiperAnimateCache(swiper); //隐藏动画元素 
			// swiperAnimate(swiper); //初始化完成开始动画
			var $firstslide = $(swiper.slides[0]);
			var anis = $firstslide.find('[swiper-animate-effect]');
			anis.each(function(index,item){
				var effect = $(this).attr("swiper-animate-effect")
				$(this).addClass(effect);
			})
		},
		onImagesReady(swiper){

		},
		onSlideChangeStart:function(swiper){
			swiperAnimateCache(swiper);
		},
		onSlideChangeEnd: function(swiper) {
			swiperAnimate(swiper); //每个slide切换结束时也运行当前slide动画
		}

	});

	//头部固定滚动
	var head = $(".head").height();
	$(window).scroll(function() {
		var topScr = $(window).scrollTop();
		if(topScr > head) {
			$(".header_wrap").addClass("naver-fixed");
			$("body").addClass("fixnav");
		} else {
			$(".header_wrap").removeClass("naver-fixed");
			$("body").removeClass("fixnav");
		}
	})

	//菜单下拉
	var timer = null;
	$('.downlist-subnav').css('height', '0');
	$('.downlist-subnav .naversub-wrap').css('height', 'auto');

	function showDialog(obj) {

		clearTimeout(timer);
		$('.downlist-subnav').stop().animate({
			height: '436'
		});
		if(obj){
			var getVal = $(obj).data('subnav');
			$(obj).addClass("hover");
			$('.naversub-con[data-link=' + getVal + ']').show().siblings('.naversub-con').hide();
		}
	}
	function showDialogMobile(index) {

		$(".naver-subbg").fadeIn('fast');
		$('.naversub-con[data-link=' + index + ']').show().siblings('.naversub-con').hide();
	}
	function hideDialogMobile(index) {

		$(".naver-subbg").fadeOut('fast');
		$('.naversub-con[data-link=' + index + ']').hide();
	}

	function hideDialog(obj, timeOut) {
		$(obj).removeClass("hover");
		timeOut = timeOut ? timeOut : 100;
		timer = setTimeout(function() {
			$('.downlist-subnav').stop().animate({
				height: '0'
			}, function() {
				$(".naver-subbg").fadeOut('fast');
				if(obj) {
					var getVal = $(obj).data('subnav');
					$('.naversub-con[data-link=' + getVal + ']').hide();
				}
			});
		}, timeOut);
	}

	// 是否为pc
	function isPC() {
	    var userAgentInfo = navigator.userAgent.toLowerCase();
	    var Agents = new Array("android", "iphone", "symbianOS", "windows phone", "ipad", "ipod");
	    var flag = true;
	    for (var v = 0; v < Agents.length; v++) {
	        if (userAgentInfo.indexOf(Agents[v]) > 0) { flag = false; break; }
	    }
	    return flag;
	}




	var isPC = isPC();
    if(!isPC){

        // 首先判断导航是否有链接，如果有就不做操作，如果没有就添加点击事件
        var naverNavas = $('.naver-nav li');
        $.each(naverNavas,function(i,item){
        	var isthislink = $(this).find('a').attr('href'),
        	    thisindex =  $(this).attr('data-subnav'),
        	    clickcount = 0;

			if(!isthislink){
				$(this).click(function(event) {
					clickcount++;
					console.log(clickcount%2 == 0);
					if(clickcount%2 == 0){
						hideDialogMobile(thisindex);
					}else{
						showDialogMobile(thisindex);
					}
		        	
		        });
			}
        });

    }else{
    	$(".naver-nav li").hover(function() {
		var getVal = $(this).data('subnav');
		    if(getVal){
				$(".naver-subbg").fadeIn('fast');
			}

			showDialog(this);
		}, function() {
			hideDialog(this);
		});

		$(".downlist-subnav .naversub-con").hover(function() {
			var getVal = $(this).data('link');
			var obj = $('.nav li[data-subnav=' + getVal + ']')[0];
			showDialog(obj)
		}, function() {
			var getVal = $(this).data('link');
			var obj = $('.nav li[data-subnav=' + getVal + ']')[0];
			hideDialog(obj);
		});
    }



	



	$(".naversub-close a").click(function(){
		var getVal = $(this).parent().parent().data('link');
		var obj = $('.nav li[data-subnav=' + getVal + ']')[0];
		hideDialog(obj, 0);
	})


	//快速通道
	function yuan(r, _x, _y) {
		var list = [];
		for(var i = 0, d = 0; d < 360; i++, d = i * 45) {
			x = Math.cos(Math.PI / 180 * d) * r + _x;
			y = Math.sin(Math.PI / 180 * d) * r + _y;
			list[i] = [x, y];
		}
		return list;
	}

	function draw(s, w, h) {
		var r = $('.passcir-small').width() / 2 * s;
		var _x = r - w / 2,
			_y = $('.passcir-small').height() / 2 - h / 2;
		var list = yuan(r, _x, _y);
		$(list).each(function(i, v) {
			var o = $(".indexlight").eq(i);
			if(!o.hasClass('indexlightgig')) {
				$(".indexlight").eq(i).css({
					left: v[0],
					top: v[1]
				});
			}
		});
	}
	draw(0.9, 80, 200);

	$(".indexlight").mouseover(function() {
		draw(0.86, 80, 200);
		$(this).addClass("indexlightgig");
		$(".passcir3").addClass("indexlightgig1");
		$(".passcir-arround").addClass("indexlightgig2");

	}).mouseout(function() {
		draw(0.9, 80, 200);
		$(this).removeClass("indexlightgig");
		$(".passcir3").removeClass("indexlightgig1");
		$(".passcir-arround").removeClass("indexlightgig2");
	})

	//悬浮QQ
	var flag = 1;
	$(".slidebar-btn").click(function() {
		if(flag == 1) {
			$(".slidebar-fixed").animate({
				right: 0
			}, 300);
			flag = 0;
		} else {
			$(".slidebar-fixed").animate({
				right: '-294px'
			}, 300);
			flag = 1;
		}

	})

	//光圈转动
	$(".quickEnter li").hover(function() {
		$(this).find("em").show().addClass("anround");
	}, function() {
		$(this).find("em").hide().removeClass("anround");
	})

})
