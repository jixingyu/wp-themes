<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html> 
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" /> 
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1">
    <title><?php if ( is_home() ) {
            bloginfo('name');
        } elseif ( is_category() ) {
            single_cat_title(); echo " - "; bloginfo('name');
        } elseif (is_single() || is_page() ) {
            single_post_title();
        } elseif (is_search() ) {
            echo "搜索结果 - "; bloginfo('name');
        } elseif (is_404() ) {
            echo '页面未找到!';
        } else {
            wp_title('',true);
        } ?></title>
    <?php
        $description = '';
        $keywords = '';

        if (is_home() || is_page()) {
           $description = get_bloginfo('name');
           $keywords = get_bloginfo('name');
        } elseif (is_single()) {
           $description1 = get_post_meta($post->ID, "description", true);
           $description2 = str_replace("\n","",mb_strimwidth(strip_tags($post->post_content), 0, 200, "…", 'utf-8'));

           // 填写自定义字段description时显示自定义字段的内容，否则使用文章内容前200字作为描述
           $description = $description1 ? $description1 : $description2;
           
           // 填写自定义字段keywords时显示自定义字段的内容，否则使用文章tags作为关键词
           $keywords = get_post_meta($post->ID, "keywords", true);
           if($keywords == '') {
              $tags = wp_get_post_tags($post->ID);    
              foreach ($tags as $tag ) {        
                 $keywords = $keywords . $tag->name . ", ";    
              }
              $keywords = rtrim($keywords, ', ');
           }
        } elseif (is_category()) {
           $description = category_description();
           $keywords = single_cat_title('', false);
        } elseif (is_tag()){
           $description = tag_description();
           $keywords = single_tag_title('', false);
        }
        if (empty($keywords)) {
          $keywords = get_bloginfo('name');
        }
        $description = trim(strip_tags($description));
        $keywords = trim(strip_tags($keywords));
    ?>
    <meta name="description" content="<?php echo $description; ?>" />
    <meta name="keywords" content="<?php echo $keywords; ?>" />
    <link rel="shortcut icon" href="/wp-content/themes/uts/img/favicon.ico" />

    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />

    <?php
        global $th_options;
        wp_head();
    ?>
</head>
<body>
  <!-- 导航 如果管理员登录了之后 navbg追加一个class=>  admin-login -->
  <div class="navbg<?php if ( is_user_logged_in() ) echo ' admin-login'; ?>">   
    <div class="container">
      <div class="row clearfix">
        <div class="col-md-12 column">
          <div class="navbar navbar-youtong">
            <nav class="navbar navbar-youtong" role="navigation">
              <div class="navbar-header">
                 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse"> <span class="sr-only">切换</span><div class="line-iconbar"></div><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button> 
                 <a class="navbar-brand" href="/"><div class="logo"><img src="<?php bloginfo('template_url');?>/img/logo.png" /></div></a>
              </div>
            
              <div class="collapse navbar-collapse" id="navbar-collapse">
                <div class="navbar-login navbar-right">
                  <!-- id="qiyeuser" -->
                  <!-- <a href="#"><span class="bgorgrad">登录</span></a> -->
                  <!-- 登录后显示下面运单查询代码 -->
                  <span id="waybilltop" class="search-btn bgorgrad"><img src="<?php bloginfo('template_url');?>/img/search.png" alt="运单查询">运单查询</span>
                </div>
                <?php
                    wp_nav_menu( array(
                        'theme_location' => 'navmain',
                        'walker' => new Uts_Navmain_Walker(),
                        'container' => '',
                        'items_wrap' => '<ul class="nav navbar-nav navbar-right">%3$s</ul>',
                        'depth' => 2
                    ) );
                ?>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>

