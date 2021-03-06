<?php
/*
Template Name: 关于我们
*/
  get_header();
?>
  <!-- banner -->
  <div class="banner">
    <!-- <h3>极速物流·完整供应链·助力智慧物流</h3> -->
    <img alt="" src="<?php echo empty($th_options['head-banner-img']) ? get_bloginfo('template_url') . '/img/long-banner.jpg' : $th_options['head-banner-img'];?>" class="bannerimg"/>
  </div>
  <div class="navbussies navbussies-case">
    <div class="bussiescont ">
      <ul>
        <li class="active">
          <a href="Javascript: void(0)">
            <h4>关于我们</h4>
          </a>
        </li>
      </ul>
    </div>
  </div>
  <div class="container">
    <div class="about-banner">
      <img class="" src="<?php bloginfo('template_url');?>/img/zongbu.jpg"  title="优通总部大楼" alt="优通总部大楼">
      <div class="aboutpdiv">
        <p>优通成立于1997年，是一家专业从事第三方物流的大型物流企业。优通总部位于上海，服务网络覆盖全国，并在主要城市设立了<span class="maxtext">五家分公司、三十二个办事处</span>。</p>
        <p>优通是集<span class="maxtext">干线运输、仓储管理、城市配送、流通加工、信息处理、物流金融、国际货代、进出口报关</span>及其他增值业务于一体的第三方物流服务商。并专注于为客户提供专业化、定制化、最优化供应链管理解决方案。</p>
        <p>我们为客户的每个项目配备专门的管理团队进行信息化管理和调度跟踪监控。</p>
      </div>
      <div class="threepart">
        <div class="aboutbgfff">
          <h4>1.基本理念</h4>
          <p class="desc">企业不仅仅是为了追求自身的利益而存在，同时是为了适应社会的发展并回馈于社会文明进步而存在。</p>
        </div>
        <div class="aboutbgfff">
          <h4>2.优通愿景</h4>
          <p class="desc">以智慧物流为核心，成为中国领先的供应链集成商。</p>
        </div>
        <div class="aboutbgfff">
          <h4>3.优通使命</h4>
          <p class="desc">为客户提供创新方案，以智慧物流为客户创造更大的价值；为优通的员工提供完备的事业发展平台。</p>
        </div>
      </div>
      <div class="aboutnewbg">
        <p class="text-left"><span class="iconsabout iconsabout01"></span><span class="aboutnewbigtext">信赖</span>——使客户对我们信赖，使员工对我们信赖，使社会对我们信赖</p>
        <p class="text-right"><span class="iconsabout iconsabout02"></span><span class="aboutnewbigtext">创新/智慧</span>——不断创新提升服务能力，打造优通智慧物流</p>
        <p class="text-left"><span class="iconsabout iconsabout03"></span><span class="aboutnewbigtext">效率</span>——高效的解决方案，为客户创利取胜</p>
        <p class="text-right"><span class="iconsabout iconsabout04"></span><span class="aboutnewbigtext">绿色</span>——优化供应链环节，遏止污染和能源浪费</p>
      </div>
    </div>
    <div class="col-md-12">
      <div class="bussiescont bussiescont-toppart clearfix">
        <h2>- 联系我们 -</h2>
        <div class="row clearfix contactrow">
          <div class="col-md-4">
            <div class="borderpart">
              <span class="icon-address dis-min"><img src="<?php bloginfo('template_url');?>/img/address.png" alt=""></span>
              <h5>地址</h5>
              <h6>上海闵行区都会路</h6><h6>2338弄15/16栋</h6>
            </div>
          </div>
          <div class="col-md-4">
           <div class="borderpart contactpart">
              <span class="icon-phone dis-min"><img src="<?php bloginfo('template_url');?>/img/contact.png" alt=""></span>
              <h5>联系方式</h5>
              <h6>电话：+86-21-51530018</h6>
              <h6>邮箱：Sale@utscchina.com</h6>
           </div>
          </div>
          <div class="col-md-4">
            <div class="borderpart">
              <span class="icon-weixin dis-min"><img src="<?php bloginfo('template_url');?>/img/weixin.png" alt=""></span>
              <img class="weixinimg" src="<?php bloginfo('template_url');?>/img/weixin.jpg" alt="微信公众号" title="微信公众号">
            </div>
          </div>
        </div>
        <h2>- 地图导航 -</h2>
        <div class="row clearfix">
          <div id="mapdiv" class="col-md-12 mapdiv">
          </div>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=9heVASdNFpkcDNyWj0pvOSBEaO6lryFh"></script>
  <script type="text/javascript" src="http://api.map.baidu.com/library/SearchInfoWindow/1.5/src/SearchInfoWindow_min.js"></script>
  <link rel="stylesheet" href="http://api.map.baidu.com/library/SearchInfoWindow/1.5/src/SearchInfoWindow_min.css" />
  <script type="text/javascript">
    // 百度地图API功能
    var map = new BMap.Map("mapdiv");
    var point = new BMap.Point(121.425161,31.077908);
    var marker = new BMap.Marker(point);
    map.addOverlay(marker);
    map.centerAndZoom(point, 17);
    // var opts = {
    //   width : 200,
    //   height: 100,
    //   title : "<?php bloginfo('name');?>"
    // }
    // var infoWindow = new BMap.InfoWindow("地址：上海闵行区都会路2338弄15/16栋", opts);
    var content = '<div style="margin:0;line-height:20px;padding:2px;">'
      + '<img src="<?php bloginfo('template_url');?>/img/zongbu.gif" alt="" style="float:right;zoom:1;overflow:hidden;width:100px;height:100px;margin-left:3px;"/>'
      + '地址：上海市闵行区都会路2338弄15/16栋<br/>电话：+86-21-51530018'
      + '</div>';
    searchInfoWindow = new BMapLib.SearchInfoWindow(map, content, {
      title  : "<?php bloginfo('name');?>",      //标题
      width  : 290,             //宽度
      height : 105,              //高度
      panel  : "panel",         //检索结果面板
      enableAutoPan : true,     //自动平移
      searchTypes   :[
        BMAPLIB_TAB_SEARCH,   //周边检索
        BMAPLIB_TAB_TO_HERE,  //到这里去
        BMAPLIB_TAB_FROM_HERE //从这里出发
      ]
    });
    marker.addEventListener("click", function(){
      // map.openInfoWindow(infoWindow,point);
      searchInfoWindow.open(marker);
    });
    map.enableScrollWheelZoom(true);
  </script>
<?php get_footer('about'); ?>