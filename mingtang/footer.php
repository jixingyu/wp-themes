  <!-- footer 通用 -->
  <?php global $tplRootUrl;?>
  <div class="footer-bg">
    <div class="container footerlink">
      <div class="collapse navbar-collapse">
        <?php
          wp_nav_menu( array(
            'theme_location' => 'navfooter',
            'walker' => new Xy_Navfooter_Walker(),
            'container' => '',
            'items_wrap' => '<ul class="nav navbar-nav">%3$s</ul>',
            'depth' => 1,
          ) );
        ?>
      </div>
      <div class="footerlogo">
        <img src="<?php echo $tplRootUrl;?>/img/logo.png" alt="" class="dis-mid">
        <div class="h7 dis-mid">Copyright © 2017 吴门画派研究院<br>ICP备</div>
      </div>
    </div>
  </div>
  <script type="text/javascript" src="http://v3.jiathis.com/code_mini/jia.js" charset="utf-8"></script>
  <?php wp_footer(); ?>
<script>
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?aa44070b1368fc9dab9ceb3104efe693";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
</script>
</body>
</html>