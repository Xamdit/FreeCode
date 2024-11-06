<?php
/**
 **** AppzStory Back Office Management System Template ****
 * Index Get ALL Members
 * 
 * @link https://appzstory.dev
 * @author Yothin Sapsamran (Jame AppzStory Studio)
 */
header('Content-Type: application/json');
require_once '../connect.php';

/**
 |--------------------------------------------------------------------------
 | ดึงข้อมูล Members ทั้งหมด
 | 'SELECT * FROM members'
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
        'fisrt_name' => 'Pranee',
        'last_name' => 'Kanchana',
        'phone' => '0585635354',
        'email' => 'Pranee@gmail.com',
        'status' => 'true',
        'updated_at' => '2020-10-01 20:50:40',
        'created_at' => '2020-10-01 20:50:40'
    ],[
        'id' => '2',
        'fisrt_name' => 'Sukhon',
        'last_name' => 'Wattana',
        'phone' => '0585564554',
        'email' => 'Sukhon@gmail.com',
        'status' => 'true',
        'updated_at' => '2020-10-01 20:51:40',
        'created_at' => '2020-10-01 20:51:40'
    ],[
        'id' => '3',
        'fisrt_name' => 'Siriporn',
        'last_name' => 'Anong',
        'phone' => '0885454875',
        'email' => 'Siriporn@gmail.com',
        'status' => 'true',
        'updated_at' => '2020-10-01 20:52:40',
        'created_at' => '2020-10-01 20:52:40'
    ],[
        'id' => '4',
        'fisrt_name' => 'Sukhon',
        'last_name' => 'Ratree',
        'phone' => '0885454545',
        'email' => 'Sukhon@gmail.com',
        'status' => 'true',
        'updated_at' => '2020-10-01 20:53:40',
        'created_at' => '2020-10-01 20:53:40'
    ],[
        'id' => '5',
        'fisrt_name' => 'Somsak',
        'last_name' => 'Pranee',
        'phone' => '0885455875',
        'email' => 'Somsak@gmail.com',
        'status' => 'true',
        'updated_at' => '2020-10-01 20:54:40',
        'created_at' => '2020-10-01 20:54:40'
    ]),
    'message' => 'Get Data Success'
];
http_response_code(200);
echo json_encode($response);
