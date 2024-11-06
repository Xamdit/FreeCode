<?php

class User_model extends CI_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->load->database();
    }

    public function __call($name, $arg)
    {

        if ($name == 'auth') {
            switch (count($arg)) {

                case 0:

                    return 0;

                case 1:

                    return $this->chekusername($arg[0]);

                case 2:

                    return $this->login($arg[0], $arg[1]);

                case 3:

                    return $this->add_mem($arg[0], $arg[1], $arg[2]);
            }
        }
    }

    public function login($user, $pass)
    {

        $sql = "SELECT * FROM `member` WHERE username = ? and password = ?";

        $query = $this->db->query($sql, array($user, $pass));

        $result = $query->result_array();

        return $result;
    }

    public function chekusername($u)
    {

        $query = $this->db->get_where('member', array('username' => $u));

        $result = $query->num_rows();

        return $result;
    }

    public function chekaccnum($u)
    {

        $query = $this->db->get_where('member', array('username' => $u));

        $result = $query->unbuffered_row('array');

        return $result;
    }

    public function chekphonenum($u)
    {

        $query = $this->db->get_where('member', array('phone' => $u));

        $result = $query->num_rows();

        return $result;
    }

    public function chekname($u)
    {

        $query = $this->db->get_where('member', array('name' => $u));

        $result = $query->num_rows();

        return $result;
    }

    public function chekline($u)
    {

        $query = $this->db->get_where('member', array('line' => $u));

        $result = $query->num_rows();

        return $result;
    }
    public function CheckPromotion($data)
    {

        $query = $this->db->get_where('promotion_history', array('username' => $data[0], 'amount' => $data[1], 'txtencode' => $data[2]));

        $result = $query->num_rows();

        return $result;
    }
    public function Promotions($username)
    {
        $sql    = "SELECT *,promotion.name AS pro_name FROM `promotion` INNER JOIN `member` ON promotion.id = member.promotion_id WHERE member.username = '" . $username . "'";
        $query  = $this->db->query($sql);
        $result = $query->unbuffered_row('array');

        return $result;
    }
    public function ResultPromotion($username)
    {

        $query = $this->db->get_where('promotion_history', array('username' => $username));

        $result = $query->result_array();

        return $result;
    }
    public function updateIP($data)
    {
        date_default_timezone_set('asia/bangkok');
        $this->db->set('IP', $data['IP']);
        $this->db->set('LastUpdate', date("Y-m-d H:i:s"));
        $this->db->where('username', $data['username']);
        $this->db->update('member');
    }
    
    public function getall_user()
    {

        $sql = "SELECT * FROM `member` WHERE  stats = 0";

        $query = $this->db->query($sql);

        $result = $query->result_array();

        return $result;
    }

    public function get_user_acc($acc)
    {

        $sql = "SELECT * FROM `member` WHERE `accnum` = " . $acc;

        $query = $this->db->query($sql);

        $result = $query->row();

        return $result;
    }

    public function user_ufa($u)
    {

        $query = $this->db->get_where('ufa_acc', array('member_username' => $u));

        $result = $query->unbuffered_row('array');

        return $result;
    }

    public function promotion($username)
    {
        $query = $this->db->get_where('topup_history', array('username' => $username));

        $result = $query->result_array();

        return $result;
    }
    public function select_last_trans($u)
    {

        $sql = "SELECT * FROM `topup_history` WHERE username = ? and alert = 0 ORDER BY id DESC LIMIT 1";

        $query = $this->db->query($sql, [$u]);

        $result = $query->unbuffered_row('array');

        return $result;
    }

    public function add_mem($data)
    {

        $data = $this->db->insert('member', $data);
    }
    public function add_promotion($data)
    {

        $data = $this->db->insert('promotion_history', $data);
    }

    public function get_user_id($uid)
    {

        $this->db->from('member');

        $this->db->where('id', $uid);

        return $this->db->get()->row_array();
    }

    public function add_ufa($data)
    {

        $data = $this->db->insert('ufa_acc', $data);
    }

    public function add_aff($data)
    {

        $data = $this->db->insert('aff_history', $data);
    }

    public function aff($u)
    {

        $query = $this->db->from('aff_history')->where(array('username' => $u))->order_by('id', 'DESC')->limit(5)->get();

        $result = $query->result_array();

        return $result;
    }

    public function history_ref($u, $d)
    {

        $sql = "SELECT * FROM `history_turnover` WHERE `username` = ? AND `date` =  ?";

        $query = $this->db->query($sql, [$u, $d]);

        $result = $query->result_array();

        return $result;
    }

    public function ref($u)
    {

        $sql = "SELECT * FROM `member` LEFT JOIN `ufa_acc` ON ufa_acc.member_username = member.username WHERE ref = ?  ORDER  BY member.id DESC";

        $query = $this->db->query($sql, [$u]);

        $result = $query->result_array();

        return $result;
    }
    public function GetDeposit_newDate($user, $date)
    {
        //print_r($user);

        $query = $this->db->get_where('transaction', array('member_username' => $user, 'transaction.type' => 1, 'pro_id' => 0, 'date_new' => $date));

        // $query  = $this->db->query($sql);
        $result = $query->unbuffered_row('array');
        //print_r($result);

        return $result;
    }

    // upload img
    public function ipdatepro_img($d)
    {

        $this->db->set('img_name', $d['img_name']);

        $this->db->where('id', $d['id']);

        $this->db->update('promotion');
    }
    public function ipdatepro_img2($d)
    {

        $this->db->set('img_name', $d['img_name']);

        $this->db->where('id', $d['id']);

        $this->db->update('promotion');
    }
    public function ipdatepro_img3($d)
    {

        $this->db->set('img_name', $d['img_name']);

        $this->db->where('id', $d['id']);

        $this->db->update('promotion');
    }
    public function chang_pass($u, $p)
    {

        $this->db->set('password', $p);

        $this->db->where('username', $u);

        $this->db->update('member');
    }

    public function chang_pass_u($u, $p)
    {

        $this->db->set('password', $p);

        $this->db->where('username', $u);

        $this->db->update('ufa_acc');
    }

    public function stats($user)
    {

        $this->db->set('status', 1);

        $this->db->where('username', $user);

        $this->db->update('member');
    }

    public function affc($user)
    {

        $this->db->set('aff', 0);

        $this->db->where('username', $user);

        $this->db->update('member');
    }

    public function alert($id)
    {

        $this->db->set('alert', 1);

        $this->db->where('id', $id);

        $this->db->update('topup_history');
    }

    public function get_user_all()
    {

        $query = $this->db->get('member');

        $result = $query->result_array();

        return $result;
    }

    public function getdata_user($u)
    {

        $query = $this->db->get_where('member', array('username' => $u));

        $result = $query->unbuffered_row('array');

        return $result;
    }
    public function user_pro($user)
    {

        $query = $this->db->get_where('pro_log', array('member_username' => $user));

        $result = $query->unbuffered_row('array');

        return $result;
    }
    public function CheckDeposit($user)
    {
        $query = $this->db->get_where('transaction', array('member_username' => $user, 'transaction.type' => 1, 'pro_id' => 0));

        $result = $query->num_rows();

        return $result;
    }

    public function CheckDepositFrist($user)
    {
        $sql = "SELECT * FROM `transaction` WHERE member_username = ? and type = 1 and pro_id = 0 ORDER BY id ASC LIMIT 1";

        $query = $this->db->query($sql, [$user]);

        $result = $query->num_rows();

        return $result;
    }

    public function CheckDeposit_date($user, $d)
    {

        $sql = "SELECT * FROM `transaction` WHERE member_username = ? and `date_new` = ? and `type` = 1 and `pro_id` = 0 ORDER BY id ASC";

        $query = $this->db->query($sql, [$user, $d]);

        $result = $query->num_rows();

        return $result;
    }

    public function CheckDeposit_dateArray($user, $d)
    {

        $sql = "SELECT * FROM `transaction` WHERE member_username = ? and `date_new` = ? and `type` = 1 and `pro_id` = 0 ORDER BY id ASC";

        $query = $this->db->query($sql, [$user, $d]);

        $result = $query->unbuffered_row('array');


        return $result;
    }
    public function CheckWithdraw_date($user, $s, $e)
    {


        $sql = "SELECT * FROM `transaction` WHERE member_username = '$user' and `type` = 0 and `stats` = 0 and `date` BETWEEN '$s' AND '$e'";

        $query = $this->db->query($sql);

        $result = $query->num_rows();

        return $result;
    }


    public function updatepro($username, $promotion_id)
    {
        $this->db->set('promotion_id', $promotion_id);
        $this->db->where('username', $username);
        $this->db->update('member');
    }
    public function GetDeposit($user)
    {
        //print_r($user);

        $query = $this->db->get_where('transaction', array('member_username' => $user, 'transaction.type' => 1, 'pro_id' => 0));

        // $query  = $this->db->query($sql);
        $result = $query->unbuffered_row('array');
        //print_r($result);

        return $result;
    }

    public function chack_promotions($user)
    {
        //print_r($user);

        $query = $this->db->get_where('pro_log', array('member_username' => $user, 'pro_id' => 15));

        // $query  = $this->db->query($sql);
        $result = $query->unbuffered_row('array');
        //print_r($result);

        return $result;
    }
    public function chack_promotions_date($user, $t)
    {
        //print_r($user);

        // 		$query = $this->db->get_where('pro_log', array('member_username' => $user,'pro_id' => 17));

        //         // $query  = $this->db->query($sql);
        //         $result = $query->unbuffered_row('array');
        // 		//print_r($result);

        //         return $result;
        $sql = "SELECT * FROM `pro_log` WHERE member_username = ? and `date_time` like ? and pro_id = 17 ORDER BY id ASC LIMIT 1";

        $query = $this->db->query($sql, [$user, $t . '%']);

        $result = $query->num_rows();

        return $result;
    }

    public function UpdateTransaction($tran_id, $pro_id)
    {
        $this->db->set('pro_id', $pro_id);
        $this->db->where('id', $tran_id);
        $this->db->update('transaction');
        return "1";
    }
    public function getdata_id($u)
    {

        $query = $this->db->get_where('member', array('id' => $u));

        $result = $query->unbuffered_row('array');

        return $result;
    }

    public function get_bank_color($u)
    {

        $sql = "SELECT * FROM `member` INNER JOIN bank ON bank.bank_id = member.bank WHERE member.username = ?";

        $query = $this->db->query($sql, [$u]);

        $result = $query->unbuffered_row('array');

        return $result;
    }

    public function up_member($password, $id)
    {

        $sql = "UPDATE `member` SET `password` = ? WHERE `member`.`id` = ?;";

        $query = $this->db->query($sql, [$password, $id]);
    }

    public function del_member($id)
    {

        $this->db->delete('member', array('id' => $id));
    }

    public function up_member_ufa_old($member_username)
    {

        // $sql = "UPDATE `ufa_acc` SET `member_username` = '99{$member_username}' WHERE `member_username` = {$member_username};";
        $new = '99' . $member_username;
        $this->db->set('member_username', $new);

        $this->db->where('member_username', $member_username);

        $this->db->update('ufa_acc');
    }

    public function clearproid($u)
    {

        $this->db->set('promotion_id', 0);

        $this->db->where('username', $u);

        $this->db->update('member');
    }

    //แก้ไข
    public function check_date_powyingshup($username)
    {

        $sql = "SELECT * FROM `promotion_history` WHERE username = ?  ORDER BY id DESC LIMIT 1";

        $query = $this->db->query($sql, [$username]);

        $result = $query->unbuffered_row('array');

        return $result;
    }
    public function update_play_powyingshup($username, $play)
    {
        $this->db->set('powyingshup', $play);
        $this->db->where('username', $username);
        $this->db->update('member');
        return "1";
    }
    //แก้ไข
    public function update_reset_promotion($member_username)
    {

        $this->db->set('promotion_id', 0);

        $this->db->where('username', $member_username);

        $this->db->update('member');
    }

    public function user_pro_newDate($user, $start_date, $end_date)
    {

        $sql = "SELECT * FROM `pro_log` WHERE member_username = ?  AND date_time BETWEEN ? AND ?";

        $query = $this->db->query($sql, [$user, $start_date, $end_date]);

        $result = $query->unbuffered_row('array');

        return $result;
    }

    public function history_turnover($user)
    {

        $sql = "SELECT * FROM `history_turnover` WHERE username = ?  ORDER  BY date DESC";

        $query = $this->db->query($sql, [$user]);

        $result = $query->result_array();

        return $result;
    }

    public function get_code_allianace($code)
    {

        $this->db->from('alliance');

        $this->db->where('code', $code);

        return $this->db->get()->row_array();
    }

    public function insert_log_ref($data)
    {

        $data = $this->db->insert('ref_log', $data);
    }
    
    public function check_ref($u,$d)
    {

        $sql = "SELECT * FROM `ref_log` WHERE `member_username` = ? AND `date` = ?";

        $query = $this->db->query($sql, [$u,$d]);

        $result = $query->result_array();

        return $result;
    }
    public function check_ref_all($u)
    {

        $sql = "SELECT * FROM `ref_log` WHERE `member_username` = ?";

        $query = $this->db->query($sql, [$u]);

        $result = $query->result_array();

        return $result;
    }
    
    public function getall_usergen()
    {

        $sql = "SELECT * FROM `ufagen` WHERE status = 1 AND changpass = 1 AND used = 0 ORDER BY `id` ASC";

        $query = $this->db->query($sql);

        $result = $query->row();

        return $result;
    }
    
    public function usergen_update($id)
    {

        $this->db->set('used', 1);

        $this->db->where('id', $id);

        $this->db->update('ufagen');
    }

}
