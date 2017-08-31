<?php
/*
Template Name: 关于我们
*/
  get_header();
?>
  <!-- banner -->
  <div class="banner">
    <img alt="" src="<?php echo empty($th_options['head-banner-img']) ? get_bloginfo('template_url') . '/img/long-banner.jpg' : $th_options['head-banner-img'];?>" class="bannerimg"/>
  </div>
  <!-- 公司新闻列表 -->
  <div class="container">
    <div class="row clearfix">
      <div class="col-md-12 breadcrumbdiv list-line-b">
        <ol class="breadcrumb"><?php xy_breadcrumb(); ?></ol>
      </div>
    </div>
    <div class="row clearfix contactrow">
      <div class="col-md-4">
        <div class="borderpart float-l">
          <span class="icon-address dis-min"><img src="<?php bloginfo('template_url');?>/img/address.png" alt=""></span>
          <h5>公司地址</h5>
          <h6>上海闵行区都会路2338弄15/16栋</h6>
        </div>
      </div>
      <div class="col-md-4">
       <div class="borderpart contactpart">
          <span class="icon-phone dis-min"><img src="<?php bloginfo('template_url');?>/img/contact.png" alt=""></span>
          <h5>联系方式</h5>
          <h6>电话：+86-21-51530018</h6>
          <h6>邮箱：Sale@utscchina.com</h6>
          <h6>传真：+86-21-51796019</h6>
       </div>
      </div>
      <div class="col-md-4">
       <div class="borderpart float-r">
          <span class="icon-weixin dis-min"><img src="<?php bloginfo('template_url');?>/img/weixin.png" alt=""></span>
          <h5>微信公众号</h5>
          <img src="<?php bloginfo('template_url');?>/img/weixin.jpg" alt="微信公众号" title="微信公众号">
       </div>
      </div>
    </div>
    <div class="row clearfix">
      <div id="mapdiv" class="col-md-12 mapdiv">
      </div>
    </div>
  </div>

  <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=9heVASdNFpkcDNyWj0pvOSBEaO6lryFh"></script>
  <script type="text/javascript">
    // 百度地图API功能
    var map = new BMap.Map("mapdiv");
    var point = new BMap.Point(121.425161,31.077908);
    var marker = new BMap.Marker(point);
    map.addOverlay(marker);
    map.centerAndZoom(point, 17);
    var opts = {
      width : 200,
      height: 100,
      title : "<?php bloginfo('name');?>"
    }
    var infoWindow = new BMap.InfoWindow("地址：上海闵行区都会路2338弄15/16栋", opts);
    marker.addEventListener("click", function(){
      map.openInfoWindow(infoWindow,point);
    });
    map.enableScrollWheelZoom(true);
  </script>
<?php get_footer('about'); ?>