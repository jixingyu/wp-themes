<?php
/**
CREATE TABLE `wp_uts_user` (
  `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(255) NOT NULL DEFAULT '',
  `apikey` VARCHAR(1000) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MYISAM DEFAULT CHARSET=utf8

47 已回单
46 已签收
45 已到货
43 已提货
42 在途
40 已计划
20 审核
10 开放
*/
class Tms_api
{
    const LOGIN_URL = "http://app.360scm.com/SCM.TMS7.WebApi/Oauth/GetTokenByPassword?username=%s&password=%s";
    const TOKEN_URL = "http://app.360scm.com/SCM.TMS7.WebApi/Oauth/GetTokenByCustomer?apikey=%s";
    const TRACKING_URL = "http://app.360scm.com/SCM.TMS7.WebApi/Customer/GetOrderTracking?token=%s&gid=%s&typeCode=%s";
    const ORDER_LIST_URL = 'http://app.360scm.com/SCM.TMS7.WebApi/Customer/GetOrderListByPage';
    const ADMIN_TRACKING_URL = "http://app.360scm.com/SCM.TMS7.WebApi/Order/GetOrderTracking?token=%s&gid=%s&typeCode=%s";
    const ADMIN_ORDER_LIST_URL = 'http://app.360scm.com/SCM.TMS7.WebApi/Order/GetOrderListByPage';
    const ADMIN_TOKEN_URL = 'http://app.360scm.com/SCM.TMS7.WebApi/Oauth/GetToken?apikey=%s';
    const ADMIN_API = 'NHE51ewL3esR/wYvriV3vQSLctm7LtbW3A0FHiVXg1l8GJ8zJLs3fLWU7GErquH9kwdgn8pCNjXzvnJU9l4hRbercB9YWnHuF2/VYZCmQdJ+L5Q1yxAZZOqJC31XbRQnYVipN3/HLXS8boE2GrxtbKqzGT9uJWvscumo3lXTVsXAoejymkSS1ZOzeDUCwxmXLv83Io7fmuEQYNo8+QR/+g==';
    private $status_list = array(
        10 => '开放 ',
        20 => '审核',
        40 => '已计划',
        42 => '在途',
        43 => '已提货',
        45 => '已到货',
        46 => '已签收',
        47 => '已回单',
    );

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
		    			Xysession::set('uts-login', array(
                            'username' => $username,
                            'token' => $tokenData['token'],
                        ));
		    			return array('code' => 0);
		    		}
	    		}
    		} else {
    			return array('code' => $data['resultCode'], 'msg' => $data['msg']);
    		}
    	}
    	return array('code' => 9001, 'msg' => '登录失败');
    }

    public function logout()
    {
        Xysession::clear('uts-login');
    }

    public function order_list($curPage, $order_search, $type = 3, $order_status = '')
    {
        $utsLogin = Xysession::get('uts-login');
        if (empty($utsLogin)) {
            return array('code' => 9002, 'msg' => '未登录');
        }
        $token = $utsLogin['token'];
        $limit = (int) get_option('posts_per_page');

        $params = array(
            'Search' => array(
                'PageInfo' => array(
                    'CurrentPage' => $curPage,
                    'PageSize' => $limit,
                    'SortField' => 'CREATED_DATE',
                    'SortDirection' => 'DESC',
                    'IsPaging' => 'true',
                    'IsGetTotalCount' => 'true',
                ),
            ),
            'token' => $token,
        );
        if (!empty($order_status) && !isset($this->status_list[$order_status])) {
            $order_status = '';
        }
        if (!empty($order_search) || !empty($order_status)) {
            $items = array();
            if (!empty($order_search)) {
                $items[] = array(
                    'Field' => $type == 2 ? 'ORDER_ID' : 'C_ORDER_NO',
                    'Method' => 'Equal',
                    'Value' => $order_search,
                );
            }
            if (!empty($order_status)) {
                $items[] = array(
                    'Field' => 'STATUS',
                    'Method' => 'Equal',
                    'Value' => $order_status,
                );
            }
            $params['Search']['QueryModel'] = array('Items' => $items);
        }

        $data = $this->curl_post(self::ORDER_LIST_URL, $params);
        if (!empty($data['data']['list'])) {
            $result = array();
            foreach ($data['data']['list'] as $order) {
                $retult[] = array(
                    'ORDER_ID' => $order['ORDER_ID'],
                    'C_ORDER_NO' => $order['C_ORDER_NO'],
                    'CREATED_DATE' => $order['CREATED_DATE'],
                    'STATUS' => $order['STATUS'],
                    'CUSTOMER_NAME' => $order['CUSTOMER_NAME'],
                    'SRC_ADDRESS' => $order['SRC_ADDRESS'],
                    'DEST_ADDRESS' => $order['DEST_ADDRESS'],
                    'STATUS' => $order['STATUS'],
                );
            }
            if ($data['data']['total'] > $limit * $curPage) {
                $nextPage = 1;
            } else {
                $nextPage = 0;
            }
            return array('code' => 0, 'data' => array(
                'data' => $retult,
                'nextPage' => $nextPage,
            ));
        }
        return array('code' => 7001, 'msg' => '订单查询失败');
    }

    public function order_list_by_admin($order_search, $type = 3)
    {
        $token = Xysession::get('tms_admin_token');
        if (!$token) {
            $tokenData = $this->curl_get(sprintf(self::ADMIN_TOKEN_URL, urlencode(self::ADMIN_API)));
            if (isset($tokenData['resultCode']) && $tokenData['resultCode'] == 0) {
                Xysession::set('tms_admin_token', $tokenData['token']);
            }
            $token = $tokenData['token'];
        }
        if (!empty($token)) {
            $data = $this->curl_post(self::ADMIN_ORDER_LIST_URL, array(
                'Search' => array(
                    'QueryModel' => array(
                        'Items' => array(
                            array(
                                'Field' => $type == 2 ? 'ORDER_ID' : 'C_ORDER_NO',
                                'Method' => 'Equal',
                                'Value' => $order_search,
                            ),
                        ),
                    ),
                    'PageInfo' => array(
                        'CurrentPage' => 1,
                        'PageSize' => 1,
                        'SortField' => 'CREATED_DATE',
                        'SortDirection' => 'DESC',
                    ),
                ),
                'token' => $token,
            ));
            if (isset($data['data']['list'][0])) {
                $order = $data['data']['list'][0];
                $order_info = array(
                    'ORDER_ID' => $order['ORDER_ID'],
                    'C_ORDER_NO' => $order['C_ORDER_NO'],
                    'CREATED_DATE' => $order['CREATED_DATE'],
                    'STATUS' => $order['STATUS'],
                    'CUSTOMER_NAME' => $order['CUSTOMER_NAME'],
                    'SRC_ADDRESS' => $order['SRC_ADDRESS'],
                    'DEST_ADDRESS' => $order['DEST_ADDRESS'],
                    'STATUS' => $order['STATUS'],
                );
                foreach ($this->status_list as $one_status => $status_desc) {
                    $order_info['tracking'][$one_status] = array('status_desc' => $status_desc);
                }
                $tracking = $this->curl_get(sprintf(self::ADMIN_TRACKING_URL, urlencode($token), urlencode($order_search), $type));
                if (isset($tracking['data'][0]['order_tracking'])) {
                    foreach ($this->status_list as $one_status => $status_desc) {
                        foreach ($tracking['data'][0]['order_tracking'] as $tracking_row) {
                            if ($one_status == $tracking_row['STATUS'] && empty($order_info['tracking'][$one_status]['time'])) {
                                $order_info['tracking'][$one_status]['time'] = str_replace('T', ' ', $tracking_row['CREATED_DATE']);
                            }
                        }
                    }
                }
                return array('code' => 0, 'data' => $order_info);
            }
        }
        return array('code' => 7001, 'msg' => '订单查询失败');
    }

    public function order_tracking($order_search, $type = '3')
    {
    	$utsLogin = Xysession::get('uts-login');
    	if (empty($utsLogin)) {
    		return array('code' => 9002, 'msg' => '未登录');
    	}
        $token = $utsLogin['token'];
        $result = array();
        foreach ($this->status_list as $one_status => $status_desc) {
            $result[$one_status] = array('status_desc' => $status_desc, 'time' => '');
        }
        $tracking = $this->curl_get(sprintf(self::TRACKING_URL, urlencode($token), urlencode($order_search), $type));
        if (isset($tracking['data'][0]['order_tracking'])) {
            foreach ($this->status_list as $one_status => $status_desc) {
                foreach ($tracking['data'][0]['order_tracking'] as $tracking_row) {
                    if ($one_status == $tracking_row['STATUS'] && empty($result[$one_status]['time'])) {
                        $result[$one_status]['time'] = str_replace('T', ' ', $tracking_row['CREATED_DATE']);
                    }
                }
            }
            return array('code' => 0, 'data' => $result);
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
