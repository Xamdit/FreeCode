<?php
/**
 **** AppzStory Back Office Management System Template ****
 * Index Get ALL Manager
 * 
 * @link https://appzstory.dev
 * @author Yothin Sapsamran (Jame AppzStory Studio)
 */
header('Content-Type: application/json');
require_once '../connect.php';

/**
 |--------------------------------------------------------------------------
 | ดึงข้อมูล admin ทั้งหมด
 | 'SELECT * FROM admin'
 |--------------------------------------------------------------------------
*/
/** 
 * กำหนดข้อมูลสำหรับการ Response ไปยังฝั่ง Client
 * 
 * @return array 
 */
$response = [
    'status' => true,
    'response' => array([
            'id' => '1',
            'username' => 'admin',
            'fisrt_name' => 'Yothin',
            'last_name' => 'Sapsamran',
            'email' => 'yothin@gmail.com',
            'status' => 'superadmin',
            'updated_at' => '2020-10-01 20:50:40',
            'created_at' => '2020-10-01 20:50:40'
        ],[
            'id' => '2',
            'username' => 'admin2',
            'fisrt_name' => 'AppzStory',
            'last_name' => 'Sapsamran',
            'email' => 'appzstory@gmail.com',
            'status' => 'admin',
            'updated_at' => '2020-10-01 20:50:40',
            'created_at' => '2020-10-01 20:50:40'
        ]
    ),
    'message' => 'Get Data Manager Success'
];
http_response_code(200);
echo json_encode($response);
