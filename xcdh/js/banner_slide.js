$(document).ready(function(){var t;var index=-1;var times=3000;t=setInterval(play,times);function play(){index++;if(index>3){index=0}
$('.img').eq(index).addClass('opactiy01').siblings().removeClass('opactiy01')
$('.cir').eq(index).addClass('cr').siblings().removeClass('cr')}
$('.cir').click(function(){$(this).addClass('cr').siblings().removeClass('cr')
var index=$(this).index()
$('.img').eq(index).addClass('opactiy01').siblings().removeClass('opactiy01')})
$('.pre').click(function(){index--
if(index<0){index=3}
$('.img').eq(index).addClass('opactiy01').siblings().removeClass('opactiy01')
$('.cir').eq(index).addClass('cr').siblings().removeClass('cr')})
$('.next').click(function(){index++
if(index>3){index=0}
$('.img').eq(index).addClass('opactiy01').siblings().removeClass('opactiy01')
$('.cir').eq(index).addClass('cr').siblings().removeClass('cr')})
$('.banner').hover(function(){clearInterval(t)},function(){t=setInterval(play,times)
function play(){index++
if(index>3){index=0}
$('.img').eq(index).addClass('opactiy01').siblings().removeClass('opactiy01')
$('.cir').eq(index).addClass('cr').siblings().removeClass('cr')}});});