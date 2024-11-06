<?php
defined('BASEPATH') or exit('No direct script access allowed');
header('Content-Type: application/json');
class Cron_topup extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->library('scb');
		$this->load->model('user_model');
		$this->load->model('bank_model');
		$this->load->library('Ufa');
		$this->load->model('admin_model');
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

	public function index()
	{
		if (php_sapi_name() === 'cli') {
			$seting = $this->admin_model->result_setting();
			$bb = $this->admin_model->bank();
			// print_r( $bb);
			echo "CRON TOPUP".PHP_EOL;
			$scb = [
				"accnum" => $bb['accnum'], //เลขบช
				"deviceid" => $bb['username'], //deviceid
				"pin" => $bb['password'], ////api_refresh
			];
			if ($bb['status_scb'] == 1) {
				$this->scb->SetLogin($scb['deviceid'], $scb['pin'], $scb['accnum']);
				$trans = $this->scb->getTransaction();
				$tran = json_decode($trans, true);

				
				// echo $tran;

				$user = $this->user_model->get_user_all();
			 //print_r($tran);die;
				foreach ($user as $users) {
				// 	$pro = $this->user_model->Promotions($users['username']);
				// 	if (@$pro['promotion_id'] == 0) {
				// 		$percen = 0;
				// 	} else {
				// 		$percen = $pro['percen'] / 100;
				// 	}
				    $percen = 0;
					foreach ($tran["result"] as $v) {

						if ($v['txnDebitCreditFlag'] !== "C") {
							continue;
						}
						// print_r($tran);die;
						$timestamp = strtotime($v["txnDateTime"]);
						$v['date'] = date("d-m-Y", $timestamp);
						$v['time'] = date("H:i:s", $timestamp);
					    $bank = explode(" ", $v['txnRemark']);

						$v['description'] = md5($v['txnDateTime'] . $v['acc_num']);
						$money_deposit = $v['txnAmount'];
						$mm = (float)str_replace(',', '', $money_deposit);
						$mmmm = $mm * $percen;
						$m = $mmmm + $mm;
						
						

						$data = ["date" => $v['date'], "time" => $v['time'], "description" => $v['description']];
						$data_topup  = ["username" => $users['username'], "date" => $v['date'], "time" => $v['time'], "description" => $v['description'], "amount" => $m];

						$check = $this->bank_model->check_tran($data_topup);
						if ($check == 0) {
							if ($m >= $seting['d_limit']) {
							    if(!($v['time']>="00:00:00" && $v['time']<"00:59:59")){
								$data = ["date" => $v['date'], "time" => $v['time'], "description" => $v['description']];
								$data_topup  = ["username" => $users['username'], "date" => $v['date'], "time" => $v['time'], "description" => $v['description'], "amount" => $m];

								if ($users['bank'] == 'scb') {
									preg_match_all("/SCB x(.*) /U ", $v['txnRemark'], $scbbank);
									$v['acc_num'] = str_replace("SCB x", "", implode($scbbank[1]));
									//echo $v['acc_num'];
								} elseif ($users['bank'] == 'gsb' || $users['bank'] == 'baac') {
									$v['acc_num'] = str_replace("/X", "", $bank[2]);
								} else {
									$v['acc_num'] = str_replace("/X", "", $bank[2]);
									//  echo $v['acc_num']."<br>";
								}
								//  print_r($users["accnum"]);die;
								// echo $v['acc_num']."<br>";
								$datasend = "";
								// echo substr($users["accnum"], -4 )." ".$users["accnum"]." ".(substr($users["accnum"], -4 ) === $v['acc_num']).PHP_EOL;
								// echo (substr($users["accnum"], -4))." ".(substr($v["acc_num"], -4))." ".(substr($users["accnum"], -4) === substr($users["accnum"], -4)).PHP_EOL;
								if (substr($users["accnum"], -4 ) === substr($v["acc_num"], -4)) {
									$user_ufa = $this->user_model->user_ufa($users['username']);
									// $check_ufa = $this->user_model->getdata_user($users['username']);
									echo "เข้าเงี่อนไขๆๆๆๆ \n Username : {$user_ufa["username"]}  \n Accnum : {$users["accnum"]} \n LIKE {$v['acc_num']} \n";
									$datasend .= "\n❤ระบบเติมเงิน AUTO❤";
									$datasend .= "\nระบบ =>ufacv9";
									$datasend .= "\nสมาชิก => " . $user_ufa["username"];
									$datasend .= "\nจำนวนเงิน => {$m} บาท";
									$newser = $user_ufa["username"];
									$usercll = $users['username'];
									$lastcredit = json_decode($this->check_credit($user_ufa["username"]))->balance;
									// check_credit
									// echo '<pre>';
									// print_r($lastcredit);die;
									$datasend .= "\nยอดก่อนฝาก {$lastcredit} บาท";
									// $this->notify_sent($datasend);
									// print_r($users["username"]);die;
									$check_ufa = $this->user_model->getdata_user($users['username']);
									// print_r($check_ufa);die;
									if ($check_ufa['aff'] != 0) {
										$number = $m;

										if($lastcredit<=10){
										     echo "Reset Promotion ".$users['username'];
											$this->user_model->update_reset_promotion($users['username']);
										}

										$add = $this->add_credit($user_ufa["username"], $number);
										echo 'COIN = ' . $number . PHP_EOL;
										if ($add['status'] == true) {

											if ($m >= $seting['aff_d']) {
												$u = $check_ufa['aff'];
												$uu = $this->user_model->getdata_id($u);
												echo $users['username'];
												$check_ufa = $this->user_model->getdata_user($users['username']);
												$user_ufa = $this->user_model->user_ufa($uu['username']);
												if($lastcredit<=10){
											$this->user_model->update_reset_promotion($users['username']);
											 echo "Reset Promotion ".$users['username'];
										}
												$json = $this->add_credit($user_ufa['username'], $m * $seting['aff_m']);
												echo "COIN * = " . $m * $seting['aff_m'];
												if ($json['status'] == true) {
													$d_aff = ["amout" => $m, "amout_get" => $m * $seting['aff_m'], "username" => $uu['username'],];
													$this->user_model->add_aff($d_aff);
													$this->user_model->affc($users['username']);
													echo json_encode(['status' => true, 'msg' => $uu['username'] . 'ได้รับค่าแนะนำ']);
												} else {
													echo json_encode(['status' => false, 'msg' => 'เกิดข้อผิดพลาดจากระบบ']);
												}
											}

											echo json_encode(['status' => true]);
											$this->bank_model->update_tran($data_topup);
											$this->bank_model->update_transection(['member_username' => $users['username'], 'type' => 1, 'amount' => $number]);
											$endcredit = json_decode($this->check_credit($newser))->balance;
											$datasend .= "\nยอดหลังฝาก {$endcredit} บาท";
											$datasend .= "\nสถานะ => ระบบเติมเงินเข้ามาเรียบร้อยแล้ว";

											$this->notify_sent($datasend,3);
										} else {
											$datasend .= "\nสถานะ => ⛔เกิดข้อผิดพลาดจาระบบเติมเงิน⛔";
											$this->notify_sent($datasend,3);
											echo json_encode(['status' => false, 'msg' => 'เกิดข้อผิดพลาดจากระบบ']);
										}
									} else {
										// $user_ufa = $this
										//     ->user_model
										//     ->user_ufa($users['username']);
										$number = $m;
										if($lastcredit<=10){
										    echo "Reset Promotion ".$users['username'];
											$this->user_model->update_reset_promotion($users['username']);
										}
										$json = $this->add_credit($user_ufa['username'], $number);
										echo "COIN x = " . $number;
								// 		print_r($json);die;
										if ($json['status'] == true) {
											echo json_encode(['status' => true]);
											$this->bank_model->update_tran($data_topup);
											$this->bank_model->update_transection(['member_username' => $users['username'], 'type' => 1, 'amount' => $number]);
											$endcredit = json_decode($this->check_credit($user_ufa["username"]))->balance;
											$datasend .= "\nยอดหลังฝาก {$endcredit} บาท";
											$datasend .= "\nสถานะ => ระบบเติมเงินเข้ามาเรียบร้อยแล้ว";
											$this->notify_sent($datasend,3);
										} else {
											$datasend .= "\nสถานะ => เกิดข้อผิดพลาดจาระบบเติมเงิน⛔";
											$this->notify_sent($datasend,3);
											echo json_encode(['status' => false, 'msg' => 'เกิดข้อผิดพลาดจากระบบ']);
										}
									}
									//$this->bank_model->update_tran($data);

								} else {
									//echo 'ไม่พบ';

								}
								
							    }else{
							     //echo $v['date'].' '.$v['time']." ไม่อยู่ในช่วงเวลา".PHP_EOL;
							}
							}
							
							
						} else {
							//echo json_encode(['status' => false, 'msg' => 'เกิดข้อผิดพลาดจากระบบ']);
						}
					}
				}
			} else {
				echo 'SCB CLOSE';
			}
		} else {
			echo "5555+";
		}
	}

	private function adduser()
	{
		return $this->ufa->add_member(); //สร้างยูส
	}
	private function add_credit($username, $amount)
	{
		return $this->ufa->Deposit($username, $amount); // เติม

	}

	private function check_credit($username)
	{
		return json_encode($this->ufa->get_balance($username)); // เติม

	}
}
