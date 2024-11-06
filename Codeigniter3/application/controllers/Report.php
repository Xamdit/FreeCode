<?php
defined('BASEPATH') or exit('No direct script access allowed');
header('Content-Type: application/json');

class Report extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('report_model');
    }

    public function Deposit()
    {
        $start_date = $this->input->get('start_date', true);
        $end_date   = $this->input->get('end_date', true);

        $draw            = $_POST['draw'];
        $page            = $_POST['start'];
        $per_page        = $_POST['length']; // Rows display per page
        $columnIndex     = $_POST['order'][0]['column']; // Column index
        $columnName      = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        $searchValue     = $_POST['search']['value'];

        $start_date = $start_date ? $start_date : date('Y-m-d') . ' 00:00:00';
        $end_date   = $end_date ? $end_date : date('Y-m-d H:i:s');

        $deposit = $this->report_model->Deposit($start_date, $end_date, $page, $per_page, $columnName, $columnSortOrder, $searchValue);

        $response = [
            'draw'                 => intval($draw),
            'iTotalRecords'        => $deposit['totalRecords'],
            'iTotalDisplayRecords' => $deposit['totalRecordFilter'],
            'aaData'               => $deposit['data'],
        ];
        echo json_encode($response);
    }

    public function Withdraw()
    {
        $start_date = $this->input->get('start_date', true);
        $end_date   = $this->input->get('end_date', true);

        $draw            = $_POST['draw'];
        $page            = $_POST['start'];
        $per_page        = $_POST['length']; // Rows display per page
        $columnIndex     = $_POST['order'][0]['column']; // Column index
        $columnName      = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        $searchValue     = $_POST['search']['value'];

        $start_date = $start_date ? $start_date : date('Y-m-d') . ' 00:00:00';
        $end_date   = $end_date ? $end_date : date('Y-m-d H:i:s');

        $deposit = $this->report_model->Withdraw($start_date, $end_date, $page, $per_page, $columnName, $columnSortOrder, $searchValue);

        $response = [
            'draw'                 => intval($draw),
            'iTotalRecords'        => $deposit['totalRecords'],
            'iTotalDisplayRecords' => $deposit['totalRecordFilter'],
            'aaData'               => $deposit['data'],
        ];
        echo json_encode($response);
    }
        public function Wheelspins()
    {
        $start_date = $this->input->get('start_date', true);
        $end_date   = $this->input->get('end_date', true);

        $draw            = $_POST['draw'];
        $page            = $_POST['start'];
        $per_page        = $_POST['length']; // Rows display per page
        $columnIndex     = $_POST['order'][0]['column']; // Column index
        $columnName      = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        $searchValue     = $_POST['search']['value'];

        $start_date = $start_date ? $start_date : date('Y-m-d') . ' 00:00:00';
        $end_date   = $end_date ? $end_date : date('Y-m-d H:i:s');

        $wheelspin = $this->report_model->wheelspins($start_date, $end_date, $page, $per_page, $columnName, $columnSortOrder, $searchValue);
        $response = [
            'draw'                 => intval($draw),
            'iTotalRecords'        => $wheelspin['totalRecords'],
            'iTotalDisplayRecords' => $wheelspin['totalRecordFilter'],
            'aaData'               => $wheelspin['data'],
        ];
        echo json_encode($response);
    }
        //แก้ไข
    public function Powyingshup()
    {
        $start_date = $this->input->get('start_date', true);
        $end_date   = $this->input->get('end_date', true);

        $draw            = $_POST['draw'];
        $page            = $_POST['start'];
        $per_page        = $_POST['length']; // Rows display per page
        $columnIndex     = $_POST['order'][0]['column']; // Column index
        $columnName      = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        $searchValue     = $_POST['search']['value'];

        $start_date = $start_date ? $start_date : date('Y-m-d') . ' 00:00:00';
        $end_date   = $end_date ? $end_date : date('Y-m-d H:i:s');

        $wheelspin = $this->report_model->powyingshup($start_date, $end_date, $page, $per_page, $columnName, $columnSortOrder, $searchValue);
        $response = [
            'draw'                 => intval($draw),
            'iTotalRecords'        => $wheelspin['totalRecords'],
            'iTotalDisplayRecords' => $wheelspin['totalRecordFilter'],
            'aaData'               => $wheelspin['data'],
        ];
        echo json_encode($response);
    }
       //แก้ไข
       public function Withdrawauto()
       {
           $start_date = $this->input->get('start_date', true);
           $end_date   = $this->input->get('end_date', true);
   
           $draw            = $_POST['draw'];
           $page            = $_POST['start'];
           $per_page        = $_POST['length']; // Rows display per page
           $columnIndex     = $_POST['order'][0]['column']; // Column index
           $columnName      = $_POST['columns'][$columnIndex]['data']; // Column name
           $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
           $searchValue     = $_POST['search']['value'];
   
           $start_date = $start_date ? $start_date : date('Y-m-d') . ' 00:00:00';
           $end_date   = $end_date ? $end_date : date('Y-m-d H:i:s');
   
           $deposit = $this->report_model->Withdrawauto($start_date, $end_date, $page, $per_page, $columnName, $columnSortOrder, $searchValue);

           $response = [
               'draw'                 => intval($draw),
               'iTotalRecords'        => $deposit['totalRecords'],
               'iTotalDisplayRecords' => $deposit['totalRecordFilter'],
               'aaData'               => $deposit['data'],
               'test'                 => $deposit['test']
           ];
           echo json_encode($response);
       }

       public function Transactionauto()
       {
           
        $start_date = $this->input->get('start_date', true);
        $end_date   = $this->input->get('end_date', true);

        $draw            = $_POST['draw'];
        $page            = $_POST['start'];
        $per_page        = $_POST['length']; // Rows display per page
        $columnIndex     = $_POST['order'][0]['column']; // Column index
        $columnName      = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        $searchValue     = $_POST['search']['value'];

        $start_date = $start_date ? $start_date : date('Y-m-d') . ' 00:00:00';
        $end_date   = $end_date ? $end_date : date('Y-m-d H:i:s');

        $deposit = $this->report_model->transactionauto($start_date, $end_date, $page, $per_page, $columnName, $columnSortOrder, $searchValue);
        // echo  json_encode($deposit['data']);die;

        $response = [
            'draw'                 => intval($draw),
            'iTotalRecords'        => $deposit['totalRecords'],
            'iTotalDisplayRecords' => $deposit['totalRecordFilter'],
            'aaData'               => $deposit['data'],
        ];
        echo json_encode($response);
       }
}
