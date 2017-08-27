<?php get_header(); ?>

<?php
  global $wp_query;
  $cat_option = get_option( THEME_PREFIX . '_cat_options_' . $wp_query->queried_object_id );
  $pic = ( is_category() && isset( $cat_option['top-pic'] ) ) ? $cat_option['top-pic'] : '';
  $cat_ID = get_query_var('cat');
  $cur_cat = get_category($cat_ID);
?>

  <div class="newsbg"<?php if ($pic) echo ' style="background: url(' . $pic . ') center 0 no-repeat;"';?>>
  </div>
  <div class="container padding-b300">
    <div class="row clearfix">
      <div class="col-md-12">
        <div class="newstitle center">
          <span class="dis-mid icons"></span><?php echo $cur_cat->name;?>
        </div>

        <?php if( have_posts() ): ?>
        <div class="newslist">
          <ul>
            <?php while( have_posts() ): the_post(); ?>
            <li>
              <a href="<?php the_permalink();?>"><span class="ellipsis"><?php the_title();?></span></a> <span class="float-r"><?php the_time('Y年m月d日');?></span>
            </li>
            <?php endwhile; ?>
          </ul>
        </div>
        <div class="pagefooter">
          <?php xy_paginate();?>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
<?php get_footer(); ?>
