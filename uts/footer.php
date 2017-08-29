  <!-- footer nav -->
  <div class="bg33 phonehidden">
    <div class="container footernav">
       <div class="row clearfix">
        <div class="col-md-1 column"> </div>
        <div class="col-md-11 column"> 
          <div class="collapse navbar-collapse">
            <?php
              wp_nav_menu( array(
                'theme_location' => 'navfooter',
                'walker' => new Uts_Navfooter_Walker(),
                'container' => '',
                'items_wrap' => '<ul class="nav navbar-nav">%3$s<li><div id="hoverweixin" class="weixinfooter"><div class="hideweixin"><img src="' . get_bloginfo('template_url') . '/img/weixin.jpg" alt="优通公众号" title="优通公众号"></div>微信公众号</div></li></ul>',
                'depth' => 1,
              ) );
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="footer bgeee phonehidden">
    <div class="container">
      <div class="row clearfix">
        <div class="col-md-5 col-md-offset-1 column h7">
          电话：+86-21-51530018<br>
          邮箱：<a href="mailto:Sale@utscchina.com">Sale@utscchina.com</a>
        </div>
        <div class="col-md-5 col-md-offset-1 column h7">
          传真：+86-21-51796019<br>
          地址：上海闵行区都会路2338弄15/16栋
        </div>
        <div class="col-md-12 column h7 center">
           © 2017 上海优通供应链管理有限公司 (沪ICP备15020782号)
        </div>
      </div>
    </div>
  </div>

  <!-- and phone footer -->
  <div class="phoneshow phonefooter">
    <ul>
      <li>
        <div id="hoverweixin" class="weixinfooter phonefooterli">
          <div class="hideweixin"><img src="<?php bloginfo('template_url');?>/img/weixin.jpg" alt="优通公众号" title="优通公众号"><p>将二维码截图保存至相册，打开微信识别相册中的二维码关注</p></div>
          <span>微信公众号</span><img class="weixinicon" src="<?php bloginfo('template_url');?>/img/weixin-icon.png" alt="优通公众号">
        </div>
      </li>
      <li>
        <div class="phonefooterli">联系我们</div>
      </li>
      <li><div class="phonefooterli indent">电话：+86-21-51530018</div></li>
      <li><div class="phonefooterli indent">邮箱：<a href="mailto:Sale@utscchina.com">Sale@utscchina.com</a></div></li>
      <li><div class="phonefooterli indent">传真：+86-21-51796019</div></li>
      <li><div class="phonefooterli indent">地址：上海闵行区都会路2338弄15/16栋</div></li>
      <li>
        <div class="copyright">
          上海优通供应链管理有限公司<br>Copyright © 2014 上海优通供应链管理有限公司(沪ICP备15020782号)
        </div>
      </li>
    </ul>
  </div>
  <div class="phoneshow totop" id="totop">
    <img src="<?php bloginfo('template_url');?>/img/totop.png" alt="到顶部" title="到顶部">
  </div>

  <?php wp_footer(); ?>
</body>
</html>