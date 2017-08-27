<?php
  get_header();

  while( have_posts() ): the_post();
    $meta = get_post_meta( $wp_query->queried_object_id , '_' . THEME_PREFIX . '_top_pic', true );
    $pic = ( isset( $meta['pic'] ) && $meta['pic'] ) ? $meta['pic'] : '';
?>
  <div class="newsbg"<?php if ($pic) echo ' style="background: url(' . $pic . ') center 0 no-repeat;"';?>>
  </div>
  <div class="container padding-b300">
    <div class="row clearfix">
      <div class="col-md-12">
        <div class="newstitle center">
          <span class="dis-mid icons"></span><?php the_title(); ?> 
        </div>
        <div class="newscontent">
          <?php the_content(); ?>
        </div>
        
      </div>
    </div>
  </div>
<?php endwhile; ?>
<?php get_footer(); ?>