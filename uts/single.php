<?php get_header(); ?>

<!-- banner -->
<div class="banner">
  <img alt="" src="<?php echo empty($th_options['head-banner-img']) ? get_bloginfo('template_url') . '/img/long-banner.jpg' : $th_options['head-banner-img'];?>" class="bannerimg"/>
</div>

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
        <div class="list-text-b"><span class="float-l">发布时间：<?php the_time('Y-m-d');?></span><span class="float-r"><?php post_views();?></span></div>
        <div class="details">
          <?php the_content(); ?>
        </div>

        <?php xy_post_nav();?>
      <?php endwhile; ?>
    </div>
  </div>
</div>

<?php get_footer(); ?>