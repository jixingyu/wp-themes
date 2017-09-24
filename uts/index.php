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
    </div>
  </div>
  <?php endif; ?>

  <!--运单查询以及企业用户登录-->
  <div class="taborgbg">
    <div class="container">
      <!-- 登录后隐藏一下内容 -->
      <div class="taborg-waybill" id="waybill">
        <div class="bgorgrad">
          <h3>运单查询</h3>
          <span class="iconspng icon-down"></span>
        </div>
      </div>
    </div>
  </div>
  <!-- 业务介绍 -->
  <div class="navbussies">
    <div class="bussiescont bussiescont-index">
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
            $query_title = get_the_title();
            if (preg_match('/\[(.*?)\](.*)/', $query_title, $title_matches)) {
              $title_icon = $title_matches[1];
            } else {
              $title_icon = $query_title;
            }
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
            <h4><?php echo $title_icon;?></h4>
          </a>
        </li>
        <?php endwhile;wp_reset_postdata(); ?>
      </ul>
    </div>
  </div>
  <div class="clear"></div>
  <div class="f0bgtop">
    <div class="bussiescont indexlist">
      <?php
        $i = 0;
        while( $query->have_posts() ):
          $query->the_post();
          $i++;
          $query_title = get_the_title();
          if (preg_match('/\[(.*?)\](.*)/', $query_title, $title_matches)) {
            $title_desc = $title_matches[2];
          } else {
            $title_desc = $query_title;
          }
      ?>
      <div class="row clearfix newsdetails">
        <div class="col-md-12">
          <h3 class="news-title">· <?php echo $title_desc;?> ·</h3>
          <div class="details border0">
            <?php the_content();?>
          </div>
        </div>
      </div>
      <?php endwhile;wp_reset_postdata(); ?>
    </div>
  </div>
  <div class="frombg" id="frombg01">
    <div class="waybillform">
      <div class="taborg-waybill bgorgradfrom" id="closewaybill">
        <div class="bgorgrad">
          <h3>运单查询</h3>
          <span class="iconspng icon-down"></span>
        </div>
      </div>
      <form id="form-js">
        <div id="placediv" class="placediv">
          <h5>点击输入运单号</h5>
        </div>
        <textarea id="textareaway" class="textareaway"></textarea>
        <h6>可同时查询20条，以逗号、空格、回车键隔开</h6>
      </form>
      <div id="subBtn"  class="subBtn waybillbtn"><img src="<?php bloginfo('template_url');?>/img/search.png" alt=""></div>
    </div>
  </div>
<script>
 (function(){
    // tab切换
    $(".newsdetails").eq(0).addClass('active');
    $(".navbussies").eq(0).addClass('active');
    $(".navbussies li").on("mouseover",function(){
      $(this).addClass('active').siblings().removeClass('active');
      var num =$(".navbussies li").index(this);
      $(".f0bgtop .newsdetails").removeClass('active');
      $(".f0bgtop .newsdetails").eq(num).addClass('active').siblings().removeClass('active');
    });

    // 订单号查询

    $('#form-js').on('click',function(){
      $('#placediv').hide();
      $('#textareaway').css({'z-index':'99'}).focus();
    });

    function restwaybill(){
      var html ='<h5>点击输入运单号</h5>';
      $("#placediv").html(html).show();
      $('#textareaway').val('');
    }
    function restuserlogin(){
      $('#form2-js input').val('').blur();;
      $('.errorlog').css({'z-index':'-1'}).text('');
    }

    var isqiyeuser=0,islogin = true,textareaway='';

    // 运单查询
    // $('#waybill').on('click',function(e){
    //   $('#frombg01').show();
    //   $('body').css({'overflow':'hidden'});
    // });
    // $('#waybilltop').on('click',function(e){
    //   $('#frombg01').show();
    //   $('body').css({'overflow':'hidden'});
    // });
    

    $('#closewaybill').on('click',function(e){
      $('#frombg01').hide();
      $('body').css({'overflow':'auto'});
      restwaybill();
    });

    
    var $from2inputs = $('#form2-js').find('label');
    $from2inputs.on('click',function(e){
      $(this).find('.errorlog').hide().css({'z-index':'-1'});
      $(this).find('input').focus();
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

  })();
</script>
<?php get_footer(); ?>