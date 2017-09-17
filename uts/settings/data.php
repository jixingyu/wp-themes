<?php

$datas_1 = array(
	'banner' => array(
		'section_title' => '头部图像',
		'section_text' => '',
		array( 'type' => 'upload', 'name' => 'head-banner-img', 'label' => '头部图像', 'tips' => '建议图片尺寸：1920*508' ),
	),
	'slider' => array(
		'section_title' => '首页轮播图',
		'section_text' => '',
		array( 'type' => 'text', 'name' => 'head-slider-num', 'label' => '轮播图数量', 'des' => '输入轮播图数量，点击保存，然后上传轮播图片' ),
	),
);

global $th_options;
$slider_num = ( isset( $th_options['head-slider-num'] ) && $th_options['head-slider-num'] ) ? (int) $th_options['head-slider-num'] : 0;
if( 0 < $slider_num ) {
	for( $i = 1; $i <= $slider_num; $i++ ) {
		$datas_1['slider'][] = array( 'type' => 'upload', 'name' => 'head-slider-pic-' . $i, 'label' => '轮播图' . $i, 'tips' => '轮播图尺寸为 1920*750' );
		$datas_1['slider'][] = array( 'type' => 'text', 'name' => 'head-slider-pic-link-' . $i, 'label' => '链接' . $i, 'tips' => '轮播图链接' );
	}
}

$datas_2 = array(
	'business' => array(
		'section_title' => '业务介绍',
		'section_text' => '',
		array( 'type' => 'text', 'name' => 'business-posts', 'label' => '文章集（4篇）')
	),
	'news' => array(
		'section_title' => '新闻设置',
		'section_text' => '',
		array( 'type' => 'category', 'name' => 'news-hot', 'label' => '热门新闻', 'selected' => -1 ),
	),
);

$settings = array( '图片设置' => $datas_1, '栏目' => $datas_2 );