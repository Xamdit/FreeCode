<?php
switch ($_GET['page']) {
    case "":
        include("template/temp_page_wallet.php");
        break;
    case "refill":
         include("template/temp_page_refill.php");
        break;
    case "tranfer":
         include("template/temp_page_tranfer.php");
        break;
    default:
        include("template/temp_page_wallet.php");
}
?>