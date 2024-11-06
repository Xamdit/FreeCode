<?php
/**
 **** AppzStory Back Office Management System Template ****
 *  Year Sales Report
 * 
 * @link https://appzstory.dev
 * @author Yothin Sapsamran (Jame AppzStory Studio)
 */
header('Content-Type: application/json');
require_once '../connect.php';
/**
 |--------------------------------------------------------------------------
 | ดึงข้อมูลจากฐานข้อมูล orders ออกมาแสดง Year Sales Report
 |--------------------------------------------------------------------------
 */
/**
 * กำหนดข้อมูลสำหรับการ Response ไปยังฝั่ง Client
 * 
 * @return array
 */
$response = [
    'status' => true,
    'response' => [
        'label' => 'ยอดขายปี 2021',
        'labels' => ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.','ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'], 
        'results' => [45000, 70000, 65000, 80000, 120000, 80000, 60000, 75000, 64000, 46000, 75000, 65000]
    ],
    'message' => 'OK'
];
http_response_code(200);
echo json_encode($response);
