<?php
defined('BASEPATH') or exit('No direct script access allowed');
header('Content-Type: application/json');
class Api extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('admin_model');
		$this->load->model('bank_model');
		$this->load->library('session');
		$this->load->helper('cookie');
		$this->load->library('Ufa');
		$this->load->library('scb');
	}
	public function check_transaction($t)
	{

		$bb = $this->admin_model->bank_w();
		$scb = [
			"accnum" => $bb['accnum'], //เลขบช
			"deviceid" => $bb['username'], //deviceid
			"pin" => $bb['password']
		]; ////api_refresh
		$this->scb->SetLogin($scb['deviceid'], $scb['pin'], $scb['accnum']);
		$cc = $this->scb->getTransaction1($t);
		echo $cc;
	}

	public function checkbaba()
	{
		$bb = $this->admin_model->bank();
		$scb = [
			"accnum" => $bb['accnum'], //เลขบช
			"deviceid" => $bb['username'], //deviceid
			"pin" => $bb['password']
		]; ////api_refresh
		$this->scb->SetLogin($scb['deviceid'], $scb['pin'], $scb['accnum']);
		$cc = $this->scb->GetBalance();
		echo $cc;
	}
	public function checkbaba_w()
	{
		$bb = $this->admin_model->bank_w();
		$scb = [
			"accnum" => $bb['accnum'], //เลขบช
			"deviceid" => $bb['username'], //deviceid
			"pin" => $bb['password']
		]; ////api_refresh
		$this->scb->SetLogin($scb['deviceid'], $scb['pin'], $scb['accnum']);
		$cc = $this->scb->GetBalance();
		echo $cc;
	}

	public function checkagent_info()
	{
		if (php_sapi_name() == 'cli') {
			$check = $this->ufa->agent_info();
			if (!empty($check)) {
				foreach ($check as $k => $v) {
					echo "{$k}={$v}" . PHP_EOL;
				}
			}
		}
	}

	private function getDatacb()
	{
		$bb = $this->admin_model->bank();
		$scb = [
			"accnum" => $bb['accnum'], //เลขบช
			"deviceid" => $bb['username'], //deviceid
			"pin" => $bb['password']
		]; ////api_refresh
		return $scb;
	}

	public function checkuser()
	{

		$username = $this->input->post('username');
		$check    = $this->user_model->auth($username);
		if ($check == 0) {

			echo json_encode(['status' => true]);
		} else {
			echo json_encode(['status' => false]);
		}
	}

	public function notificationsadmin()
	{

		$username = $this->session->userdata('stats_admin');
		$count = $this->admin_model->count_withdraw($username);
		if ($count['count(*)'] >= 0) {

			echo json_encode(['status' => true, 'msg' => 'มีข้อความ', 'count' => $count['count(*)']]);
		} else {
			echo json_encode(['status' => false]);
		}
	}

	// แก้
	public function Promotion()
	{
		$user_session = $this->session->userdata('user');
		if ($user_session) {
			if ($_POST) {
				$balance = 0;
				date_default_timezone_set('asia/bangkok');
				$member =  $this->user_model->getdata_user($user_session);
				$username = $user_session;
				$date_s = date("d-m-Y");
				$date_c = $this->user_model->check_date_powyingshup($username);
				$setting_powyingshup = $this->admin_model->setting_powyingshup();
				$acc = '';
				if ($date_c != '') {
					$str_date = explode(" ", $date_c['date']);
					$str_date_1 = explode("-", $str_date[0]);
					$date_str = $str_date_1[2] . '-' . $str_date_1[1] . '-' . $str_date_1[0];
					$date_s =  $date_str;
					$acc = $this->user_model->promotion1($username, $setting_powyingshup[0]['deposit'], $date_s);
				} else {
					$date_s = date("d-m-Y");
					$acc = $this->user_model->promotion($username, $setting_powyingshup[0]['deposit'], $date_s);
				}
				$user_ufa = $this->user_model->user_ufa($username);

				foreach ($acc as $key => $value) {
					$date = str_replace('/', '-', $value['date']);
					$balance +=   (int) $value['amount'];
					$dates[] = strtotime($date);
				}
				if (empty($acc)) {
					echo json_encode(['stats' => false, 'msg' => 'ยังไม่การเข้าระบบ']);
					exit;
				}
				// echo json_encode(['stats' => false, 'msg' => $acc]);die;
				$balance =  round($balance * (3 / 100));

				$conseq = array();
				$ii = 0;
				$max = count($dates);

				for ($i = 0; $i < count($dates); $i++) {
					$conseq[$ii][] = date('Y-m-d', $dates[$i]);

					if ($i + 1 < $max) {
						$dif = $dates[$i + 1] - $dates[$i];
						if ($dif >= 90000) {
							$ii++;
						}
					}
				}
				rsort($conseq);

				foreach ($conseq as $key => $value) {
					$value = array_unique($value);
					// echo json_encode(['stats' => false, 'msg' => $value]);die;
					// print_r($conseq);die;

					if (count($value) >= $setting_powyingshup[0]['day']) { // โปรเติมเงินติดต่อกัน 3 วัน

						$txtencode =  md5($value[0] . $value[count($value)]);
						$data = [
							$username,
							$balance,
							$txtencode
						];

						$check =  $this->user_model->CheckPromotion($data);
						$powyingshup = intval($member['powyingshup']) + intval($setting_powyingshup[0]['play']);
						$result = $this->user_model->update_play_powyingshup($username, $powyingshup);
						// echo json_encode(['stats' => false, 'msg' => $member['powyingshup']]);die;
						if ($check == 0) {
							echo json_encode(['stats' => true, 'msg' => 'คุณได้รับ ', 'balance' => $setting_powyingshup[0]['play']]);
							$this->user_model->add_promotion(['username' => $username, 'amount' => $setting_powyingshup[0]['play'], 'txtencode' => $txtencode, 'balance' => $powyingshup]);
							exit;
						} else {
							echo json_encode(['stats' => false, 'msg' => 'คุณเคยได้รับแล้ว']);
							exit;
						}
					} else {
						echo json_encode(['stats' => false, 'msg' => 'ยังไม่ครบเวลาที่กำหนด เหลือเวลาอีก ' . (intval($setting_powyingshup[0]['day']) - intval(count($value))) . ' วัน']);
						exit;
					}
				}
			}
		} else {
			header('location: ../');
		}
	}
	//แก้ไข

	public function alert_topup()
	{
		$user_session = $this->session->userdata('user');
		if ($user_session) {
			$data = $this->user_model->select_last_trans($user_session);
			if ($data) {

				echo json_encode(['status' => true, 'id' => $data['id'], 'amount' => $data['amount']]);
			} else {
				echo json_encode(['status' => false]);
			}
		} else {
			header('location: ../');
		}
	}

	public function check_bank()
	{
	     header("Access-Control-Allow-Origin: *");
		$bank   = $this->input->post('bank_name');
		$accnum = $this->input->post('bank_number');
		$banks  = array(
			"bbl" => array("name" => "กรุงเทพ", "code" => "002"),
			"scb" => array("name" => "ไทยพาณิชย์", "code" => "014"),
			"kbank" => array("name" => "กสิกร", "code" => "004"),
			"bay" => array("name" => "กรุงศรีอยุธยา", "code" => "025"),
			"ktb" => array("name" => "กรุงไทย", "code" => "006"),
			"tmb" => array("name" => "ทหารไทย", "code" => "011"),
			"tbank" => array("name" => "ธนชาติ", "code" => "065"),
			"gsb" => array("name" => "ออมสิน", "code" => "030"),
			"baac" => array("name" => "เพื่อการเกษตรและสหกรณ์การเกษตร", "code" => "034"),
			"uob" => array("name" => "ยูโอบี", "code" => "024"),
			"tisco" => array("name" => "ทิสโก้", "code" => "067"),
			"cimb" => array("name" => "ซีไอเอ็มบีไทย", "code" => "022"),
			"citi" => array("name" => "ซิตี้แบงก์", "code" => "017"),
			"deut" => array("name" => "ดอยช์แบงก์", "code" => "032"),
			"ghb" => array("name" => "อาคารสงเคราะห์", "code" => "033"),
			"hsbc" => array("name" => "ฮ่องกงและเซี่ยงไฮ้", "code" => "031"),
			"icbc" => array("name" => "ไอซีบีซี", "code" => "070"),
			"isbt" => array("name" => "อิสลามแห่งประเทศไทย", "code" => "066"),
			"kkp" => array("name" => "เกียรตินาคิน", "code" => "069"),
			"mizuho" => array("name" => "มิซูโฮ", "code" => "039"),
			"scbt" => array("name" => "สแตนดาร์ดชาร์เตอร์ด", "code" => "020"),
			"smbc" => array("name" => "ซูมิโตโม", "code" => "018"),
			"tcd" => array("name" => "ไทยเครดิต", "code" => "071"),
			"lhb" => array("name" => "แลนด์แอนด์เฮ้าส์", "code" => "073")
		);

		if (is_numeric($accnum)) {
			if (array_key_exists($bank, $banks)) {
				$scb = $this->getDatacb();
				$this->scb->SetLogin($scb['deviceid'], $scb['pin'], $scb['accnum']);
				$res = $this->scb->Verify($accnum, $banks[$bank]["code"], 0.01);

				$ck = json_decode($res, true);
				// print_r($ck);die;
				if ($ck["data"]["transferType"] == "3RD") {
					$name1 = str_replace("นาย ", "", $ck["data"]["accountToName"]);
					$name1 = str_replace("นาย", "", $name1);
					$name1 = str_replace("น.ส. ", "", $name1);
					$name1 = str_replace("น.ส.", "", $name1);
					$name1 = str_replace("นางสาว", "", $name1);
					$name1 = str_replace("นางสาว ", "", $name1);
					$name1 = str_replace("นาง ", "", $name1);
					$name1 = str_replace("นาง", "", $name1);
					$name1 = str_replace("ด.ช. ", "", $name1);
					$name1 = str_replace("ด.ช.", "", $name1);
					$name1 = str_replace("ด.ญ. ", "", $name1);
					$name1 = str_replace("ด.ญ.", "", $name1);

					echo json_encode(['status' => 200, 'name' => $name1]);
				} else if ($ck["status"]["code"] == "1000") {
					$name = str_replace("นาย ", "", $ck["data"]["accountToDisplayName"]);
					$name = str_replace("นาย", "", $name);
					$name = str_replace("น.ส. ", "", $name);
					$name = str_replace("น.ส.", "", $name);
					$name = str_replace("นางสาว ", "", $name);
					$name = str_replace("นางสาว", "", $name);
					$name = str_replace("นาง ", "", $name);
					$name = str_replace("นาง", "", $name);
					$name = str_replace("ด.ญ. ", "", $name);
					$name = str_replace("ด.ญ.", "", $name);

					echo json_encode(['status' => 200, 'name' => $name]);
				} else {
					echo json_encode(['status' => 500, 'msg' => 'ไม่พบเลขบัญชีของคุณ']);
				}
			} else {
				echo json_encode(['status' => 500, 'msg' => 'กรุณาเลือก ธนาคาร']);
			}
		} else {
			echo json_encode(['status' => 500, 'msg' => 'กรุณาใส่ตัวเลขเท่านั้น']);
		}
	}
	public function Otp()
	{
		if ($_POST) {
			$phone = $this->input->post('phone');
			$res   = $this->sms->sent_otp($phone);
			echo $res;
		}
	}
	public function ConOtp()
	{
		if ($_POST) {
			$otp   = $this->input->post('otp');
			$token = $this->input->post('token');
			$res   = $this->sms->verify_otp($otp, $token);
			echo $res;
			$dd = json_decode($res, true);
			if ($dd['data']['status'] == 'success') {
				$this->session->set_userdata('otp', true);
			}
		}
	}
	public function update_alert()
	{
		$id           = $this->input->post('id');
		$user_session = $this->session->userdata('user');
		if ($user_session) {
			if ($id == null) {
				// echo json_encode(['status'=>false,'msg'=>'id is null']);
			} else {
				$this->user_model->alert($id);
				echo json_encode(['status' => true]);
			}
		} else {
			header('location: ../');
		}
	}
	public function index()
	{
	}
	public function game_notify()
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
		$headerOptions = array(
			'http' => array(
				'method' => 'POST',
				'header' => "Content-Type: application/x-www-form-urlencoded\r\n"
					. "Authorization: Bearer " . $token . "\r\n"
					. "Content-Length: " . strlen($queryData) . "\r\n",
				'content' => $queryData
			),
		);
		$context = stream_context_create($headerOptions);
		$result = file_get_contents(LINE_API, FALSE, $context);
		$res = json_decode($result);
		return $res;
	}
	public function login()
	{
		if ($_POST) {
			$seting    = $this->admin_model->result_setting();
			$ip       = $this->input->ip_address();
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			// $password = password_hash($this->input->post('password'),PASSWORD_BCRYPT);
			$check    = $this->user_model->auth($username, $password);
			$token    = $this->input->post('token');
			// $res =  $this->captcha->CheckCaptcha($token, $seting["re_secretkey"]);
			// $res = json_decode($res, true);
			$res['success'] = true;
			if ($res['success'] == true) {
				if ($check) {
					echo json_encode(['status' => true, 'msg' => 'เข้าสู่ระบบสำเร็จ ']);
					$this->user_model->updateIP(['IP' => $ip, 'username' => $username]);
					$this->session->set_userdata('user', $username);
					$this->session->set_userdata('ip', $ip);
					//$this->notify_sent('Username : '. $username . ' ได้เข้าสู่ระบบ  IP : ' . $ip);
					// $this->notify_sent("\n☢แจ้งเตือนเข้าสู่ระบบ☢ \nผู้ใช้งาน : $username\nIP Login : $ip");
				} else {
					echo json_encode(['status' => false, 'msg' => 'กรุณาตรวจสอบชื่อผู้ใช้งานหรือรหัสผ่าน']);
				}
			} else {
				echo json_encode(['status' => false, 'msg' => 'BOT ควยไรล่ะ', 'recapcha' => $res]);
			}
		}
	}
	public function CheckLogin()
	{
		$user_session = $this->session->userdata('user');
		$ip_session   = $this->session->userdata('ip');
		if ($user_session) {
			$user = $this->user_model->getdata_user($user_session);
			$ip   = $user['IP'];
			if ($ip_session != $ip) {
				echo json_encode(['stats' => false, 'msg' => 'Double login']);
			} else {
				echo json_encode(['stats' => true, 'msg' => '']);
			}
		}
	}

	public function chang_pass()
	{
		if ($_POST) {
			$user_session = $this->session->userdata('user');
			if ($user_session) {

				//$user = $this->input->post('username');
				$pass     = $this->input->post('password');
				$new_pass = $this->input->post('new_password');
				$pass_old = $this->user_model->getdata_user($user_session);
				// print_r($pass_old);die;
				if ($pass_old['password'] != $pass) {
					echo json_encode(['stats' => false, 'msg' => 'พาสเวิร์ดเก่าไม่ถูกต้อง']);
				} else {
					$this->user_model->chang_pass($user_session, $new_pass);
					echo json_encode(['stats' => true, 'msg' => 'เปลี่ยนรหัสสำเร็จ']);
				}
			} else {
				echo json_encode(['stats' => false, 'msg' => 'error login']);
			}
		}
	}
	public function hide_alert()
	{
		$this->session->set_userdata('stats', 1);
	}
	public function logout()
	{
		$this->session->unset_userdata('user');
		$this->session->unset_userdata('stats');
		$this->session->unset_userdata('ip');
		header('location: ../');
		// echo json_encode(['status' =>true,'msg'=>'ออกจากระบบสำเร็จ']);
	}
	public function coins_trade()
	{
		if ($_POST) {
			$user_session = $this->session->userdata('user');
			if ($user_session) {

				$data_u = $this->user_model->getdata_user($user_session);
				$coins  = $this->input->post('coins');
				if ($data_u['coins'] >= $coins) {
					$data   = $this->user_model->get_coins($coins);
					$credit = $data['credit_code'];
					$data   = $this->user_model->get_code($credit);
					//$this->user_model-> update_coins($user_session,$coins);
					if ($data['code'] != '') {
						$this->user_model->update_coins($user_session, $coins);
						$this->user_model->del_code($data['id']);
						echo json_encode(['stats' => true, 'code' => $data['code'], 'msg' => 'แลกสำเร็จ']);
					} else {
						echo json_encode(['stats' => false, 'code' => null, 'msg' => 'โค๊ดหมด']);
					}
				} else {
					echo json_encode(['stats' => false, 'msg' => 'เหรียญไม่เพียงพอ']);
				}
			} else {
				echo json_encode(['stats' => false, 'msg' => 'login error']);
			}
		} else {
		}
	}
	public function register()
	{
		if ($_POST) {
			$token = $this->input->post('token');
			$ip       = $this->input->ip_address();

			if ($this->input->cookie('aff')) {
				$aff = $this->input->cookie('aff');

				//delete_cookie("aff");
			} else {
				$aff = '';
			}

			if ($this->input->cookie('ref')) {
				$ref = $this->input->cookie('ref');

				//delete_cookie("aff");
			} else {
				$ref = '';
			}

			if ($this->input->cookie('alliance')) {
				$alliance = $this->input->cookie('alliance');

				//delete_cookie("aff");
			} else {
				$alliance = '';
			}
			//   $seting    = $this->admin_model->result_setting();
			$username = $this->input->post('username');
			$check    = $this->user_model->auth($username);
			$check1   = $this->user_model->chekaccnum($this->input->post('bank_number'));
			$check2   = $this->user_model->chekname($this->input->post('fname'));

			if ($check > 0) {
				echo json_encode(['status' => false, 'msg' => 'มีชื่อผู้ใช้งานนี้แล้ว']);
			} elseif ($check1 > 0) {
				echo json_encode(['status' => false, 'msg' => 'มีเลขบัญชีนี้แล้ว']);
			} elseif ($check2 > 0) {
				echo json_encode(['status' => false, 'msg' => 'มีชื่อนี้แล้ว']);
				// } elseif ($check3 > 0) {
				//     echo json_encode(['status' => false, 'msg' => 'มีเบอร์นี้แล้ว']);
			} elseif (substr($username, 0, 2) != '08' and substr($username, 0, 2) != '09' and substr($username, 0, 2) != '06') {
				echo json_encode(['status' => false, 'msg' => 'เบอร์โทรศัพท์ผิดพลาด']);
			} else {
				// $res = $this->captcha->CheckCaptcha($token,$seting["re_secretkey"]);
				// $res = json_decode($res, true);
				$res['success'] = true;
				if ($res['success'] == true) {
					$data = [
						"username"     => $this->input->post('username'),
						// "password"     => password_hash($this->input->post('password'),PASSWORD_BCRYPT),
						"password"     => $this->input->post('password'),
						"accnum"       => $this->input->post('bank_number'),
						"name"         => $this->input->post('fname'),
						"line"         => $this->input->post('line'),
						"bank"         => $this->input->post('bank_name'),
						"promotion_id" => $this->input->post('promotion'),
						"aff"          => $aff,
						"alliance"	   => $alliance,
						"ref"          => $ref,
					];
					// 
				// 	$res_user = $this->ufa->AddMember($this->input->post('username'));
				// 	// print_r($ss);die;
				// 	// $res_user = json_decode($this->ufa->AddMember($this->input->post('username')));
				// 	// 	print_r($res_user);die;
				// 	if (empty($res_user) || empty($res_user->username) || empty($res_user->newpass)) {
				// 		exit(json_encode(['status' => false, 'msg' => $res_user]));
				// 	}
					// 	exit(json_encode(['status' => false, 'msg' => $res_user]));
				// 		die;
					$this->user_model->add_mem($data);
					
					$usersgen  = $this->user_model->getall_usergen();
				// 	print_r($usersgen);die;
					$this->user_model->add_ufa(['member_username' => $this->input->post('username'), "username" => $usersgen->username, "password" => $usersgen->password]);
					//$pass = $this->ufa->changePass($res_user->username);
					$pass = $usersgen->pasword;
					
					$updateused = $this->user_model->usergen_update($usersgen->id);

					$this->session->set_userdata('user', $username);
					delete_cookie("aff");
					delete_cookie("alliance");
					delete_cookie("ref");
					echo json_encode(['status' => true, 'msg' => 'สมัครสมาชิกสำเร็จ']);
					//  $this->notify_sent("\nแจ้งเตือนสมัครสมาชิก \nผู้ใช้งาน : $username\nเลขบัญชี : $accnumline\nธนาคาร : $bankline\nชื่อบัญชี : $nameline\nไอดีไลน์ : $linenoti\nIP Register : $ip");
					$this->notify_sent("\n🔥แจ้งเตือนสมัครสมาชิก🔥 \nผู้ใช้งาน : {$data['username']}\nเลขบัญชี : {$data['accnum']}\nธนาคาร : {$data['bank']}\nชื่อบัญชี : {$data['name']}\nไอดีไลน์ : {$data['line']}\nUserUFA $usersgen->username", 1);
				} else {
					echo json_encode(['status' => false, 'msg' => 'Bot']);
				}
			}
		}
	}


	public function register_manual()
	{


		if ($this->input->cookie('aff')) {
			$aff = $this->input->cookie('aff');
		} else {
			$aff = '';
		}

		$username = $this->input->post('username');
		$check    = $this->user_model->auth($username);
		$check2   = $this->user_model->chekname($this->input->post('fname'));

		if ($check > 0) {
			echo json_encode(['status' => false, 'msg' => 'มีชื่อผู้ใช้งานนี้แล้ว']);
		} elseif ($check2 > 0) {
			echo json_encode(['status' => false, 'msg' => 'มีชื่อนี้แล้ว']);
		} elseif (substr($username, 0, 2) != '08' and substr($username, 0, 2) != '09' and substr($username, 0, 2) != '06') {
			echo json_encode(['status' => false, 'msg' => 'เบอร์โทรศัพท์ผิดพลาด']);
		} else {
			$data = [
				"username"     => $this->input->post('username'),
				"password"     => $this->input->post('password'),
				"accnum"       => $this->input->post('bank_number'),
				"name"         => $this->input->post('fname'),
				"line"         => $this->input->post('line'),
				"bank"         => $this->input->post('bank_name'),
				"promotion_id" => $this->input->post('promotion'),
				"aff"          => $aff,
				"cr_prog"      => 'Manual'
			];
			$res_user = $this->ufa->AddMember($this->input->post('username'));
			if (empty($res_user) || empty($res_user->username) || empty($res_user->newpass)) {
				exit(json_encode(['status' => false, 'msg' => $res_user]));
			}

			$this->user_model->add_mem($data);
			$this->user_model->add_ufa(['member_username' => $this->input->post('username'), "username" => $res_user->username, "password" => $res_user->newpass]);
			$pass = $res_user->username;
			delete_cookie("aff");
			echo json_encode(['status' => true, 'msg' => 'สมัครสมาชิกสำเร็จ']);
			$this->notify_sent("\n🔥แจ้งเตือนสมัครสมาชิก🔥 \nผู้ใช้งาน : {$data['username']}\nเลขบัญชี : {$data['accnum']}\nธนาคาร : {$data['bank']}\nชื่อบัญชี : {$data['name']}\nไอดีไลน์ : {$data['line']}\nUserUFA $pass", 1);
			$user_session = $this->session->userdata('user');
			$staff_data = [

				"username" => $user_session,

				"type" => 0,

				"detail" => "เพิ่มสมาชิก ผู้ใช้งาน " . $username . " || ประเภท : Manual"

			];

			$this->admin_model->staff_h_insert($staff_data);
		}
	}

	private function Balance($user = false)
	{
		$this->load->library('ufa');
		if ($user) {
			$ufa = $this->user_model->user_ufa($user);
			$username =  $ufa['username'];
			if ($username != '') {
				return json_encode($this->ufa->get_Balance($username));
			} else {
				echo 'error';
			}
		}
	}

	public function checkResetPromotion()
	{
		$user_session = $this->session->userdata('user');
		$Balance = json_decode($this->Balance($user_session), true);
		$money_ufa =  $Balance['balance'];
		if ($money_ufa <= 10) {
			$this->user_model->update_reset_promotion($user_session);
			echo json_encode(['stats' => true, 'msg' => 'Update Reset Promotion']);
		} else {
			echo json_encode(['stats' => false, 'msg' => '']);
		}
	}

	public function bonusref()
	{
		$user_session = $this->session->userdata('user');
		$usernameUFA = $this->input->post('usernameUFA');
		$bonus = $this->input->post('bonus');
		if ($user_session) {
			$result =	$this->add_credit($usernameUFA, $bonus);
			if ($result['status'] == true) {
				date_default_timezone_set('asia/bangkok');
				$date  = date('d-m-Y');
				$data = [
					"member_username" => $user_session,
					"bonus" => $bonus,
					"date" => $date
				];
				$this->user_model->insert_log_ref($data);
				echo json_encode(['stats' => true, 'msg' => $result, 'data' => $data]);
			} else {
				echo json_encode(['stats' => false, 'msg' => $result]);
			}
		}
	}
	private function add_credit($username, $amount)
	{
		return $this->ufa->Deposit($username, $amount); // เติม

	}
	
	public function changePass($username=null){
	    if(!empty($username)){
	        $res = $this->ufa->ChageFirstPass($username);
	        print_r($res);
	    }
	}
	
}
