<?php get_header(); ?>

<!-- banner -->
<div class="banner">
  <!-- <h3>极速物流·完整供应链·助力智慧物流</h3> -->
  <img alt="" src="<?php echo empty($th_options['head-banner-img']) ? get_bloginfo('template_url') . '/img/long-banner.jpg' : $th_options['head-banner-img'];?>" class="bannerimg"/>
</div>

<?php
  $hot_cat_id = ( isset( $th_options['news-hot'] ) && $th_options['news-hot'] ) ? $th_options['news-hot'] : '';
  $cur_cat = get_the_category();
  $cur_cat = $cur_cat[0];
  $cat_option = get_option( THEME_PREFIX . '_cat_options_' . $cur_cat->term_id );
  $catType = isset( $cat_option['template'] ) ? $cat_option['template'] : 'default';
?>
<!-- 新闻详情页 -->
<div class="navbussies navbussies-case">
  <div class="bussiescont ">
    <ul>
      <li class="active">
        <a href="Javascript: void(0)">
          <h4><?php echo $cur_cat->name;?></h4>
        </a>
      </li>
    </ul>
  </div>
</div>
<div class="clear"></div>

<?php while( have_posts() ): the_post(); ?>
<div class="toppart">
  <div class="bussiescont bussiescont-toppart clearfix">
    <?php if ($catType != 'picture') : ?>
    <a href="<?php echo get_category_link($cur_cat->term_id);?>">
      <div class="topcrumb"><span class="iconspng icon-return"></span>返回目录</div>
    </a>
    <?php endif; ?>
    <h2><?php the_title();?></h2>
  </div>
</div>
<div class="bgf8 ">
  <div class="bussiescont news-details paading20_0 ">
    <?php if ($catType != 'picture') : ?>
    <div class="center list-text-b"><span class="pulishtime">发布时间：<?php the_time('Y-m-d');?></span><span>阅读量：<?php xy_post_views();?></span></div>
    <?php endif; ?>
    <?php the_content(); ?>
  </div>
</div>

<?php if ($cur_cat->term_id == $hot_cat_id) : ?>
<div class="hotlist">
  <div class="hotnews">
    <div class="news-bottom-a">
      <?php xy_post_nav();?>
    </div>
    <h5>热门新闻</h5>
    <ol>
      <?php xy_most_viewed_format($hot_cat_id);?>
    </ol>
  </div>
</div>
<?php endif;?>
<?php endwhile; ?>

<?php get_footer(); ?>
