<?php
/**
 **** AppzStory Back Office Management System Template ****
 * Index Get ALL Products
 * 
 * @link https://appzstory.dev
 * @author Yothin Sapsamran (Jame AppzStory Studio)
 */
header('Content-Type: application/json');
require_once '../connect.php';

/**
 |--------------------------------------------------------------------------
 | ดึงข้อมูล Members ทั้งหมด
 | 'SELECT * FROM products'
 |--------------------------------------------------------------------------
*/
/** 
 * กำหนดข้อมูลสำหรับการ Response ไปยังฝั่ง Client
 * 
 * @return array 
 */
$response = [
    'status' => true,
    'response' => [[
            'p_id' => 'P001',
            'p_image' => 'http://i3.ytimg.com/vi/h4pOXOU_Mqo/maxresdefault.jpg',
            'p_name' => 'sClass1 FullCourse PHP MySQLi Bootstrap4 สอนเขียนเว็บไซต์ด้วยตัวเองตั้งแต่ 0 - 100',
            'url' => 'https://appzstory.dev/c/sclass1-full-courses_0-100',
            'cat_name' => 'storyclass',
            'price' => '4,500.00',
            'p_status' => true,
            'updated_at' => '2020-10-01 20:50:40',
            'created_at' => '2020-10-01 20:50:40'
        ],[
            'p_id' => 'P002',
            'p_image' => 'https://www.filepicker.io/api/file/v15smsWhT7CeG9OB6mI0',
            'p_name' => 'sClass2 Weblog Bootsrtap5 + Vuejs CDN + PHP สอนเขียนเว็บไซต์ด้วยตัวเองตั้งแต่ 0 - 100',
            'url' => 'https://appzstory.dev/c/sclass2-weblog-vuejs-php/',
            'cat_name' => 'storyclass',
            'price' => '3,500.00',
            'p_status' => true,
            'updated_at' => '2020-10-01 20:50:40',
            'created_at' => '2020-10-01 20:50:40'
        ],[
            'p_id' => 'P003',
            'p_image' => 'https://www.filepicker.io/api/file/o3UX9cfzQsWcD2MPrFjx',
            'p_name' => 'MiniCourse 1PLUS User Management System สอนเขียนระบบจัดการสมาชิก (หน้าบ้าน + หลังบ้าน)',
            'url' => 'https://appzstory.dev/c/mini1plus-user-management-system',
            'cat_name' => 'minicourse',
            'price' => '1,600.00',
            'p_status' => true,
            'updated_at' => '2020-10-01 20:50:40',
            'created_at' => '2020-10-01 20:50:40'
        ],[
            'p_id' => 'P004',
            'p_image' => 'https://www.filepicker.io/api/file/diQjU2L7T5SIxkvKEDf6',
            'p_name' => 'MiniCourse 2 Laravel Web Service สอนเขียนเว็บไซต์ในรูปแบบของ RESTFul Web Service',
            'url' => 'https://course.appzstory.dev/p/minicourse-2-laravel-web-service',
            'cat_name' => 'minicourse',
            'price' => '2,900.00',
            'p_status' => false,
            'updated_at' => '2020-10-01 20:50:40',
            'created_at' => '2020-10-01 20:50:40'
        ],[
            'p_id' => 'P005',
            'p_image' => 'https://cdn.fs.teachablecdn.com/TDkkwfJ1T4qu77hr5BKc',
            'p_name' => 'MiniCourse 3 สอนสร้าง PHP Framework REST API ด้วยตัวเองทั้งหมด ตั้งแต่ 0 - 100 ',
            'url' => 'https://course.appzstory.dev/courses/minicourse3-php-framework-rest-api/lectures/29434231',
            'cat_name' => 'minicourse',
            'price' => '2,500.00',
            'p_status' => true,
            'updated_at' => '2020-10-01 20:50:40',
            'created_at' => '2020-10-01 20:50:40'
        ]
    ],
    'message' => 'Get Data Success'
];
http_response_code(200);
echo json_encode($response);
