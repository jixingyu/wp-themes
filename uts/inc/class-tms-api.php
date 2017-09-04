<?php

class Tms_api
{
    const TOKEN_URL = "http://app.360scm.com/SCM.TMS7.WebApi/Oauth/GetTokenByPassword?username=%s&password=%s";
    const SHIPPING_LIST_URL = "http://app.360scm.com/SCM.TMS7.WebApi/Shipment/SearchShipmentPageList";

    public function get_token($username, $password)
    {
    	$data = $this->curl_get(sprintf(self::TOKEN_URL, $username, $password));
    	var_dump($data);exit;
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

	    return empty($data) ? null : $data;
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

	    return empty($data) ? null : $data;
	}

	private function curl_post_json($url, $data=array(), $header=array(), $timeout=30)
	{
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	    curl_setopt($ch, CURLOPT_POST, true);
	    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data,JSON_UNESCAPED_UNICODE));
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
	    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);

	    $response = curl_exec($ch);

	    if($error=curl_error($ch)){
	        log_message('error','wx_curl_https_post:'.$url.' --- '.$error);
	        return NULL;
	    }

	    curl_close($ch);
	    return $response;
	}
}
