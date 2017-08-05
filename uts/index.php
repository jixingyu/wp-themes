<?php get_header(); ?>
  <!-- 幻灯切换 -->
  <?php
    $slider_num = ( isset( $th_options['head-slider-num'] ) && $th_options['head-slider-num'] ) ? (int) $th_options['head-slider-num'] : 0;
    if ( 0 < $slider_num ) :
  ?>
  <div class="sildebg">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <?php for ( $i = 1; $i <= $slider_num; $i++ ) { ?>
          <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i - 1;?>" <?php if ($i == 1) echo 'class="active"';?>></li>
        <?php } ?>
      </ol>

      <div class="carousel-inner">
        <?php
          for ( $i = 1; $i <= $slider_num; $i++ ) {
            $pic = isset( $th_options[ 'head-slider-pic-' . $i ] ) ? esc_attr( $th_options[ 'head-slider-pic-' . $i ] ) : '';
            $link = isset( $th_options[ 'head-slider-pic-link-' . $i ] ) ? esc_attr( $th_options[ 'head-slider-pic-link-' . $i ] ) : '';
            $active = $i == 1 ? ' active' : '';
            if ($link) {
              echo '<div class="item' . $active . '"><a href="' . $link . '" target="_blank"><img src="' . $pic . '"></a></div>';
            } else {
              echo '<div class="item' . $active . '"><img src="' . $pic . '"></div>';
            }          }
        ?>
      </div> 
      <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>
  <?php endif; ?>
  <!--运单查询以及企业用户登录-->
  <div class="taborgbg">
    <div class="container">
      <div class="row clearfix">
        <div class="col-md-6 taborg taborg-waybill">
          <div id="waybill">
            <div class="tabicon01"></div>
            <h6>运单查询</h6>
          </div>
          <div class="waybillform">
            <form id="form-js">
              <div id="placediv" class="placediv">
                <h5>您可以输入运单号进行查询</h5>
                <h6>最多可查询20条，以逗号，空格或回车建隔开</h6>
              </div>
              <textarea id="textareaway" class="textareaway"></textarea>
            </form>
            <div id="subBtn"  class="subBtn">马上查单</div>
          </div>
        </div>
        <div class="col-md-6 taborg taborg-qiyeuser">
          <div id="qiyeuser">
            <div class="tabicon02"></div>
            <h6>企业用户登录</h6>
          </div>
          <div class="waybillform" >
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
  <!-- 业务介绍 -->
  <div class="container padding60-0">
    <div class="row clearfix">
      <div class="col-md-12 titlediv">
        <h2>优通业务介绍</h2>
        <div class="title-bottom"></div>
      </div>
    </div>
    <div class="row clearfix padding50-0 business">
      <div class="col-md-2">
        <img src="<?php bloginfo('template_url');?>/img/introud01.png" alt="干线运输" title="干线运输">
        <h4>干线运输</h4>
      </div>
      <div class="col-md-2">
        <img src="<?php bloginfo('template_url');?>/img/introud02.png" alt="仓库管理" title="仓库管理">
        <h4>仓库管理</h4>
      </div>
      <div class="col-md-2">
        <img src="<?php bloginfo('template_url');?>/img/introud03.png" alt="城市配送" title="城市配送">
        <h4>城市配送</h4>
      </div>
      <div class="col-md-2">
        <img src="<?php bloginfo('template_url');?>/img/introud04.png" alt="信息处理" title="信息处理">
        <h4>信息处理</h4>
      </div>
      <div class="col-md-2">
        <img src="<?php bloginfo('template_url');?>/img/introud05.png" alt="供应链金融" title="供应链金融">
        <h4>供应链金融</h4>
      </div>
      <div class="col-md-2">
        <img src="<?php bloginfo('template_url');?>/img/introud06.png" alt="国际货代" title="国际货代">
        <h4>国际货代</h4>
      </div>
    </div>
  </div>
  <!-- 案例中心 -->
  <?php
    $itab1 = isset( $th_options['index-tab-1'] ) ? (int) $th_options['index-tab-1'] : -1;
    if ($itab1 != 1) {
  ?>
  <div class="bg53">
    <div class="container padding40-0 ">
      <div class="row clearfix">
        <div class="col-md-12 titlediv">
          <h2><?php echo get_cat_name( $itab1 ); ?></h2>
          <div class="title-bottom"></div>
        </div>
        <div class="listdiv">
          <ul>
            <?php
              $query = new WP_Query( array(
                'cat' => $itab1,
                'posts_per_page' => 5,
                'ignore_sticky_posts' => true
              ) );
              while( $query->have_posts() ):
                $query->the_post();
            ?>
            <li>
              <a href="<?php the_permalink();?>">
                <div class="listimgdiv">
                  <img src="<?php echo xy_thumb();?>">
                  <div class="listimgbg"></div>
                  <h4><?php the_title();?></h4>
                </div>
              </a>
            </li>
            <?php endwhile;wp_reset_postdata(); ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>
  <!-- 公司新闻 -->
  <?php
    $itab2 = isset( $th_options['index-tab-2'] ) ? (int) $th_options['index-tab-2'] : -1;
    if ($itab2 != 1) {
  ?>
  <div class="container padding60-0">
    <div class="row clearfix">
      <div class="col-md-12 titlediv">
        <h2><?php echo get_cat_name( $itab2 ); ?></h2>
        <div class="title-bottom"></div>
      </div>
    </div>
    <div class="row clearfix newsrow">
      <?php
        $query = new WP_Query( array(
          'cat' => $itab2,
          'posts_per_page' => 8,
          'ignore_sticky_posts' => true
        ) );
        while( $query->have_posts() ):
          $query->the_post();
      ?>
      <div class="col-md-3">
        <a href="<?php the_permalink();?>">
          <div class="hoverdiv">
            <img src="<?php echo xy_thumb();?>" alt="">
            <div class="hidetext">
              <h3><?php the_title();?></h3>
              <div class="h7"><?php echo get_the_excerpt();?></div>
            </div>
          </div>
        </a>
      </div>
    <?php endwhile;wp_reset_postdata(); ?>
    </div>
  </div>
  <?php } ?>
<script>
(function(){
  // $('#dropdown-toggle').hover(function(){
  //   $(".dropdown").addClass('open');
  // },function(){
  //  $(".dropdown").removeClass('open');
  // }); 
  $('#form-js').on('click',function(){
    $('#placediv').hide();
    $('#textareaway').css({'z-index':'99'}).focus();
  });

  function restwaybill(){
    var html ='<h5>您可以输入运单号进行查询</h5><h6>最多可查询20条，以逗号，空格或回车建隔开</h6>';
    $("#placediv").html(html).show();
    $('.taborg-waybill').removeClass('active');
  }

  var iswaybill=0,isqiyeuser=0,islogin = true,textareaway='';

  $('#waybill').on('click',function(e){
    iswaybill++;
    if(iswaybill%2==1){
      $('.taborg-waybill').addClass('active');
    }else{
      restwaybill();
    }
    e.stopPropagation();
  });

  
  var $from2inputs = $('#form2-js').find('label');
  $from2inputs.on('click',function(e){
    $(this).find('.errorlog').hide().css({'z-index':'-1'});
    $(this).find('input').focus();
  });

  $('#qiyeuser').on('click',function(e){
    isqiyeuser++;
    if(isqiyeuser%2==1){
      $('.taborg-qiyeuser').addClass('active');
    }else{
      $('.taborg-qiyeuser').removeClass('active');
    }
  });

  

  // 点击提交运单号
  $('#subBtn').on('click',function(){
    // 首先判断是否登录 ， 然后判断输入是否为空，如果为空则提示输入为空，如果有值则直接查询
    if(!islogin){
      alert("请先登录");
    }
    textareaway = $('#textareaway').val();

    if(!textareaway||textareaway==''){
      var html ="<h5 class='error'>请先输入运单号</h5>";
      $("#placediv").html(html).show();
    }
    // 查询订单
    var data ={};
    data.waynum=textareaway;
    // $.ajax({
    //  type: "POST",
    //  url: "#",
    //  data: data,
    //  dataType: "json",
    //  success: function(data){
    //     restwaybill();
        
    //   }
    // });
  });

  // 企业用户登录
  var username='',password='';
  $('#loginBtn').on('click',function(){
    var data={};
    // 首先判断用户名密码是否非空，如果非空，则去空格后提交
    username = $.trim($('input[name="username"]').val());
    password = $.trim($('input[name="password"]').val());
    console.log(username);
    console.log(password);

    if(!username||!password){
      !username && $('input[name="username"]').next().text('请输入用户名').show().css({'z-index':'2'});
      !password && $('input[name="password"]').next().text('请输入密码').show().css({'z-index':'2'});
      return false;
    }
    
    data.username = username;
    data.password = password;
    // 提交到后台

    // $.ajax({
    //  type: "POST",
    //  url: "#",
    //  data: data,
    //  dataType: "json",
    //  success: function(data){
    //     restwaybill();
    // $('input[name="username"]').next().text('用户名不存在').show().css({'z-index':'2'});
    // $('input[name="password"]').next().text('密码不正确').show().css({'z-index':'2'});
        
    //   }
    // });

  });
  
})();
</script>
<?php get_footer(); ?>