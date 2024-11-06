<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Apiupdate extends CI_Controller

{

	public function __construct()

	{

		parent::__construct();

		$this->load->library('Checkupdate');
	}

	public function index()
	{

		echo $this->checkupdate->check();
	}
}
