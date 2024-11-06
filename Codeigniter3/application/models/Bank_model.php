<?php

class Bank_model extends CI_Model

{

    public function __construct()

    {

        parent::__construct();

        $this->load->database();
    }



    public function check_tran($v)

    {
        $sql = "SELECT * FROM `topup_history` where date = '" . $v['date'] . "' and time = '" . $v['time'] . "' and description = '" . $v['description'] . "'";

        $query = $this->db->query($sql);

        $result = $query->num_rows();

        return $result;
    }

    public function update_tran($data)
    {

        $data = $this->db->insert('topup_history', $data);
    }

    public function update_transection($data)
    {

        $data = $this->db->insert('transaction', $data);
    }

    public function update_bank($accnum, $name)
    {

        $this->db->set('accnum', $accnum);

        $this->db->set('bank', $name);

        $this->db->where('id', 1);

        $this->db->update('account_bank');
    }

    public function transection($u)

    {

        // $query = $this->db->get_where('transaction', array('member_username' => $u));

        $query = $this->db->from('transaction')->where(array('member_username' => $u))->order_by('id', 'DESC')->limit(5)->get();



        $result = $query->result_array();

        return $result;
    }
}