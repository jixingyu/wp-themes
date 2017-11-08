<?php
/*
Template Name: 优通登录
*/
  $utsUser = Xysession::get('uts-login');
  if (!empty($utsUser)) {
    header('Location: /order-search');
    exit;
  }

  get_header();
?>
  <!-- banner -->
  <div class="banner">
    <img alt="" src="<?php echo empty($th_options['head-banner-img']) ? get_bloginfo('template_url') . '/img/long-banner.jpg' : $th_options['head-banner-img'];?>" class="bannerimg"/>
  </div>

  <!-- 运单查询 -->
  <div class="navbussies navbussies-case">
    <div class="bussiescont ">
      <ul>
        <li class="active">
          <a href="Javascript: void(0)">
            <h4>运单查询</h4>
          </a>
        </li>
      </ul>
    </div>
  </div>
  <div class="search-bill">
    <!-- 企业用户登录 2-->
    <div class="bgf5" id="logindiv">
      <div class="billLogin">
        <div class="waybillformuser" >
          <form id="form3-js" class="taborgform3">
            <label for="username">
              <span class="user-icon"></span>
              <input type="username" value="" name="username" placeholder="点击输入用户名" onfocus="if(placeholder=='点击输入用户名') {placeholder=''}" onblur="if (value=='') {placeholder='点击输入用户名'}">
              <p class="errorlog">点击输入用户名</p>
            </label>
            <label for="password">
              <span class="password-icon"></span>
              <input type="password" value="" name="password" placeholder="点击输入密码" onfocus="if(placeholder=='点击输入密码') {placeholder=''}" onblur="if (value=='') {placeholder='点击输入密码'}">
              <p class="errorlog">点击输入密码</p>
            </label>
          </form>
          <div id="loginCancel" class="cancel-btn">取消</div>
          <div id="loginBtn" class="subBtn">登录</div>
        </div>
      </div>
    </div>

  </div>
  <script>
  $('#loginCancel').on('click',function(){
    location.href='/uts-search';
  });
  $('#loginBtn').on('click',function(){
    // 首先判断用户名密码是否非空，如果非空，则去空格后提交
    var username = $.trim($('input[name="username"]').val());
    var password = $.trim($('input[name="password"]').val());
    var hasError = false;
    if (username == '') {
      hasError = true;
      $('input[name="username"]').next().text('请输入用户名').show().css({'z-index':'2'});
    }
    if (password == '') {
      hasError = true;
      $('input[name="password"]').next().text('请输入密码').show().css({'z-index':'2'});
    }
    if (hasError) {
      return false;
    }

    $.ajax({
      type: "POST",
      url: "/wp-admin/admin-ajax.php?action=xy_tms",
      data: {t:'login',username:username,password:password},
      dataType: "json",
      success: function(data){
        if (data.code == 0) {
          window.location.href='/order-search';
        } else {
          // alert(data.msg);
          $('input[name="password"]').next().text(data.msg).show().css({'z-index':'2'});
        }
      }
    });
  });
  </script>
  <?php get_footer(); ?>