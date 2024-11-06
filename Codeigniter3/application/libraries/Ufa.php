<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Ufa
{
	protected $CI;
	public $credentials = array();
	public $cookie_file = null;
	public $curl_options = null;

	public $response = null;
	public $http_code = null;
	private $sub = false;

	private $urlmain = "http://ocean.isme99.com";
	private $urllogin = "http://ocean.isme99.com/Public/Default11.aspx";
	private $urlagent_info = "http://ocean.isme99.com/AccInfo.aspx";
	private $urlbalance = "http://ocean.isme99.com/_SubAg/AccBal.aspx?role=sa";
	private $urlmem_info = "http://ocean.isme99.com/_SubAg1/MemberSet.aspx?&userName=";
	private $urlturnover = "http://ocean.isme99.com/_SubAg/SubAccsWinLoseFull.aspx?role=sa&userName=";
	private $urlmember = "http://ocean.isme99.com/_SubAg1/MemberSet.aspx";

	public $attemp_login = 0;
	public $is_login = null;

	public $headers = array();
	public $postdata = array();

	public $user_agent;
	public $user_agent_name;
	public $pass_agent;

	private $vs = null;
	private $ev = null;
	private $vsg = null;

	public function __construct()
	{
		$this->CI = get_instance();
		date_default_timezone_set('Asia/Manila');

		$this->CI->load->model('admin_model');
		$setting = $this->CI->admin_model->result_setting();
		$this->user_agent = $setting['acc_ufa'];
		$this->user_agent_name = $setting['acc_ufa'];
		$this->pass_agent = $setting['ufa_pass'];
		// 		print_r($this->user_agent);die;
		$this->setCookieFile(FCPATH . $this->user_agent.'.ops');
		$this->checkSub(true);
		$this->check_login();
	}

	private function checkSub($ss = null)
	{
		if ($ss) {
			$this->sub = true;
		}
		if (!$this->sub) {
			$this->urlmain = "http://ocean.isme99.com";
			$this->urllogin = "http://ocean.isme99.com/Public/Default11.aspx";
			$this->urlagent_info = "http://ocean.isme99.com/AccInfo.aspx";
			$this->urlbalance = "http://ocean.isme99.com/_Age/AccBal.aspx?role=ag";
			$this->urlmem_info = "http://ocean.isme99.com/_Age1/MemberSet.aspx?&userName=";
			$this->urlturnover = "http://ocean.isme99.com/_Age/SubAccsWinLoseFull.aspx?role=sa&userName=";
			$this->urlmember = "http://ocean.isme99.com/_Age1/MemberSet.aspx";
		}
	}

	private function setCookieFile($cookie_path = null, $space = '')
	{
		if (is_null($cookie_path)) $cookie_path = sys_get_temp_dir();

		if (file_exists($cookie_path) && is_dir($cookie_path)) {
			$cookie_path = $cookie_path . "ccis" . $space . ".ops";
			register_shutdown_function(function () {
				@unlink($this->cookie_path);
			});
		} else {
			if (!file_exists($cookie_path)) file_put_contents($cookie_path, "");
			$cookie_path = realpath($cookie_path);
		}
		$this->cookie_file = $cookie_path;
	}

	private function request($url, $path, $data = null, $tt = false, $img = false, $fr = false)
	{
		$handle = curl_init($url . $path);

		if (!is_null($data)) {
			curl_setopt_array($handle, array(
				CURLOPT_POST => true,
				CURLOPT_POSTFIELDS => is_array($data) ? http_build_query($data) : $data
			));
		}
		if ($tt) {
			curl_setopt_array($handle, array(
				CURLOPT_COOKIEFILE => $this->cookie_file,
			));
		} else {
			curl_setopt_array($handle, array(
				CURLOPT_COOKIEFILE => $this->cookie_file,
				CURLOPT_COOKIEJAR => $this->cookie_file,
			));
		}
		if ($fr) {
			curl_setopt_array($handle, array(
				CURLOPT_FOLLOWLOCATION => false,
			));
		} else {
			curl_setopt_array($handle, array(
				CURLOPT_FOLLOWLOCATION => true,
			));
		}

		curl_setopt_array($handle, array(
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_HTTPHEADER => $this->headers,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_SSL_VERIFYHOST => false,
		));

		if (is_array($this->curl_options)) curl_setopt_array($handle, $this->curl_options);
		if ($img) {
			$this->response = curl_exec($handle);
		} else {
			// $this->response = curl_exec($handle);
			$this->response = iconv("utf-8", "utf-8", curl_exec($handle));
		}
		$this->http_code = curl_getinfo($handle, CURLINFO_HTTP_CODE);
		curl_close($handle);
		// if (preg_match("<input type=\"hidden\" name=\"org\.apache\.struts\.taglib\.html\.TOKEN\" value=\"([0-9]*(\.[0-9]{1,16})?)\">", $this->response, $matches)) {
		//     $this->_TOKEN = $matches[1];
		// }
		return $this->response;
	}

	private function request2($url, $path, $data = null, $tt = false, $img = false, $fr = false)
	{
		$handle = curl_init($url . $path);
		curl_setopt_array($handle, array(
			CURLOPT_PROXYPORT => "3128",
			CURLOPT_PROXYTYPE => 'HTTPS',
			CURLOPT_PROXY => "116.204.183.229",
			CURLOPT_PROXYUSERPWD => "breopodfodfg01@gmail.com:Q123456123q"
		));

		if (!is_null($data)) {
			curl_setopt_array($handle, array(
				CURLOPT_POST => true,
				CURLOPT_POSTFIELDS => is_array($data) ? http_build_query($data) : $data
			));
		}
		if ($tt) {
			curl_setopt_array($handle, array(
				CURLOPT_COOKIEFILE => $this->cookie_file,
			));
		} else {
			curl_setopt_array($handle, array(
				CURLOPT_COOKIEFILE => $this->cookie_file,
				CURLOPT_COOKIEJAR => $this->cookie_file,
			));
		}
		if ($fr) {
			curl_setopt_array($handle, array(
				CURLOPT_FOLLOWLOCATION => false,
			));
		} else {
			curl_setopt_array($handle, array(
				CURLOPT_FOLLOWLOCATION => true,
			));
		}

		curl_setopt_array($handle, array(
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_HTTPHEADER => $this->headers,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_SSL_VERIFYHOST => false,
		));

		if (is_array($this->curl_options)) curl_setopt_array($handle, $this->curl_options);
		if ($img) {
			$this->response = curl_exec($handle);
		} else {
			// $this->response = curl_exec($handle);
			$this->response = iconv("utf-8", "utf-8", curl_exec($handle));
		}
		$this->http_code = curl_getinfo($handle, CURLINFO_HTTP_CODE);
		curl_close($handle);
		// if (preg_match("<input type=\"hidden\" name=\"org\.apache\.struts\.taglib\.html\.TOKEN\" value=\"([0-9]*(\.[0-9]{1,16})?)\">", $this->response, $matches)) {
		//     $this->_TOKEN = $matches[1];
		// }
		return $this->response;
	}

	private function DOMXPath($html, $qry)
	{
		$html = mb_convert_encoding($html, 'HTML-ENTITIES', "UTF-8");
		$doc = new DOMDocument();
		libxml_use_internal_errors(true);
		$doc->loadHTML($html);
		libxml_clear_errors();
		$xpath = new DOMXPath($doc);
		$nodeList = $xpath->query($qry);

		return $nodeList;
	}

	public function check_login()
	{
		$this->headers = array(
			"accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9",
			"cache-control: no-cache",
			"user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36"
		);
		$this->request($this->urlagent_info, '', $this->headers, 0, 0);
		$res = $this->DOMXPath($this->response, "//span[@id='lblsCashBalance']");
		// print_r($this->response);die;
		if (!empty($res[0]->nodeValue)) {
			$this->is_login = true;
		} else {
			$this->is_login = $this->Login();
		}
		return $this->is_login;
	}

	public function Login()
	{
		$this->request("{$this->urllogin}?", "lang=EN-US");
		$this->viewState();

		$this->headers = $this->getHeaders();
		$this->headers[] = "content-type: application/x-www-form-urlencoded";

		$this->postdata = array(
			'__EVENTTARGET' => 'btnSignIn',
			'__EVENTARGUMENT' => '',
			'__VIEWSTATE' => $this->vs[0]->nodeValue,
			'__VIEWSTATEGENERATOR' => $this->vsg[0]->nodeValue,
			// '__EVENTVALIDATION' => $this->ev[0]->nodeValue,
			'hid_rd' => '',
			'txtUserName' => $this->user_agent,
			'txtPassword' => $this->pass_agent,
			'txtCode' => '',
			'lstLang' => 'Default11.aspx?lang=EN-US'
		);
		$this->request("{$this->urllogin}?lang=EN-US", "", $this->postdata);
		// 		print_r($this->response);die;
		$c = explode('<title>', $this->response);
		$c = explode('</title>', $c[1]);
		if (strpos(trim($c[0]), ':: Management ::') !== false) {
			return false;
		} else {
			return true;
		}
	}

	public function agent_info()
	{
		if ($this->is_login) {
			$this->headers = $this->getHeaders();
			$this->request($this->urlagent_info, '', null);
			// 			print_r($this->response);die;
			$lblaUserName = $this->DOMXPath($this->response, "//span[@id='lblsUserName']");
			$lblaCashBalance = $this->DOMXPath($this->response, "//span[@id='lblsCashBalance']");
			$lblaAccBalance = $this->DOMXPath($this->response, "//span[@id='lblsAccBalance']");
			$lblaTotalBalance = $this->DOMXPath($this->response, "//span[@id='lblsTotalBalance']");
			$lblaTotalOutstanding = $this->DOMXPath($this->response, "//span[@id='lblsTotalOutstanding']");
			$lblaTotalAgentCredit = $this->DOMXPath($this->response, "//span[@id='lblsTotalAgentCredit']");
			$lblaTotalMemberCredit = $this->DOMXPath($this->response, "//span[@id='lblsTotalMemberCredit']");
			$lblaCurrency = $this->DOMXPath($this->response, "//span[@id='lblsCurrency']");
			$lblaTotalGivenCredit = $this->DOMXPath($this->response, "//span[@id='lblsTotalGivenCredit']");
			$lblaMinBet = $this->DOMXPath($this->response, "//span[@id='lblsMinBet']");
			$lblaTotalAgentCount = $this->DOMXPath($this->response, "//span[@id='lblsTotalAgentCount']");
			$lblaTotalMemberCount = $this->DOMXPath($this->response, "//span[@id='lblsTotalMemberCount']");
			$lblaCredit = $this->DOMXPath($this->response, "//span[@id='lblsCredit']");
			$data = [
				"lblaUserName" => $lblaUserName[0]->nodeValue,
				"lblaCredit" => $lblaCredit[0]->nodeValue,
				"lblaCashBalance" => $lblaCashBalance[0]->nodeValue,
				"lblaAccBalance" => $lblaAccBalance[0]->nodeValue,
				"lblaTotalBalance" => $lblaTotalBalance[0]->nodeValue,
				"lblaTotalOutstanding" => $lblaTotalOutstanding[0]->nodeValue,
				"lblaTotalAgentCredit" => $lblaTotalAgentCredit[0]->nodeValue,
				"lblaTotalMemberCredit" => $lblaTotalMemberCredit[0]->nodeValue,
				"lblaCurrency" => $lblaCurrency[0]->nodeValue,
				"lblaTotalGivenCredit" => $lblaTotalGivenCredit[0]->nodeValue,
				"lblaMinBet" => $lblaMinBet[0]->nodeValue,
				"lblaTotalAgentCount" => $lblaTotalAgentCount[0]->nodeValue,
				"lblaTotalMemberCount" => $lblaTotalMemberCount[0]->nodeValue,
			];
			return $data;
		} else {
			return ['code' => 'error', 'msg' => 'No Data Agent info', 'status' => false];
		}
	}

	public function get_balance($username = null)
	{
		if (!empty($username)) {
			if ($this->is_login) {
				$this->headers = $this->getHeaders();
				$this->request($this->urlbalance, "&userName={$this->user_agent_name}&searchKey={$username}&pageIndex=1");

				$rows = $this->DOMXPath($this->response, '//tr[@class="GridItem"]/td');
				$cellData = [];
				foreach ($rows as $row) {
					$cells = $row->getElementsByTagName('span');
					foreach ($cells as $cell) {
						$cellData[] = $cell->nodeValue;
					}
				}
				$res = preg_replace('/\s\s+/', '', $cellData);
				// print_r($res);die;
				if (!empty($res[5])) {
					return ['balance' => $res[5]];
				} else {
					return ['balance' => null];
				}
			} else {
				$this->Login();
				return $this->get_balance($username);
			}
		}
	}

	private function mem_info($id = null)
	{
		if (!empty($id)) {
			if ($this->is_login) {
				$this->headers = $this->getHeaders();
				$this->request($this->urlmem_info, "{$id}&set=1");
				$rows = $this->DOMXPath($this->response, '//input[@name="txtTotalLimit"]/@value');
				$this->viewState();
				if (!empty($rows[0])) {
					if (strlen($rows[0]->nodeValue) >= 5) {
						$number = (float) str_replace(',', '', $rows[0]->nodeValue);
						return $number;
					} else {
						return $rows[0]->nodeValue;
					}
				} else {
					return ['code' => 'error', 'msg' => 'No info', 'status' => false];
				}
			} else {
				$this->Login();
				return $this->mem_info($id);
			}
		}
	}

	public function Deposit($username = null, $amount = null)
	{
		if (!empty($username) && !empty($amount)) {
			if ($this->is_login) {
				$m = $this->mem_info($username);
				if (!is_array($m)) {
					$m = $m + $amount;
					$this->headers = $this->getHeaders();
					$this->headers[] = "content-type: application/x-www-form-urlencoded";
					$data = $this->postaddcredit($m);
					$this->request($this->urlmem_info, "{$username}&set=1", $data);
					$lblStatus = $this->DOMXPath($this->response, "//span[@id='lblStatus']/span[@class='ENG']");
					// 	print_r($lblStatus[0]->nodeValue);die;
					// if ($lblStatus[0]->nodeValue == "อัพเดตข้อมูลเรียบร้อย") {
					if ($lblStatus[0]->nodeValue == "Profile updated successfully.") {
						return ['username' => $username, "addcredit" => $amount, 'status' => true];
					} else {
						return ['code' => 'error', 'msg' => 'Error Deposit No response', 'status' => false];
					}
				} else {
					return ['code' => 'error', 'msg' => 'Error Deposit', 'status' => false];
				}
			}
		}
	}

	public function ClearDeposit($username = null, $amount = null)
	{
		if (!empty($username) && !empty($amount)) {
			if ($this->is_login) {
				$m = $this->mem_info($username);
				if (!is_array($m)) {
					$m = $m - $amount;
					$this->headers = $this->getHeaders();
					$this->headers[] = "content-type: application/x-www-form-urlencoded";
					$data = $this->postaddcredit($m);
					$this->request($this->urlmem_info, "{$username}&set=1", $data);
					$lblStatus = $this->DOMXPath($this->response, "//span[@id='lblStatus']/span[@class='ENG']");
					// 	if ($lblStatus[0]->nodeValue == "อัพเดตข้อมูลเรียบร้อย") {
					if ($lblStatus[0]->nodeValue == "Profile updated successfully.") {
						return ['username' => $username, "clearamount" => $amount];
					} else {
						return ['code' => 'error', 'msg' => 'Error Deposit No response', 'status' => false];
					}
				} else {
					return ['code' => 'error', 'msg' => 'Error Deposit', 'status' => false];
				}
			}
		}
	}

	public function Withdraw($username = null, $amount = null)
	{
		if (!empty($username) && !empty($amount)) {
			if ($this->is_login) {
				$this->headers = $this->getHeaders();
				$this->request($this->urlbalance, "&userName={$this->user_agent_name}&searchKey={$username}&pageIndex=1");
				$link2 = $this->DOMXPath($this->response, "//a[@class='Link2']/@href");
				$this->request($this->urlmain, $link2[0]->nodeValue);
				$this->viewState();
				$_withdraw_data = array(
					'__LASTFOCUS' => '',
					'__EVENTTARGET' => '',
					'__EVENTARGUMENT' => '',
					'__VIEWSTATE' => $this->vs[0]->nodeValue,
					'__VIEWSTATEGENERATOR' => $this->vsg[0]->nodeValue,
					'__EVENTVALIDATION' => $this->ev[0]->nodeValue,
					'AccPay_cm1$txtAmount' => '-' . $amount,
					'AccPay_cm1$btnSubmit' => 'Submit'
				);
				$this->headers[] = "content-type: application/x-www-form-urlencoded";
				$this->request($this->urlmain, $link2[0]->nodeValue, $_withdraw_data);
				$lblStatus = $this->DOMXPath($this->response, "//span[@id='AccPay_cm1_lblStatus']");

				if ($lblStatus[0]->nodeValue == '') {
					return ['username' => $username, "withdraw" => $amount, "status" => true];
				} else {
					return ["status" => false];
				}
			}
		}
	}

	public function ClearYod($username = null, $amount = null)
	{
		///IF Credit > 0 Not withdraw
		if (!empty($username) && !empty($amount)) {
			if ($this->is_login) {
				$this->headers = $this->getHeaders();
				$this->request($this->urlbalance, "&userName={$this->user_agent_name}&searchKey={$username}&pageIndex=1");
				$link2 = $this->DOMXPath($this->response, "//a[@class='Link2']/@href");
				$this->request($this->urlmain, $link2[0]->nodeValue);
				$this->viewState();
				$_withdraw_data = array(
					'__LASTFOCUS' => '',
					'__EVENTTARGET' => '',
					'__EVENTARGUMENT' => '',
					'__VIEWSTATE' => $this->vs[0]->nodeValue,
					'__VIEWSTATEGENERATOR' => $this->vsg[0]->nodeValue,
					'__EVENTVALIDATION' => $this->ev[0]->nodeValue,
					'AccPay_cm1$txtAmount' => $amount,
					'AccPay_cm1$btnSubmit' => 'Submit'
				);
				$this->headers[] = "content-type: application/x-www-form-urlencoded";
				$this->request($this->urlmain, $link2[0]->nodeValue, $_withdraw_data);
				$lblStatus = $this->DOMXPath($this->response, "//span[@id='AccPay_cm1_lblStatus']");
				if ($lblStatus[0]->nodeValue == '') {
					$this->ClearDeposit($username, $amount);
				} else {
					return false;
				}
			}
		}
	}

	public function TurnOver($username = null, $start = null, $end = null)
	{
		if (!empty($username) && !empty($start) && !empty($end)) {
			if ($this->is_login) {
				$this->headers = $this->getHeaders();
				$this->request($this->urlturnover, "{$this->user_agent_name}&catId=&gId=-1");

				if (date('d', strtotime($start)) == date('d')) {
					$start = date('m/d/Y', strtotime('-1 day', strtotime($start)));
				}
				$this->viewState();
				$postdata = 'SubAccsWinLoseFull_cm1%24chkAll=on&SubAccsWinLoseFull_cm1%24chkCatList%240=on&SubAccsWinLoseFull_cm1%24chkCatList%241=on&SubAccsWinLoseFull_cm1%24chkCatList%2410=on&SubAccsWinLoseFull_cm1%24chkCatList%2411=on&SubAccsWinLoseFull_cm1%24chkCatList%2412=on&SubAccsWinLoseFull_cm1%24chkCatList%2413=on&SubAccsWinLoseFull_cm1%24chkCatList%2414=on&SubAccsWinLoseFull_cm1%24chkCatList%2415=on&SubAccsWinLoseFull_cm1%24chkCatList%2416=on&SubAccsWinLoseFull_cm1%24chkCatList%2417=on&SubAccsWinLoseFull_cm1%24chkCatList%242=on&SubAccsWinLoseFull_cm1%24chkCatList%243=on&SubAccsWinLoseFull_cm1%24chkCatList%244=on&SubAccsWinLoseFull_cm1%24chkCatList%245=on&SubAccsWinLoseFull_cm1%24chkCatList%246=on&SubAccsWinLoseFull_cm1%24chkCatList%247=on&SubAccsWinLoseFull_cm1%24chkCatList%248=on&SubAccsWinLoseFull_cm1%24chkCatList%249=on&__EVENTARGUMENT=&__EVENTTARGET=SubAccsWinLoseFull_cm1%24btnSubmit&__EVENTVALIDATION=' . urlencode($this->ev[0]->nodeValue) . '&__VIEWSTATE=' . urlencode($this->vs[0]->nodeValue) . '&__VIEWSTATEGENERATOR=' . urlencode($this->vsg[0]->nodeValue) . '&datBegin=' . urlencode($start) . '&datEnd=' . urlencode($end);
				$this->headers[] = "content-type: application/x-www-form-urlencoded";
				$this->request($this->urlturnover, "{$this->user_agent_name}&catId=&gId=-1", $postdata);
				$rows = $this->DOMXPath($this->response, "//tr[@align='center'][contains(@class,'Grid')]");
				$user_data = [];
				for ($i = 2; $i <= count($rows) - 2; $i++) {
					$data = preg_replace("/\s+/", "/", trim($rows[$i]->nodeValue));
					$s =  explode("/", $data);
					$user = str_replace("*", "", $s[0]);
					$user_data[$user] = [
						"username" => $user,
						"turnover" => floatval(preg_replace('/\.(?=.*\.)/', '', str_replace(",", ".", $s[3]))),
						"w/l" => floatval(preg_replace('/\.(?=.*\.)/', '', str_replace(",", ".", $s[8])))
					];
				}
				if (array_key_exists($username, $user_data)) {
					return 	$user_data[$username];
				} else {
					return null;
				}
			}
		}
	}

	public function TurnOver1($username = null, $start = null, $end = null)
	{
		if (!empty($start) && !empty($end)) {
			if ($this->is_login) {
				$this->headers = $this->getHeaders();
				$this->request($this->urlturnover, "{$this->user_agent_name}&catId=&gId=-1");

				if (date('d', strtotime($start)) == date('d')) {
					$start = date('m/d/Y', strtotime('-1 day', strtotime($start)));
				}
				$this->viewState();
				$postdata = 'SubAccsWinLoseFull_cm1%24chkAll=on&SubAccsWinLoseFull_cm1%24chkCatList%240=on&SubAccsWinLoseFull_cm1%24chkCatList%241=on&SubAccsWinLoseFull_cm1%24chkCatList%2410=on&SubAccsWinLoseFull_cm1%24chkCatList%2411=on&SubAccsWinLoseFull_cm1%24chkCatList%2412=on&SubAccsWinLoseFull_cm1%24chkCatList%2413=on&SubAccsWinLoseFull_cm1%24chkCatList%2414=on&SubAccsWinLoseFull_cm1%24chkCatList%2415=on&SubAccsWinLoseFull_cm1%24chkCatList%2416=on&SubAccsWinLoseFull_cm1%24chkCatList%2417=on&SubAccsWinLoseFull_cm1%24chkCatList%242=on&SubAccsWinLoseFull_cm1%24chkCatList%243=on&SubAccsWinLoseFull_cm1%24chkCatList%244=on&SubAccsWinLoseFull_cm1%24chkCatList%245=on&SubAccsWinLoseFull_cm1%24chkCatList%246=on&SubAccsWinLoseFull_cm1%24chkCatList%247=on&SubAccsWinLoseFull_cm1%24chkCatList%248=on&SubAccsWinLoseFull_cm1%24chkCatList%249=on&__EVENTARGUMENT=&__EVENTTARGET=SubAccsWinLoseFull_cm1%24btnSubmit&__EVENTVALIDATION=' . urlencode($this->ev[0]->nodeValue) . '&__VIEWSTATE=' . urlencode($this->vs[0]->nodeValue) . '&__VIEWSTATEGENERATOR=' . urlencode($this->vsg[0]->nodeValue) . '&datBegin=' . urlencode($start) . '&datEnd=' . urlencode($end);
				$this->headers[] = "content-type: application/x-www-form-urlencoded";
				$this->request($this->urlturnover, "{$this->user_agent_name}&catId=&gId=-1", $postdata);
				$rows = $this->DOMXPath($this->response, "//tr[@align='center'][contains(@class,'Grid')]");
				$user_data = [];
				for ($i = 2; $i <= count($rows) - 2; $i++) {
					$data = preg_replace("/\s+/", "/", trim($rows[$i]->nodeValue));
					$s =  explode("/", $data);
					$user = str_replace("*", "", $s[0]);
					$user_data[$user] = [
						"username" => $user,
						"turnover" => floatval(preg_replace('/\.(?=.*\.)/', '', str_replace(",", ".", $s[3]))),
						"w/l" => floatval(preg_replace('/\.(?=.*\.)/', '', str_replace(",", ".", $s[8])))
					];
				}
				return 	$user_data;
			}
		}
	}

	public function TurnOverUser($username = null, $start = null, $end = null)
	{
		if (!empty($username) && !empty($start) && !empty($end)) {
			if ($this->is_login) {
				$this->headers = $this->getHeaders();
				$this->request($this->urlturnover, "{$this->user_agent_name}&catId=&gId=-1");

				if (date('d', strtotime($start)) == date('d')) {
					$start = date('m/d/Y', strtotime('-1 day', strtotime($start)));
				}
				$this->viewState();
				$postdata = 'SubAccsWinLoseFull_cm1%24chkAll=on&SubAccsWinLoseFull_cm1%24chkCatList%240=on&SubAccsWinLoseFull_cm1%24chkCatList%241=on&SubAccsWinLoseFull_cm1%24chkCatList%2410=on&SubAccsWinLoseFull_cm1%24chkCatList%2411=on&SubAccsWinLoseFull_cm1%24chkCatList%2412=on&SubAccsWinLoseFull_cm1%24chkCatList%2413=on&SubAccsWinLoseFull_cm1%24chkCatList%2414=on&SubAccsWinLoseFull_cm1%24chkCatList%2415=on&SubAccsWinLoseFull_cm1%24chkCatList%2416=on&SubAccsWinLoseFull_cm1%24chkCatList%2417=on&SubAccsWinLoseFull_cm1%24chkCatList%242=on&SubAccsWinLoseFull_cm1%24chkCatList%243=on&SubAccsWinLoseFull_cm1%24chkCatList%244=on&SubAccsWinLoseFull_cm1%24chkCatList%245=on&SubAccsWinLoseFull_cm1%24chkCatList%246=on&SubAccsWinLoseFull_cm1%24chkCatList%247=on&SubAccsWinLoseFull_cm1%24chkCatList%248=on&SubAccsWinLoseFull_cm1%24chkCatList%249=on&__EVENTARGUMENT=&__EVENTTARGET=SubAccsWinLoseFull_cm1%24btnSubmit&__EVENTVALIDATION=' . urlencode($this->ev[0]->nodeValue) . '&__VIEWSTATE=' . urlencode($this->vs[0]->nodeValue) . '&__VIEWSTATEGENERATOR=' . urlencode($this->vsg[0]->nodeValue) . '&datBegin=' . urlencode($start) . '&datEnd=' . urlencode($end);
				$this->headers[] = "content-type: application/x-www-form-urlencoded";
				$this->request($this->urlturnover, "{$this->user_agent_name}&catId=&gId=-1", $postdata);
				$rows = $this->DOMXPath($this->response, "//tr[@align='center'][contains(@class,'Grid')]");
				$user_data = [];
				for ($i = 2; $i <= count($rows) - 2; $i++) {
					$data = preg_replace("/\s+/", "/", trim($rows[$i]->nodeValue));
					$s =  explode("/", $data);
					$user = str_replace("*", "", $s[0]);
					$user_data[$user] = [
						"username" => $user,
						"turnover" => floatval(preg_replace('/\.(?=.*\.)/', '', str_replace(",", ".", $s[3]))),
						"w/l" => floatval(preg_replace('/\.(?=.*\.)/', '', str_replace(",", ".", $s[8])))
					];
				}
				if (array_key_exists($username, $user_data)) {
					return 	$user_data[$username];
				} else {
					return null;
				}
			}
		}
	}

	public function TurnOverUserSlot($username = null, $start = null, $end = null)
	{
		if (!empty($username) && !empty($start) && !empty($end)) {
			if ($this->is_login) {
				$this->headers = $this->getHeaders();
				$this->request($this->urlturnover, "{$this->user_agent_name}&catId=&gId=-1");

				if (date('d', strtotime($start)) == date('d')) {
					$start = date('m/d/Y', strtotime('-1 day', strtotime($start)));
				}
				$this->viewState();
				$postdata = 'SubAccsWinLoseFull_cm1%24chkAll=on&SubAccsWinLoseFull_cm1%24chkCatList%240=on&SubAccsWinLoseFull_cm1%24chkCatList%241=on&SubAccsWinLoseFull_cm1%24chkCatList%2410=on&SubAccsWinLoseFull_cm1%24chkCatList%2411=on&SubAccsWinLoseFull_cm1%24chkCatList%2412=on&SubAccsWinLoseFull_cm1%24chkCatList%2413=on&SubAccsWinLoseFull_cm1%24chkCatList%2414=on&SubAccsWinLoseFull_cm1%24chkCatList%2415=on&SubAccsWinLoseFull_cm1%24chkCatList%2416=on&SubAccsWinLoseFull_cm1%24chkCatList%2417=on&SubAccsWinLoseFull_cm1%24chkCatList%242=on&SubAccsWinLoseFull_cm1%24chkCatList%243=on&SubAccsWinLoseFull_cm1%24chkCatList%244=on&SubAccsWinLoseFull_cm1%24chkCatList%245=on&SubAccsWinLoseFull_cm1%24chkCatList%246=on&SubAccsWinLoseFull_cm1%24chkCatList%247=on&SubAccsWinLoseFull_cm1%24chkCatList%248=on&SubAccsWinLoseFull_cm1%24chkCatList%249=on&__EVENTARGUMENT=&__EVENTTARGET=SubAccsWinLoseFull_cm1%24btnSubmit&__EVENTVALIDATION=' . urlencode($this->ev[0]->nodeValue) . '&__VIEWSTATE=' . urlencode($this->vs[0]->nodeValue) . '&__VIEWSTATEGENERATOR=' . urlencode($this->vsg[0]->nodeValue) . '&datBegin=' . urlencode($start) . '&datEnd=' . urlencode($end);
				$this->headers[] = "content-type: application/x-www-form-urlencoded";
				$this->request($this->urlturnover, "{$this->user_agent_name}&catId=&gId=-1", $postdata);
				$rows = $this->DOMXPath($this->response, "//tr[@align='center'][contains(@class,'Grid')]");
				$user_data = [];
				for ($i = 2; $i <= count($rows) - 2; $i++) {
					$data = preg_replace("/\s+/", "/", trim($rows[$i]->nodeValue));
					$s =  explode("/", $data);
					$user = str_replace("*", "", $s[0]);
					$user_data[$user] = [
						"username" => $user,
						"turnover" => floatval(preg_replace('/\.(?=.*\.)/', '', str_replace(",", ".", $s[3]))),
						"w/l" => floatval(preg_replace('/\.(?=.*\.)/', '', str_replace(",", ".", $s[8])))
					];
				}
				if (array_key_exists($username, $user_data)) {
					return 	$user_data[$username];
				} else {
					return null;
				}
			}
		}
	}

	public function AddMember($phone = null)
	{

		if ($this->is_login) {
			$user = rand(100000, 999999);
			$pass = "xaxa!6969";
			$phone = (!empty($phone)) ? $phone : "AddWEBNEW";
			$this->headers = $this->getHeaders();
			$this->request($this->urlmember, '');

			$this->viewState();
			// 			print_r($this->is_login);die();
			$data = $this->getPercent();
			// // 			print_r($data);die();
			// $data = "__EVENTTARGET=btnSave&__EVENTARGUMENT=&__LASTFOCUS=&txtTotalLimit=0&Usa=btnUsaYes&Suspend=btnSuspendNo&LoginType=btnLoginTypeYes&lstCommissionType=A&lstCommission=0&txtTransLimit=1%2C500%2C000&txtBeforeRun=3%2C000%2C000&lstCommissionX12=0.3&lstCommissionPar=1&txtMaxPar=150%2C000&txtPar=500%2C000&lstCommissionOther=1&txtMaxOther=150%2C000&txtMatchLimitOther=500%2C000&txtMaxOS=150%2C000&txtMatchLimitOS=500%2C000&lstShares=0.7&lstSharesRun=0.7&lstSharesX12=0.7&lstSharesRunX12=0.7&lstSharesPar=0.7&lstCommissionRAM=0&hidRAMProfile=1&RAM=btnRAMEnable&optRAMProfile=1&lstSharesRAM=0.7&lstCommissionRAR=0&hidRARProfile=1&RAR=btnRAREnable&optRARProfile=1&lstSharesRAR=0.7&RAS=btnRASEnable&lstSharesRAS=0.7&RCV=btnRCVEnable&lstSharesRCV=0.7&RAU=btnRAUEnable&lstSharesRAU=0.7&lstCommissionRBF=0&hidRBFProfile=1&RBF=btnRBFEnable&hidRBFProfile=1&lstSharesRBF=0.7&lstCommissionRBG=0&hidRBGProfile=1&optRBGProfile=1&lstSharesRBG=0.7&RBH=btnRBHDisable&lstSharesRBH=0.7&hidRBIProfile=1&RBI=btnRBIEnable&lstSharesRBI=0.7&optRBIProfile=1&RBL=btnRBLEnable&lstSharesRBL=0.7&lstCommissionRBM=0&hidRBMProfile=2&RBM=btnRBMEnable&optRBMProfile=1&lstSharesRBM=0.7&lstCommissionRBO=0&hidRBOProfile=2&RBO=btnRBOEnable&optRBOProfile=1&lstSharesRBO=0.7&lstCommissionRCW=0&RCW=btnRCWEnable&optRBOProfile=1&lstSharesRCW=0.7&lstCommissionRCX=0&RCX=btnRCXEnable&lstSharesRCX=0.7&hidSP=0";
			// 			$data = "__EVENTTARGET=btnSave&__EVENTARGUMENT=&__LASTFOCUS=&txtTotalLimit=0&Usa=btnUsaYes&Suspend=btnSuspendNo&LoginType=btnLoginTypeYes&lstCommissionType=A&lstCommission=0.5&txtTransLimit=1%2C500%2C000&txtBeforeRun=3%2C000%2C000&lstCommissionX12=0.5&txtMaxX12=150%2C000&txtMatchLimitX12=500%2C000&lstCommissionPar=1&txtMaxPar=150%2C000&txtPar=500%2C000&lstCommissionOther=1&txtMaxOther=150%2C000&txtMatchLimitOther=500%2C000&txtMaxOS=150%2C000&txtMatchLimitOS=500%2C000&lstShares=0.8&lstSharesRun=0.8&lstSharesX12=0.8&lstSharesRunX12=0.8&lstSharesPar=0.8&lstCommissionRAR=0.7&hidRARProfile=1&RAR=btnRAREnable&optRARProfile=1&lstSharesRAR=0.75&RAS=btnRASEnable&lstSharesRAS=0.75&RCV=btnRCVEnable&lstSharesRCV=0.75&RAU=btnRAUEnable&lstSharesRAU=0.75&lstCommissionRBF=0&hidRBFProfile=1&RBF=btnRBFEnable&optRBFProfile=1&lstSharesRBF=0.75&RCZ=btnRCZEnable&lstSharesRCZ=0.75&lstCommissionRBG=0.25&hidRBGProfile=1&optRBGProfile=1&lstSharesRBG=0.75&RBH=btnRBHDisable&lstSharesRBH=0.75&hidRBIProfile=1&RBI=btnRBIEnable&optRBIProfile=1&lstSharesRBI=0.75&RBL=btnRBLEnable&lstSharesRBL=0.75&lstCommissionRBM=0&hidRBMProfile=1&RBM=btnRBMEnable&optRBMProfile=1&lstSharesRBM=0.8&lstCommissionRBO=0&hidRBOProfile=2&RBO=btnRBOEnable&optRBOProfile=2&lstSharesRBO=0.75&lstCommissionRCW=0.25&RCW=btnRCWEnable&lstSharesRCW=0.75&lstCommissionRCX=0.25&RCX=btnRCXEnable&lstSharesRCX=0.75&hidSP=0";
			$data .= "&__VIEWSTATE=" . urlencode($this->vs[0]->nodeValue);
			$data .= "&__VIEWSTATEGENERATOR=" . urlencode($this->vsg[0]->nodeValue);
			// $data .= "&__EVENTVALIDATION=" . urlencode($this->ev[0]->nodeValue);
			$data .= "&txtContact={$phone}&txtPassword={$pass}&txtUserName={$user}";
			// 			print_r($data);die();
			$this->headers[] = "content-type: application/x-www-form-urlencoded";
			$this->request($this->urlmember, "", $data, 1);
			$lblatatus = $this->DOMXPath($this->response, "//span[@id='lblStatus']/span[@class='ENG']");

// 			        echo '<pre>';
// 			print_r($this->response);die();
// 			die();
			// return ['username' => $data];die();
			// if ($lblatatus[0]->nodeValue == "อัพเดตข้อมูลเรียบร้อย") {
// 			print_r($data);die();
			if ($lblatatus[0]->nodeValue == "Profile updated successfully.") {
				$res = $this->ChageFirstPass($this->user_agent_name . $user);
				if ($res != false) {
					if ($res->msg->nodeValue == "รหัสผ่านเปลี่ยนแปลงประสบความสำเร็จ.") {
						return (object)['username' => $res->user, "newpass" => $res->newpass];
					} else {
						return (object)['code' => 'error', 'msg' => 'Error Chagepass, try manual', 'user' => $res->user, 'status' => false];
					}
				}
			} else if ($lblatatus[0]->nodeValue == "User Name already exists.") {
				return $this->AddMember();
			} else {
				return (object)['code' => 'error', 'msg' => 'Error Addmember No response', 'status' => false];
			}
		} else {
			$this->Login();
			return $this->AddMember();
		}
	}

	public function ChageFirstPass($username = null)
	{
		$this->setCookieFile(FCPATH, "betufa.ops");
		$this->headers = $this->getHeaders();
		$this->request2('https://www.betufa.com/Default8.aspx?lang=EN-GB', '');
		// 		print_r($this->response);die;
		$this->viewState();
		$data = "__EVENTTARGET=btnLogin";
		$data .= "&__EVENTARGUMENT=&__VIEWSTATE=" . urlencode($this->vs[0]->nodeValue) . "&__VIEWSTATEGENERATOR=" . urlencode($this->vsg[0]->nodeValue) . "&lstLang=Default8.aspx%3Flang%3DEN-GB&txtUserName={$username}&password=xaxa%216969";
		$this->headers[] = "content-type: application/x-www-form-urlencoded";
		$this->request2('https://www.betufa.com/Default8.aspx?lang=EN-GB', '', $data, 0, 0, 1);
		// print_r($this->response);die;
		$this->headers = $this->getHeaders();
		$this->request2('https://www.betufa.com/Public/ChgPwd2.aspx?lang=EN-GB', '');
		$this->viewState();
		$newpass = $this->genarate_Password() . rand(10, 99);
		$data = "__EVENTTARGET=&__EVENTARGUMENT=&__VIEWSTATE=" . urlencode($this->vs[0]->nodeValue) . "&__VIEWSTATEGENERATOR=" . urlencode($this->vsg[0]->nodeValue) . "&__EVENTVALIDATION=" . urlencode($this->ev[0]->nodeValue) . "&txtOldPassword=xaxa%216969&txtNewPassword={$newpass}&txtConfirmPassword={$newpass}&btnSave=%E0%B8%A2%E0%B8%B7%E0%B8%99%E0%B8%A2%E0%B8%B1%E0%B8%99";
		$this->headers[] = "content-type: application/x-www-form-urlencoded";
		$this->request2("https://www.betufa.com/Public/ChgPwd2.aspx?lang=EN-GB", "", $data);
		$lblStatus = $this->DOMXPath($this->response, "//span[@id='lblStatus']/span");
		// 		print_r($this->response);die;
		if (!empty($lblStatus[0])) {
			return (object)["user" => $username, "newpass" => $newpass, "msg" => $lblStatus[0]];
		} else {
			return (object)["user" => $username, "msg" => false];
		}
	}

	private function viewState()
	{
		$this->vs = $this->DOMXPath($this->response, "//input[@name='__VIEWSTATE']/@value");
		$this->ev = $this->DOMXPath($this->response, "//input[@name='__EVENTVALIDATION']/@value");
		$this->vsg = $this->DOMXPath($this->response, "//input[@name='__VIEWSTATEGENERATOR']/@value");
	}

	private function getHeaders()
	{
		$header = array(
			"cache-control: no-cache",
			"origin: http://ocean.isme99.com",
			"user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36"
		);
		return $header;
	}

	private function getCurlValue($filename, $contentType, $postname)
	{
		if (function_exists('curl_file_create')) {
			return curl_file_create($filename, $contentType, $postname);
		}
		$value = "@{$filename};filename=" . $postname;
		if ($contentType) {
			$value .= ';type=' . $contentType;
		}
		return $value;
	}

	private function getPercent()
	{
		$this->CI->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
		if (!$foo = $this->CI->cache->get('getPercent')) {

		$this->request("{$this->urlmember}", "");

		$data = "__EVENTTARGET=btnSave&__EVENTARGUMENT=&__LASTFOCUS=&txtTotalLimit=0";
		$res = $this->DOMXPath($this->response, "//input[@name='Usa'][@checked='checked']/@value");
		$data .= '&Usa=' . urlencode($res[0]->nodeValue);

		$res = $this->DOMXPath($this->response, "//input[@name='Suspend'][@checked='checked']/@value");
		$data .= '&Suspend=' . urlencode($res[0]->nodeValue);

		$res = $this->DOMXPath($this->response, "//input[@name='LoginType'][@checked='checked']/@value");
		$data .= '&LoginType=' . urlencode($res[0]->nodeValue);

		$res = $this->DOMXPath($this->response, "//select[@name='lstCommissionType']/option[@selected='selected']/@value");
		$data .= '&lstCommissionType=' . urlencode($res[0]->nodeValue);

		$res = $this->DOMXPath($this->response, "//select[@name='lstCommission']/option[@selected='selected']/@value");
		$data .= '&lstCommission=' . urlencode($res[0]->nodeValue);

		$res = $this->DOMXPath($this->response, "//input[@name='txtTransLimit']/@value");
		$data .= '&txtTransLimit=' . urlencode($res[0]->nodeValue);

		$res = $this->DOMXPath($this->response, "//input[@name='txtBeforeRun']/@value");
		$data .= '&txtBeforeRun=' . urlencode($res[0]->nodeValue);

		$res = $this->DOMXPath($this->response, "//select[@name='lstCommissionX12']/option[@selected='selected']/@value");
		$data .= '&lstCommissionX12=' . urlencode($res[0]->nodeValue);
		$res = $this->DOMXPath($this->response, "//input[@name='txtMaxX12']/@value");
		$data .= '&txtMaxX12=' . urlencode($res[0]->nodeValue);
		$res = $this->DOMXPath($this->response, "//input[@name='txtMatchLimitX12']/@value");
		$data .= '&txtMatchLimitX12=' . urlencode($res[0]->nodeValue);
		$res = $this->DOMXPath($this->response, "//select[@name='lstCommissionPar']/option[@selected='selected']/@value");
		$data .= '&lstCommissionPar=' . urlencode($res[0]->nodeValue);
		$res = $this->DOMXPath($this->response, "//input[@name='txtMaxPar']/@value");
		$data .= '&txtMaxPar=' . urlencode($res[0]->nodeValue);
		$res = $this->DOMXPath($this->response, "//input[@name='txtPar']/@value");
		$data .= '&txtPar=' . urlencode($res[0]->nodeValue);

		$res = $this->DOMXPath($this->response, "//select[@name='lstCommissionOther']/option[@selected='selected']/@value");
		$data .= '&lstCommissionOther=' . urlencode($res[0]->nodeValue);

		$res = $this->DOMXPath($this->response, "//input[@name='txtMaxOther']/@value");
		$data .= '&txtMaxOther=' . urlencode($res[0]->nodeValue);

		$res = $this->DOMXPath($this->response, "//input[@name='txtMatchLimitOther']/@value");
		$data .= '&txtMatchLimitOther=' . urlencode($res[0]->nodeValue);

		$res = $this->DOMXPath($this->response, "//input[@name='txtMaxOS']/@value");
		$data .= '&txtMaxOS=' . urlencode($res[0]->nodeValue);

		$res = $this->DOMXPath($this->response, "//input[@name='txtMatchLimitOS']/@value");
		$data .= '&txtMatchLimitOS=' . urlencode($res[0]->nodeValue);

		$res = $this->DOMXPath($this->response, "//select[@name='lstShares']/option[@selected='selected']/@value");
		$data .= '&lstShares=' . urlencode($res[0]->nodeValue);

		$res = $this->DOMXPath($this->response, "//select[@name='lstSharesRun']/option[@selected='selected']/@value");
		$data .= '&lstSharesRun=' . urlencode($res[0]->nodeValue);

		$res = $this->DOMXPath($this->response, "//select[@name='lstSharesX12']/option[@selected='selected']/@value");
		$data .= '&lstSharesX12=' . urlencode($res[0]->nodeValue);

		$res = $this->DOMXPath($this->response, "//select[@name='lstSharesRunX12']/option[@selected='selected']/@value");
		$data .= '&lstSharesRunX12=' . urlencode($res[0]->nodeValue);

		$res = $this->DOMXPath($this->response, "//select[@name='lstSharesPar']/option[@selected='selected']/@value");
		$data .= '&lstSharesPar=' . urlencode($res[0]->nodeValue);
		
		$res = $this->DOMXPath($this->response, "//input[@name='RDB'][@checked='checked']/@value");
		$data .= '&RDB=' . urlencode($res[0]->nodeValue);
		
		$res = $this->DOMXPath($this->response, "//input[@name='RDB'][@checked='checked']/@value");
		$data .= '&RDB=' . urlencode($res[0]->nodeValue);
		
		$res = $this->DOMXPath($this->response, "//input[@name='optRDBProfile'][@checked='checked']/@value");
		$data .= '&optRDBProfile=' . urlencode($res[0]->nodeValue);
		
		$res = $this->DOMXPath($this->response, "//select[@name='lstSharesRDB']/option[@selected='selected']/@value");
		$data .= '&lstSharesRDB=' . urlencode($res[0]->nodeValue);

		// 			$res = $this->DOMXPath($this->response, "//select[@name='lstCommissionRAM']/option[@selected='selected']/@value");
		// 			$data .= '&lstCommissionRAM=' . urlencode($res[0]->nodeValue);

		// 			$res = $this->DOMXPath($this->response, "//input[@name='hidRAMProfile']/@value");
		// 			$data .= '&hidRAMProfile=' . urlencode($res[0]->nodeValue);

		// 			$res = $this->DOMXPath($this->response, "//input[@name='RAM'][@checked='checked']/@value");
		// 			$data .= '&RAM=' . urlencode($res[0]->nodeValue);

		// 			$res = $this->DOMXPath($this->response, "//input[@name='optRAMProfile']/@value");
		// 			$data .= '&optRAMProfile=' . urlencode($res[0]->nodeValue);

		// 			$res = $this->DOMXPath($this->response, "//select[@name='lstSharesRAM']/option[@selected='selected']/@value");
		// 			$data .= '&lstSharesRAM=' . urlencode($res[0]->nodeValue);

		$res = $this->DOMXPath($this->response, "//select[@name='lstCommissionRAR']/option[@selected='selected']/@value");
		$data .= '&lstCommissionRAR=' . urlencode($res[0]->nodeValue);

		$res = $this->DOMXPath($this->response, "//input[@name='hidRARProfile']/@value");
		$data .= '&hidRARProfile=' . urlencode($res[0]->nodeValue);

		$res = $this->DOMXPath($this->response, "//input[@name='RAR'][@checked='checked']/@value");
		$data .= '&RAR=' . urlencode($res[0]->nodeValue);
		$res = $this->DOMXPath($this->response, "//input[@name='optRARProfile']/@value");
		$data .= '&optRARProfile=' . urlencode($res[0]->nodeValue);
		$res = $this->DOMXPath($this->response, "//select[@name='lstSharesRAR']/option[@selected='selected']/@value");
		$data .= '&lstSharesRAR=' . urlencode($res[0]->nodeValue);

		$res = $this->DOMXPath($this->response, "//input[@name='RAS'][@checked='checked']/@value");
		$data .= '&RAS=' . urlencode($res[0]->nodeValue);
		$res = $this->DOMXPath($this->response, "//select[@name='lstSharesRAS']/option[@selected='selected']/@value");
		$data .= '&lstSharesRAS=' . urlencode($res[0]->nodeValue);

		$res = $this->DOMXPath($this->response, "//input[@name='RCV'][@checked='checked']/@value");
		$data .= '&RCV=' . urlencode($res[0]->nodeValue);
		$res = $this->DOMXPath($this->response, "//select[@name='lstSharesRCV']/option[@selected='selected']/@value");
		$data .= '&lstSharesRCV=' . urlencode($res[0]->nodeValue);

		$res = $this->DOMXPath($this->response, "//input[@name='RAU'][@checked='checked']/@value");
		$data .= '&RAU=' . urlencode($res[0]->nodeValue);
		$res = $this->DOMXPath($this->response, "//select[@name='lstSharesRAU']/option[@selected='selected']/@value");
		$data .= '&lstSharesRAU=' . urlencode($res[0]->nodeValue);

		$res = $this->DOMXPath($this->response, "//select[@name='lstCommissionRBF']/option[@selected='selected']/@value");
		$data .= '&lstCommissionRBF=' . urlencode($res[0]->nodeValue);

		$res = $this->DOMXPath($this->response, "//input[@name='hidRBFProfile']/@value");
		$data .= '&hidRBFProfile=' . urlencode($res[0]->nodeValue);

		$res = $this->DOMXPath($this->response, "//input[@name='RBF'][@checked='checked']/@value");
		$data .= '&RBF=' . urlencode($res[0]->nodeValue);
		$res = $this->DOMXPath($this->response, "//input[@name='optRBFProfile']/@value");
		$data .= '&optRBFProfile=' . urlencode($res[0]->nodeValue);
		$res = $this->DOMXPath($this->response, "//select[@name='lstSharesRBF']/option[@selected='selected']/@value");
		$data .= '&lstSharesRBF=' . urlencode($res[0]->nodeValue);

		$res = $this->DOMXPath($this->response, "//input[@name='RCZ'][@checked='checked']/@value");
		$data .= '&RCZ=' . urlencode($res[0]->nodeValue);
		$res = $this->DOMXPath($this->response, "//select[@name='lstSharesRCZ']/option[@selected='selected']/@value");
		$data .= '&lstSharesRCZ=' . urlencode($res[0]->nodeValue);

		$res = $this->DOMXPath($this->response, "//select[@name='lstCommissionRBG']/option[@selected='selected']/@value");
		$data .= '&lstCommissionRBG=' . urlencode($res[0]->nodeValue);
		$res = $this->DOMXPath($this->response, "//input[@name='hidRBGProfile']/@value");
		$data .= '&hidRBGProfile=' . urlencode($res[0]->nodeValue);
		$res = $this->DOMXPath($this->response, "//input[@name='optRBGProfile']/@value");
		$data .= '&optRBGProfile=' . urlencode($res[0]->nodeValue);

		$res = $this->DOMXPath($this->response, "//select[@name='lstSharesRBG']/option[@selected='selected']/@value");
		$data .= '&lstSharesRBG=' . urlencode($res[0]->nodeValue);

		$res = $this->DOMXPath($this->response, "//input[@name='RBH'][@checked='checked']/@value");
		$data .= '&RBH=' . urlencode($res[0]->nodeValue);
		$res = $this->DOMXPath($this->response, "//select[@name='lstSharesRBH']/option[@selected='selected']/@value");
		$data .= '&lstSharesRBH=' . urlencode($res[0]->nodeValue);
		$res = $this->DOMXPath($this->response, "//input[@name='hidRBIProfile']/@value");
		$data .= '&hidRBIProfile=' . urlencode($res[0]->nodeValue);

		$res = $this->DOMXPath($this->response, "//input[@name='RBI'][@checked='checked']/@value");
		$data .= '&RBI=' . urlencode($res[0]->nodeValue);
		$res = $this->DOMXPath($this->response, "//select[@name='lstSharesRBI']/option[@selected='selected']/@value");
		$data .= '&lstSharesRBI=' . urlencode($res[0]->nodeValue);
		$res = $this->DOMXPath($this->response, "//input[@name='optRBIProfile']/@value");
		$data .= '&optRBIProfile=' . urlencode($res[0]->nodeValue);

		$res = $this->DOMXPath($this->response, "//input[@name='RBL'][@checked='checked']/@value");
		$data .= '&RBL=' . urlencode($res[0]->nodeValue);
		$res = $this->DOMXPath($this->response, "//select[@name='lstSharesRBL']/option[@selected='selected']/@value");
		$data .= '&lstSharesRBL=' . urlencode($res[0]->nodeValue);

		$res = $this->DOMXPath($this->response, "//select[@name='lstCommissionRBM']/option[@selected='selected']/@value");
		$data .= '&lstCommissionRBM=' . urlencode($res[0]->nodeValue);
		$res = $this->DOMXPath($this->response, "//input[@name='hidRBMProfile']/@value");
		$data .= '&hidRBMProfile=' . urlencode($res[0]->nodeValue);
		$res = $this->DOMXPath($this->response, "//input[@name='RBM'][@checked='checked']/@value");
		$data .= '&RBM=' . urlencode($res[0]->nodeValue);

		$res = $this->DOMXPath($this->response, "//input[@name='optRBMProfile']/@value");
		$data .= '&optRBMProfile=' . urlencode($res[0]->nodeValue);
		$res = $this->DOMXPath($this->response, "//select[@name='lstSharesRBM']/option[@selected='selected']/@value");
		$data .= '&lstSharesRBM=' . urlencode($res[0]->nodeValue);
		$res = $this->DOMXPath($this->response, "//select[@name='lstCommissionRBO']/option[@selected='selected']/@value");
		$data .= '&lstCommissionRBO=' . urlencode($res[0]->nodeValue);
		$res = $this->DOMXPath($this->response, "//input[@name='hidRBOProfile']/@value");
		$data .= '&hidRBOProfile=' . urlencode($res[0]->nodeValue);

		$res = $this->DOMXPath($this->response, "//input[@name='RBO'][@checked='checked']/@value");
		$data .= '&RBO=' . urlencode($res[0]->nodeValue);
		// 			$res = $this->DOMXPath($this->response, "//input[@name='optRBOProfile']/@value");
		$res = $this->DOMXPath($this->response, "//input[@name='optRBOProfile'][@checked='checked']/@value");
		$data .= '&optRBOProfile=' . urlencode($res[0]->nodeValue);
		$res = $this->DOMXPath($this->response, "//select[@name='lstSharesRBO']/option[@selected='selected']/@value");
		$data .= '&lstSharesRBO=' . urlencode($res[0]->nodeValue);

		$res = $this->DOMXPath($this->response, "//select[@name='lstCommissionRCW']/option[@selected='selected']/@value");
		$data .= '&lstCommissionRCW=' . urlencode($res[0]->nodeValue);
		$res = $this->DOMXPath($this->response, "//input[@name='RCW'][@checked='checked']/@value");
		$data .= '&RCW=' . urlencode($res[0]->nodeValue);
		// 			$res = $this->DOMXPath($this->response, "//input[@name='optRBOProfile']/@value");
		// 			$data .= '&optRBOProfile=' . urlencode($res[0]->nodeValue);
		$res = $this->DOMXPath($this->response, "//select[@name='lstSharesRCW']/option[@selected='selected']/@value");
		$data .= '&lstSharesRCW=' . urlencode($res[0]->nodeValue);

		$res = $this->DOMXPath($this->response, "//select[@name='lstCommissionRCX']/option[@selected='selected']/@value");
		$data .= '&lstCommissionRCX=' . urlencode($res[0]->nodeValue);
		$res = $this->DOMXPath($this->response, "//input[@name='RCX'][@checked='checked']/@value");
		$data .= '&RCX=' . urlencode($res[0]->nodeValue);
		$res = $this->DOMXPath($this->response, "//select[@name='lstSharesRCX']/option[@selected='selected']/@value");
		$data .= '&lstSharesRCX=' . urlencode($res[0]->nodeValue);

		$res = $this->DOMXPath($this->response, "//input[@name='hidSP']/@value");
		$data .= '&hidSP=' . urlencode($res[0]->nodeValue);

		$foo = $data;
			$this->CI->cache->save('getPercent', $foo, 86400);
		}
		return $foo;
	}

	function postaddcredit($m)
	{
		return [
			"LoginType" => "btnLoginTypeYes",
			"RAM" => "btnRAMEnable",
			"RAR" => "btnRAREnable",
			"RAS" => "btnRASEnable",
			"RAU" => "btnRAUEnable",
			"RBF" => "btnRBFEnable",
			"RBH" => "btnRBHDisable",
			"RBI" => "btnRBIDisable",
			"RBL" => "btnRBLEnable",
			"RBM" => "btnRBMEnable",
			"RBO" => "btnRBOEnable",
			"Suspend" => "btnSuspendNo",
			"Usa" => "btnUsaYes",
			"__EVENTARGUMENT" => "",
			"__EVENTTARGET" => "btnUpdateC",
			"__EVENTVALIDATION" => $this->ev[0]->nodeValue,
			"__LASTFOCUS" => "",
			"__VIEWSTATE" => $this->vs[0]->nodeValue,
			"__VIEWSTATEGENERATOR" => $this->vsg[0]->nodeValue,
			"hidRAMProfile" => "3",
			"hidRARProfile" => "2",
			"hidRBFProfile" => "3",
			"hidRBGProfile" => "1",
			"hidRBIProfile" => "1",
			"hidRBMProfile" => "4",
			"hidRBOProfile" => "2",
			"lstCommission" => "1",
			"lstCommissionOther" => "2",
			"lstCommissionPar" => "5",
			"lstCommissionRAM" => "0",
			"lstCommissionRAR" => "0",
			"lstCommissionRBF" => "0",
			"lstCommissionRBG" => "0",
			"lstCommissionRBM" => "0",
			"lstCommissionRBO" => "0",
			"lstCommissionType" => "A",
			"lstCommissionX12" => "1",
			"lstShares" => "0",
			"lstSharesPar" => "0",
			"lstSharesRAM" => "0",
			"lstSharesRAR" => "0",
			"lstSharesRAS" => "0",
			"lstSharesRAU" => "0",
			"lstSharesRBF" => "0",
			"lstSharesRBG" => "0",
			"lstSharesRBH" => "0",
			"lstSharesRBI" => "0",
			"lstSharesRBL" => "0",
			"lstSharesRBM" => "0",
			"lstSharesRBO" => "0",
			"lstSharesRun" => "0",
			"lstSharesRunX12" => "0",
			"lstSharesX12" => "0",
			"optRAMProfile" => "3",
			"optRARProfile" => "2",
			"optRBFProfile" => "3",
			"optRBGProfile" => "1",
			"optRBIProfile" => "1",
			"optRBMProfile" => "4",
			"optRBOProfile" => "2",
			"txtBeforeRun" => "3%2C000%2C000",
			"txtContact" => "12345678",
			"txtMatchLimitOS" => "500%2C000",
			"txtMatchLimitOther" => "500%2C000",
			"txtMatchLimitX12" => "500%2C000",
			"txtMaxOS" => "150%2C000",
			"txtMaxOther" => "150%2C000",
			"txtMaxPar" => "150%2C000",
			"txtMaxX12" => "150%2C000",
			"txtPar" => "500%2C000",
			"txtPassword" => "",
			"txtTotalLimit" => $m,
			"txtTransLimit" => "1%2C500%2C000"
		];
	}

	function genarate_Password()
	{
		$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
		$pass = array();
		$alphaLength = strlen($alphabet) - 1;
		for ($i = 0; $i < 8; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass);
	}
}
