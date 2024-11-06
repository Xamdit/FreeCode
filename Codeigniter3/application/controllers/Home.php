<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Home extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('user_model');
		$this->load->model('bank_model');
		$this->load->model('admin_model');
		$this->load->helper('cookie');
		$this->load->helper('form');
		$this->load->helper('url');
	}

	public function aff($aff = false)
	{
		$user = $this->session->userdata('user');
		if (!$user) {
			if ($aff == false) {
				redirect(base_url('/'));
			} else {
				if ($this->user_model->get_user_id($aff)) {
					$cookie = array(
						'name'   => 'aff',
						'value'  => $aff,
						'expire' => '600',
						'path'   => "/"
					);
					$this->input->set_cookie($cookie);
					redirect(base_url('/'));
				} else {
					redirect(base_url('/'));
				}
			}
		} else {
			redirect(base_url('/'));
		}
	}

	public function ref($ref = false)
	{
		$user = $this->session->userdata('user');
		if (!$user) {
			if ($ref == false) {
				redirect(base_url('/'));
			} else {
				if ($this->user_model->get_user_id($ref)) {
					$cookie = array(
						'name'   => 'ref',
						'value'  => $ref,
						'expire' => '600',
						'path'   => "/"
					);
					$this->input->set_cookie($cookie);
					redirect(base_url('/'));
				} else {
					redirect(base_url('/'));
				}
			}
		} else {
			redirect(base_url('/'));
		}
	}

	public function alliance($alliance = false)
	{
		$user = $this->session->userdata('user');
		if (!$user) {
			if ($alliance == false) {
				redirect(base_url('/'));
			} else {
				if ($this->user_model->get_code_allianace($alliance)) {
					$cookie = array(
						'name'   => 'alliance',
						'value'  => $alliance,
						'expire' => '600',
						'path'   => "/"
					);
					$this->input->set_cookie($cookie);
					redirect(base_url('/'));
				} else {
					redirect(base_url('/'));
				}
			}
		} else {
			redirect(base_url('/'));
		}
	}

	public function index()
	{
	    $res = scandir(FCPATH . 'application/views');
	   // print_r($res);die;
	   $seting = $this->admin_model->result_setting();
	   foreach ($res as $val){
	       //$str = substr($val,0, -4);
	       $view = $seting['theme'].".php";
	       // echo $str."123<br>";
	       // if(!empty($str)){
	       if (strpos($val, $view) !== false) {
	           return $this->load->view($seting['theme']);
	           //echo $str."<br>";
	       }
	       // }
	   }
	   
	   return $this->load->view('home');
	    
	   // if($seting['theme'] == 'theme-1'){
	   //    return $this->load->view('theme-1'); 
	   // }if(!empty($seting['theme'])){
	   //    return $this->load->view($seting['theme']); 
	   // }else{
	   //     return $this->load->view('home');
	   // }
		
	}

	public function get_client_ip()
	{
		$ipaddress = '';
		if (isset($_SERVER['HTTP_CLIENT_IP']))
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if (isset($_SERVER['HTTP_X_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		else if (isset($_SERVER['HTTP_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		else if (isset($_SERVER['REMOTE_ADDR']))
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}

	public function game()
	{
		$user = $this->session->userdata('user');

		if ($user) {

			$user_ufa = $this->user_model->user_ufa($user);

			$ip = $this->input->ip_address();

			$curlip = curl_init();

			curl_setopt_array($curlip, array(
				CURLOPT_URL => "http://ip-api.com/php/{$ip}?fields=country,city,regionName&key=c4j1ih733rks3k2",
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "GET",
			));

			$response = unserialize(curl_exec($curlip));

			curl_close($curlip);

			$agent = $_SERVER['HTTP_USER_AGENT'];
			$browserArray = array(
				'Windows Mobile' => 'IEMobile',
				'Android Mobile' => 'Android',
				'iPhone Mobile' => 'iPhone',
				'Firefox' => 'Firefox',
				'Google Chrome' => 'Chrome',
				'Internet Explorer' => 'MSIE',
				'Opera' => 'Opera',
				'Safari' => 'Safari'
			);
			foreach ($browserArray as $k => $v) {
				if (preg_match("/$v/", $agent)) {
					break;
				} else {
					$k = "Browser Unknown";
				}
			}
			$browser = $k;


			// echo '<pre>';
			// print_r($ip);die;
			$SMS = "\n☢แจ้งเตือนเข้าสู่ WEB UFA☢";
			$SMS .= "\nสมาชิก => " . $user_ufa['username'];
			$SMS .= "\nIP Login => " . $ip;
			$SMS .= "\nBrowser => " . $browser;
			$SMS .= "\nCity => " . $response['city'] . "," . $response['regionName'];
			$SMS .= "\nCountry => " . $response['country'];
			$SMS .= "\nDate => " . date("Y-m-d H:i:s");

			$this->notify_sent($SMS, 2);
			return $this->load->view('game');
		} else {
			header('location: ./');
		}
	}

	public function game2()
	{
		$user = $this->session->userdata('user');

		if ($user) {

			$user_ufa = $this->user_model->user_ufa($user);

			$ip = $this->input->ip_address();

			$curlip = curl_init();

			curl_setopt_array($curlip, array(
				CURLOPT_URL => "http://ip-api.com/php/{$ip}?fields=country,city,regionName&key=c4j1ih733rks3k2",
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "GET",
			));

			$response = unserialize(curl_exec($curlip));

			curl_close($curlip);

			$agent = $_SERVER['HTTP_USER_AGENT'];
			$browserArray = array(
				'Windows Mobile' => 'IEMobile',
				'Android Mobile' => 'Android',
				'iPhone Mobile' => 'iPhone',
				'Firefox' => 'Firefox',
				'Google Chrome' => 'Chrome',
				'Internet Explorer' => 'MSIE',
				'Opera' => 'Opera',
				'Safari' => 'Safari'
			);
			foreach ($browserArray as $k => $v) {
				if (preg_match("/$v/", $agent)) {
					break;
				} else {
					$k = "Browser Unknown";
				}
			}
			$browser = $k;


			// echo '<pre>';
			// print_r($ip);die;
			$SMS = "\n☢แจ้งเตือนเข้าสู่ WEB UFA☢";
			$SMS .= "\nสมาชิก => " . $user_ufa['username'];
			$SMS .= "\nIP Login => " . $ip;
			$SMS .= "\nBrowser => " . $browser;
			$SMS .= "\nCity => " . $response['city'] . "," . $response['regionName'];
			$SMS .= "\nCountry => " . $response['country'];
			$SMS .= "\nDate => " . date("Y-m-d H:i:s");

			$this->notify_sent($SMS, 2);
			return $this->load->view('game2');
		} else {
			header('location: ./');
		}
	}


	private function notify_sent($message, $tt = 1)
	{
		$setting = $this->admin_model->result_setting();
		$token =  "";
		if ($tt == 1) {
			$token =  $setting['token_line'];
		} else if ($tt == 2) {
			$token =  $setting['token_line_game'];
		} else if ($tt == 3) {
			$token =  $setting['token_line_depo'];
		} else if ($tt == 4) {
			$token =  $setting['token_line_with'];
		} else {
			$token =  $setting['token_line'];
		}

		// $token =  $setting['token_line']; //ใส่Token ที่copy เอาไว้
		$str = $message; //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร

		$res = $this->notify_message($str, $token);
		//print_r($res);
	}

	private  function notify_message($message, $token)
	{
		$queryData = array('message' => $message);
		$queryData = http_build_query($queryData, '', '&');
// 		$headerOptions = array(
// 			'https' => array(
// 				'method' => 'POST',
// 				'header' => "Content-Type: application/x-www-form-urlencoded\r\n"
// 					. "Authorization: Bearer " . $token . "\r\n"
// 					. "Content-Length: " . strlen($queryData) . "\r\n",
// 				'content' => $queryData
// 			),
// 		);
// 		$context = stream_context_create($headerOptions);
// 		$result = file_get_contents(LINE_API, FALSE, $context);
// 		$res = json_decode($result);
// 		return $res;
		
		$curl_handle=curl_init();
        curl_setopt($curl_handle, CURLOPT_URL,LINE_API);
        curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $queryData);
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_USERAGENT, 'ServerMe');
        $query = curl_exec($curl_handle);
        curl_close($curl_handle);
        return json_decode($query);
	}
}
