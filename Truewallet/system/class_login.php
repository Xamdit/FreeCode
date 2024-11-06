<?php
use Maythiwat\Truewallet;
$wallet = new Truewallet();
session_start();
$_SESSION['token'] = $wallet->GetToken($_POST['email'],$_POST['password'],"email");
$_SESSION['username'] = "SystemByLolipopKunGz"; // ขี้เกียจเปลี่ยน ไม่ต้องลบนะ
if(isset($_SESSION['token'])){
echo '<script>alert("เข้าสู่ระบบแล้วคับ");</script>';
echo '<meta http-equiv="refresh" content="0; url=index.php"/>';
}else{
echo '<script>alert("รหัสผ่านหรืออีเมล์ผิด");</script>';
session_destroy();
echo '<meta http-equiv="refresh" content="0; url=index.php"/>';
}