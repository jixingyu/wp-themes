<?php get_header(); ?>

<?php
  global $wp_query;
  $cat_option = get_option( THEME_PREFIX . '_cat_options_' . $wp_query->queried_object_id );
  $tmp = ( is_category() && isset( $cat_option['template'] ) ) ? $cat_option['template'] : 'default';
  $cat_ID = get_query_var('cat');
  $cur_cat = get_category($cat_ID);
  if ( $tmp == 'picture' ) :
?>
  <style>
    .listdiv li{
      width:25%;
      margin-bottom: 2%;
    }
   
    .caserow h2{
      display: none;
      color: #fff;
      font-size: 24px;
      text-align: center;
      padding: 5% 0;
    }
    @media screen and (max-width: 800px) {
      .caserow h2{
        display: block;
      }
    }
    @media screen and (max-width: 737px) {
      
    }
    @media screen and (max-width: 450px) {
      .listdiv li{
        width:33.3333%;
      }
      .pagination>li>a, .pagination>li>span{
        padding:6px 7px;
      }
    }
   

  </style>
<?php endif; ?>

<!-- banner -->
<div class="banner">
  <img alt="" src="<?php echo empty($th_options['head-banner-img']) ? get_bloginfo('template_url') . '/img/long-banner.jpg' : $th_options['head-banner-img'];?>" class="bannerimg"/>
</div>

  <?php if ( $tmp == 'picture' ) : ?>
  <div class="bg53">
    <div class="container">
      <div class="row clearfix padding60-0 caserow">
        <h2><?php echo $cur_cat->name;?></h2>
      	<?php if( have_posts() ): ?>
        <div class="listdiv padding40-0 listdivlist">
          <ul>
          	<?php while( have_posts() ): the_post(); ?>
            <li>
              <a href="<?php the_permalink();?>">
                <div class="listimgdiv">
                  <img src="<?php echo xy_thumb();?>" alt="">
                  <div class="listimgbg"></div>
                  <h4><?php the_title(); ?></h4>
                </div>
              </a>
            </li>
          	<?php endwhile; ?>
          </ul>
        </div>
        <div class="col-md-12 center pagefooter">
          <?php xy_paginate();?>
        </div>
      	<?php endif;?>
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
    <div class="row clearfix newslist">
      <div class="col-md-9 newslist-l">
      	<?php if( have_posts() ): ?>
        <ul>
        	<?php while( have_posts() ): the_post(); ?>
          <li>
            <a href="<?php the_permalink();?>" target="_blank">
	            <?php $xythumb = xy_thumb(); if (!empty($xythumb)) : ?>
	            	<img src="<?php echo $xythumb;?>" alt=""  class="float-l">
	            <?php endif; ?>
	            <div class="list-r-text">
	              <h4 class="ellipsis"><?php the_title(); ?></h4>
	              <div class="list-text-b"><span class="float-l">发布时间：<?php the_time('Y-m-d'); ?></span></div>
	            </div>
	          </a>
          </li>
          <?php endwhile; ?>
        </ul>
        <div class="col-md-12 center pagefooter">
          <?php xy_paginate();?>
        </div>
				<?php endif; ?>
      </div>
      <div class="col-md-3 newslist-r">
        <div class="hotnews">
          <h5>热门</h5>
          <ol>
            <?php xy_most_viewed_format($cur_cat->term_id);?>
          </ol>
        </div>
      </div>
      
    </div>
  </div>
	<?php endif; ?>
<?php get_footer(); ?>

