<?php
use Maythiwat\TrueWallet;
$wallet = new TrueWallet();
if($wallet->Logout($_SESSION['token'])){
session_destroy();
echo '<meta http-equiv="refresh" content="0; url=index.php"/>';
}

?>


 