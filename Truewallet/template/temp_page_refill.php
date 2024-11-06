<div style="background: white;width:100%;" class="d-flex p-0">
    <div class="p-2" style="width: 70%" align="left">
        <img src="img/addm-active.png" class="l-right-icon">&nbsp;เติมเงิน Wallet
    </div>
    <div class="p-2" style="width: 30%" align="right">
        <img src="img/refresh.png" class="l-right-icon-sm">&nbsp;System By LolipopKunGz
    </div>
    </div>
    <hr class="bar">
<div class="alert alart-warnning" style="background: #ff8400;color: white;">
 เติมเงินด้วยบัตรเงินสดทรูมันนี่ ค่าธรรมเนียมการเติมเงิน 14%
</div>
<div style="width: 50%;border: solid 0.5px #9E9E9E;padding: 30px;">

<form method="post" action="?page=refill&do=confirm">
บัตรเงินสดทรูมันนี่(14 หลัก) : <hr>
<input type="text" name="cashcard"/>
<input type="submit" class="l-btn" value="ยืนยันการเติมเงิน" style="margin-top: 10px;">
</form>
</div>

<div style="height: 50px;"></div>
<?php 
if($_GET['do']=="confirm"){
  
  if (!empty(rtrim($_POST['cashcard']))) {
    
        $tm = $wallet->CashcardTopup(login_token, $_POST['cashcard']);
        @$tx = $tm['transactionId'];
        if ($tx !== false && $tx !== null) {
            // $tm['amount'] <-- จำนวนเงิน
            echo '<script>alert("เติมเงินสำเร็จ! จำนวน : '.$tm['amount'].' บาท");</script>';
			echo "<meta http-equiv='refresh' content='0;url=index.php'>";
        }else{
            echo '<script>alert("รหัสบัตรเงินสดไม่ถูกต้อง!");</script>';
			echo "<meta http-equiv='refresh' content='0;url=?page=refill'>";
        }
    
}else{
    echo '<script>alert("โปรดกรอกข้อมูลให้ถูกต้องและครบถ้วน!");</script>';
	echo "<meta http-equiv='refresh' content='0;url=?page=refill'>";
}

}
?>