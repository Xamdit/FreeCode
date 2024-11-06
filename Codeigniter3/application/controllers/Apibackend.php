<?php
defined('BASEPATH') or exit('No direct script access allowed');
header('Content-Type: application/json');
class Apibackend extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('Ufa');
		$this->load->model('user_model');
		$this->load->library('scb');
	}

	public function index()
	{
		$res = array('status' => false, 'data' => 'No file');
		exit(json_encode($res));
	}

	private function getRequestHeaders()
	{
		$headers = array();
		foreach ($_SERVER as $key => $value) {
			if (substr($key, 0, 5) <> 'HTTP_') {
				continue;
			}
			$header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
			$headers[$header] = $value;
		}
		$hh = '';
		foreach ($headers as $header => $value) {
			if ($header == 'Authorization') {
				$hh = $value;
				break;
			}
		}
		$resAuth = explode(" ", $hh);
		$sql = "SELECT * FROM `log_token` WHERE token = '" . $resAuth[1] . "'";
		$query = $this->db->query($sql);
		$result = $query->result_array();
		$res = false;
		if ($result) {
			$res = true;
		} else {
			$res = false;
		}

		return $res;
	}

	public function agent_info()
	{
		$token = $this->getRequestHeaders();		
		if ($token) {
			$result = $this->ufa->agent_info();
			$res = array('status' => true, 'msg' => 'Success', 'data' => $result);
		} else {
			$res = array('status' => false, 'msg' => 'Unauthorized');
		}
		exit(json_encode($res));
	}

	public function view_credit($user = null)
	{
		$token = $this->getRequestHeaders();
		$this->load->library('ufa');
		if ($token) {
			$res = array('status' => true, 'msg' => 'Success', 'data' => $this->ufa->get_Balance($user));
		} else {
			$res = array('status' => false, 'msg' => 'Unauthorized');
		}

		exit(json_encode($res));
	}

	public function view_Turnover($user = null)
	{
		$token = $this->getRequestHeaders();
		$this->load->library('ufa');
		if ($token) {
			$check_turns = $this->ufa->TurnOverUser($user, date('m/d/Y'), date('m/d/Y'));
			$res = array('status' => true, 'msg' => 'Success', 'data' => $check_turns);
		} else {
			$res = array('status' => false, 'msg' => 'Unauthorized');
		}
		exit(json_encode($res));
	}

	public function add_credit()
	{
		$token = $this->getRequestHeaders();
		$this->load->library('ufa');
		if ($token) {
			$username = $this->input->post('username');
			$val = $this->input->post('amount');
			$user = $this->input->post('admin');
			$ip = $this->input->post('ip');
			$datasend = "";
			$res = $this->ufa->Deposit($username, $val);
			date_default_timezone_set('Asia/Bangkok');
			$datasend .= "\n👉เครดิตเติมมือ By ADMIN👈";
			$datasend .= "\nโดย Admin ชื่อ => {$user}";
			$datasend .= "\nเติมให้สมาชิก => " . $username;
			$datasend .= "\nจำนวนเงิน => {$val} บาท";
			$datasend .= "\nIp => {$ip}";
			$datasend .= "\nTime => " . date('Y-m-d H:i:s', time());
			$staff_data = [
				"username" => $user,
				"type" => 0,
				"detail" => "เติมเงินให้ " . $username . " , จำนวน " . $val . " บาท || ประเภท : Manual"
			];
			$transaction_manual = [
				"member_username" => $username,
				"credit" => $val,
				"cr_by" => $user,
				"module" => 'Deposit'
			];
			if ($res['status']) {
				$this->notify_sent($datasend, 3);
				$this->admin_model->staff_h_insert($staff_data);
				$this->admin_model->transaction_manual($transaction_manual);
				$res = array('status' => true, 'msg' => 'Success');
			} else {
				$res = array('status' => false, 'msg' => 'Add Credit Fail');
			}
		} else {
			$res = array('status' => false, 'msg' => 'Unauthorized');
		}
		exit(json_encode($res));
	}

	public function add_credit_inject()
	{
		$token = $this->getRequestHeaders();
		$this->load->library('ufa');
		if ($token) {
			$username = $this->input->post('username');
			$val = $this->input->post('amount');
			$user = $this->input->post('admin');
			$ip = $this->input->post('ip');
			$datasend = "";
			$res = $this->ufa->Deposit($username, $val);
			date_default_timezone_set('Asia/Bangkok');
			$staff_data = [
				"username" => $user,
				"type" => 0,
				"detail" => "เติมเงินให้ " . $username . " , จำนวน " . $val . " บาท || ประเภท : Manual"
			];
			$transaction_manual = [
				"member_username" => $username,
				"credit" => $val,
				"cr_by" => $user,
				"module" => 'Deposit'
			];
			if ($res['status']) {
				$this->notify_sent($datasend, 3);
				$this->admin_model->staff_h_insert($staff_data);
				$this->admin_model->transaction_manual($transaction_manual);
				$res = array('status' => true, 'msg' => 'Success');
			} else {
				$res = array('status' => false, 'msg' => 'Add Credit Fail');
			}
		} else {
			$res = array('status' => false, 'msg' => 'Unauthorized');
		}
		exit(json_encode($res));
	}

	public function minus_credit()
	{
		$token = $this->getRequestHeaders();
		$this->load->library('ufa');
		if ($token) {
			$username = $this->input->post('username');
			$val = $this->input->post('amount');
			$user = $this->input->post('admin');
			$ip = $this->input->post('ip');
			$datasend = "";
			$res =  $this->ufa->Withdraw($username, $val);
			date_default_timezone_set('Asia/Bangkok');
			$datasend .= "\n👉ถอนเครดิตมือ By ADMIN👈";
			$datasend .= "\nโดย Admin ชื่อ => {$user}";
			$datasend .= "\nเถอินให้สมาชิก => " . $username;
			$datasend .= "\nจำนวนเงิน => {$val} บาท";
			$datasend .= "\nIp => {$ip}";
			$datasend .= "\nTime => " . date('Y-m-d H:i:s', time());
			$staff_data = [
				"username" => $user,
				"type" => 0,
				"detail" => "ถอนเงินให้ " . $username . " , จำนวน " . $val . " บาท || ประเภท : Manual"
			];
			$transaction_manual = [
				"member_username" => $username,
				"credit" => $val,
				"cr_by" => $user,
				"module" => 'Withdraw'
			];
			if ($res['status']) {
				$this->notify_sent($datasend, 3);
				$this->admin_model->staff_h_insert($staff_data);
				$this->admin_model->transaction_manual($transaction_manual);
				$res = array('status' => true, 'msg' => 'Success');
			} else {
				$res = array('status' => false, 'msg' => 'Withdraw Fail');
			}
		} else {
			$res = array('status' => false, 'msg' => 'Unauthorized');
		}
		exit(json_encode($res));
	}

	public function transfer_scb()
	{
		$token = $this->getRequestHeaders();

		if ($token) {

			$accnum = $this->input->post('accnum');
			$bank = $this->input->post('bank');
			$amount = $this->input->post('amount');
			$id = $this->input->post('id');
			$ip = $this->input->post('ip');
			$admin = $this->input->post('admin');
			$username = $this->input->post('username');
			$usernameUFA = $this->input->post('usernameUFA');
			$bank_name = $this->input->post('bank_name');
			$secert = $this->input->post('secert');
			$Balance = $this->ufa->get_Balance($usernameUFA);
			$money_ufa =  $Balance['balance'];
			if ($secert == 'CUfL4levur') {
				$bb = $this->admin_model->bank();
				$scb = [
					"accnum" => $bb['accnum'], //เลขบช
					"deviceid" => $bb['username'], //deviceid
					"pin" => $bb['password'], ////api_refresh
				];
				$this->scb->SetLogin($scb['deviceid'], $scb['pin'], $scb['accnum']);
				$tranfer = $this->scb->Transfer($accnum, $bank, $amount);

				$jsde = json_decode($tranfer, true);
				if ($jsde["status"]["code"] == 1000) {
					$d = [
						"id" => $id,
						"stats" => 0,
					];
					$this->admin_model->update_stats_w($d);
					$staff_data = [
						"username" => $admin,
						"type" => 0,
						"detail" => "อนุมัติการถอนเงินออโต้ให้ " . $username . " จำนวน " . $amount . " บาท"
					];
					$this->admin_model->staff_h_insert($staff_data);
					$res = array('status' => true, 'msg' => 'Success', 'data' => $jsde["status"]["description"]);
					$datasend = "";
					$datasend .= "\n✅ อนุมัติการถอนเงินให้ ✅";
					$datasend .= "\nสมาชิก => {$usernameUFA}";
					$datasend .= "\nธนาคารลูกค้า =>{$bank_name} {$accnum}";
					$datasend .= "\nจำนวนเงินที่ถอน => {$amount} บาท";
					$datasend .= "\nยอดเงินลูกค้าคงเหลือ => {$money_ufa} บาท";
					$datasend .= "\nสถานะ => ดำเนินการเรียบร้อยแล้ว \nโดย : {$admin}";
					$datasend .= "\nIP => {$ip}";
					$this->notify_sent($datasend, 4);
				} else {
					$res = array('status' => false, 'msg' => $jsde["status"]["description"]);
				}
			} else {
				$res = array('status' => false, 'msg' => 'Code Error');
			}
		} else {
			$res = array('status' => false, 'msg' => 'Unauthorized');
		}
		exit(json_encode($res));
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



	public function register_manual()
	{
		$token = $this->getRequestHeaders();

		if ($token) {

			$username = $this->input->post('username');
			$data = [
				"username"     => $this->input->post('username'),
				"password"     => $this->input->post('password'),
				"accnum"       => $this->input->post('bank_number'),
				"name"         => $this->input->post('fname'),
				"line"         => $this->input->post('line'),
				"bank"         => $this->input->post('bank_name'),
				"cr_prog"      => 'Manual'
			];
			// $res_user = $this->ufa->AddMember($this->input->post('username'));
			// if (empty($res_user) || empty($res_user->username) || empty($res_user->newpass)) {
			//     $res = array('status' => false, 'msg' => $res_user);
			// }

			// $this->user_model->add_mem($data);
			// $this->user_model->add_ufa(['member_username' => $this->input->post('username'), "username" => $res_user->username, "password" => $res_user->newpass]);
			// $pass = $res_user->username;

			$this->user_model->add_mem($data);
			$usersgen  = $this->user_model->getall_usergen();
			$this->user_model->add_ufa(['member_username' => $this->input->post('username'), "username" => $usersgen->username, "password" => $usersgen->password]);
			$pass = $usersgen->pasword;
			$updateused = $this->user_model->usergen_update($usersgen->id);

			$res = array('status' => true, 'msg' => 'สมัครสมาชิกสำเร็จ');
			$this->notify_sent("\n🔥แจ้งเตือนสมัครสมาชิก🔥 \nผู้ใช้งาน : {$data['username']}\nเลขบัญชี : {$data['accnum']}\nธนาคาร : {$data['bank']}\nชื่อบัญชี : {$data['name']}\nไอดีไลน์ : {$data['line']}\nUserUFA $pass", 1);
			$user_session = $this->input->post('admin');
			$staff_data = [

				"username" => $user_session,

				"type" => 0,

				"detail" => "เพิ่มสมาชิก ผู้ใช้งาน " . $username . " || ประเภท : Manual"

			];

			$this->admin_model->staff_h_insert($staff_data);
		} else {
			$res = array('status' => false, 'msg' => 'Unauthorized');
		}
		exit(json_encode($res));
	}

	public function check_scb()
	{
		$token = $this->getRequestHeaders();

		if ($token) {
			$bb = $this->admin_model->bank();
			$scb = [
				"accnum" => $bb['accnum'], //เลขบช
				"deviceid" => $bb['username'], //deviceid
				"pin" => $bb['password']
			];
			$this->scb->SetLogin($scb['deviceid'], $scb['pin'], $scb['accnum']);
			$result = $this->scb->GetBalance();
			$res = array('status' => true, 'msg' => 'Success', 'data' => $result);
		} else {
			$res = array('status' => false, 'msg' => 'Unauthorized');
		}
		exit(json_encode($res));
	}

	public function auto_login()
	{
		$auto_login = $_POST['auto_login'];
		$VIEWSTATEGENERATOR = $_POST['VIEWSTATEGENERATOR'];
		$VIEWSTATE = $_POST['VIEWSTATE'];
		$EVENTVALIDATION = $_POST['EVENTVALIDATION'];

		$sql = "UPDATE setting_game SET auto_login = '$auto_login', VIEWSTATEGENERATOR = '$VIEWSTATEGENERATOR', VIEWSTATE = '$VIEWSTATE', EVENTVALIDATION = '$EVENTVALIDATION' WHERE id = 1";
		$query = $this->db->query($sql);
		$res = array('status' => true);
		exit(json_encode($res));
	}
}
