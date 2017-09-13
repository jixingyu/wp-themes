<?php
/*
Template Name: 企业用户登录
*/
get_header();
// require_once(ABSPATH . 'wp-content/themes/uts/inc/class-tms-api.php');
// $tmsapi = new Tms_api();

?>

<style>
    .taborg-qiyeuser{
      width:50%;
      min-width: 365px;
      margin: 0 auto;
      padding-bottom:12%;
      padding-top: 10%;
    }
    .waybillformuser{
      background: #fff;
      padding: 20px;
      width: 100%;

    }

    @media screen and (max-width: 416px) {
      .taborg-qiyeuser{
        width: 365px;
        min-width: 365px;
      }
      .taborg-qiyeuser .waybillformuser{
        height:auto;
      }
    }
    @media screen and (max-width: 375px) {
     .taborg-qiyeuser {
        width: 320px;
        min-width: 320px;
      }
    }
     @media screen and (max-width: 320px) {
      .taborg-qiyeuser{
        width: 300px;
        min-width: 300px;
      }
    }
    
</style>

  <!--运单查询以及企业用户登录-->
  <div class="taborgbg">
    <div class="container">
      <div class="row clearfix">
        <div class="col-md-12">
          <div class="taborg taborg-qiyeuser">
            <div id="qiyeuser">
              <div class="tabicon02"></div>
              <h6>企业用户登录</h6>
            </div>
            <div class="waybillformuser" >
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
              <div id="loginBtn"  class="subBtn">登录</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php get_footer(); ?>