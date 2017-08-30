<?php
require_once('inc/xy_captcha.php');

define('WP_USE_THEMES', false);
require('../../../wp-load.php');

$xy_captcha = new xy_captcha();
$xy_captcha->doimg('reg');
