<?php

class Report_model extends CI_Model
{

    public function __construct()
    {

        parent::__construct();

        $this->load->database();
    }

    public function deposit($start_date, $end_date, $start, $per_page, $columnName, $columnSortOrder, $searchValue)
    {
        $searchQuery = ' ';
        if ($searchValue != '') {
            $searchQuery = " and (username like '%" . $searchValue . "%' or
                accnum like '%" . $searchValue . "%' or
                bank_name like '%" . $searchValue . "%' or
                amount like'%" . $searchValue . "%' ) ";
        }

        $sql_total = "SELECT *,transaction.id as tid FROM `member`
        INNER JOIN `transaction` on member.username = transaction.member_username
        INNER JOIN bank on bank.bank_id = member.bank
        WHERE transaction.type = 1 and transaction.stats = 0 AND `date` BETWEEN '{$start_date}' AND '{$end_date}'";
        $q1           = $this->db->query($sql_total);
        $totalRecords = $q1->num_rows();

        $sql_total_filter = "SELECT *,transaction.id as tid FROM `member`
        INNER JOIN `transaction` on member.username = transaction.member_username
        INNER JOIN bank on bank.bank_id = member.bank
        WHERE transaction.type = 1 and transaction.stats = 0 AND `date` BETWEEN '{$start_date}' AND '{$end_date}' {$searchQuery}";
        $q2                = $this->db->query($sql_total_filter);
        $totalRecordFilter = $q2->num_rows();

        $sql = "SELECT *,transaction.id as tid FROM `member`
        INNER JOIN `transaction` on member.username = transaction.member_username
        INNER JOIN bank on bank.bank_id = member.bank
        WHERE transaction.type = 1 and transaction.stats = 0 AND `date` BETWEEN '{$start_date}' AND '{$end_date}' {$searchQuery} ORDER BY {$columnName} {$columnSortOrder} LIMIT {$start}, {$per_page}";
        $q3   = $this->db->query($sql);
        $data = $q3->result_array();

        return ['data' => $data, 'totalRecords' => $totalRecords, 'totalRecordFilter' => $totalRecordFilter];
    }

    public function withdraw($start_date, $end_date, $start, $per_page, $columnName, $columnSortOrder, $searchValue)
    {

        $searchQuery = ' ';
        if ($searchValue != '') {
            $searchQuery = " and (username like '%" . $searchValue . "%' or
                name like '%" . $searchValue . "%' or
                accnum like '%" . $searchValue . "%' or
                bank_name like '%" . $searchValue . "%' or
                amount like'%" . $searchValue . "%' ) ";
        }

        $sql_total = "SELECT *,transaction.id as tid FROM `member`
        INNER JOIN `transaction` on member.username = transaction.member_username
        INNER JOIN bank on bank.bank_id = member.bank
        WHERE transaction.type = 0 and transaction.stats = 0 AND `date` BETWEEN '{$start_date}' AND '{$end_date}'";
        $q1           = $this->db->query($sql_total);
        $totalRecords = $q1->num_rows();

        $sql_total_filter = "SELECT *,transaction.id as tid FROM `member`
        INNER JOIN `transaction` on member.username = transaction.member_username
        INNER JOIN bank on bank.bank_id = member.bank
        WHERE transaction.type = 0 and transaction.stats = 0 AND `date` BETWEEN '{$start_date}' AND '{$end_date}' {$searchQuery}";
        $q2                = $this->db->query($sql_total_filter);
        $totalRecordFilter = $q2->num_rows();

        $sql = "SELECT *,transaction.id as tid FROM `member`
        INNER JOIN `transaction` on member.username = transaction.member_username
        INNER JOIN bank on bank.bank_id = member.bank
        WHERE transaction.type = 0 and transaction.stats = 0 AND `date` BETWEEN '{$start_date}' AND '{$end_date}' {$searchQuery} ORDER BY {$columnName} {$columnSortOrder} LIMIT {$start}, {$per_page}";
        $q3   = $this->db->query($sql);
        $data = $q3->result_array();

        return ['data' => $data, 'totalRecords' => $totalRecords, 'totalRecordFilter' => $totalRecordFilter];
    }

    public function finance($month = null, $year = null)
    {

        if (!empty($month) && !empty($year)) {
            if ($month < 10) {
                $month = '0' . $month;
            }
            $getLastDay = date('t', strtotime($year . '-' . $month . '-01'));
        } else {
            if ($month < 10) {
                $month = '0' . $month;
            }
            $year       = date('Y');
            $getLastDay = date('t', strtotime($year . '-' . $month . '-01'));
        }

        $total_deposit  = 0;
        $total_withdraw = 0;
        $total          = [];
        for ($day = 0; $day < $getLastDay; $day++) {

            if ($day < 9) {
                $start_date = $year . '-' . $month . '-' . '0' . ($day + 1) . ' ' . '00:00:00';
                $end_date   = $year . '-' . $month . '-' . '0' . ($day + 1) . ' ' . '23:59:59';
            } else {
                $start_date = $year . '-' . $month . '-' . ($day + 1) . ' ' . '00:00:00';
                $end_date   = $year . '-' . $month . '-' . ($day + 1) . ' ' . '23:59:59';
            }

            $deposit  = $this->deposit_summary($start_date, $end_date);
            $withdraw = $this->withdraw_summary($start_date, $end_date);

            if ($deposit) {
                $total_deposit += $deposit;
            }

            if ($withdraw) {
                $total_withdraw += $withdraw;
            }

            $total[] = [
                'deposit'  => $deposit ? $deposit : 0,
                'withdraw' => $withdraw ? $withdraw : 0,
            ];

        }

        return ['total_deposit' => $total_deposit, 'total_withdraw' => $total_withdraw, 'total' => $total];
    }

    public function deposit_summary($start_date, $end_date)
    {
        $sql = "SELECT SUM(amount) AS total FROM `member`
        INNER JOIN `transaction` on member.username = transaction.member_username
        INNER JOIN bank on bank.bank_id = member.bank
        WHERE transaction.type = 1 and transaction.stats = 0 AND `date` BETWEEN '{$start_date}' AND '{$end_date}'";
        $query = $this->db->query($sql);
        $data  = $query->result_array();

        return $data[0]['total'];
    }

    public function withdraw_summary($start_date, $end_date)
    {
        $sql = "SELECT SUM(amount) AS total FROM `member`
        INNER JOIN `transaction` on member.username = transaction.member_username
        INNER JOIN bank on bank.bank_id = member.bank
        WHERE transaction.type = 0 and transaction.stats = 0 AND `date` BETWEEN '{$start_date}' AND '{$end_date}'";
        $query = $this->db->query($sql);
        $data  = $query->result_array();

        return $data[0]['total'];
    }
    
            public function wheelspins($start_date, $end_date, $start, $per_page, $columnName, $columnSortOrder, $searchValue)
    {
        $searchQuery = ' ';
        if ($searchValue != '') {
            $searchQuery = " and (user like '%" . $searchValue . "%' or
                credit like '%" . $searchValue . "%' or
                create_date like '%" . $searchValue . "%' ) ";
        }

        $sql_total = "SELECT * ,wheel.id as wid FROM `wheel` WHERE  `create_date` BETWEEN '{$start_date}' AND '{$end_date}'";
        $q1           = $this->db->query($sql_total);
        $totalRecords = $q1->num_rows();

        $sql_total_filter = "SELECT * ,wheel.id as wid FROM `wheel` WHERE  `create_date` BETWEEN '{$start_date}' AND '{$end_date}' {$searchQuery}";
        $q2                = $this->db->query($sql_total_filter);
        $totalRecordFilter = $q2->num_rows();

        $sql = "SELECT *,wheel.id as wid  FROM `wheel` WHERE  `create_date` BETWEEN '{$start_date}' AND '{$end_date}' {$searchQuery} ORDER BY {$columnName} {$columnSortOrder} LIMIT {$start}, {$per_page}";
        $q3   = $this->db->query($sql);
        $data = $q3->result_array();

        return ['data' => $data, 'totalRecords' => $totalRecords, 'totalRecordFilter' => $totalRecordFilter];
    }
        //แก้ไข
    public function powyingshup($start_date, $end_date, $start, $per_page, $columnName, $columnSortOrder, $searchValue)
    {
        $searchQuery = ' ';
        if ($searchValue != '') {
            $searchQuery = " and (user like '%" . $searchValue . "%' or
                credit like '%" . $searchValue . "%' or
                date like '%" . $searchValue . "%' ) ";
        }

        $sql_total = "SELECT * ,powyingshup_log.id as wid FROM `powyingshup_log` WHERE  `date` BETWEEN '{$start_date}' AND '{$end_date}'";
        $q1           = $this->db->query($sql_total);
        $totalRecords = $q1->num_rows();

        $sql_total_filter = "SELECT * ,powyingshup_log.id as wid FROM `powyingshup_log` WHERE  `date` BETWEEN '{$start_date}' AND '{$end_date}' {$searchQuery}";
        $q2                = $this->db->query($sql_total_filter);
        $totalRecordFilter = $q2->num_rows();

        $sql = "SELECT *,powyingshup_log.id as wid  FROM `powyingshup_log` WHERE  `date` BETWEEN '{$start_date}' AND '{$end_date}' {$searchQuery} ORDER BY {$columnName} {$columnSortOrder} LIMIT {$start}, {$per_page}";
        $q3   = $this->db->query($sql);
        $data = $q3->result_array();

        return ['data' => $data, 'totalRecords' => $totalRecords, 'totalRecordFilter' => $totalRecordFilter];
    }
    //แก้ไข

    public function withdrawauto($start_date, $end_date, $start, $per_page, $columnName, $columnSortOrder, $searchValue)
    {

        $searchQuery = ' ';
        if ($searchValue != '') {
            $searchQuery = " and (member_username like '%" . $searchValue . "%' or
                bank_name like '%" . $searchValue . "%' or
                bank_acc like '%" . $searchValue . "%' or
                name like '%" . $searchValue . "%' or
                amount like'%" . $searchValue . "%' ) ";
        }

        $sql_total = "SELECT * FROM `auto_withdraw`
        WHERE `date` BETWEEN '{$start_date}' AND '{$end_date}'";
        $q1           = $this->db->query($sql_total);
        $totalRecords = $q1->num_rows();

        $sql_total_filter = "SELECT * FROM `auto_withdraw`
        WHERE `date` BETWEEN '{$start_date}' AND '{$end_date}' {$searchQuery}";
        $q2                = $this->db->query($sql_total_filter);
        $totalRecordFilter = $q2->num_rows();

        $sql = "SELECT * FROM `auto_withdraw`
        WHERE `date` BETWEEN '{$start_date}' AND '{$end_date}' {$searchQuery} ORDER BY {$columnName} {$columnSortOrder} LIMIT {$start}, {$per_page}";
        $q3   = $this->db->query($sql);
        $data = $q3->result_array();

        return ['data' => $data, 'totalRecords' => $totalRecords, 'totalRecordFilter' => $totalRecordFilter,'test' =>$sql];
    }

    public function transactionauto($start_date, $end_date, $start, $per_page, $columnName, $columnSortOrder, $searchValue)
    {

        $searchQuery = ' ';
        if ($searchValue != '') {
            $searchQuery = " and (member_username like '%" . $searchValue . "%' or
                credit like '%" . $searchValue . "%' or
                cr_by like '%" . $searchValue . "%' or
                module like '%" . $searchValue . "%' or";
        }

        $sql_total = "SELECT * FROM transaction_manual
        WHERE `date` BETWEEN '{$start_date}' AND '{$end_date}'";
        $q1           = $this->db->query($sql_total);
        $totalRecords = $q1->num_rows();

        $sql_total_filter = "SELECT * FROM transaction_manual
        WHERE `date` BETWEEN '{$start_date}' AND '{$end_date}' {$searchQuery}";
        $q2                = $this->db->query($sql_total_filter);
        $totalRecordFilter = $q2->num_rows();

        $sql = "SELECT * FROM transaction_manual
        WHERE `date` BETWEEN '{$start_date}' AND '{$end_date}' {$searchQuery} ORDER BY {$columnName} {$columnSortOrder}";
        $q3   = $this->db->query($sql);
        $data = $q3->result_array();

        return ['data' => $data, 'totalRecords' => $totalRecords, 'totalRecordFilter' => $totalRecordFilter];
    }

}
