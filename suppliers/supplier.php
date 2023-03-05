<?php
  session_start();
  if(!isset($_SESSION['uname'])) {
    header("Location: index.php");
  } 

  include '../database/dbconnect.php';
  include '../model/commFunc2.php';

  if(isset($_POST['save'])) {
    commonFunc2::saveUser();
  }

  if(isset($_POST['delete'])) {
    $id = $_POST['delete'];
    commonFunc2::deleteUser($id);
  }

  if(isset($_POST['update'])) {
    $id = $_POST['update'];
    commonFunc2::updateMember($id);
  }

  if(isset($_POST['select'])){
    
    $id=$_POST['select'];
    dbconnect::connectDb();
    $link = mysqli_connect("localhost","root","","webdev");
    $sql = "SELECT * FROM supplier WHERE (supplierid='$id')";
    $query = mysqli_query($link,$sql) or die ("sql error");
    $userdata = mysqli_fetch_array($query);
    //dbconnect::closeDb();
}
?>

<html>
    <head>
        <title>Web Application Development</title>
		<link rel="stylesheet" type="text/css" href="../home.css">
        <script type="text/javascript">
			function testUserForm(){
				
				var flag = 0; 

				if(document.userform.supplierid.value==""){
					document.getElementById('supplieridmsg').innerHTML = "Please Enter Supplier Id.";
					flag = 1;
				}else{
					document.getElementById('supplieridmsg').innerHTML = "";
				}
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
				
				
				if(flag == 1){
					
					return false;
				}else{
					return true;
				}
			}

		</script>

    </head>
    <body background="../4.jpg">
        <h1>Supply Chain Management System</h1>
        <ul>
		<li style="float:right"><a href="../logout.php">Logout <?php echo $_SESSION['uname']?></a></li>

		<li><a href="../home.php">Home</a></td>
		<li class="dropdown"><a href="javascript:void(0)" class="dropbtn">Members</a>
		<div class="dropdown-content">
			<a href="../members.php">Users</a>
			<a href="../customers/customer.php">Customers</a>
			<a href="supplier.php">Suppliers</a>
			<a href="../product/product.php">Product</a>
			<a href="../orders/order.php">Orders</a>
			<a href="../purchases/purchase.php">Purchases</a>
			<a href="../purchases/purchaseitem.php">Purchase Item</a>
		</div>
	</li>
		<li class="dropdown"><a href="javascript:void(0)" class="dropbtn">Report</a>
		<div class="dropdown-content">
			<a href="../report.php">User</a>
			<a href="../customers/report_custom.php">Customer</a>
			<a href="report_supplier.php">Supplier</a>
			<a href="../product/report_product.php">Product</a>
			<a href="../orders/report_order.php">Order</a>
		</div>
	</li>
		<li><a href="../backup.php">Backup</a></td>
		</ul>
        
        <table width='100%'>
			<tr>
				<td>
					<form name="userform" method="POST" action="supplier.php" onSubmit="return testUserForm()" enctype="multipart/form-data">
					<h2>Supplier Registration Form</h2>
						<table border="0">

							<tr>
								<td>Supplier Id : </td>
								<td><input type="text" name="supplierid" <?php if(isset($_POST['select'])){echo "value=".$userdata['supplierid'];}?>>
								<font color="#ff0000"><span id="supplieridmsg"></span></font></td>
							</tr>
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
								<td>Phone : </td>
								<td><input type="text" name="phone" maxlength="10" <?php if(isset($_POST['select'])){echo "value=".$userdata['phone'];}?>>
								<font color="#ff0000"><span id="phonemsg"></span></font></td>
							</tr>

							<tr>
								<td>Email : </td>
								<td><input type="text" name="email" <?php if(isset($_POST['select'])){echo "value=".$userdata['email'];}?>>
								<font color="#ff0000"><span id="emailmsg"></span></font></td>
							</tr>
							
							
							<tr>
								<td></td>
								<td><?php if(isset($_POST['select'])){echo  "<button type='submit' name='update' value='".$userdata['supplierid']."'>Update</button>";}else{echo "<input type='submit' name='save' value='Save'>";}?><input type="reset" name="clear" value="Clear" onclick="window.location.href='supplier.php'"></td>
							</tr>
                        </table>
                    </form>
                </td>
                <td>
                <h2>Registered Suppliers</h2>
					<form name="usertable" method="POST" action="supplier.php">
					<table border='1' width='100%'>
						<tr>
							<th>Supplier Id</th>
							<th>Name</th>
							<th>Address</th>
							<th>Phone</th>
							<th>E-mail</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					<?php
						commonFunc2::userTable();
					?>
					</table>
                    </form>
                </td>
            </tr>
        </table>
    </body>
</html>