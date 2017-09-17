  <!-- footer nav -->
  <div class="footer bgeee phonehidden">
    <div class="container">
      <div class="row clearfix">
         <div class="col-md-10 pull-left h7">
          上海优通供应链管理有限公司<br>
          电话：+86-21-51530018<br>
          邮箱：<a href="mailto:Sale@utscchina.com">Sale@utscchina.com</a><br>
          地址：上海市闵行区都会路2338弄15/16栋<br>
          <p class="copryright">© 2017 上海优通供应链管理有限公司 (沪ICP备15020782号)</p>
        </div>
        <div class="col-md-2 pull-right h7">
          <img src="<?php bloginfo('template_url');?>/img/weixin.jpg" alt=""><br>
          优通微信公众号
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
      <li><div class="phonefooterli indent">地址：上海闵行区都会路2338弄15/16栋</div></li>
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
  <div class="frombg" id="frombg02">
    <div class="waybillform waybillformuser" >
      <div class="iconspng icon-close pull-right" id="closefrom2"></div>
      <h3>用户登录</h3>
      <form id="form2-js" class="taborgform2">
        <label for="username">
          <span class="user-icon"></span>
          <span class="line-right"></span>
          <input type="username" name="username" placeholder="请输入用户名" onfocus="if(placeholder=='请输入用户名') {placeholder=''}" onblur="if (value=='') {placeholder='请输入用户名'}">
          <p class="errorlog">请输入用户名</p>
        </label>
        <label for="password">
          <span class="password-icon"></span>
          <span class="line-right"></span>
          <input type="password" name="password" placeholder="请输入密码" onfocus="if(placeholder=='请输入密码') {placeholder=''}" onblur="if (value=='') {placeholder='请输入密码'}">
          <p class="errorlog">请输入密码</p>
        </label>
      </form>
      <div id="loginBtn"  class="subBtn waybillbtn loginbtn">登录</div>
    </div>
  </div>

  <?php wp_footer(); ?>
</body>
</html>