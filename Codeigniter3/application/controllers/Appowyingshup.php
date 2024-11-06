<?php
defined('BASEPATH') or exit('No direct script access allowed');
header('Content-Type: application/json');
class Appowyingshup extends CI_Controller
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
            $sql = "SELECT * FROM `powyingshup_log` WHERE member_username = '" . $user . "' ORDER BY id DESC";
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
            $query = $this->db->get_where('member', array('username' => $user));
            $result = $query->result_array();

            if ($result) {
                $status = true;
            }

            $res = array('status' => $status, 'data' => (!empty($result) ? $result : null));
        } else {
            $res = array('status' => false, 'data' => 'No API');
        }
        exit(json_encode($res));
    }

    public function checkrole($user = null)
    {
        if (!empty($user)) {
            $query = $this->db->get_where('member', array('username' => $user, 'powyingshup >' => 0));
            $result = $query->num_rows();
            $setting = $this->admin_model->setting_powyingshup();

            if ($result > 0) {
                $query = $this->db->get_where('powyingshup_log', array('result' => 2));
                $result = $query->num_rows();
                if ($result == 0) {
                    $round = 1;
                } else {
                    $round = $result % $setting[0]['round'];
                }
                if ($round != 0) {
                    $credit = rand($setting[0]['credit_low'], $setting[0]['credit_high']);
                    $data = [
                        'member_username' => $user,
                        'credit' => $credit,
                        'result' => 0,
                        'status' => 0
                    ];
                    $this->db->insert('powyingshup_log', $data);
                    $res = array('status' => true, 'credit' => $credit, 'result' => '0');
                } else {
                    $data = [
                        'member_username' => $user,
                        'credit' => $setting[0]['credit_prize'],
                        'result' => 0,
                        'status' => 0
                    ];
                    $this->db->insert('powyingshup_log', $data);
                    $res = array('status' => true, 'credit' => $setting[0]['credit_prize'], 'result' => '1');
                }
            } else {
                $res = array('status' => false);
            }
        } else {
            $res = array('status' => false, 'data' => 'No API');
        }
        exit(json_encode($res));
    }

    public function updateresult()
    {

        $user  = $this->input->post('username');
        $type = $this->input->post('type');
        $query = $this->db->get_where('member', array('username' => $user));
        $result = $query->result_array();
        if ($result[0]['powyingshup'] > 0) {
            $powyingshup = intval($result[0]['powyingshup']) - 1;
            $this->db->set('powyingshup', $powyingshup);
            $this->db->where('username', $user);
            $this->db->update('member');

            $query = $this->db->get_where('powyingshup_log', array('member_username' => $user, 'status' => 0));
            $result = $query->result_array();
            $credit = intval($result[0]['credit']);
            $this->db->set('status', 1);
            $this->db->set('result', $type);
            $this->db->where('member_username', $user);
            $this->db->where('status', 0);
            $this->db->update('powyingshup_log');
            if ($type == 2) {
                $ufa = $this->user_model->user_ufa($user);
                $username =  $ufa['username'];
                $rrr['status'] = ($credit > 0) ? false : true;
                if ($credit > 0) {
                    $rrr = $this->ufa->Deposit($username, $credit);
                }
                if ($result) {
                    $status = true;
                }
                $res = array('status' => $status, 'data' => $credit);
            } else {

                $res = array('status' => false);
            }
        } else {
            $res = array('status' => false);
        }
        exit(json_encode($res));
    }
}
