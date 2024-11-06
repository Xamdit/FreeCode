<div style="background: white;width:100%;" class="d-flex p-0">
	<div class="p-2" style="width: 70%" align="left">
		<img src="img/wallet-active.png" class="l-right-icon">&nbsp;กระเป๋าเงิน Wallet
	</div>
	<div class="p-2" style="width: 30%" align="right">
		<a href="index.php"><img src="img/refresh.png" class="l-right-icon-sm">&nbsp;อัพเดทข้อมูล</a>
	</div>
	</div>
	<hr class="bar">

	<table class="table">
  <thead>
    <tr>
      <th scope="col" width="12%">ประเภท</th>
      <th scope="col" width="70%">รายละเอียด</th>
      <th scope="col" width="15%">จำนวนเงิน</th>
      <th scope="col" width="15%">วันที่</th>
    </tr>
  </thead>
  <tbody>

<?php 
 $start_date = date('Y-m-d', strtotime('-10 days')); // ตั้งเองเลยย่อนกี่วัน
  $end_date = date('Y-m-d', strtotime('1 days'));
  
  $activities = $wallet->FetchActivities(login_token, $start_date, $end_date);
  foreach($activities as $arr) {
    ?>
 <tr>
      <th scope="row"><img src="<?php echo $arr["logo_url"] ?>" class="l-dicon"></th>
      <td><?php echo $arr['title'] ?><br><?php echo $arr['sub_title']; ?></td>
      <td><?php echo $arr['amount'] ?></td>
      <td><?php echo $arr['date_time'] ?></td>
    </tr>
    <?php
  }
?>

    
    
  </tbody>
</table>