<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Apiufa extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('Ufa');
		$this->load->library('session');
		$this->load->model('user_model');
	}

	public function agent_info()
	{
		//--------------------------------------------//
		$user = $this->session->userdata('stats_admin');
		if ($user) {
			// echo '<pre>';
			$res = $this->ufa->agent_info();
			echo json_encode($res); //ข้อมูลเอเจ้น

		} else {
			echo 'error';
		}
	}
	public function Balance()
	{
		$user = $this->session->userdata('user');
		if ($user) {
			$ufa = $this->user_model->user_ufa($user);
			$username =  $ufa['username'];
			// $username =  "ufixc5a80002";
			if ($username != '') {
				exit(json_encode($this->ufa->get_balance($username))); // 
			}
		}
	}
	public function get_Balance()
	{
		$user = $this->session->userdata('stats_admin');
		if ($user) {
			$username = $this->input->post('username');
			// print_r($username);die;
			// $username = "ufixc5a80002";
			// print_r($username);die;
			if ($username != '') {
				exit(json_encode($this->ufa->get_balance($username))); // 
			} else {
				echo 'error';
			}
		}
	}

	private function Withdraw_ufa($username, $amount)
	{
		return  $this->ufa->Withdraw($username, $amount); // เติม

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

	public function add_powyinhshup_manual()
	{
		$user = $this->session->userdata('stats_admin');
		if ($user) {
			$username = $this->input->post('username');
			$play = $this->input->post('play');
			$play_before = $this->input->post('play_before');
			$total = $play - $play_before;

			if ($username != '') {
				$data = [
					"play" => $play,
					"username" => $username
				];
				$this->admin_model->update_play_powyingshup($data);

				echo json_encode(['stats' => true, 'msg' => 'Success', 'username' => $username]);
				//date_default_timezone_set('Asia/Manila');
				$staff_data = [
					"username" => $user,
					"type" => 0,
					"detail" => "เติมรอบการเล่นเป่ายิ้งฉุบให้ " . $username . " , จำนวน " . $total . " รอบ ,ก่อนหน้า " . $play_before . " เพิ่มเป็น " . $play . " || ประเภท : Manual"
				];
				$this->admin_model->staff_h_insert($staff_data);

				// echo json_encode($this->ufa->Deposit($username, $val)); //    
			} else {
				echo 'error';
			}
		}
	}



	public function add_Balance()
	{
		$user = $this->session->userdata('stats_admin');
		if ($user) {
			$username = $this->input->post('username');
			$val = $this->input->post('val');
			$ip = $_SERVER['REMOTE_ADDR'];
			$datasend = "";
			if ($username != '') {
				$res = $this->ufa->Deposit($username, $val);
				$res['module'] = 'Deposit';
				$res['credit'] = $res['addcredit'];
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
					echo json_encode($res);
					$this->admin_model->staff_h_insert($staff_data);
					$this->admin_model->transaction_manual($transaction_manual);
				} else {
					echo 'error';
				}
			} else {
				echo 'error';
			}
		}
	}


	public function minus_Balance()
	{
		$user = $this->session->userdata('stats_admin');
		if ($user) {
			$username = $this->input->post('username');
			$val = $this->input->post('val');
			$ip = $_SERVER['REMOTE_ADDR'];
			$datasend = "";
			$Balance = json_decode($this->get_Balance_user($username), true);

			$money_ufa_ori = $Balance['balance'];


			$money_ufa_split = explode(",", $money_ufa_ori);
			$money_ufa = $money_ufa_split[0].''.$money_ufa_split[1];


			// $res['credit'] = $money_ufa;
			// echo json_encode($res);die;

			if ($username != '') {


				if ($money_ufa >= $val) {
					$res =  $this->Withdraw_ufa($username, $val);
					$res['module'] = 'Withdraw';
					$res['credit'] = $res['withdraw'];
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
						echo json_encode($res);
						$this->admin_model->staff_h_insert($staff_data);
						$this->admin_model->transaction_manual($transaction_manual);
					} else {
						echo 'error';
					}
				} else {
					$res['status'] = true;
					$res['credit'] = $val;
					$res['username'] = $username;
					$res['module'] = 'Withdraw';
					$res['msg'] = 'Not balance';
					echo json_encode($res);
				}
			} else {
				echo 'error';
			}
		}
	}

	private function get_Balance_user($user = false)
	{
		$this->load->library('ufa');
		if ($user != '') {
			return json_encode($this->ufa->get_Balance($user));
		} else {
			echo 'error';
		}
	}
}
