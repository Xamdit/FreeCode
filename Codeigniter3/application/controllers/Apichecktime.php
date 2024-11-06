<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Apichecktime extends CI_Controller

{

	public function __construct()

	{

		parent::__construct();

		$this->load->library('Checkupdate');
	}

	private function DOMXPath2($html, $qry)

	{

		$doc = new DOMDocument();

		@$doc->loadHTML($html);

		$xpath = new DOMXPath($doc);

		$nodeList = $xpath->query($qry);



		return $nodeList;
	}

	public function index()
	{
		$url = file_get_contents('https://ag1.ufabet.com');

		$res = @explode("<script language='javascript'>window.open('", $url);

		$res = @explode("','_top');</script>", $res[1]);


		if ($res[0] != '') {
			$url = file_get_contents('https://ag1.ufabet.com/Public/' . $res[0]);

			$textopen = $this->DOMXPath2($url, '//span[@style="color: #F00"]');

			//  echo $textopen[0]->nodeValue;
			echo json_encode(['status' => false, 'msg' => 'ปิดปรับปรุง', 'time' => $textopen[0]->nodeValue]);
		} else {
			echo json_encode(['status' => true, 'msg' => 'เปิดให้บริการ', 'times' => '24 ชม.']);
		}
	}
}
