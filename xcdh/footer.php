<?php global $tplRootUrl;?>
<div class="footer_wrap">
    <div class="pageW">
        <div class="footer-T clearfix">
            <div class="other fl">
                <h3 class="tit">其他</h3>
                <p><a href="/exceptions">免责条款</a></p>
                <p><a href="/privacy_protection">隐私保护</a></p>
                <p><a href="/about">公司简介</a></p>
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
                <p>上海市普陀区祁连山南路2888号A座17C</p>
                <p>客服电话: <span class="phone">400-7788-188<br/>021-66116920</span></p>
                <p class="gzh-pic"><img src="<?=$tplRootUrl ?>/img/ewm.png" /><span class="tx">E客公众账号</span></p>
            </div>
        </div>
        <div class="footer-b">
                  
<p> Copyright 2016 E客IT服务平台 All Rights Reserved 上海创轩网络科技有限公司
                <br>电信与信息服务营业经营许可证：<a href="http://www.miitbeian.gov.cn/" rel="nofollow">沪ICP备16023643</a>
            <br>
              <a target="_blank" href="" rel="nofollow"><img src="<?=$tplRootUrl ?>/img/jc.png">沪公网安备 31010702002900号</a>
  <br/>
  </p>
        </div>
    </div>
</div>
<!--弹窗-->
<div class="faskquick-diaolg" id="serviceDetailDiv">
    <div class="faskquick-mask">
        <div class="mask-head"></div>
        <div id="scrollbar1">
            <div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
            <div class="faskquick-content viewport" style="padding-left: 0px;">
                <div class="overview">
                    <img id="descrImg" src="<?=$tplRootUrl ?>/img/P201606200001.png">
                </div>
            </div>
        </div>
        <div class="close"><img src="<?=$tplRootUrl ?>/img/close1.png" /></div>
    </div>
</div>
<div class="faskquick-diaolg" id="payAccountDiv">
    <div class="faskquick-mask">
        <div class="mask-head"></div>
        <div style="margin:40px 20px;">
            <div style="height: 80px;margin: 0 auto;text-align: center;">
                <span style="margin-top: 80px;font-size: 35px;font-weight: bold;">线下支付账号信息</span>
            </div>
            <div style="margin: 0 auto;width: 60%;line-height:22px;">
                <span style="display:block;font-size: 20px;font-weight: bold;margin-bottom: 5px;">公司名称：上海创轩网络科技有限公司</span><br/>
                <span style="display:block;font-size: 20px;font-weight: bold;margin-bottom: 5px;">银&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;行：上海农商行新华支行</span><br/>
                <span style="display:block;font-size: 20px;font-weight: bold;margin-bottom: 5px;">银行账户：32401508010073548</span><br/>
                <span style="display:block;font-size: 20px;font-weight: bold;margin-bottom: 5px;">电&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;话：400-7788-188</span><br/>
                <span style="display:block;font-size: 20px;font-weight: bold;color: red;">温馨提示：转帐后请致电400电话核实确认，谢谢！</span>
            </div>
        </div>
        <div class="close"><img src="<?=$tplRootUrl ?>/img/close1.png" /></div>
    </div>
</div>
<!--弹窗-->
<div class="faskquick-diaolg" id="werchartPayDiv">
    <div class="faskquick-mask">
        <div class="mask-head" style="height: 190px;"></div>
        <div style="margin:30px 20px;">
            <div style="height: 40px;margin: 0 auto;text-align: center;">
                <span style="font-size: 35px;font-weight: bold;">请用微信进行扫码支付</span>
            </div>
            <div style="margin: 0 auto;width: 60%;text-align: center;">
                <img id="payImg" src="">
            </div>
        </div>
        <div class="close"><img src="<?=$tplRootUrl ?>/img/close1.png" /></div>
    </div>
</div>
<div class="naver-subbg"></div>

<script src="<?=$tplRootUrl ?>/js/jquery-1.10.1.min.js"></script>
<script src="<?=$tplRootUrl ?>/js/jquery.tinyscrollbar.min.js"></script>
<script src="<?=$tplRootUrl ?>/js/idangerous.swiper.js"></script>
<script src="<?=$tplRootUrl ?>/js/swiper.animate1.0.2.min.js"></script>
<script src="<?=$tplRootUrl ?>/js/vue.min.js"></script>
<script src="<?=$tplRootUrl ?>/js/vue-resource.min.js"></script>
<script src="<?=$tplRootUrl ?>/js/index.js"></script>

<?php wp_footer(); ?>
</body>
</html>