<?php
/**
 **** AppzStory Back Office Management System Template ****
 * Index Get ALL Member Orders
 * 
 * @link https://appzstory.dev
 * @author Yothin Sapsamran (Jame AppzStory Studio)
 */
header('Content-Type: application/json');
require_once '../connect.php';

/**
 |--------------------------------------------------------------------------
 | ดึงข้อมูล Member Orders
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
            'odd_id' => 'O00001',
            'p_id' => 'P001',
            'mem_id' => '1',
            'mem_name' => 'Yothin Sapsamran',
            'p_image' => 'http://i3.ytimg.com/vi/h4pOXOU_Mqo/maxresdefault.jpg',
            'p_name' => 'คอร์สเรียน sClass1 FullCourse สอนเขียนเว็บไซต์ด้วยตัวเอง	',
            'url' => 'https://appzstory.dev/c/sclass1-full-courses_0-100',
            'price' => 5900,
            'amount' => 1,
            'discount' => 1000,
            'ps' => 'หมายเหตุอื่นๆ....',
            'status' => 'true',
            'updated_at' => '2020-10-01 20:50:40',
            'created_at' => '2020-10-01 20:50:40'
        ],[
            'odd_id' => 'O00002',
            'p_id' => 'P002',
            'mem_id' => '1',
            'mem_name' => 'Yothin Sapsamran',
            'p_image' => 'https://www.filepicker.io/api/file/v15smsWhT7CeG9OB6mI0',
            'p_name' => 'คอร์สเรียน sClass2 Vuejs + REST API สอนเขียนเว็บไซต์ด้วยตัวเอง	',
            'url' => 'https://appzstory.dev/c/sclass2-weblog-vuejs-php/',
            'price' => 3500,
            'amount' => 1,
            'discount' => 1000,
            'ps' => 'หมายเหตุอื่นๆ....',
            'status' => 'true',
            'updated_at' => '2020-10-01 20:50:40',
            'created_at' => '2020-10-01 20:50:40'
        ],[
            'odd_id' => 'O00003',
            'p_id' => 'P003',
            'mem_id' => '1',
            'mem_name' => 'Yothin Sapsamran',
            'p_image' => 'https://www.filepicker.io/api/file/o3UX9cfzQsWcD2MPrFjx',
            'p_name' => 'MiniCourse 1PLUS สอนเขียนระบบจัดการสมาชิก',
            'url' => 'https://appzstory.dev/c/mini1plus-user-management-system',
            'price' => 1600,
            'amount' => 1,
            'discount' => 1000,
            'ps' => 'หมายเหตุอื่นๆ....',
            'status' => 'true',
            'updated_at' => '2020-10-01 20:50:40',
            'created_at' => '2020-10-01 20:50:40'
        ],[
            'odd_id' => 'O00004',
            'p_id' => 'P004',
            'mem_id' => '4',
            'mem_name' => 'Yothin Sapsamran',
            'p_image' => 'https://cdn.fs.teachablecdn.com/TDkkwfJ1T4qu77hr5BKc',
            'p_name' => 'MiniCourse 3 สอนสร้าง PHP Framework',
            'url' => 'https://course.appzstory.dev/courses/minicourse3-php-framework-rest-api/lectures/29434231',
            'price' => 2500,
            'amount' => 1,
            'discount' => 1000,
            'ps' => 'หมายเหตุอื่นๆ....',
            'status' => 'true',
            'updated_at' => '2020-10-01 20:50:40',
            'created_at' => '2020-10-01 20:50:40'
        ]
    ),
    'message' => 'Get Data Success'
];
http_response_code(200);
echo json_encode($response);
