<?php
  get_header();

  while( have_posts() ): the_post();
    $meta = get_post_meta( $wp_query->queried_object_id , '_' . THEME_PREFIX . '_top_pic', true );
    $pic = ( isset( $meta['pic'] ) && $meta['pic'] ) ? $meta['pic'] : '';
    $not_show_title = ( isset( $meta['show_title'] ) && $meta['show_title'] ) ? $meta['show_title'] : '';
?>
  <div class="newsbg">
    <img src="<?php echo $pic ? $pic : $tplRootUrl . '/img/news-bg.gif';?>" alt="">
  </div>
  <div class="container padding-b300">
    <div class="row clearfix">
      <div class="col-md-12">
        <?php if (!$not_show_title) :?>
        <div class="newstitle center">
          <span class="dis-mid icons"></span><?php the_title(); ?> 
        </div>
        <?php endif;?>
        <div class="newscontent">
          <?php the_content(); ?>
        </div>
        
      </div>
    </div>
  </div>
<?php endwhile; ?>
<?php get_footer(); ?>