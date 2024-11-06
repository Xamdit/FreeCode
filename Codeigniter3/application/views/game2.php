<?php
$user = $this->session->userdata('user');
$setting = $this->admin_model->result_setting_game2();


if( $user){
    $ufa = $this->user_model->user_ufa( $user);
    if($ufa['username'] !=''){

      $user_ufa =  $ufa['username'];
      $pass_ufa =  $ufa['password'];
    }
   }
?>

<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script >
$(document).ready(function() {
	setInterval(function(){ 
		$("#form1").submit();
	}, 700);
});
</script>


<form action="<?=$setting['auto_login']?>" method="post" id="form1">
	<input name="__EVENTTARGET" type="hidden" id="__EVENTTARGET" value="btnSignIn" />
	<input name="__VIEWSTATEGENERATOR" type="hidden" id="__VIEWSTATEGENERATOR" value="<?=$setting['VIEWSTATEGENERATOR']?>" />
	<input name="__VIEWSTATE" type="hidden" id="__VIEWSTATE" value="<?=$setting['VIEWSTATE']?>" />
	<input name="__EVENTVALIDATION" type="hidden" id="__EVENTVALIDATION" value="<?=$setting['EVENTVALIDATION']?>" />
	<input name="txtUserName" type="hidden" id="txtUserName" value="<?=$user_ufa?>" />
	<input name="password" type="hidden" id="password" value="<?=$pass_ufa?>" />
		<!--<input name="__EVENTTARGET" type="hidden" id="__EVENTTARGET" value="btnLogin" />-->
	<!--<input name="__VIEWSTATE" type="hidden" id="__VIEWSTATE" value="/wEPDwUJNjg1ODU4MzY3D2QWAmYPZBYEAgIPFgIeC3BsYWNlaG9sZGVyBR7guIrguLfguYjguK3guJzguLnguYnguYPguIrguYlkAgMPFgIfAAUY4Lij4Lir4Lix4Liq4Lic4LmI4Liy4LiZZGSU/349Ay8B9CcRo2NtxbcDNU345g==" />-->
	<!--<input name="__VIEWSTATE" type="hidden" id="__VIEWSTATE" value="/wEPDwUKLTM5MDgxMTQ1OA9kFgJmD2QWBAIBDxYCHgtwbGFjZWhvbGRlcgUe4LiK4Li34LmI4Lit4Lic4Li54LmJ4LmD4LiK4LmJZAICDxYCHwAFGOC4o+C4q+C4seC4quC4nOC5iOC4suC4mWRk8aFvhbe2ayPSeX0ZIKMPzvo3x2o=" />-->
	<!--<input name="__EVENTVALIDATION" type="hidden" id="__EVENTVALIDATION" value="/wEdAARJt4soDXp6PQKMb/ltmDeNY3plgk0YBAefRz3MyBlTcO4sciJO3Hoc68xTFtZGQEivn9vBjVd9fs+uQ2w6sTEuPnl+ioZCpAIR5x4Z2cDiFeuTtW4=" />-->
	
	<!--<input name="lstLang" type="hidden" id="lstLang" value="Default8.aspx?lang=EN-GB" />-->

</form>