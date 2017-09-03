<?php

$datas_1 = array(
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
	'index' => array(
		'section_title' => '首页栏目设置',
		'section_text' => '',
		array( 'type' => 'text', 'name' => 'index-posts', 'label' => '图片文章集（7篇）' ),
		array( 'type' => 'category', 'name' => 'index-notice', 'label' => '首页公告', 'selected' => -1 ),
		array( 'type' => 'text', 'name' => 'index-reg_types', 'label' => '首页预约位置', 'tips' => '例：1,2,3  类型对应的数字点击左侧预约报名页面，在下拉筛选中查看' ),
	),
	'reg' => array(
		'section_title' => '预约报名设置',
		'section_text' => '',
		array( 'type' => 'text', 'name' => 'reg-reg_types', 'label' => '预约报名类型', 'tips' => '例：1,2,3  类型对应的数字点击左侧预约报名页面，在下拉筛选中查看' ),
	),
);

$settings = array( '图片设置' => $datas_1, '栏目' => $datas_2 );