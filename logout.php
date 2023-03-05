<?php
	session_start();
	
	unset($_SESSION["userID"]);
	if(session_destroy()) {
      header("Location: index.php"); 
   }
?>