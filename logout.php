<?php 
	include("functions.php");

    if((isset($_SESSION['user_id']) && isset($_SESSION['user_name']) && isset($_SESSION['user_level'])) )  {
        if($_SESSION['user_level'] == "staff") {
        	session_destroy();
         	header("Location: index.php");
        }
        else
        	header("Location: index.php");
    }

    else
    	header("Location: index.php");

?>