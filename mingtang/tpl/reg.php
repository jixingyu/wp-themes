<?php
/*
Template Name: 预约报名
*/
    require_once(ABSPATH . 'wp-content/themes/mingtang/inc/xy_captcha.php');

    get_header();
    require_once(ABSPATH . 'wp-content/themes/mingtang/mt-config.php');
    function add_mtreg($reg) {
        $reg['create_time'] = !empty($reg['create_time']) ? $reg['create_time'] : time();
        
        global $wpdb;
        $table_name = $wpdb->prefix . 'mingtang_reg';
        if( $wpdb->insert( $table_name, $reg ) )
            return $wpdb->insert_id;
        
        return 0;
        
    }
    $reg_type = (int)$_GET['t'];
    if (isset($_POST['mtregNonce'])) {
        if (!wp_verify_nonce($_POST['mtregNonce'], 'mtreg-nonce' ) ) {
            $message = '安全认证失败，请重试！';
        } else {
            $xy_captcha = new xy_captcha();
            $captcha_check = $xy_captcha->verify('reg', $_POST['captcha']);
            if ($captcha_check !== true) {
              $captcha_message = $captcha_check;
            } else {
              $phone = trim($_POST['phone']);
              $real_name = trim($_POST['real_name']);
              $real_name = sanitize_text_field($real_name);
              if (!$real_name) {
                $message = '姓名填写有误';
              } elseif (!is_numeric($phone)) {
                $message = '电话号码必须是数字';
              } else {
                $postReg = array(
                    'phone' => $phone,
                    'real_name' => $real_name,
                    'reg_type' => $reg_type,
                );
                $ret = add_mtreg($postReg);
                if (is_numeric($ret)) {
                    if ($ret) {
                        $reg_success = '恭喜您，预约报名成功';
                    } else {
                        $message = '预约报名失败，请重试或联系客服！';
                    }
                } else {
                    $message = $ret;
                }
              }
            }
        }
    }
?>
  <div class="container padding40-0">
    <div class="row clearfix padding40-0">
      <div class="col-md-12">
          <div class="tab-left float-l">
            <ul>
              <?php 
                require_once(ABSPATH . 'wp-content/themes/mingtang/mt-config.php');
                if (!isset($all_reg_types[$reg_type])) {
                  $reg_type = 0;
                }
                $indexregtypes = $th_options['reg-reg_types'];
                if (!empty($indexregtypes)) {
                  $indexregtypes = explode(',', $indexregtypes);
                  $i = 0;
                  foreach ($indexregtypes as $regtype_id) {
                    $i++;
                    $regtype_id = (int) $regtype_id;
                    if (isset($all_reg_types[$regtype_id])) {
                      if ($i == 1 && !$reg_type) {
                        echo '<li class="active">';
                        if (!$reg_type) $reg_type = $regtype_id;
                      } elseif ($reg_type && $reg_type == $regtype_id) {
                        echo '<li class="active">';
                      } else {
                        echo '<li>';
                      }
                      echo '<a href="/mtreg?t=' . $regtype_id . '">' . $all_reg_types[$regtype_id] . '</a></li>';
                    }
                  }
                }
              ?>
            </ul>
          </div>
          <div class="from-right float-l">
            <div class="fromdiv">
              <?php if (!empty($reg_success)) : ?>
                <div class="alert alert-success" role="alert"><?php echo $reg_success;?></div>
              <?php else :?>
                <?php if (!empty($message)) :?>
                <div class="alert alert-warning" role="alert"><?php echo $message;?></div>
                <?php endif;?>
                <form id="regform" class="form" method="post">
                  <label for="real_name">
                    <div class="dis-top formleft">姓名：</div>
                    <div class="dis-top">
                      <input type="name" name="real_name" value="<?php if (!empty($_POST['real_name'])) echo esc_attr($_POST['real_name']);?>" placeholder="请输入您的真实姓名" onfocus="if(placeholder=='请输入您的真实姓名') {placeholder=''}" onblur="if (value=='') {placeholder='请输入您的真实姓名'}">
                      <p class="errorlog" id="nameerror"></p>
                    </div>
                  </label>
                  <label for="phone">
                    <div class="dis-top formleft">电话：</div>
                    <div class="dis-top">
                      <input type="text" name="phone" value="<?php if (!empty($_POST['phone'])) echo esc_attr($_POST['phone']);?>" placeholder="请输入您的电话" onfocus="if(placeholder=='请输入您的电话') {placeholder=''}" onblur="if (value=='') {placeholder='请输入您的电话'}">
                      <p class="errorlog" id="telerror"></p>
                     </div>
                  </label>
                  <label for="random">
                    <div class="dis-top formleft">验证码：</div>
                    <div class="dis-top">
                      <img src="/wp-content/themes/mingtang/captcha.php" class="autoRandom">
                      <input type="text"  name="captcha" class="randominput">                 
                      <p class="errorlog" id="randomerror"><?php if (!empty($captcha_message)) echo $captcha_message;?></p>
                    </div>
                  </label>
                  <input type="hidden" name="mtregNonce" value="<?php echo wp_create_nonce('mtreg-nonce');?>" >
                  <input type="button" class="submit" value="提交预约">
                </form>
              <?php endif;?>
            </div>
          </div>
      </div>
    </div>
  </div>
  <script>
  $('.autoRandom').on('click',function(){
      $(this).attr('src', '/wp-content/themes/mingtang/captcha.php?' + Math.random());
  })
  $('.submit').on("click",function(){
    var isValided = valid();
    if(!isValided){
      return false;
    } else {
      $('#regform').submit();
    }
  });

  var valid = function(){
    var isvalid = true,
        errorname=false,
        errortel=false,
        errorrandom=false,
        real_name = $.trim($('input[name="real_name"]').val()),
        phone = $.trim($('input[name="phone"]').val()),
        captcha = $.trim($('input[name="captcha"]').val());

    $('.errorlog').text('');
    if(!real_name){
      $('#nameerror').text('姓名不能为空');
      errorname=true;
    }
    if(!phone){
      $('#telerror').text('电话号码不能为空');
      errortel=true;
    }else{
      var re=/^\d+$/; 
      if(!re.test(phone)){ 
        $('#telerror').text('电话号码必须是数字');
        errortel=true;
      }
    }

    if(!captcha){
      $('#randomerror').text('请填写验证码');
      errorrandom=true;
    }

    if(errorname || errortel || errorrandom){
      isvalid = false;
    }
    return isvalid;
  }
  </script>
<?php get_footer();?>