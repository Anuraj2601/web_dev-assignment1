<?php
  session_start();
  if(!isset($_SESSION['uname'])) {
    header("Location: index.php");
  } 

  include '../database/dbconnect.php';
  include '../model/commFunc4.php';

  if(isset($_POST['save'])) {
    commonFunc4::saveUser();
  }

  if(isset($_POST['delete'])) {
    $id = $_POST['delete'];
    commonFunc4::deleteUser($id);
  }

  if(isset($_POST['update'])) {
    $id = $_POST['update'];
    commonFunc4::updateMember($id);
  }

  if(isset($_POST['select'])){
    
    $id=$_POST['select'];
    dbconnect::connectDb();
    $link = mysqli_connect("localhost","root","","webdev");
    $sql = "SELECT * FROM `order` WHERE (orderid='$id')";
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
				if(document.userform.orderid.value==""){
					document.getElementById('orderidmsg').innerHTML = "Please Enter Order Id.";
					flag = 1;
				}else{
					document.getElementById('orderidmsg').innerHTML = "";
				}
				if(document.userform.date.value==""){
					document.getElementById('datemsg').innerHTML = "Please Enter Date.";
					flag = 1;
				}else{
					document.getElementById('datemsg').innerHTML = "";
				}
				if(document.userform.customerid.value==""){
					document.getElementById('customeridmsg').innerHTML = "Please Enter CustomerId.";
					flag = 1;
				}else{
					document.getElementById('customeridmsg').innerHTML = "";
				}
				
				
				if(document.userform.amount.value==""){
					document.getElementById('amountmsg').innerHTML = "Please Enter Amount.";
					flag = 1;
				}else{
					document.getElementById('amountmsg').innerHTML = "";
				}
				if(/^[0-9]{10}.test(document.userform.amount.value)){
					document.getElementById('amountmsg').innerHTML = "";
				}else{
					document.getElementById('amountmsg').innerHTML = "Please Enter valide Amount.";
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
			<a href="../suppliers/supplier.php">Suppliers</a>
			<a href="../product/product.php">Product</a>
			<a href="order.php">Orders</a>
			<a href="../purchases/purchase.php">Purchases</a>
			<a href="../purchases/purchaseitem.php">Purchase Item</a>
		</div>
	</li>
		<li class="dropdown"><a href="javascript:void(0)" class="dropbtn">Report</a>
		<div class="dropdown-content">
			<a href="../report.php">User</a>
			<a href="../customersreport_custom.php">Customer</a>
			<a href="../suppliers/report_supplier.php">Supplier</a>
			<a href="../product/report_product.php">Product</a>
			<a href="report_order.php">Order</a>
		</div>
	</li>
		<li><a href="../backup.php">Backup</a></td>
		</ul>
        
        <table width='100%'>
			<tr>
				<td>
					<form name="userform" method="POST" action="order.php" onSubmit="return testUserForm()" enctype="multipart/form-data">
					<h2>Order Registration Form</h2>
						<table border="0">
							<tr>
								<td>Order Id : </td>
								<td><input type="text" name="orderid" <?php if(isset($_POST['select'])){echo "value=".$userdata['orderid'];}?>>
								<font color="#ff0000"><span id="orderidmsg"></span></font></td>
							</tr>
							<tr>
								<td>Order Date : </td>
								<td><input type="date" name="date" <?php if(isset($_POST['select'])){echo "value=".$userdata['orderdate'];}?>>
								<font color="#ff0000"><span id="datemsg"></span></font></td>
							</tr>
							<tr>
								<td>Customer Id : </td>
								<td><input type="text" name="customerid" maxlength="10" <?php if(isset($_POST['select'])){echo "value=".$userdata['customerid'];}?>>
								<font color="#ff0000"><span id="customeridmsg"></span></font></td>
							</tr>
							
							<tr>
								<td>Total amount : </td>
								<td><input type="text" name="amount" <?php if(isset($_POST['select'])){echo "value=".$userdata['total_amount'];}?>>
								<font color="#ff0000"><span id="amountmsg"></span></font></td>
							</tr>
							
							
							<tr>
								<td></td>
								<td><?php if(isset($_POST['select'])){echo  "<button type='submit' name='update' value='".$userdata['orderid']."'>Update</button>";}else{echo "<input type='submit' name='save' value='Save'>";}?><input type="reset" name="clear" value="Clear" onclick="window.location.href='order.php'"></td>
							</tr>
                        </table>
                    </form>
                </td>
                <td>
                <h2>Registered Orders</h2>
					<form name="usertable" method="POST" action="order.php">
					<table border='1' width='100%'>
						<tr>
							<th>Order Id</th>
							<th>Order date</th>
							<th>Customer Id</th>
							<th>Total amount</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					<?php
						commonFunc4::userTable();
					?>
					</table>
                    </form>
                </td>
            </tr>
        </table>
    </body>
</html>