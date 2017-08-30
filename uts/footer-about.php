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
        <div class="col-md-12 column h7 center">
           © 2017 上海优通供应链管理有限公司 (沪ICP备15020782号)
        </div>
      </div>
    </div>
  </div>
  <div class="phoneshow phonefooter">
    <ul>
      <li>
        <div class="copyright">
          © 2017 上海优通供应链管理有限公司 (沪ICP备15020782号)
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