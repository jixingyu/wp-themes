<?php global $tplRootUrl;?>
<div class="footer_wrap">
    <div class="pageW">
        <div class="footer-T clearfix">
            <div class="other fl">
                <h3 class="tit">其他</h3>
                <?php
                wp_nav_menu( array(
                  'theme_location' => 'navfooterother',
                  'walker' => new Xy_Friendlink_Walker(),
                  'container' => '',
                  'before' => '<p>',
                  'after' => '</p>',
                  'items_wrap' => '%3$s',
                  'depth' => 1,
                ) );
                ?>
            </div>
            <div class="friendlink fl">
                <h3 class="tit">友情链接</h3>
                <?php
                wp_nav_menu( array(
                  'theme_location' => 'navfooter',
                  'walker' => new Xy_Friendlink_Walker(),
                  'container' => '',
                  'items_wrap' => '<p>%3$s</p>',
                  'depth' => 1,
                ) );
                ?>
            </div>
            <div class="links fl">
                <h3 class="tit">联系方式</h3>
                <p>苏州工业园区世纪金融大厦4楼408A</p>
                <p>客服电话: <span class="phone">18020266589<br/>18362725276</span></p>
                <p class="gzh-pic"><img src="<?=$tplRootUrl ?>/img/weixin.png" /><span class="tx">联系微信</span></p>
            </div>
        </div>
        <div class="footer-b">
                  
<p> Copyright 2018 All Rights Reserved 苏州星辰大海网络科技有限公司
                <br>ICP经营许可证：<a href="http://www.miitbeian.gov.cn/" rel="nofollow">苏ICP备18054498</a>
  <br/>
  </p>
        </div>
    </div>
</div>

<div class="naver-subbg"></div>

<script src="<?=$tplRootUrl ?>/js/jquery-1.10.1.min.js"></script>
<script src="<?=$tplRootUrl ?>/js/jquery.tinyscrollbar.min.js"></script>
<script src="<?=$tplRootUrl ?>/js/idangerous.swiper.js"></script>
<script src="<?=$tplRootUrl ?>/js/swiper.animate1.0.2.min.js"></script>
<script src="<?=$tplRootUrl ?>/js/vue.min.js"></script>
<script src="<?=$tplRootUrl ?>/js/vue-resource.min.js"></script>
<script src="<?=$tplRootUrl ?>/js/index.js?v=<?php echo date('Y-m-d');?>"></script>
<!-- 新幻灯片片 -->
<script src="<?=$tplRootUrl ?>/js/banner_slide.js?v=<?php echo date('Y-m-d');?>"></script>  


<?php wp_footer(); ?>
</body>
</html>