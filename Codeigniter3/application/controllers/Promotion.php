<?php
//include_once (dirname(__FILE__) . "/ApiUfa.php");
defined('BASEPATH') or exit('No direct script access allowed');
header('Content-Type: application/json');
class Promotion extends CI_Controller
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
        echo "55";
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
	private function edit_userpro()
	{

		$user = $this->input->get('user');

		print_r($user);die;
		
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

	private function edit_userpromotion()
	{
		
	}

	private function Withdraw_ufa($username, $amount)
	{


		return  $this->ufa->Withdraw($username, $amount); // เติม



	}




}