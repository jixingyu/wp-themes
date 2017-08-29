<?php get_header(); ?>
  <style>
    .newsdetails .border0{border-bottom:0;padding-bottom: 0;}
    .newsdetails{display: none;}
    .listdiv li:nth-child(6){
      display: none;
    }
    @media screen and (max-width: 668px) {
      .listdiv li:nth-child(6){
          display: block;
      }
    }
  </style>
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
          <a href="/uts-login">
            <div id="qiyeuser">
              <div class="tabicon02"></div>
              <h6>企业用户登录</h6>
            </div>
          </a>
        </div>
      </div>
    </div>
  </div>
  <!-- 业务介绍 -->
  <div class="navbussies">
    <ul>
      <?php
        $business_ids = ( isset( $th_options['business-posts'] ) && $th_options['business-posts'] ) ? $th_options['business-posts'] : '';
        $business_ids = trim($business_ids);
        if ($business_ids) {
          $business_ids = explode(',', $business_ids);
        } else {
          $business_ids = array();
        }
        $query = new WP_Query( array(
          'post__in' => $business_ids,
          'posts_per_page' => 4,
          'ignore_sticky_posts' => true,
          'orderby' => 'post__in',
        ) );
        $i = 0;
        while( $query->have_posts() ):
          $query->the_post();
          $i++;
      ?>
      <li<?php if ($i == 1) echo ' class="active"'; ?>>
        <a href="Javascript: void(0)">
          <span class="icons<?php switch ($i) {
            case 1:
              echo ' icon-buss02';
              break;
            case 2:
              echo ' icon-buss03';
              break;
            case 3:
              echo ' icon-buss05';
              break;
            case 4:
            default:
              echo ' icon-buss06';
              break;
          }?>"></span>
          <h4><?php the_title();?></h4>
        </a>
      </li>
      <?php endwhile;wp_reset_postdata(); ?>
    </ul>
  </div>
  <div class="clear"></div>
  <div class="container">
    <?php
      $i = 0;
      while( $query->have_posts() ):
        $query->the_post();
        $i++;
    ?>
    <div class="row clearfix newsdetails">
      <div class="col-md-12">
        <div class="details border0">
          <?php the_content();?>
        </div>
      </div>
    </div>
    <?php endwhile;wp_reset_postdata(); ?>
  </div>
<script>
 (function(){
    // tab切换
    $(".newsdetails").eq(0).show();
    $(".navbussies").eq(0).addClass('active');
    $(".navbussies li").on("mouseover",function(){
      $(this).addClass('active').siblings().removeClass('active');
      var num =$(".navbussies li").index(this);
      $(".newsdetails").hide();
      $(".newsdetails").eq(num).show().siblings().hide();
    });

    // 企业新闻截取
    // var thiswidth,maxlength=60;
    // thiswidth = $(window).width();
    // if(thiswidth<=568){
    //    maxlength = 37;
    // }
    
    // var $newstexts = $('.newsrow .hoverdiv').find('.h7');
    // $.each($newstexts,function(){
    //   var str = $(this).text();
    //   if(str.length>maxlength){
    //     str=str.substr(0,maxlength);
    //     $(this).html(str+'...');
    //   }
    // });

    // 订单号查询  以及 企业用户登录

    $('#form-js').on('click',function(){
      $('#placediv').hide();
      $('#textareaway').css({'z-index':'99'}).focus();
    });

    function restwaybill(){
      var html ='<h5>您可以输入运单号进行查询</h5><h6>最多可查询20条，以逗号，空格或回车建隔开</h6>';
      $("#placediv").html(html).show();
      $('#textareaway').val('');
      $('.taborg-waybill').removeClass('active');
    }
    function restuserlogin(){
      $('#form2-js input').val('').blur();;
      $('.taborg-qiyeuser').removeClass('active');
      $('.taborg-qiyeuser .errorlog').css({'z-index':'-1'}).text('');
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
        restuserlogin();
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