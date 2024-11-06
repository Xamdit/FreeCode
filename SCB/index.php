<?php
include 'class.php';
$SCB = new SCB();
// ดึงจำนวนเงิน
// echo $SCB->balance();

// ดึงประวัติเงินเข้า-ออก ย้อนหลัง 1 วัน
// echo $SCB->transactions();

// ตรวจสอบลิป รับค่า Qrcode
// echo $SCB->scan(""); //สแกน Qrcode รับค่า code

// เช็คโค๊ดธนาคาร
// echo $SCB->showCode();

// ตรวจสอบชื่อ รับค่า เลขบัญชี/โค๊ดธนาคาร
// echo $SCB->verification("","");

// โอนเงิน รับค่า เลขบัญชี/โค๊ดธนาคาร/จำนวนเงิน
// echo $SCB->tranfers("","","");

// โอนเงินเกิน 50,000  รับค่า โค๊ดธนาคาร/เลขบัญชี/จำนวนเงิน
// echo $SCB->bulktransferprofiles("","","");
?>