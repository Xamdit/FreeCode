<?php
if(empty($_SESSION['username'])) { include 'template/temp_login.php'; }else{ include 'template/temp_dashboard.php'; };
   