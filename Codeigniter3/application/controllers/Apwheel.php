<?php
defined('BASEPATH') or exit('No direct script access allowed');
header('Content-Type: application/json');
class Apwheel extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('Ufa');
		$this->load->model('user_model');
	}

	public function index()
	{
		$res = array('status' => false, 'data' => 'No file');
		exit(json_encode($res));
	}

	public function table($user = null)
	{
		$result = null;
		if (!empty($user)) {
			$sql = "SELECT * FROM `wheel` WHERE user = '" . $user . "'";
			$query = $this->db->query($sql);
			$result = $query->result_array();
			$res = array('status' => true, 'data' => $result);
		} else {
			$res = array('status' => false, 'data' => $result);
		}
		exit(json_encode($res));
	}

	public function getrole($user = null)
	{
		if (!empty($user)) {
			$date = date("Y-m-d");

			$sql = "SELECT * FROM `wheel` WHERE user = '" . $user . "' AND date_new = '" . $date . "'";
			$query = $this->db->query($sql);
			$result = $query->result_array();
			$num = $query->num_rows();
			
			$sql = "SELECT lowcredit FROM `setting_wheel` WHERE id = 1";
		    $query = $this->db->query($sql);
		    $c_credit = $query->row();
			
            $status = true;
			$checkcredit = false;
			if ($num > 0) {
				$status = false;
			}
		    $credit = $this->checkCredit($user);
		    
		    if($credit >= $c_credit->lowcredit){
		        $checkcredit = true;
		    }
			$ip = $this->input->ip_address();
			$data = [
				'user' => $user,
				'detail' => 'เปิดหน้าวงล้อ',
				'module' => 'Wheelspin',
				'ip_address' => $ip
			];
			$this->db->insert('report_activity', $data);

			$res = array('status' => $status, 'data' => (!empty($result) ? $result : null) , 'credit'=> $checkcredit,'lowcredit'=>$c_credit->lowcredit);
		} else {
			$res = array('status' => false, 'data' => 'No API');
		}
		exit(json_encode($res));
	}

	public function cccc()
	{
		$date = date("Y-m-d");

		$sql = "SELECT * FROM `wheel`";
		$query = $this->db->query($sql);
		$result = $query->result_array();
		// strlen($result['data'])

		for ($x = 0; $x < 5; $x++) {
			$sql = "UPDATE wheel SET date_new = '" . $result[$x]['create_date'] . "' WHERE '" . $result[$x]['user'] . "'";
			$query = $this->db->query($sql);
		}


		$res = array('status' => true, 'msg' => $sql, 'result' => $result);
		echo (json_encode($res));
	}

	public function getrd($user = null)
	{
		if (!empty($user)) {
			$date = date("Y-m-d");

			$sql = "SELECT * FROM `wheel` WHERE user = '" . $user . "' AND date_new = '" . $date . "'";
			$query = $this->db->query($sql);
			$result = $query->result_array();
			$num = $query->num_rows();


			$status = true;
			if ($num > 0) {
				$status = false;
			}

			$ip = $this->input->ip_address();
			$data = [
				'user' => $user,
				'detail' => 'หมุนวงล้อ',
				'module' => 'Wheelspin',
				'ip_address' => $ip
			];
			$this->db->insert('report_activity', $data);

			if ($status) {
				$num = rand(0, 9);
				$arr = array();
				$setting_w_type = $this->admin_model->setting_w_type();
				foreach ($setting_w_type as $v) {
					array_push($arr, $v['value']);
				}
				$ufa = $this->user_model->user_ufa($user);
				$username =  $ufa['username'];
				$rrr['status'] = ($arr[$num] > 0) ? false : true;
				if ($arr[$num] > 0) {
					$rrr = $this->ufa->Deposit($username, $arr[$num]);
				}
				if ($rrr['status']) {
					$data = [
						'user' => $user,
						'credit' => $arr[$num],
						'date_new' => $date
					];
					$this->db->insert('wheel', $data);
					$res = [
						'status' => true,
						'msg' => 'Add creadit success',
						'data' => [
							'num' => $num,
							'credit' => $arr[$num]
						],
					];
				} else {
					$res = array('status' => false, 'data' => 'Error Add credit');
				}
			} else {
				$res = array('status' => false, 'data' => 'ไม่สามารถรับได้');
			}
		} else {
			$res = array('status' => false, 'data' => 'No API');
		}
		exit(json_encode($res));
	}
	
	private function checkCredit($mem_user){
	    $sql = "SELECT username FROM `ufa_acc` WHERE member_username = '" . $mem_user . "'";
		$query = $this->db->query($sql);
		$result = $query->row();
		$balance = $this->ufa->get_balance($result->username);
		$balance = str_replace(',','',$balance);

		return floatval($balance['balance']);
	}
}
