<?php

if(empty($_SESSION['username'])){
 echo '<link href="dist/login.css" rel="stylesheet">'; 
}else{ 
	echo '<link href="dist/dashboard.css" rel="stylesheet">';
}