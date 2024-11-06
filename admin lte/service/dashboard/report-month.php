<?php
/**
 **** AppzStory Back Office Management System Template ****
 * Monthly Sales Report
 * 
 * @link https://appzstory.dev
 * @author Yothin Sapsamran (Jame AppzStory Studio)
 */
header('Content-Type: application/json');
require_once '../connect.php';
/**
 |--------------------------------------------------------------------------
 | ดึงข้อมูลจากฐานข้อมูล orders ออกมาแสดง Monthly Sales Report
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
        'label' => 'ยอดขายเดือน มิถุนายน 2021',
        'labels' => ['01', '02', '03', '04', '05', '06', '07','08', '09', '10', '11', '12', '13', '14','15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30'], 
        'results' => [1290, 2000, 1300, 1800, 1000, 1500, 2600, 3250, 2000, 1300, 4100, 1000, 1500, 3500, 2250, 2000, 1300, 1800, 3500, 1500, 2600, 3500, 2250, 1300, 1800, 3500, 1500, 2600, 3500, 2250]
    ],
    'message' => 'OK'
];

http_response_code(200);
echo json_encode($response);
