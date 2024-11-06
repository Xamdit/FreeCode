<?php
require 'ClassTRUE.php';

$tw = new TrueWallet();
$tw->setConfig(Array("username" => "เบอร์", "password"=> "รหัส"));

//ขอotp
print_r($tw->RequestLoginOTP());
//ขั้นตอน 2
//print_r($tw->SubmitLoginOTP("รหัสotp", "เบอร์", "ref otp 4 ตัว"));


?>