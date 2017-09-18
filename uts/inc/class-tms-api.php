<?php
/**
CREATE TABLE `wp_uts_user` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(255) NOT NULL DEFAULT '',
  `apikey` VARCHAR(1000) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MYISAM DEFAULT CHARSET=utf8
*/
if (!session_id()) session_start();
class Tms_api
{
    const LOGIN_URL = "http://app.360scm.com/SCM.TMS7.WebApi/Oauth/GetTokenByPassword?username=%s&password=%s";
    const TOKEN_URL = "http://app.360scm.com/SCM.TMS7.WebApi/Oauth/GetTokenByCustomer?apikey=%s";
    const TRACKING_URL = "http://app.360scm.com/SCM.TMS7.WebApi/Customer/GetOrderTracking?token=%s&gid=%s&typeCode=%s";

    public function login($username, $password)
    {
    	$data = $this->curl_get(sprintf(self::LOGIN_URL, urlencode($username), urlencode($password)));
    	if (isset($data['resultCode'])) {
    		if ($data['resultCode'] == 0) {
	    		// login success
	    		global $wpdb;
	    		$apikey = $wpdb->get_var($wpdb->prepare("SELECT apikey FROM " . $wpdb->prefix . "uts_user WHERE `username` = %s", $username));
	    		if ($apikey) {
		    		$tokenData = $this->curl_get(sprintf(self::TOKEN_URL, urlencode($apikey)));
    				if (isset($tokenData['resultCode']) && $tokenData['resultCode'] == 0) {
		    			$_SESSION['tms_token'] = $tokenData['token'];
		    			return array('code' => 0);
		    		}
	    		}
    		} else {
    			return array('code' => $data['resultCode'], 'msg' => $data['msg']);
    		}
    	}
    	return array('code' => 9001, 'msg' => '登录失败');
    }

    public function get_token()
    {
    	if (!empty($_SESSION['tms_token'])) {
    		return $_SESSION['tms_token'];
    	} else {
    		return false;
    	}
    }

    public function order_tracking($search, $type = '2')
    {
    	$token = $this->get_token();
    	if (!$token) {
    		return array('code' => 9002, 'msg' => '未登录');
    	}
    	$data = $this->curl_get(sprintf(self::TRACKING_URL, urlencode($token), urlencode($search), $type));
    	if (isset($data['resultCode']) && $data['resultCode'] == 0) {
    		return array('code' => 0, 'data' => isset($data['data'][0]['order_tracking']) ? $data['data'][0]['order_tracking'] : array());
    	}
    	return array('code' => 8001, 'msg' => '跟踪信息获取失败，请重试');
    }

	private function curl_get($url = '', $timeout = '')
	{
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:15.0)");
	    if (!empty($timeout)) {
	        curl_setopt($ch, CURLOPT_TIMEOUT, intval($timeout));
	    }
	    $data = curl_exec($ch);
	    curl_close($ch);

	    return empty($data) ? null : json_decode($data, true);
	}

	private function curl_post($url = '', $params = array(), $timeout = '')
	{
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:15.0)");
	    curl_setopt($ch, CURLOPT_POST, 1);
	    if (!empty($params)) {
	        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
	    }
	    if (!empty($timeout)) {
	        curl_setopt($ch, CURLOPT_TIMEOUT, intval($timeout));
	    }
	    $data = curl_exec($ch);
	    curl_close($ch);

	    return empty($data) ? null : json_decode($data, true);
	}
}
