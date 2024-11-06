<?php
defined('BASEPATH') or exit('No direct script access allowed');
header('Content-Type: application/json');
class Apimanage extends CI_Controller
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

    public function auto_login()
    {
        $auto_login = $_POST['auto_login'];
        $VIEWSTATEGENERATOR = $_POST['VIEWSTATEGENERATOR'];
        $VIEWSTATE = $_POST['VIEWSTATE'];
        $EVENTVALIDATION = $_POST['EVENTVALIDATION'];
        $type = $_POST['$type'];

if($type == 1){
            $sql = "UPDATE setting_game SET auto_login = '$auto_login', VIEWSTATEGENERATOR = '$VIEWSTATEGENERATOR', VIEWSTATE = '$VIEWSTATE', EVENTVALIDATION = '$EVENTVALIDATION' WHERE id = 1";
        $query = $this->db->query($sql);
        $res = array('status' => true);
}else{
            $sql = "UPDATE setting_game SET auto_login = '$auto_login', VIEWSTATEGENERATOR = '$VIEWSTATEGENERATOR', VIEWSTATE = '$VIEWSTATE', EVENTVALIDATION = '$EVENTVALIDATION' WHERE id = 2";
        $query = $this->db->query($sql);
        $res = array('status' => true);
}

        exit(json_encode($res));
    }
}
