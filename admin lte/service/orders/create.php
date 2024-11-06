<?php
/**
 **** AppzStory Back Office Management System Template ****
 * Create Orders
 * 
 * @link https://appzstory.dev
 * @author Yothin Sapsamran (Jame AppzStory Studio)
 */
header('Content-Type: application/json');
require_once '../connect.php';
/**
 |--------------------------------------------------------------------------
 | เขียนโค้ด Insert Orders SQL ตัวอย่าง
 | 'INSERT INTO Orders (field1, field2, field3) VALUES (:var1, :var2, :var3)'
 |--------------------------------------------------------------------------
*/
$response = [
    'status' => true,
    'message' => 'Create Success'
];
http_response_code(201);
echo json_encode($response);

?>