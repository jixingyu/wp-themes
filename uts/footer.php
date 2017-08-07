  <!-- footer nav -->
  <div class="bg33">
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
                'items_wrap' => '<ul class="nav navbar-nav">%3$s</ul>',
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
        <div class="col-md-1 column"> </div>
        <div class="col-md-5 column h7">
          电话：+86-21-51530018<br>
          邮箱：<a href="mailto:Sale@utscchina.com">Sale@utscchina.com</a><br>
          传真：+86-21-51796019<br>
          地址：上海闵行区都会路2338弄15/16栋
        </div>
        <div class="col-md-6 column">
          <div class="footer-right">
            <div class="float-bottom h7">
              上海优通供应链管理有限公司<br>Copyright © 2014 上海优通供应链管理有限公司(沪ICP备15020782号) All rights reserved
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php wp_footer(); ?>
</body>
</html>