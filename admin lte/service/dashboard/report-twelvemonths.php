<?php
/**
 **** AppzStory Back Office Management System Template ****
 *  12 Month Sales Report
 * 
 * @link https://appzstory.dev
 * @author Yothin Sapsamran (Jame AppzStory Studio)
 */
header('Content-Type: application/json');
require_once '../connect.php';
/**
 |--------------------------------------------------------------------------
 | ดึงข้อมูลจากฐานข้อมูล orders ออกมาแสดง 12 Month Sales Report
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
        'label' => 'ยอดขาย 12 เดือนย้อนหลัง',
        'labels' => ['ต.ค. 20', 'พ.ย. 20', 'ธ.ค. 20', 'ม.ค. 21', 'ก.พ. 21', 'มี.ค. 21', 'เม.ย. 21', 'พ.ค. 21', 'มิ.ย. 21', 'ก.ค. 21','ส.ค. 21', 'ก.ย. 21'], 
        'results' => [65000, 80000, 64000, 80000, 54000, 46000, 80000, 75000, 64000, 46000, 75000, 120000]
    ],
    'message' => 'OK'
];
http_response_code(200);
echo json_encode($response);
