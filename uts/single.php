<?php get_header(); ?>

<!-- banner -->
<div class="banner">
  <img alt="" src="<?php echo empty($th_options['head-banner-img']) ? get_bloginfo('template_url') . '/img/long-banner.jpg' : $th_options['head-banner-img'];?>" class="bannerimg"/>
</div>

<?php
  $business_ids = ( isset( $th_options['business-posts'] ) && $th_options['business-posts'] ) ? $th_options['business-posts'] : '';
  $business_ids = trim($business_ids);
  if ($business_ids) {
    $business_ids = explode(',', $business_ids);
  } else {
    $business_ids = array();
  }
  $cur_post_id = get_the_ID();
  if (in_array($cur_post_id, $business_ids)) :
?>
  <!-- 业务介绍导航条 -->
  <div class="navbussies">
    <ul>
      <?php for ($i = 0; $i < 6; $i++) {if (!isset($business_ids[$i])) $business_ids[$i] = 1; $business_ids[$i] = (int) $business_ids[$i]; ?>
        <?php if ($business_ids[$i] == $cur_post_id) :?>
        <li class="active">
          <a href="javascript:void(0);">
            <span class="icons icon-buss0<?php echo $i + 1;?>"></span>
            <h4><?php echo get_the_title($business_ids[$i]);?></h4>
          </a>
        </li>
        <?php else : ?>
        <li>
          <a href="<?php echo get_the_permalink($business_ids[$i]);?>">
            <span class="icons icon-buss0<?php echo $i + 1;?>"></span>
            <h4><?php echo get_the_title($business_ids[$i]);?></h4>
          </a>
        </li>
        <?php endif; ?>
      <?php } ?>
    </ul>
  </div>
  <div class="clear"></div>
  <div class="container">
    <div class="row clearfix newsdetails">
      <div class="col-md-12">
        <?php while( have_posts() ): the_post(); ?>
          <h3 class="news-title"><?php the_title(); ?></h3>
          <div class="details">
            <?php the_content(); ?>
          </div>
        <?php endwhile; ?>
      </div>
    </div>
  </div>
  <?php else : ?>
  <div class="container">
    <div class="row clearfix">
      <div class="col-md-12 breadcrumbdiv list-line-b">
        <ol class="breadcrumb"><?php xy_breadcrumb(); ?></ol>
      </div>
    </div>
    <div class="row clearfix newsdetails">
      <div class="col-md-12">
        <?php while( have_posts() ): the_post(); ?>
          <h3 class="news-title"><?php the_title(); ?></h3>
          <div class="list-text-b"><span class="float-l">发布时间：<?php the_time('Y-m-d');?></span><span class="float-r"><?php xy_post_views();?></span></div>
          <div class="details">
            <?php the_content(); ?>
          </div>

          <?php xy_post_nav();?>
        <?php endwhile; ?>
      </div>
    </div>
  </div>

  <?php endif; ?>
<?php get_footer(); ?>