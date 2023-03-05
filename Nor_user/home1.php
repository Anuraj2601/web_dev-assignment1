<?php
    session_start();
    if(!isset($_SESSION['uname'])) {
        header("Location: index1.php");
    }
?>

<html>
    <head>
        <title>Web Application Development</title>
		<link rel="stylesheet" type="text/css" href="home.css">
    </head>
    <body background="4.jpg">
        <h1>Supply Chain Management System</h1>
       <ul>
		<li style="float:right"><a href="logout.php">Logout <?php echo $_SESSION['uname']?></a></li>

		<li><a href="home1.php">Home</a></td>
		<li class="dropdown"><a href="javascript:void(0)" class="dropbtn">News</a>
		<div class="dropdown-content">
			
		</div>
	</li>
		<li class="dropdown"><a href="javascript:void(0)" class="dropbtn">Services</a>
		<div class="dropdown-content">
		</div>
	</li>
		<li><a href="contact.php">Contact</a></td>
		</ul>
                
            </tr>
        </table>
    </body>
</html>