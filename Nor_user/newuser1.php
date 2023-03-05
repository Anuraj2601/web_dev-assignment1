<?php
	require_once '../database/dbconnect.php'; 
	require_once '../model/commFunc_user.php'; 

	if(isset($_POST['save'])){
		 
		commonFunc7::saveUser();
	}
?>

<html>
	<head>
		<title>Web Application Development</title>

		<script type="text/javascript">
			function testUserForm(){
				
				var flag = 0;
				if(document.userform.name.value==""){
					document.getElementById('namemsg').innerHTML = "Please Enter Name.";
					flag = 1;
				}else{
					document.getElementById('namemsg').innerHTML = "";
				}
				if(document.userform.email.value==""){
					document.getElementById('emailmsg').innerHTML = "Please Enter email.";
					flag = 1;
				}else{
					document.getElementById('emailmsg').innerHTML = "";
				}
				if(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/.test(document.userform.email.value)){
					document.getElementById('emailmsg').innerHTML = "";
				}else{
					document.getElementById('emailmsg').innerHTML = "Please Enter valide email.";
					flag = 1;
				}
				if(document.userform.username.value==""){
					document.getElementById('usernamemsg').innerHTML = "Please Enter Username.";
					flag = 1;
				}else{
					document.getElementById('usernamemsg').innerHTML = "";
				}
				if(document.userform.pass.value==""){
					document.getElementById('passmsg').innerHTML = "Please Enter Password.";
					flag = 1;
				}else{
					document.getElementById('passmsg').innerHTML = "";
				}
				if(document.userform.pass.value!=document.userform.pass1.value){
					document.getElementById('passmsg').innerHTML = "Password missmatched.";
					flag = 1;
				}else{
					document.getElementById('passmsg').innerHTML = "";
				}
				if(flag == 1){
					
					return false;
				}else{
					return true;
				}
			}

		</script>

	</head>
	<body background="4.jpg">
		<h1>New User Registraion</h1>
		<table width='100%'>
			<tr>
				<td>
					<form name="userform" method="POST" action="newuser1.php" onSubmit="return testUserForm()" enctype="multipart/form-data">
						<table border="0">
							<tr>
								<td>Name : </td>
								<td><input type="text" name="name">
								<font color="#ff0000"><span id="namemsg"></span></font></td>
							</tr>
							
							
							
							<tr>
								<td>Email : </td>
								<td><input type="text" name="email" >
								<font color="#ff0000"><span id="emailmsg"></span></font></td>
							</tr>
							
							
							<tr>
								<td>Username : </td>
								<td><input type="text" name="username" >
								<font color="#ff0000"><span id="usernamemsg"></span></font></td>
							</tr>
							<tr>
								<td>Password : </td>
								<td><input type="password" name="pass"></td>
							</tr>
							<tr>
								<td>Retype Password : </td>
								<td><input type="password" name="pass1">
								<font color="#ff0000"><span id="passmsg"></span></font></td>
							</tr>
							<tr>
								<td></td>
								<td><input type='submit' name='save' value='Save'><input type="reset" name="clear" value="Clear"></td>
							</tr>
						</table>
					</form>
				</td>
			</tr>
		</table>
		<h3><a href="index1.php">Back</a></h3>
	</body>
</htmL>
