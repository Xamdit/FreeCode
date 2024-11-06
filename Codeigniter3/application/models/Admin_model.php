<?php

class Admin_model extends CI_Model

{

    public function __construct()

    {

        parent::__construct();

        $this->load->database();
    }



    public function login($user, $pass)

    {

        $sql = "SELECT * FROM `admin` WHERE username = ? and password = ?";

        $query = $this->db->query($sql, array($user, $pass));

        $result = $query->result_array();

        return $result;
    }

    public function withdraw_manage_select($id)
    {

        $sql = "SELECT *,transaction.id as tid FROM `member` INNER JOIN transaction on member.username = transaction.member_username LEFT JOIN bank on bank.bank_id = member.bank WHERE transaction.id = ?";

        $query = $this->db->query($sql, [$id]);

        $result = $query->unbuffered_row('array');

        return $result;
    }

    public function result_setting()
    {

        $query = $this->db->get_where('seting', array('id' => 1));

        $result = $query->unbuffered_row('array');

        return $result;
    }
    public function get_bank_w()
    {

        $query = $this->db->get_where('acc_withdraw', array('id' => 1));

        $result = $query->unbuffered_row('array');

        return $result;
    }


    public function result_getuser()
    {

        $query = $this->db->get_where('seting', array('id' => 1));

        $result = $query->unbuffered_row('array');

        $this->db->set('numbercount', $result['numbercount'] + 1);
        $this->db->where('id', 1);
        $this->db->update('seting');

        return $result;
    }

    public function chekusername($u)

    {

        $query = $this->db->get_where('admin', array('username' => $u));

        $result = $query->num_rows();

        return $result;
    }

    public function update_setting($data)
    {

        $this->db->set('line', $data['line']);

        $this->db->set('name_web', $data['name_web']);

        $this->db->set('d_limit', $data['d_limit']);

        $this->db->set('w_limit', $data['w_limit']);

        $this->db->set('aff_d', $data['aff_d']);

        $this->db->set('aff_m', $data['aff_m']);

        $this->db->where('id', 1);

        $this->db->update('seting');
    }

    public function update_line($data)
    {
        $this->db->set('token_line', $data['token_line']);
        $this->db->set('token_line_game', $data['token_line_game']);
        $this->db->set('token_line_depo', $data['token_line_depo']);
        $this->db->set('token_line_with', $data['token_line_with']);

        $this->db->where('id', 1);

        $this->db->update('seting');
    }

    public function bank()
    {

        $query = $this->db->get_where('account_bank', array('id' => 1));

        $result = $query->unbuffered_row('array');

        return $result;
    }
    public function bank_w()
    {

        $query = $this->db->get_where('acc_withdraw', array('id' => 1));

        $result = $query->unbuffered_row('array');

        return $result;
    }
    public function update_bank($data)
    {

        $this->db->set('accnum', $data['accnum']);

        $this->db->set('name', $data['name']);

        $this->db->set('username', $data['username']);

        $this->db->set('password', $data['password']);

        $this->db->set('status_scb', $data['status_scb']);

        $this->db->where('id', 1);

        $this->db->update('account_bank');
    }
    public function update_bank_ktb($data)
    {

        $this->db->set('accnum_ktb', $data['accnum_ktb']);

        $this->db->set('name_ktb', $data['name_ktb']);

        $this->db->set('username_ktb', $data['username_ktb']);

        $this->db->set('password_ktb', $data['password_ktb']);

        $this->db->set('status_ktb', $data['status_ktb']);

        $this->db->where('id', 1);

        $this->db->update('account_bank');
    }

    public function update_acc_ufa($data)
    {

        $this->db->set('acc_ufa', $data['acc_ufa']);

        $this->db->set('ufa_pass', $data['ufa_pass']);

        $this->db->where('id', 1);

        $this->db->update('seting');
    }

    public function get_user_all()
    {

        $query = $this->db->from("member")->order_by("member.id desc")->get();

        //$this->db->order_by("id", "asc");

        $result = $query->result_array();

        return $result;
    }

    public function promotion_history()
    {

        $query = $this->db->from("pro_log")->order_by("pro_log.id desc")->get();

        //$this->db->order_by("id", "asc");

        $result = $query->result_array();

        return $result;
    }
    public function get_user_all2()
    {
        $sql = "SELECT *,member.id FROM `member` LEFT JOIN bank on bank.bank_id = member.bank ORDER BY member.id DESC";
        $query = $this->db->query($sql);

        $result = $query->result_array();

        return $result;
    }

    

    public function promotion_history2()
    {
        $sql = "SELECT *,promotion.id FROM `promotion` INNER JOIN pro_log on pro_log.pro_id = promotion.id ORDER BY promotion.id DESC";
        $query = $this->db->query($sql);

        $result = $query->result_array();

        return $result;
    }
    public function last_Deposit()
    {

        $sql = "SELECT * FROM `topup_history` ORDER BY id DESC limit 5";

        $query = $this->db->query($sql);

        $result = $query->result_array();

        return $result;
    }
    public function last_Deposits($username)
    {

        $sql = "SELECT * FROM `topup_history` where username = ? ORDER BY id DESC limit 1";

        $query = $this->db->query($sql, [$username]);

        $result = $query->unbuffered_row('array');

        return $result;
    }

    public function last_Deposits_id($username, $id)
    {

        $sql = "SELECT * FROM `transaction` where member_username = ? AND pro_id = ? ORDER BY id DESC limit 1";

        $query = $this->db->query($sql, [$username, $id]);

        $result = $query->unbuffered_row('array');

        return $result;
    }

    public function add_promotions($data)
    {
        $data = $this->db->insert('promotion', $data);
    }
    public function edit_promotions($data)
    {

        $this->db->set('percen', $data['percen']);
        $this->db->set('x', $data['x']);
        $this->db->where('id', $data['id']);
        $this->db->update('promotion');
    }
    public function get_promotions()
    {
        $query = $this->db->get('promotion');

        $result = $query->result_array();

        return $result;
    }
    public function del_promotions($id)
    {
        $this->db->delete('promotion', array('id' => $id));
    }
    public function results($start, $end, $type)
    {

        $sql = 'SELECT * ,DATE_FORMAT(date, "%Y-%m-%d")  FROM transaction WHERE date BETWEEN ? AND ? and type = ?  and stats = 0 ';

        $query = $this->db->query($sql, [$start, $end, $type]);

        $result = $query->result_array();

        return $result;
    }

    public function lasts_Deposit()
    {

        $sql = "SELECT * FROM `transaction` where type = 1 ORDER BY id DESC ";


        $query = $this->db->query($sql);

        $result = $query->result_array();

        return $result;
    }

    public function lasts_Deposit2()
    {

        $sql = "SELECT *,transaction.id as tid FROM `member` INNER JOIN `transaction` on member.username = transaction.member_username LEFT JOIN bank on bank.bank_id = member.bank WHERE   transaction.type = 1 and transaction.stats = 0 ORDER BY transaction.id DESC";

        $query = $this->db->query($sql);

        $result = $query->result_array();

        return $result;
    }

    public function last_Withdraw_Unsuccess()
    {

        $sql = "SELECT *,transaction.id as tid FROM `member` INNER JOIN `transaction` on member.username = transaction.member_username LEFT JOIN bank on bank.bank_id = member.bank WHERE   transaction.type = 0 and transaction.stats = 2 ORDER BY transaction.id DESC ";

        $query = $this->db->query($sql);

        $result = $query->result_array();

        return $result;
    }

    public function last_Withdraw_sucess()
    {

        $sql = "SELECT *,transaction.id as tid FROM `member` INNER JOIN `transaction` on member.username = transaction.member_username LEFT JOIN bank on bank.bank_id = member.bank WHERE   transaction.type = 0 and transaction.stats = 0 ORDER BY transaction.id DESC";

        $query = $this->db->query($sql);

        $result = $query->result_array();

        return $result;
    }
    public function withdraw_search($id)
    {
        $sql = "SELECT *,transaction.id as tid FROM `member` INNER JOIN `transaction` on member.username = transaction.member_username LEFT JOIN bank on bank.bank_id = member.bank WHERE transaction.stats = 1 and transaction.type = 0 and transaction.id = ?";
        $query = $this->db->query($sql, [$id]);
        $result = $query->unbuffered_row('array');
        return $result;
    }
    public function admin_stats($user)
    {

        $query = $this->db->get_where('admin', array('username =' => $user));

        $result = $query->unbuffered_row('array');

        return $result;
    }

    public function staff()
    {

        $query = $this->db->get_where('admin', array('stats =' => 0));

        $result = $query->result_array();

        return $result;
    }

    public function staff_del($id)
    {

        $this->db->delete('admin', array('id' => $id));
    }

    public function staff_insert($data)
    {

        $data = $this->db->insert('admin', $data);
    }

    public function staff_h_insert($data)
    {

        $data = $this->db->insert('staff_history', $data);
    }

    public function last_staff_h()
    {

        $sql = "SELECT * FROM `staff_history` ORDER BY id DESC";

        $query = $this->db->query($sql);

        $result = $query->result_array();

        return $result;
    }

    public function staff_update($data)
    {

        $this->db->set('password', $data['password']);
        $this->db->set('category', $data['category']);

        $this->db->where('id', $data['id']);

        $this->db->update('admin');
    }

    public function select_staff($id)
    {

        $query = $this->db->get_where('admin', array('id' => $id));

        $result = $query->unbuffered_row('array');

        return $result;
    }
    public function select_trans($id)
    {
        $query = $this->db->get_where('transaction', array('id' => $id));
        $result = $query->unbuffered_row('array');
        return $result;
    }

    public function get_ufa_all()
    {

        $query = $this->db->get('ufa_acc');

        $result = $query->result_array();

        return $result;
    }

    public function withdraw_manage()
    {

        $sql = "SELECT *,transaction.id as tid FROM `member` INNER JOIN `transaction` on member.username = transaction.member_username LEFT JOIN bank on bank.bank_id = member.bank WHERE transaction.stats = 1 and transaction.type = 0";

        $query = $this->db->query($sql);

        $result = $query->result_array();

        return $result;
    }
    public function withdraw_managelast()
    {
        $sql = "SELECT *,transaction.id as tid FROM `member` INNER JOIN `transaction` on member.username = transaction.member_username LEFT JOIN bank on bank.bank_id = member.bank WHERE transaction.stats = 1 and transaction.type = 0 limit 5";

        $query = $this->db->query($sql);

        $result = $query->result_array();

        return $result;
    }
    public function Top_Deposit()
    {

        $sql = "SELECT member_username,SUM(amount) as amount FROM `transaction` WHERE `type` = 1 GROUP BY member_username ORDER BY `amount` DESC LIMIT 5";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }
    public function Top_Withdraw()
    {

        $sql = "SELECT member_username,SUM(amount) as amount FROM `transaction` WHERE `type` = 0 and stats = 0 GROUP BY member_username ORDER BY `amount` DESC limit 5";
        $query = $this->db->query($sql);
        $result = $query->result_array();
        return $result;
    }

    public function count_withdraw()
    {

        $sql = "SELECT count(*) FROM `member` INNER JOIN `transaction` on member.username = transaction.member_username LEFT JOIN bank on bank.bank_id = member.bank WHERE transaction.stats = 1";

        $query = $this->db->query($sql);

        $result = $query->unbuffered_row('array');

        return $result;
    }
    public function result_profit($type, $date)
    {

        $sql = "SELECT SUM(amount) as amount FROM `transaction` WHERE type = " . $type . " and date LIKE '" . $date . "%' and stats = 0";

        $query = $this->db->query($sql);

        $result = $query->unbuffered_row('array');

        return $result;
    }

    public function result_profitnew($type, $date, $date2)
    {

        $sql = "SELECT SUM(amount) as amount FROM `transaction` WHERE type = " . $type . " and date BETWEEN '" . $date . "' and '" . $date2 . "' and stats = 0";
        // print_r($sql);die;
        $query = $this->db->query($sql);

        $result = $query->unbuffered_row('array');

        return $result;
    }

    public function update_stats_w($data)
    {

        $this->db->set('stats', $data['stats']);

        $this->db->where('id', $data['id']);

        $this->db->update('transaction');
    }


    public function edit_proregister($data)
    {



        $this->db->set('name', $data['name']);

        $this->db->set('percen', $data['percen']);

        $this->db->set('x', $data['x']);

        $this->db->set('text', $data['text']);
        $this->db->set('limit_d', $data['limit_d']);

        $this->db->where('id', $data['id']);

        $this->db->update('promotion');
    }

    public function edit_proregister_1($data)
    {



        $this->db->set('name', $data['name']);

        $this->db->set('percen', $data['percen']);

        $this->db->set('x', $data['x']);

        $this->db->set('text', $data['text']);

        $this->db->set('limit_d', $data['limit_d']);

        $this->db->where('id', $data['id']);

        $this->db->update('promotion');
    }

    public function edit_proregister_all($data)
    {



        $this->db->set('name', $data['name']);

        $this->db->set('percen', $data['percen']);

        $this->db->set('x', $data['x']);

        $this->db->set('text', $data['text']);

        $this->db->set('limit_d', $data['limit_d']);

        $this->db->where('id', $data['id']);

        $this->db->update('promotion');
    }
    public function save_pro($data)
    {

        $data = $this->db->insert('pro_log',  $data);
        return 1;
    }
    public function bank_all()
    {

        $query = $this->db->get('bank');

        $result = $query->result_array();

        return $result;
    }

    public function select_user($id)
    {

        $query = $this->db->get_where('member', array('id' => $id));

        $result = $query->unbuffered_row('array');

        return $result;
    }

    public function delete_user($u)
    {

        $this->db->delete('member', array('username' => $u));

        $this->db->delete('ufa_acc', array('member_username' => $u));
    }

    public function update_user($data)
    {

        $this->db->set('password', $data['password']);

        $this->db->set('accnum', $data['accnum']);

        $this->db->set('bank', $data['bank']);

        $this->db->set('name', $data['name']);

        $this->db->set('promotion_id', $data['promotion_id']);

        $this->db->where('id', $data['id']);

        $this->db->update('member');
    }
    public function update_setting_w($data)
    {

        $this->db->set('accnum', $data['accnum']);

        $this->db->set('name', $data['name']);

        $this->db->set('username', $data['username']);

        $this->db->set('password', $data['password']);

        $this->db->set('status', $data['status']);

        $this->db->where('id', $data['id']);

        $this->db->update('acc_withdraw');

        return 1;
    }
    public function update_setting_d($data)
    {

        $this->db->set('accnum', $data['accnum']);

        $this->db->set('name', $data['name']);

        $this->db->set('username', $data['username']);

        $this->db->set('password', $data['password']);

        $this->db->set('status_scb', $data['status']);

        $this->db->where('id', $data['id']);

        $this->db->update('account_bank');

        return 1;
    }
    public function update_promotion($data)
    {

        $this->db->set('promotion_id', $data->promotion_id);

        $this->db->where('id', $data->id);

        $this->db->update('member');
    }
    public function setting_w()
    {

        $query = $this->db->get_where('setting_wheel', array('id' => 1));

        $result = $query->unbuffered_row('array');

        return $result;
    }
    public function setting_w_type()

    {

        $query = $this->db->get_where('setting_wheel', array('type' => 'wheel'));

        $result = $query->result_array();

        return $result;
    }
    public function update_setting_wheel_0($data)
    {

        $this->db->set('text_color', $data['text_color']);

        $this->db->set('text_size', $data['text_size']);

        $this->db->set('text_type', $data['text_type']);

        $this->db->set('line_color', $data['line_color']);

        $this->db->set('inner_color', $data['inner_color']);

        $this->db->set('outer_color', $data['outer_color']);

        $this->db->set('offset_text', $data['offset_text']);

        $this->db->set('center_color', $data['center_color']);

        $this->db->set('center_img', $data['center_img']);

        $this->db->set('status', $data['status']);

        $this->db->where('id', $data['id_1']);

        $this->db->update('setting_wheel');

        return 1;
    }

    public function update_setting_wheel_1($data)
    {

        $this->db->set('description', $data['description_1']);

        $this->db->set('value', $data['value_1']);

        $this->db->set('color', $data['color_1']);

        $this->db->where('id', $data['id_1']);

        $this->db->update('setting_wheel');

        $this->db->set('description', $data['description_2']);

        $this->db->set('value', $data['value_2']);

        $this->db->set('color', $data['color_2']);

        $this->db->where('id', $data['id_2']);

        $this->db->update('setting_wheel');

        $this->db->set('description', $data['description_3']);

        $this->db->set('value', $data['value_3']);

        $this->db->set('color', $data['color_3']);

        $this->db->where('id', $data['id_3']);

        $this->db->update('setting_wheel');

        $this->db->set('description', $data['description_4']);

        $this->db->set('value', $data['value_4']);

        $this->db->set('color', $data['color_4']);

        $this->db->where('id', $data['id_4']);

        $this->db->update('setting_wheel');

        $this->db->set('description', $data['description_5']);

        $this->db->set('value', $data['value_5']);

        $this->db->set('color', $data['color_5']);

        $this->db->where('id', $data['id_5']);

        $this->db->update('setting_wheel');

        $this->db->set('description', $data['description_6']);

        $this->db->set('value', $data['value_6']);

        $this->db->set('color', $data['color_6']);

        $this->db->where('id', $data['id_6']);

        $this->db->update('setting_wheel');

        $this->db->set('description', $data['description_7']);

        $this->db->set('value', $data['value_7']);

        $this->db->set('color', $data['color_7']);

        $this->db->where('id', $data['id_7']);

        $this->db->update('setting_wheel');

        $this->db->set('description', $data['description_8']);

        $this->db->set('value', $data['value_8']);

        $this->db->set('color', $data['color_8']);

        $this->db->where('id', $data['id_8']);

        $this->db->update('setting_wheel');

        $this->db->set('description', $data['description_9']);

        $this->db->set('value', $data['value_9']);

        $this->db->set('color', $data['color_9']);

        $this->db->where('id', $data['id_9']);

        $this->db->update('setting_wheel');

        $this->db->set('description', $data['description_10']);

        $this->db->set('value', $data['value_10']);

        $this->db->set('color', $data['color_10']);

        $this->db->where('id', $data['id_10']);

        $this->db->update('setting_wheel');

        return 1;
    }
        //แก้ไข
    public function setting_powyingshup()
    {

        $query = $this->db->get_where('setting_powyingshup', array('id' => 1));

        $result = $query->result_array();

        return $result;
    }

    public function update_setting_powyingshup_0($data)
    {

        $this->db->set('credit_low', $data['credit_low']);

        $this->db->set('credit_high', $data['credit_high']);

        $this->db->set('credit_prize', $data['credit_prize']);

        $this->db->set('round', $data['round']);

        $this->db->set('deposit', $data['deposit']);

        $this->db->set('play', $data['play']);

        $this->db->set('day', $data['day']);

        $this->db->set('status', $data['status']);

        $this->db->where('id', $data['id_1']);

        $this->db->update('setting_powyingshup');

        return 1;
    }
    public function transaction_manual($data)
    {

        $data = $this->db->insert('transaction_manual', $data);
    }
    //แก้ไข
        public function setting_auto_withdraw()
    {

        $sql = "SELECT * FROM setting_auto_withdraw";

        $query = $this->db->query($sql);

        $result = $query->unbuffered_row('array');

        return $result;
    }

    public function update_setting_auto($data)
    {

        $this->db->set('credit_min', $data['credit_min']);

        $this->db->set('credit_max', $data['credit_max']);

        $this->db->set('credit_limit', $data['credit_limit']);

        $this->db->set('status', $data['status']);


        $this->db->where('id', 1);

        $this->db->update('setting_auto_withdraw');
    }
        public function update_play_powyingshup($data)
    {

        $this->db->set('powyingshup', $data['play']);

        $this->db->where('username', $data['username']);

        $this->db->update('member');

        return 1;
    }
        public function result_setting_game()
    {

        $query = $this->db->get_where('setting_game', array('id' => 1));

        $result = $query->unbuffered_row('array');

        return $result;
    }
            public function result_setting_game2()
    {

        $query = $this->db->get_where('setting_game', array('id' => 2));

        $result = $query->unbuffered_row('array');

        return $result;
    }

	public function result_theme($val)
    {

        $query = $this->db->get_where('theme', array('name' => $val));

        $result = $query->row();

        return $result;
    }
}

