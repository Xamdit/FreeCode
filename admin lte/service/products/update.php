<?php
/**
 **** AppzStory Back Office Management System Template ****
 * Update Admin
 * 
 * @link https://appzstory.dev
 * @author Yothin Sapsamran (Jame AppzStory Studio)
 */
header('Content-Type: application/json');
require_once '../connect.php';
/**
 |--------------------------------------------------------------------------
 | เขียนโค้ด Update Admin SQL ตัวอย่าง
 | 'UPDATE admin SET field1 = :var1, field2= :var2 WHERE admin_id = :id "'
 |--------------------------------------------------------------------------
*/
$response = [
    'status' => true,
    'message' => 'Update Success'
];
http_response_code(200);
echo json_encode($response);

?>