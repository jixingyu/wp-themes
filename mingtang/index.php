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
  <!-- img-show-list -->
  <div class="container container-img">
    <div class="row clearfix">
      <?php
        $index_post_ids = ( isset( $th_options['index-posts'] ) && $th_options['index-posts'] ) ? $th_options['index-posts'] : '';
        $index_post_ids = trim($index_post_ids);
        if ($index_post_ids) {
          $index_post_ids = explode(',', $index_post_ids);
        } else {
          $index_post_ids = array();
        }

        $query = new WP_Query( array(
          'post_type' => array('post', 'page'),
          'post__in' => $index_post_ids,
          'posts_per_page' => 7,
          'ignore_sticky_posts' => true,
          'orderby' => 'post__in',
        ) );
        $i = 0;
        while( $query->have_posts() ):
          $query->the_post();
          $i++;
      ?>
      <div class="<?php echo $i == 1 ? 'col-md-12' : 'col-md-4';?> imglist">
        <a href="<?php the_permalink();?>">
          <img src="<?php echo xy_thumb();?>" alt="">
          <div class="imgtext">
            <h2><?php the_title(); ?></h2>
            <h6><?php echo strip_tags(get_the_excerpt()); ?></h6>
          </div>
        </a>
      </div>
      <?php endwhile;wp_reset_postdata(); ?>
    </div>
  </div>
  
  <!-- footer nav -->
  <div class="footer-mingtang">
    <div class="container">
      <div class="row clearfix footercol4">
        <div class="col-md-4">
          <?php $itab1 = isset( $th_options['index-notice'] ) ? (int) $th_options['index-notice'] : -1;?>
          <h5 class="gonggao">公告 <a href="<?php echo get_category_link($itab1); ?>" class="float-r">更多>></a></h5>
          <ul>
            <?php
              $query = new WP_Query( array(
                'cat' => $itab1,
                'posts_per_page' => 3,
                'ignore_sticky_posts' => true
              ) );
              $i = 0;
              while( $query->have_posts() ):
                $query->the_post();
            ?>
            <li>
              <a href="<?php the_permalink();?>" target="_blank"><?php the_title();?></a>
              <h6><?php the_time('Y/m/d');?></h6>
            </li>
            <?php endwhile;wp_reset_postdata(); ?>
          </ul> 
        </div>
        <div class="col-md-4"> 
          <div class="margin-b50"><h5 class="dis-top">馆址：　</h5><h5 class="dis-top">苏州工业园区启月街288号<br>紫金东方1层3-103室</h5></div>
          <div><h5 class="dis-top">联系方式： 　</h5> <h5 class="dis-top">0512-62720351<br>18913578681</h5></div>
        </div>
        <div class="col-md-4 center">
          <a href="http://map.baidu.com/?latlng=31.271073,120.730353&title=%E8%8B%8F%E5%B7%9E%E6%98%8E%E5%A0%82%E6%98%A0%E8%B1%A1%E7%BE%8E%E6%9C%AF%E9%A6%86&content=%E5%9C%B0%E5%9D%80%EF%BC%9A%E6%B1%9F%E8%8B%8F%E7%9C%81%E8%8B%8F%E5%B7%9E%E5%B8%82%E5%B7%A5%E4%B8%9A%E5%9B%AD%E5%8C%BA%E5%90%AF%E6%9C%88%E8%A1%97288%E5%8F%B7%20%E7%B4%AB%E9%87%91%E4%B8%9C%E6%96%B91%E5%B1%823-103%E5%AE%A4" target="_blank">
            <img src="<?php echo $tplRootUrl;?>/img/map.jpg" alt="">
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="fixed-r">
    <img src="<?php echo $tplRootUrl;?>/img/asktop.png" alt="">
    <a href="" class="askbg">参观画展预约</a>
    <a href="" class="askbg">体验课预约</a>
    <img class="weixinimg" src="<?php echo $tplRootUrl;?>/img/weixin.jpg" alt="扫一扫">
  </div>
<?php get_footer(); ?>