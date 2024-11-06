 <?php error_reporting(0); session_start(); include("system/autoload.php");
 define(login_token, $_SESSION['token']);
use LolipopKunGz\payload;
$payload = new payload();
$payload->call("wallet");
 ?>
 <!DOCTYPE html>
 <html>
 <head>
  <meta charset="UTF-8">
   <title></title>
   <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
   <link href="dist/main.css" rel="stylesheet">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
 <?php 
$payload->call("style");
 ?>
 </head>
 <body>
 <?php 
$payload->call("page");
if($_GET['do']=="logout"){
$payload->call("logout");
}elseif($_GET['do']=="login"){
$payload->call("login");
}

 ?>
 </body>
 </html>
