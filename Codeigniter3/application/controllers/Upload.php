<?php

class Upload extends CI_Controller
{

        public function __construct()
        {
                parent::__construct();
                $this->load->helper(array('form', 'url'));
                $this->load->model('user_model');
                $this->load->model('admin_model');
        }

        public function index()
        {
                $this->load->view('upload_form', array('error' => ' '));
        }

        public function do_upload()
        {
                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'jpg|png|gif|JPEG|PNG|svg|image|svg+xml|application/xml|text/xml';
                $config['max_size']             = 3000;
                $config['max_width']            = 1924;
                $config['max_height']           = 1268;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('userfile')) {
                        $error = array('error' => $this->upload->display_errors());
                        print_r($error);
                        die;
                        //  print_r($error);die;
                        header('Content-Type: application/json');
                        echo json_encode(['status' => false, 'msg' => 'มีข้อผิดพลาด']);
                } else {
                        $data = array('upload_data' => $this->upload->data());
                        $file_name = $data['upload_data']["file_name"];

                        $edit_id = $this->input->post('id_img', true);
                        //  $test = $this->input->post('edit_id', true);

                        // print_r($edit_id);
                        $d = array(

                                'img_name' => $file_name,
                                'id' => $edit_id
                        );
                        print_r($d);
                        $this->user_model->ipdatepro_img($d);
                        redirect('/sys/promotion', 'refresh');


                        // header('Content-Type: application/json');
                        // echo json_encode(['status' => false, 'msg' => 'มีข้อผิดพลาด']);



                }
        }
        public function do_upload2()
        {
                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'jpg|png|gif|JPEG|PNG|svg|image|svg+xml|application/xml|text/xml';
                $config['max_size']             = 3000;
                $config['max_width']            = 1924;
                $config['max_height']           = 1268;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('userfile')) {
                        $error = array('error' => $this->upload->display_errors());
                        print_r($error);
                        die;
                        //  print_r($error);die;
                        header('Content-Type: application/json');
                        echo json_encode(['status' => false, 'msg' => 'มีข้อผิดพลาด']);
                } else {
                        $data = array('upload_data' => $this->upload->data());
                        $file_name = $data['upload_data']["file_name"];

                        $edit_id = $this->input->post('id_img', true);
                        //  $test = $this->input->post('edit_id', true);

                        // print_r($edit_id);
                        $d = array(

                                'img_name' => $file_name,
                                'id' => $edit_id
                        );
                        $this->user_model->ipdatepro_img($d);
                        redirect('/sys/promotion', 'refresh');


                        // header('Content-Type: application/json');
                        // echo json_encode(['status' => false, 'msg' => 'มีข้อผิดพลาด']);



                }
        }
        public function do_upload3()
        {
                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'jpg|png|gif|JPEG|PNG|svg|image|svg+xml|application/xml|text/xml';
                $config['max_size']             = 3000;
                $config['max_width']            = 1924;
                $config['max_height']           = 1268;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('userfile')) {
                        $error = array('error' => $this->upload->display_errors());
                        print_r($error);
                        die;
                        //  print_r($error);die;
                        header('Content-Type: application/json');
                        echo json_encode(['status' => false, 'msg' => 'มีข้อผิดพลาด']);
                } else {
                        $data = array('upload_data' => $this->upload->data());
                        $file_name = $data['upload_data']["file_name"];

                        $edit_id = $this->input->post('id_img', true);
                        //  $test = $this->input->post('edit_id', true);

                        // print_r($edit_id);
                        $d = array(

                                'img_name' => $file_name,
                                'id' => $edit_id
                        );
                        $this->user_model->ipdatepro_img($d);
                        redirect('/sys/promotion', 'refresh');


                        // header('Content-Type: application/json');
                        // echo json_encode(['status' => false, 'msg' => 'มีข้อผิดพลาด']);



                }
        }

        public function setting_w()
        {

                $accnum = $this->input->post('accnum_1', true);
                $name = $this->input->post('name_1', true);
                $userb = $this->input->post('userb_1', true);
                $passb = $this->input->post('passb_1', true);
                $status = $this->input->post('status_scb_1', true);
                $id = $this->input->post('id_1', true);


                $data = array(
                        'accnum' => $accnum,
                        'name' => $name,
                        'username' => $userb,
                        'password' => $passb,
                        'status' => $status,
                        'id' => $id
                );

              //  print_r($data);die;
               $is =  $this->admin_model->update_setting_w($data);

               redirect('/sys/scb_protected', 'refresh');
               
        }
        public function setting_d()
        {

                $accnum = $this->input->post('accnum_2', true);
                $name = $this->input->post('name_2', true);
                $userb = $this->input->post('userb_2', true);
                $passb = $this->input->post('passb_2', true);
                $status = $this->input->post('status_scb_2', true);
                $id = $this->input->post('id_2', true);


                $data = array(
                        'accnum' => $accnum,
                        'name' => $name,
                        'username' => $userb,
                        'password' => $passb,
                        'status' => $status,
                        'id' => $id
                );

               // print_r($data);die;
               $is =  $this->admin_model->update_setting_d($data);

               redirect('/sys/scb_protected', 'refresh');
               
        }


        public function edit_userpro() {

                $user = $this->input->post('edit_id', true);

                print_r($user);
                
        }
         public function setting_wheel_s()
        {

                $text_color = $this->input->post('text_color', true);
                $text_size = $this->input->post('text_size', true);
                $text_type = $this->input->post('text_type', true);
                $line_color = $this->input->post('line_color', true);
                $inner_color = $this->input->post('inner_color', true);
                $outer_color = $this->input->post('outer_color', true);
                $center_color = $this->input->post('center_color', true);
                $offset_text = $this->input->post('offset_text', true);
                $center_img = $this->input->post('center_img', true);
                $status = $this->input->post('status', true);
                $id_1 = $this->input->post('id_1', true);

              

                $data = array(
                        'text_color' => $text_color,
                        'text_size' => $text_size,
                        'text_type' => $text_type,
                        'line_color' => $line_color,
                        'inner_color' => $inner_color,
                        'offset_text' => $offset_text,
                        'outer_color' => $outer_color,
                        'center_color' => $center_color,
                        'center_img' => $center_img,
                        'status' => $status,
                        'id_1' => $id_1,
                );

                $is =  $this->admin_model->update_setting_wheel_0($data);


                redirect('/sys/setting_wheel?msg=system', 'refresh');
        }


        public function setting_wheel_w()
        {

                $value_1 = $this->input->post('value_1', true);
                $description_1 = $this->input->post('description_1', true);
                $color_1 = $this->input->post('color_1', true);
                $id_1 = $this->input->post('id_1', true);

                $value_2 = $this->input->post('value_2', true);
                $description_2 = $this->input->post('description_2', true);
                $color_2 = $this->input->post('color_2', true);
                $id_2 = $this->input->post('id_2', true);

                $value_3 = $this->input->post('value_3', true);
                $description_3 = $this->input->post('description_3', true);
                $color_3 = $this->input->post('color_3', true);
                $id_3 = $this->input->post('id_3', true);

                $value_4 = $this->input->post('value_4', true);
                $description_4 = $this->input->post('description_4', true);
                $color_4 = $this->input->post('color_4', true);
                $id_4 = $this->input->post('id_4', true);

                $value_5 = $this->input->post('value_5', true);
                $description_5 = $this->input->post('description_5', true);
                $color_5 = $this->input->post('color_5', true);
                $id_5 = $this->input->post('id_5', true);

                $value_6 = $this->input->post('value_6', true);
                $description_6 = $this->input->post('description_6', true);
                $color_6 = $this->input->post('color_6', true);
                $id_6 = $this->input->post('id_6', true);

                $value_7 = $this->input->post('value_7', true);
                $description_7 = $this->input->post('description_7', true);
                $color_7 = $this->input->post('color_7', true);
                $id_7 = $this->input->post('id_7', true);

                $value_8 = $this->input->post('value_8', true);
                $description_8 = $this->input->post('description_8', true);
                $color_8 = $this->input->post('color_8', true);
                $id_8 = $this->input->post('id_8', true);

                $value_9 = $this->input->post('value_9', true);
                $description_9 = $this->input->post('description_9', true);
                $color_9 = $this->input->post('color_9', true);
                $id_9 = $this->input->post('id_9', true);

                $value_10 = $this->input->post('value_10', true);
                $description_10 = $this->input->post('description_10', true);
                $color_10 = $this->input->post('color_10', true);
                $id_10 = $this->input->post('id_10', true);

                $data = array(
                        'value_1' => $value_1,
                        'description_1' => $description_1,
                        'color_1' => $color_1,
                        'id_1' => $id_1,
                        'value_2' => $value_2,
                        'description_2' => $description_2,
                        'color_2' => $color_2,
                        'id_2' => $id_2,
                        'value_3' => $value_3,
                        'description_3' => $description_3,
                        'color_3' => $color_3,
                        'id_3' => $id_3,
                        'value_4' => $value_4,
                        'description_4' => $description_4,
                        'color_4' => $color_4,
                        'id_4' => $id_4,
                        'value_5' => $value_5,
                        'description_5' => $description_5,
                        'color_5' => $color_5,
                        'id_5' => $id_5,
                        'value_6' => $value_6,
                        'description_6' => $description_6,
                        'color_6' => $color_6,
                        'id_6' => $id_6,
                        'value_7' => $value_7,
                        'description_7' => $description_7,
                        'color_7' => $color_7,
                        'id_7' => $id_7,
                        'value_8' => $value_8,
                        'description_8' => $description_8,
                        'color_8' => $color_8,
                        'id_8' => $id_8,
                        'value_9' => $value_9,
                        'description_9' => $description_9,
                        'color_9' => $color_9,
                        'id_9' => $id_9,
                        'value_10' => $value_10,
                        'description_10' => $description_10,
                        'color_10' => $color_10,
                        'id_10' => $id_10,
                );

                // print_r($data);die;
                $is =  $this->admin_model->update_setting_wheel_1($data);

                redirect('/sys/setting_wheel?msg=wheel', 'refresh');
        }
               //แก้ไข
        public function setting_powyingshup_s()
        {

                $credit_low = $this->input->post('credit_low', true);
                $credit_high = $this->input->post('credit_high', true);
                $credit_prize = $this->input->post('credit_prize', true);
                $round = $this->input->post('round', true);
                $deposit = $this->input->post('deposit', true);
                $play = $this->input->post('play', true);
                $day = $this->input->post('day', true);
                $status = $this->input->post('status', true);
                $id_1 = $this->input->post('id_1', true);

              

                $data = array(
                        'credit_low' => $credit_low,
                        'credit_high' => $credit_high,
                        'credit_prize' => $credit_prize,
                        'round' => $round,
                        'deposit' => $deposit,
                        'play' => $play,
                        'day' => $day,
                        'status' => $status,
                        'id_1' => $id_1,
                );

                $is =  $this->admin_model->update_setting_powyingshup_0($data);


                redirect('/sys/setting_powyingshup?msg=system', 'refresh');
        }
        //แก้ไข
}
