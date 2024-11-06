<?php 
if($_GET['stream']==""||empty($_GET['stream'])){
include 'template/temp_page_tranfer_home.php';
if($_GET['do']=="sendotp"){
	$tranid = $wallet->transaction_draft(login_token,$_POST['phone'],$_POST['amount']);
	if(empty($_POST['message'])){
		$messages = "TMNWEBSITE OPENSOURCE BY LOLIPOPKUNGZ";
	}else{
		$messages = $_GET['message'];
	}
	$sendotp = $wallet->transaction_send_otp(login_token,$tranid,$messages);
	if($sendotp){
		$tranids = $sendotp['data']['draftTransactionID'];
		$amount = round($sendotp['data']['amount']);
		$otpRef = $sendotp['data']['otpRefCode'];
		$mobile = $sendotp['data']['mobileNumber'];
		$_SESSION['transaction_id'] = $tranids;
		$_SESSION['amount'] = $amount;
		$_SESSION['otpRefCode'] = $otpRef;
		$_SESSION['mobile'] = $mobile;
		echo "<meta http-equiv='refresh' content='0;url=?page=tranfer&stream=verify_otp'>";
	}

}
}elseif($_GET['stream']=="verify_otp"){
if($_GET['do']=="confirm"){
	$transfer = $wallet->transaction_transfer(login_token,$_SESSION['mobile'],$_SESSION['transaction_id'],$_POST['otp'],$_SESSION['otpRefCode']);
	if(isset($transfer['code']))
					{
						if($transfer['code'] === "20000")
						{
							$transferStatus = $transfer['data']['transferStatus'];
							echo '<script>alert("โอนเงินสำเร็จ!");</script>';
							echo "<meta http-equiv='refresh' content='0;url=index.php'>";
						} else {
							echo '<script>alert("โอนเงินไม่สำเร็จ!");</script>';
							echo "<meta http-equiv='refresh' content='0;url=?page=tranfer&stream=verify_otp'>";
						}
				}
}
include 'template/temp_page_tranfer_verify.php';
}


?>