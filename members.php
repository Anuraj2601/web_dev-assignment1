<?php
  session_start();
  if(!isset($_SESSION['uname'])) {
    header("Location: index.php");
  } 

  include 'database/dbconnect.php';
  include 'model/commFunc.php';

  if(isset($_POST['save'])) {
    commonFunc::saveUser();
  }

  if(isset($_POST['delete'])) {
    $id = $_POST['delete'];
    commonFunc::deleteUser($id);
  }

  if(isset($_POST['update'])) {
    $id = $_POST['update'];
    commonFunc::updateMember($id);
  }

  if(isset($_POST['select'])){
    
    $id=$_POST['select'];
    dbconnect::connectDb();
    $link = mysqli_connect("localhost","root","","webdev");
    $sql = "SELECT * FROM user WHERE (autoid='$id')";
    $query = mysqli_query($link,$sql) or die ("sql error");
    $userdata = mysqli_fetch_array($query);
    //dbconnect::closeDb();
}
?>

<html>
    <head>
        <title>Web Application Development</title>
		<link rel="stylesheet" type="text/css" href="home.css">
        <script type="text/javascript">
			function testUserForm(){
				
				var flag = 0; 
				if(document.userform.name.value==""){
					document.getElementById('namemsg').innerHTML = "Please Enter Name.";
					flag = 1;
				}else{
					document.getElementById('namemsg').innerHTML = "";
				}
				if(document.userform.address.value==""){
					document.getElementById('addressmsg').innerHTML = "Please Enter Address number.";
					flag = 1;
				}else{
					document.getElementById('addressmsg').innerHTML = "";
				}
				if(document.userform.gender.value==""){
					document.getElementById('gendermsg').innerHTML = "Please select Gender.";
					flag = 1;
				}else{
					document.getElementById('gendermsg').innerHTML = "";
				}
				if(document.userform.phone.value==""){
					document.getElementById('phonemsg').innerHTML = "Please Enter Phone number.";
					flag = 1;
				}else{
					document.getElementById('phonemsg').innerHTML = "";
				}
				if(/^[0-9]{10}?$/.test(document.userform.phone.value)){
					document.getElementById('phonemsg').innerHTML = "";
				}else{
					document.getElementById('phonemsg').innerHTML = "Please Enter a Valide Phone number.";
					flag = 1;
				}
				if(document.userform.nic.value==""){
					document.getElementById('nicmsg').innerHTML = "Please Enter NIC.";
					flag = 1;
				}else{
					document.getElementById('nicmsg').innerHTML = "";
				}
				if(/^[0-9]{9}[Vv]{1}?$/.test(document.userform.nic.value)){
					document.getElementById('nicmsg').innerHTML = "";
				}else{
					document.getElementById('nicmsg').innerHTML = "Please Enter Valide NIC.";
					flag = 1;
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
        <h1>Supply Chain Management System</h1>
       <ul>
		<li style="float:right"><a href="logout.php">Logout <?php echo $_SESSION['uname']?></a></li>

		<li><a href="home.php">Home</a></td>
		<li class="dropdown"><a href="javascript:void(0)" class="dropbtn">Members</a>
		<div class="dropdown-content">
			<a href="members.php">Users</a>
			<a href="customers/customer.php">Customers</a>
			<a href="suppliers/supplier.php">Suppliers</a>
			<a href="product/product.php">Product</a>
			<a href="orders/order.php">Orders</a>
			<a href="purchases/purchase.php">Purchases</a>
			<a href="purchases/purchaseitem.php">Purchase Item</a>
		</div>
	</li>
		<li class="dropdown"><a href="javascript:void(0)" class="dropbtn">Report</a>
		<div class="dropdown-content">
			<a href="report.php">User</a>
			<a href="customers/report_custom.php">Customer</a>
			<a href="suppliers/report_supplier.php">Supplier</a>
			<a href="product/report_product.php">Product</a>
			<a href="orders/report_order.php">Order</a>
		</div>
	</li>
		<li><a href="backup.php">Backup</a></td>
		</ul>
        
        <table width='100%'>
			<tr>
				<td>
					<form name="userform" method="POST" action="members.php" onSubmit="return testUserForm()" enctype="multipart/form-data">
					<h2>User Registration Form</h2>
						<table border="0">
							<tr>
								<td>Name : </td>
								<td><input type="text" name="name" <?php if(isset($_POST['select'])){echo "value=".$userdata['name'];}?>>
								<font color="#ff0000"><span id="namemsg"></span></font></td>
							</tr>
							<tr>
								<td>Address : </td>
								<td><textarea type="text" name="address" ><?php if(isset($_POST['select'])){echo $userdata['address'];}?></textarea>
								<font color="#ff0000"><span id="addressmsg"></span></font></td>
							</tr>
							<tr>
								<td>Gender : </td>
								<td><input type="radio" name="gender" value= "male" <?php if(isset($_POST['select'])){ if($userdata['gender']=='male'){echo "checked";}}?>> &nbsp Male
								<input type="radio" name="gender" value= "female" <?php if(isset($_POST['select'])){ if($userdata['gender']=='female'){echo "checked";}}?>> &nbsp Female
								<font color="#ff0000"><span id="gendermsg"></span></font></td>
							</tr>
							<tr>
								<td>Date of Birth : </td>
								<td><input type="date" name="date" <?php if(isset($_POST['select'])){echo "value=".$userdata['date'];}?>>
								<font color="#ff0000"><span id="datemsg"></span></font></td>
							</tr>
							<tr>
								<td>Phone No : </td>
								<td><input type="text" name="phone" maxlength="10" <?php if(isset($_POST['select'])){echo "value=".$userdata['phone'];}?>>
								<font color="#ff0000"><span id="phonemsg"></span></font></td>
							</tr>
							<tr>
								<td>NIC : </td>
								<td><input type="text" name="nic" maxlength="10" <?php if(isset($_POST['select'])){echo "value=".$userdata['nic'];}?>>
								<font color="#ff0000"><span id="nicmsg"></span></font></td>
							</tr>
							<tr>
								<td>Email : </td>
								<td><input type="text" name="email" <?php if(isset($_POST['select'])){echo "value=".$userdata['email'];}?>>
								<font color="#ff0000"><span id="emailmsg"></span></font></td>
							</tr>
							<tr>
								<td>Country : </td>
								<td><select name='country'>
									<option value="srilanka" <?php if(isset($_POST['select'])){if($userdata['country']=='srilanka')echo "selected";}?>>Sri Lanka</option>
									<option value="india"  <?php if(isset($_POST['select'])){if($userdata['country']=='india')echo "selected";}?>>India</option>
									<option value="usa"  <?php if(isset($_POST['select'])){if($userdata['country']=='usa')echo "selected";}?>>USA</option>
									<option value="other" <?php if(isset($_POST['select'])){if($userdata['country']=='other')echo "selected";}?>>Other</option>
								</select>
								<font color="#ff0000"><span id="emailmsg"></span></font></td>
							</tr>
							<tr>
								<td>Hobbies : </td>
								<td><input type="checkbox" name="reading" value="reading"  <?php if(isset($_POST['select'])){if($userdata['reading']==1)echo "checked";}?>> Reading<br>
									<input type="checkbox" name="movies" value="movies"  <?php if(isset($_POST['select'])){if($userdata['movie']==1)echo "checked";}?>> Watching Movies<br>
									<input type="checkbox" name="other" value="other"  <?php if(isset($_POST['select'])){if($userdata['other']==1)echo "checked";}?>> Other<br>
								</td>
							</tr>
							<tr>
								<td>Image : </td>
								<td><input type="file" name="photo" /></td>
							</tr>
							<tr>
								<td>Username : </td>
								<td><input type="text" name="username" <?php if(isset($_POST['select'])){echo "value=".$userdata['username'];}?>>
								<font color="#ff0000"><span id="usernamemsg"></span></font></td>
							</tr>
							<tr>
								<td>Password : </td>
								<td><input type="password" name="pass" <?php if(isset($_POST['select'])){echo "value=".$userdata['password'];}?>></td>
							</tr>
							<tr>
								<td>Retype Password : </td>
								<td><input type="password" name="pass1" <?php if(isset($_POST['select'])){echo "value=".$userdata['password'];}?>>
								<font color="#ff0000"><span id="passmsg"></span></font></td>
							</tr>
							<tr>
								<td></td>
								<td><?php if(isset($_POST['select'])){echo  "<button type='submit' name='update' value='".$userdata['autoid']."'>Update</button>";}else{echo "<input type='submit' name='save' value='Save'>";}?><input type="reset" name="clear" value="Clear" onclick="window.location.href='members.php'"></td>
							</tr>
                        </table>
                    </form>
                </td>
                <td>
                <h2>Registered Users</h2>
					<form name="usertable" method="POST" action="members.php">
					<table border='1' width='100%'>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Address</th>
							<th>Gender</th>
							<th>Phone</th>
							<th>NIC</th>
							<th>email</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					<?php
						commonFunc::memberTable();
					?>
					</table>
                    </form>
                </td>
            </tr>
        </table>
    </body>
</html>