<?php get_header(); ?>

<div class="news_Container">
  <div class="newscon pageW">
      <div class="positon"><?php xy_breadcrumb(); ?></div>
      <div class="news_wrap clearfix" style="min-height: 840px">
          <div class="newslist fl">
            <?php while( have_posts() ): the_post(); ?>
              <div class="newscontent">
                <h2 class="title"><?php the_title();?></h2>
                <p class="c">
                    <span class="time">日期：<?php the_time('Y-m-d H:i');?></span>
                </p>
                <div class="newscc">
                  <?php the_content(); ?>
                </div>
                <?php xy_post_nav();?>
              </div>
            <?php endwhile; ?>
          </div>
      </div>
  </div>
</div>

<?php get_footer(); ?>
