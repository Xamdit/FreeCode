<?php
//include_once (dirname(__FILE__) . "/ApiUfa.php");

defined('BASEPATH') or exit('No direct script access allowed');
header('Content-Type: application/json');
class Apitopup extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('bank_model');
		$this->load->library('session');
		$this->load->library('Ufa');
		$this->load->model('admin_model');
	}
	public function index()
	{
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

	private function notify_sent_d($message)
	{
		$token_new = $this->admin_model->get_promotions();
		define('LINE_API', "https://notify-api.line.me/api/notify");

		$token =  $token_new[0]['token']; //ใส่Token ที่copy เอาไว้
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
	private function Balance()
	{
		$user = $this->session->userdata('user');
		if ($user) {
			$ufa = $this->user_model->user_ufa($user);
			$username =  $ufa['username'];
			if ($username != '') {

				return json_encode($this->ufa->get_balance($username)); // 

			} else {
				echo 'error';
			}
		}
	}
	private function Withdraw_ufa($username, $amount)
	{


		return  $this->ufa->Withdraw($username, $amount); // เติม



	}

	public function Promotion()
	{
		date_default_timezone_set('Asia/Bangkok');
		$user = $this->session->userdata('user');
		if ($user) {

			//print_r($user);die;

			$data = $this->admin_model->last_Deposits($user);

			if (empty($data)) {
				$data['date'] = '2020-01-01';
				$data['id'] = 0;
				$data['username'] = $user;
				$data['time'] = date('H:i:s');
				$data['description'] = 'ecee22596d4c29c91ea040395d2fff8a';
				$data['amount'] = '0';
				$data['alert'] = '1';
				$data['date'] = date('d-m-Y', strtotime($data['date'] . "-1 days"));
			} else {
				$data['date'] = date('d-m-Y', strtotime($data['date'] . "-1 days"));
			}



			//print_r($data);die;

			$date = explode('-', $data['date']);

			$date = $date[1] . "/" . $date[0] . "/" . $date[2];

			$arr = [
				"date" => $date,
				"amount" => $data['amount']
			];

			//print_r($arr);die;

			return  $arr;
		}
	}

	public function promoWithid($id = null)
	{
		date_default_timezone_set('Asia/Bangkok');
		$user = $this->session->userdata('user');
		if ($user && !empty($id)) {

			//print_r($user);die;

			$data = $this->admin_model->last_Deposits_id($user, $id);
			// 			print_r($data);die;

			if (empty($data)) {
				$data['date'] = '2020-01-01';
				$data['id'] = 0;
				$data['username'] = $user;
				$data['time'] = date('H:i:s');
				$data['description'] = 'ecee22596d4c29c91ea040395d2fff8a';
				$data['amount'] = '0';
				$data['alert'] = '1';
				$data['date'] = date('d-m-Y', strtotime($data['date'] . "-1 days"));
			} else {
				$data['date'] = date('d-m-Y', strtotime($data['date'] . "-1 days"));
			}



			//print_r($data);die;

			$date = explode('-', $data['date']);

			$date = $date[1] . "/" . $date[0] . "/" . $date[2];

			$arr = [
				"date" => $date,
				"amount" => $data['amount']
			];

			//print_r($arr);die;

			return  $arr;
		}
	}

	public function Calculate_turn()
	{
		$user = $this->session->userdata('user');
		if ($user) {
			$user_ufa = $this->user_model->user_ufa($user);
			if ($user_ufa['username'] != '') {
				$data_ = $this->Promotion();
				$check_turn = $this->ufa->TurnOver($user_ufa['username'], $data_['date']);
				$check_turns = json_decode($check_turn, true);

				$pro = $this->user_model->Promotions($user);
				if ($pro['x'] == null) {

					echo json_encode(['stats' => false]);
				} else {
					$Balances = $pro['x'] * $data_['amount'];
					echo json_encode(['stats' => true, 'data' => number_format($check_turns['win_lose'], 2) . "/" . number_format($Balances, 2)]);
				}
			}
		}
	}
	public function RegisterPromotion()
	{
		if (isset($_POST['pro_id'])) {
			$user = $this->session->userdata('user');
			$info = $this->user_model->getdata_user($user);
			$user_ufa = $this->user_model->user_ufa($user);
			

			if ($user) {

				$num_deposit = $this->user_model->CheckDepositFrist($info['username']);
				$have_promotion = $this->user_model->get_user_id($info['id']);
				// 	print_r($num_deposit);die;
				if ($num_deposit == 1 && $have_promotion['promotion_id'] == 0) {


					$Balance = json_decode($this->Balance(), true);

					//$money_ufa =  $Balance['balance'];
					// 	print_r($Balance);die;


					$credit = $Balance['balance'];
					// 	$credit = 100;

					$pro_3 = $this->admin_model->get_promotions();

					$dep_detail = $this->user_model->GetDeposit($info['username']);

					// 	print_r($dep_detail);die;
					//print_r($pro_3[0]['limit_d']);die;
					if ($credit != $dep_detail['amount']) {
						echo json_encode(['stats' => false, 'msg' => 'ไม่อยู่ในเงื่อนไขที่จะได้รับ โปรโมชั่น สมัครสมาชิก ครั้งแรก']);
					} else if ($dep_detail['amount'] >= $pro_3[0]['limit_d']) {
						echo json_encode(['stats' => false, 'msg' => 'คุณมียอดฝาก เกินจำนวนที่กำหนดไว้']);
					} else {
						//$pro = '15';
						$pro_2 = $this->admin_model->get_promotions();
						//print_r($pro_2);die;
						//print_r($user_ufa);die;
						$bonus = ($credit * $pro_2[0]['percen']) / 100;
						$addbonus = $this->user_model->updateTransaction($dep_detail['id'], $pro_2[0]['id']);
						if ($addbonus == '1') {
							$data = array(
								'member_username' => $info['username'],
								'money' => $bonus,
								'pro_id' => $pro_2[0]['id'],
								'x' => $bonus + $credit * $pro_2[0]['x'],

							);
							//print_r($data);die;
							$iss = $this->admin_model->save_pro($data);

							if ($iss == 1) {

								$uppro = $this->user_model->updatepro($info['username'], $pro_2[0]['id']);

								$add = $this->add_credit($user_ufa["username"], $bonus);
						
								if ($add['code'] == 0) {
									echo json_encode(['stats' => true, 'msg' => 'รับโบนัสสำเร็จ']);
									$time = date("H:i:s");

									$bo = $bonus + $credit;
									$datasend = "";
									$datasend .= "\nรับโปรโมชั่น สมัครสมาชิกใหม่";
									$datasend .= "\nจำนวนโบนัส => {$bonus} บาท";
									$datasend .= "\nยอดก่อนฝาก {$credit} บาท";
									$datasend .= "\nสมาชิก => " . $user_ufa["username"];
									$datasend .= "\nยอดหลังรับโปร {$bo} บาท";

									$datasend .= "\nเวลาที่รับ => {$time} บาท";
									$this->notify_sent_d($datasend);
								} else {
									echo json_encode(['stats' => false, 'msg' => 'เกิดข้อผิดพลาดกรุณาติดต่อเจ้าหน้าที่']);
								}
							}
						} else {
							echo json_encode(['stats' => false, 'msg' => 'เกิดข้อผิดพลาดกรุณาติดต่อเจ้าหน้าที่']);
						}
					}
				} else {
					echo json_encode(['stats' => false, 'msg' => 'ไม่อยู่ในเงื่อนไขที่จะได้รับ สมัครสมาชิก ครั้งแรก']);
				}
			}
		}
	}

	public function newdate_promotion()
	{
		date_default_timezone_set('Asia/Bangkok');
		if (isset($_POST['newdate'])) {

			$new_s = date("Y-m-d");
			$user = $this->session->userdata('user');
			$info = $this->user_model->getdata_user($user);
			$user_ufa = $this->user_model->user_ufa($user);

			if ($user) {

				$num_deposit = $this->user_model->CheckDeposit_date($info['username'], date('Y-m-d'));
				$have_promotion = $this->user_model->get_user_id($info['id']);
				if ($num_deposit == 1 && $have_promotion['promotion_id'] == 0) {
					$data_pro = $this->user_model->CheckDeposit_dateArray($info['username'], date('Y-m-d'));

					$start_date = $data_pro['date'];
					$end_date   = date('Y-m-d H:i:s');


					$date_withdraw = $this->user_model->CheckWithdraw_date($info['username'], $start_date, $end_date);
					// echo json_encode(['stats' => false, 'msg' => 'test' , 'data' =>$date_withdraw]);die;

					if ($date_withdraw == 0) {


						$Balance = json_decode($this->Balance(), true);

						//$money_ufa =  $Balance['balance'];

						//print_r($Balance);die;
						$credit = $Balance['balance'];

						$pro_user = $this->user_model->chack_promotions_date($info['username'], date('Y-m-d'));

						// 	var_dump($pro_user);die;

						$dep_detail = $this->user_model->GetDeposit_newDate($info['username'], date('Y-m-d'));
						// print_r($pro_user);die;

						if ($pro_user != null) {
							echo json_encode(['stats' => false, 'msg' => 'คุณรับโปรโมชั่น ของวันนี้ไปแล้วค่ะ']);
						} else {
							//$pro = '15';
							$pro_2 = $this->admin_model->get_promotions();

							// 		print_r($pro_2);die;
							$bonus = ($dep_detail['amount'] * $pro_2[1]['percen']) / 100;
							$addbonus = $this->user_model->updateTransaction($dep_detail['id'], $pro_2[1]['id']);
							if ($addbonus == '1') {
								$data = array(
									'member_username' => $info['username'],
									'money' => $bonus,
									'pro_id' => $pro_2[1]['id'],
									'x' => $bonus + $dep_detail['amount'] * $pro_2[1]['x'],

								);
								//print_r($data);die;
								$iss = $this->admin_model->save_pro($data);

								if ($iss == 1) {

									$uppro = $this->user_model->updatepro($info['username'], $pro_2[1]['id']);
									$datasend = "";
									$add = $this->add_credit($user_ufa["username"], $bonus);
									if ($add['status']) {
										echo json_encode(['stats' => true, 'msg' => 'รับโบนัสสำเร็จ']);
										$time = date("H:i:s");
										$Balance = json_decode($this->Balance(), true);
										$baba = $Balance['balance'];
										$datasend .= "\nรับโปรโมชั่น " . $pro_2[1]['name'];

										$datasend .= "\nยอดฝากแรกของวัน {$dep_detail['amount']} บาท";
										$datasend .= "\nจำนวนโบนัส => {$bonus} บาท";
										$datasend .= "\nยอดคงเหลือ {$baba} บาท";
										$datasend .= "\nสมาชิก => " . $user_ufa["username"];
										$datasend .= "\nเวลาที่รับ => {$time} บาท";
										$this->notify_sent_d($datasend);
									} else {
										echo json_encode(['stats' => false, 'msg' => 'เกิดข้อผิดพลาดกรุณาติดต่อเจ้าหน้าที่']);
									}
								}
							} else {
								echo json_encode(['stats' => false, 'msg' => 'เกิดข้อผิดพลาดกรุณาติดต่อเจ้าหน้าที่']);
							}
						}
					} else {
						echo json_encode(['stats' => false, 'msg' => 'คุณไม่สามารถรับโปรโมชั่นนี้ได้แล้วค่ะ']);
					}
				} else if ($num_deposit > 1) {
					echo json_encode(['stats' => false, 'msg' => 'คุณไม่สามารถรับโปรโมชั่นนี้ได้แล้วค่ะ']);
				} else {
					echo json_encode(['stats' => false, 'msg' => 'คุณไม่อยู่ในเงื่อนไขที่จะได้รับโปรโมชั่นค่ะ']);
				}
			}
		}
	}

	public function pro_alldate_promotion()
	{
		date_default_timezone_set('Asia/Bangkok');
		if (isset($_POST['newdate'])) {

			$new_s = date("Y-m-d");
			$user = $this->session->userdata('user');
			$info = $this->user_model->getdata_user($user);
			$user_ufa = $this->user_model->user_ufa($user);

			if ($user) {

				$num_deposit = $this->user_model->CheckDeposit_date($info['username'], date('Y-m-d'));

				// 	print_r($num_deposit);die;
				if ($num_deposit == 1) {

					$Balance = json_decode($this->Balance(), true);

					//$money_ufa =  $Balance['balance'];

					//print_r($Balance);die;
					$credit = $Balance['balance'];

					$pro_user = $this->user_model->chack_promotions_date($info['username'], date('Y-m-d'));

					print_r($pro_user);
					die;

					$dep_detail = $this->user_model->GetDeposit($info['username']);


					if ($pro_user != null) {
						echo json_encode(['stats' => false, 'msg' => 'คุณรับโปรโมชั่น ของวันนี้ไปแล้วค่ะ']);
					} else {
						//$pro = '15';
						$pro_2 = $this->admin_model->get_promotions();

						//print_r($dep_detail);die;
						$bonus = ($dep_detail['amount'] * $pro_2[1]['percen']) / 100;
						$addbonus = $this->user_model->updateTransaction($dep_detail['id'], $pro_2[1]['id']);
						if ($addbonus == '1') {
							$data = array(
								'member_username' => $info['username'],
								'money' => $bonus,
								'pro_id' => $pro_2[1]['id'],
								'x' => $bonus + $credit * $pro_2[1]['x'],

							);
							//print_r($data);die;
							$iss = $this->admin_model->save_pro($data);

							if ($iss == 1) {

								$uppro = $this->user_model->updatepro($info['username'], $pro_2[1]['id']);
								$datasend = "";
								$add = $this->add_credit($user_ufa["username"], $bonus);
								if ($add['code'] == 0) {
									echo json_encode(['stats' => true, 'msg' => 'รับโบนัสสำเร็จ']);
									$time = date("H:i:s");
									$Balance = json_decode($this->Balance(), true);
									$baba = $credit + $bonus;
									$datasend .= "\nรับโปรโมชั่น " . $pro_2[1]['name'];

									$datasend .= "\nยอดก่อนฝาก {$credit} บาท";
									$datasend .= "\nจำนวนโบนัส => {$bonus} บาท";
									$datasend .= "\nยอดหลังฝาก {$baba} บาท";
									$datasend .= "\nสมาชิก => " . $user_ufa["username"];
									$datasend .= "\nเวลาที่รับ => {$time} บาท";
									$this->notify_sent_d($datasend);
								} else {
									echo json_encode(['stats' => false, 'msg' => 'เกิดข้อผิดพลาดกรุณาติดต่อเจ้าหน้าที่']);
								}
							}
						} else {
							echo json_encode(['stats' => false, 'msg' => 'เกิดข้อผิดพลาดกรุณาติดต่อเจ้าหน้าที่']);
						}
					}
				} else {
					echo json_encode(['stats' => false, 'msg' => 'คุณไม่อยู่ในเงื่อนไขที่จะได้รับโปรโมชั่นค่ะ']);
				}
			}
		}
	}
	public function Withdraw()
	{
		if ($_POST) {
			//print_r($_POST) or die;
			$seting = $this->admin_model->result_setting();
			$user = $this->session->userdata('user');
			// print_r($user);die;
			// 			exit(json_encode(['stats' => false, 'msg' => $user]));
			$money = $this->input->post('money');

			if ($user) {

				//print_r($user) or die;



				$user_ufa = $this->user_model->user_ufa($user);
				$accnum = $this->user_model->chekaccnum($user);


				// $balan = $this->ufa->get_balance($user_ufa['username']);
				// $ba_deposit = floatval(preg_replace('/[^\d.]/', '', number_format(filter_var($balan['b_deposit'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION))));
				// $ba_now = floatval(preg_replace('/[^\d.]/', '', number_format(filter_var($balan['balance'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION))));
				// // $ba_deposit['balance'];
				// // $ba_now['balance'];
				// if($ba_now > $ba_deposit){
				//   $addmem = $this->ufa->AddMember($user);
				//   if(empty($addmem->code)){
				//       $this->ufa->Withdraw($user_ufa['username'],$ba_deposit);
				//       $this->user_model->up_member_ufa_old($user);
				//       $this->user_model->add_ufa(['member_username' => $user, "username" => $addmem->username, "password" => $addmem->newpass]);
				//       $addcredit = $this->add_credit($addmem->username, $ba_now); //    
				//       if ($addcredit['status'] == true) {
				//           exit(json_encode(['stats' => false, 'msg' => 'Error try again']));
				//       }
				//     // filter_var($ba_deposit['balance'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
				//     // $dddddd = $parsed = floatval(preg_replace('/[^\d.]/', '', number_format(filter_var($ba_deposit['balance'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION))));
				//     //   exit(json_encode(['stats' => false, 'msg' => 'Error try again']));
				//   }else{
				//       exit(json_encode(['stats' => false, 'msg' => $addmem->code]));
				//   }

				// }

				// exit(json_encode(['stats' => false, 'msg' => $ba_deposit]));
				//var_dump($accnum[0]);
				$datasend = "";
				$datasend .= "\n☹▶สมาชิกแจ้งถอนเงิน◀☹";
				$datasend .= "\nสมาชิก => {$user_ufa['username']}";
				$datasend .= "\nธนาคารลูกค้า => " . $accnum['bank'];
				$datasend .= "\nเลขบัญชี => " . $accnum['accnum'];


				// $datasend .= "\nยอดก่อนถอน =>  บาท";
				// print_r($user_ufa);die;
				if ($user_ufa['username'] != '') {
					if ($money >= $seting['w_limit']) {
						// 		$Balance = json_decode($this->Balance(), true);
						$Balance = json_decode($this->Balance(), true);
						// 		print_r($Balance);die;

						$money_ufa =  $Balance['balance'];
						// 		print_r($money_ufa);die;
						$datasend .= "\nยอดก่อนถอน => {$money_ufa} บาท";
						$datasend .= "\nจำนวนเงินที่ถอน => {$money} บาท";
						$m = (float) str_replace(',', '', $money_ufa);
						if ($m >= $money) {
							$pro = $this->user_model->Promotions($user);
							// if(!empty($pro)){}
							
							// 			print_r($data_);die;

							
							// 			print_r($check_turn);die;

							// 			$check_turns = json_decode($check_turn, true);
							// 			print_r($check_turns);die;
							// 			$pro = $this->user_model->Promotions($user);
							// 			print_r($pro);die;
							// 			promotion_id
							//die;
							if (empty($pro['x'])) {
								$check =  $this->Withdraw_ufa($user_ufa['username'], $money);
								// print_r($check);
								// die;
								// echo "<pre>";
								// print_r($check);
								// die;
								// $json = json_decode($check, true);
								if ($check['status'] == true) {
									$this->bank_model->update_transection(['member_username' => $user, 'type' => 0, 'amount' => $money, 'stats' => 1]);
									// $this->notify_sent($user . '  ได้ถอนเงินจำนวน  ' . $money);
									$baba = json_decode($this->Balance(), true);
									$datasend .= "\nยอดเงินลูกค้าคงเหลือ => {$baba["balance"]} บาท";
									$datasend .= "\nสถานะ => กำลังดำเนินการทำรายการ";
									// $this->notify_sent($user . '  ได้ถอนเงินจำนวน  ' . $money);
									$this->notify_sent($datasend, 4);
								}
								echo json_encode(['status' => true]);
								$pro['x'] = 1;
							} else {
								$data_ = $this->promoWithid($pro['promotion_id']);
								$check_turns = $this->ufa->TurnOver($user_ufa['username'], $data_['date'], date('m/d/Y'));
								$Balances = $pro['x'] * $data_['amount'];
								//print_r($Balances);die;
								// print_r($check_turns['win_lose']);die;

								// $check_turns['win_lose'];
								// print_r($check_turns);die;
								// $check_turns_new = $Balance;


								if ($check_turns['turnover'] >= $Balances) {
									$check =  $this->Withdraw_ufa($user_ufa['username'], $money);
									// print_r($check);
									// die;
									// $json = json_decode($check, true);
									if ($check['status'] == true) {
										$this->bank_model->update_transection(['member_username' => $user, 'type' => 0, 'amount' => $money, 'stats' => 1]);
										$baba = json_decode($this->Balance(), true);
										$datasend .= "\nยอดเงินลูกค้าคงเหลือ => {$baba["balance"]} บาท";
										$datasend .= "\nสถานะ => กำลังดำเนินการทำรายการ";
										// $this->notify_sent($user . '  ได้ถอนเงินจำนวน  ' . $money);
										$this->notify_sent($datasend, 4);
									}
									echo json_encode(['stats' => true]);
								} else {
									if (empty($check_turns['turnover'])) {
										$check_turns['turnover'] = 0;
									}
									echo json_encode(['status' => false, 'msg' => 'เทิร์นไม่ครบ จำนวนเทิร์น ' . $check_turns['turnover'] . ' / '   . $Balances . ' บาท']);
								}
							}
						} else {
							echo json_encode(['status' => false, 'msg' => 'ยอดเงินไม่เพียงพอ']);
						}
					} else {
						echo json_encode(['status' => false, 'msg' => 'ถอนเงินขั้นต่ำ 1 บาท']);
					}
				} else {
					echo json_encode(['status' => false, 'msg' => 'คุณไม่ได้เปิดยูส']);
				}
			}
		}
	}

	private function add_credit($username, $amount)
	{
		return $this->ufa->Deposit($username, $amount); // เติม

	}
	public function check_turnover_user()
	{
		$user = $this->session->userdata('user');

		$user_ufa = $this->user_model->user_ufa($user);
		$pro = $this->user_model->Promotions($user);
		$data_ = $this->promoWithid($pro['promotion_id']);
		$check_turns = $this->ufa->TurnOver($user_ufa['username'], $data_['date'], date('m/d/Y'));
		echo json_encode(['status' => false, 'msg' => $check_turns]);
	}
	public function check_turnover_user1($user = null)
	{
		$date = $_POST['date'];
		$check_turns = $this->ufa->TurnOver1('', $date, $date);
		echo json_encode(['status' => false, 'msg' => $check_turns, 'date' => $date]);
	}

	public function check_turnover_user_member($user = null)
	{
		if ($user) {
			$check_turns = $this->ufa->TurnOver($user, date('m/d/Y'), date('m/d/Y'));
			echo json_encode(['status' => true, 'msg' => $check_turns]);
		}
	}

	public function history_turnover($user = null)
    {
		$result = $this->user_model->history_turnover($user);
		echo json_encode(['status' => true, 'result' => $result]);
    }
}
