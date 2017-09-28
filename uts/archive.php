<?php get_header(); ?>

<?php
  $hot_cat_id = ( isset( $th_options['news-hot'] ) && $th_options['news-hot'] ) ? $th_options['news-hot'] : '';
  global $wp_query;
  $cat_option = get_option( THEME_PREFIX . '_cat_options_' . $wp_query->queried_object_id );
  $tmp = ( is_category() && isset( $cat_option['template'] ) ) ? $cat_option['template'] : 'default';
  $cat_ID = get_query_var('cat');
  $cur_cat = get_category($cat_ID);
  if ( $tmp == 'picture' ) :
?>
  <style>
    @media screen and (max-width: 450px) {
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
<?php if ( $tmp == 'picture' ) : ?>
  <?php if( have_posts() ): ?>
    <div class="bussiescont-case">
      <ul id="caselist">
      </ul>
      <div class="center loading" >
        <img src="<?php bloginfo('template_url');?>/img/loading.gif" alt="" />
      </div>
      <div class="getmore" id="getmore2">
        <span class="iconspng icon-down"></span>
      </div>
    </div>
  <?php endif;?>
<?php else : ?>
    <?php if( have_posts() ): ?>
    <div class="bgf8"> 
      <div class="bussiescont newslist">
          <ul id="newslist">
          </ul>
          <div class="center loading" >
            <img src="<?php bloginfo('template_url');?>/img/loading.gif" alt="" />
          </div>
          <div class="getmore" id="getmore1">
            <span class="iconspng icon-down"></span>
          </div>
      </div>
    </div> 
    <div class="hotlist">
      <div class="hotnews">
        <h5>热门新闻</h5>
        <ol>
          <?php xy_most_viewed_format($hot_cat_id);?>
        </ol>
      </div>
    </div>
    <?php endif; ?>
<?php endif; ?>

<script>
(function(){
  var p=1,htmlNews="",htmlCase="",data={},hasMore=true;

  <?php if ( $tmp == 'picture' ) : ?>
    getCaselist(p);
    $('#getmore2').on('click',function(){
      p++;
      getCaselist(p);
    });
    // 案例列表
    function getCaselist(p){
      if (!hasMore) {
        return;
      }
      $.ajax({
       type: "GET",
       url: "/wp-admin/admin-ajax.php?action=xy_more_posts&cat=<?php echo $cat_ID;?>&p="+p,
       dataType: "json",
       success: function(data){
          if(data.data.length > 0){
            $.each(data.data,function(i,item){
              var url = item.url,
                  imgsrc = item.img,
                  title = item.title,
                  time = item.date; 
                  // view = item.views
                  // content = item.content;
                  // if(content.length>55){
                  //   content = item.content.substr(0,55)+"...";
                  // }

              htmlCase+='<li><div class="caselistdiv"><img src="'+imgsrc+'" title="'+title+'"><a href="'+url+'"><div class="casetitle">'+title+'</div></a></div></li>';
            });
            $('.loading').fadeIn();
            
            setTimeout(function(){
              if (data.data.length < <?php echo get_option('posts_per_page');?>) {
              console.log("小于所有内容条数~");
              $('#getmore2').fadeOut();
              $('#totop').fadeIn();
              }else{
                $('#getmore2').fadeIn();
              }

              $('.loading').fadeOut();
              $('#caselist').html(htmlCase);
            },500)
          } else {
            hasMore = false;
            console.log("没有更多了~");
            $('#getmore2').fadeOut();
            $('#totop').fadeIn();
          }
        }
      });
    }
  <?php else : ?>
    // 获取新闻列表
    getNewslist(p);
    $('#getmore1').on('click',function(){
      p++;
      getNewslist(p);
    });
    // 新闻列表
    function getNewslist(p){

      if (!hasMore) {
        return;
      }
      $.ajax({
       type: "GET",
       url: "/wp-admin/admin-ajax.php?action=xy_more_posts&cat=<?php echo $cat_ID;?>&p="+p,
       dataType: "json",
       success: function(data){
          if(data.data.length > 0){
            $.each(data.data,function(i,item){
              var url = item.url,
                  imgsrc = item.img,
                  title = item.title,
                  time = item.date, 
                  view = item.views,
                  content = item.content;
                  // if(content.length>55){
                  //   content = content.substr(0,55)+"...";
                  // }

              htmlNews+='<li><a href="'+url+'"><img src="'+imgsrc+'" alt=""  class="float-l"><div class="list-r-text"><h4 class="ellipsis">'+title+'</h4><div class="list-text-b"><span class="float-l pulishtime">发布时间：'+time+'</span><span class="float-l">阅读量：'+view+'</span></div><div class="list-text-con">'+content+'</div></div></a></li>';
            });
            $('.loading').fadeIn();
            
            setTimeout(function(){
              if (data.data.length < <?php echo get_option('posts_per_page');?>) {
              console.log("小于所有内容条数~");
              $('#getmore1').fadeOut();
              $('#totop').fadeIn();
              }else{
                $('#getmore1').fadeIn();
              }

              $('.loading').fadeOut();
              $('#newslist').html(htmlNews);
            },500)
          } else {
            hasMore = false;
            console.log("没有更多了~");
            $('#getmore1').fadeOut();
            $('#totop').fadeIn();
          }
        }
      });
    }
  <?php endif; ?>
})();
</script>
<?php get_footer(); ?>



