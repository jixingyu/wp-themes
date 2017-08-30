<?php
/*
Template Name: 预约报名
*/
    require_once(ABSPATH . 'wp-content/themes/mingtang/inc/xy_captcha.php');

    get_header();
    require_once(ABSPATH . 'wp-content/themes/mingtang/mt-config.php');
    function add_mtreg($reg) {
        $reg['real_name'] = sanitize_text_field($reg['real_name']);
        $reg['email'] = sanitize_email($reg['email']);
        if( empty($reg['real_name']) || empty($reg['email']) ) return;
        $reg['create_time'] = !empty($reg['create_time']) ? $reg['create_time'] : time();
        
        global $wpdb;
        $table_name = $wpdb->prefix . 'mingtang_reg';
        if( $wpdb->insert( $table_name, $reg ) )
            return $wpdb->insert_id;
        
        return 0;
        
    }
    if (isset($_POST['mtregNonce'])) {
        if (!wp_verify_nonce($_POST['mtregNonce'], 'mtreg-nonce' ) ) {
            $message = '安全认证失败，请重试！';
        } else {
            $email = $_POST['email'];
            $real_name = $_POST['real_name'];
            $postReg = array(
                'email'     => $email,
                'real_name'  => $real_name,
            );
            $ret = add_mtreg($postReg);
            if (is_numeric($ret)) {
                if ($ret) {
                    $reg_success = '恭喜您，预约报名成功';
                } else {
                    $message = '预约报名失败，请重试或联系客服！';
                }
            } else {
                $message = $ret;
            }
        }
    }
?>

<input type="hidden" name="mtregNonce" value="<?php echo wp_create_nonce('mtreg-nonce');?>" >
<img src="/wp-content/themes/mingtang/captcha.php">
<?php get_footer();?>