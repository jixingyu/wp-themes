<?php get_header();
  $xyCat = get_the_category();
  if (!empty($xyCat)) {
    $xyCatName = $xyCat[0]->name;
  } else {
    $xyCatName = '';
  }
?>

<div class="news_Container">
  <div class="newscon pageW">
      <div class="positon"><?php xy_breadcrumb(); ?></div>
      <div class="news_wrap clearfix" style="min-height: 840px">
          <div class="newslist fl">
            <?php while( have_posts() ): the_post(); ?>
              <div class="newscontent">
                <?php if ($xyCatName == '行业资讯') : ?>
                <h2 class="title"><?php the_title();?></h2>
                <p class="c">
                    <span class="time">日期：<?php the_time('Y-m-d H:i');?></span>
                </p>
                <?php endif; ?>
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
