<?php 
use Maythiwat\TrueWallet;
$wallet = new TrueWallet();
$pf_array = $wallet->GetProfile(login_token);
$pf_img = $pf_array['imageURL'];
$pf_name = $pf_array['fullname'];
$pf_money = $wallet->GetCurrentBalance(login_token)['currentBalance'];
?>
<nav class="navbar navbar-expand-lg navbar-light">
  <a class="navbar-brand" href="#" style="padding-left: 80px;"><img src="https://cdn.truemoney.com/wp-content/uploads/2017/08/wallet-logo.png" style="width: 25%;"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse">
    <ul class="navbar-nav ml-auto" style="padding-right: 80px;">
      <li class="nav-item pull-right active">
        <a class="nav-link" href="#"><img class="rounded-circle" src="<?php echo $pf_img ?>" style="width: 28px"/>&nbsp;<?php echo $pf_name; ?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?do=logout"><img src="img/power-button.png" style="width: 28px">&nbsp;ออกจากระบบ</a>
      </li>
      
    </ul>
    
  </div>
</nav>

<center>
	<div style="background: white;border: solid 0.5px #9E9E9E;width: 80%;padding-right: 80px;padding-left: 80px;margin-top: 24px;padding-bottom: 500px;" class="d-flex p-0">
		

			<div class="p-2" style="width: 30%;border-right: solid 0.5px #9E9E9E;">
				<img class="rounded-circle" src="<?php echo $pf_img ?>" style="width: 70px;padding-top: 5px;padding-left: 5px;" align="left"/>
				<div class="d-flex flex-column" style="padding-left: 15px;">
  <div align="left">ยอดเงินของคุณ</div>
  <div  align="left" style="color: #6A8156;font-size: 30px;"><?php echo $pf_money; ?></div>
</div>
<br>

<div class="d-flex flex-column mb-3">
  <a style="border-top: solid 0.5px #9E9E9E" href="index.php" class="p-3 l-menu<?php if(empty($_GET['page'])){echo'-active';}?>" align="left" ><img src="img/wallet<?php if(empty($_GET['page'])){echo'-active';}?>.png" class="l-menu-icon"/>&nbsp;กระเป๋าเงิน Wallet</a>
   <a href="?page=refill" class="p-3 l-menu<?php if($_GET['page']=='refill'){echo'-active';}?>" align="left"><img src="img/addm<?php if($_GET['page']=='refill'){echo'-active';}?>.png" class="l-menu-icon"/>&nbsp;เติมเงิน Wallet</a>
   <a href="?page=tranfer" class="p-3 l-menu<?php if($_GET['page']=='tranfer'){echo'-active';}?>" align="left"><img src="img/swap<?php if($_GET['page']=='tranfer'){echo'-active';}?>.png" class="l-menu-icon"/>&nbsp;โอนเงินระหว่าง Wallet</a>
   <a href="?do=logout" class="p-3 l-menu" align="left"><img src="img/signout.png" class="l-menu-icon"/>&nbsp;ออกจากระบบ</a>
</div>



		</div>
			<div class="p-2" style="width: 70%;"><?php include 'template/temp_dashboard_right.php'; ?></div>

		
	</div>
</center>
<hr>
<center><text>System & Design By <a href="https://www.facebook.com/FocusDevTh">LolipopKunGz</a> | Special Tanks <a href="https://www.facebook.com/maythiwatc">Demza</a><br> Its V.1 Plese Dont Remove Footer</text>
<div style="padding-bottom: 50px;"></div></center>