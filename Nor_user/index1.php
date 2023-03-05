<?php
    include '../database/dbconnect.php';

    if(isset($_POST['login'])) {
        $username = $_POST['username'];
        $pass = $_POST['pass'];

        dbconnect::connectDb();
        $link = mysqli_connect("localhost","root","","webdev") or die ("Connection error");
        $sql = "SELECT count(autoid),name FROM usr WHERE (username='$username' AND password = '$pass')";
        $query = mysqli_query($link,$sql) or die ("sql error");
        $row = mysqli_fetch_array($query);

        if($row[0] == 1) {
            echo "Welcome ". $row[1];
            session_start();
            $_SESSION['uname'] = $username;
            $_SESSION['name'] = $row[1];
            header("refresh:2; url=home1.php");
        }else {
            echo "Invalid Username or Password";
            header("refresh:3; url=index1.php");
        }
    }
?>

<html>
    <head>
        <title>Web Application Development</title>
        <link rel="stylesheet" href="1.css">
    </head>

    <body background="4.jpg">
        <h1><center>Supply Chain Management System</center></h1>
       <div class="log">
        <form action="index1.php" method="post">
        <h1>Login</h1>
            <table border="0">
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username"></td>
                </tr>
                <tr></tr>
                <tr></tr>
                <tr></tr>
                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="pass"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="login" value="Login"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><h3><a href="newuser1.php">New User </a></h3></td>
                </tr>
            </table>
        </form>
</div>
    <div class="gif"><img src="8.gif"></div>


    </body>
</html>