<?php
  session_start();
  if(!isset($_SESSION['uname'])) {
    header("Location: index.php");
  } 

  include '../database/dbconnect.php';
  include '../model/commFunc6.php';

  if(isset($_POST['save'])) {
    commonFunc6::saveUser();
  }

  if(isset($_POST['delete'])) {
    $id = $_POST['delete'];
    commonFunc6::deleteUser($id);
  }

  if(isset($_POST['update'])) {
    $id = $_POST['update'];
    commonFunc6::updateMember($id);
  }

  if(isset($_POST['select'])){
    
    $id=$_POST['select'];
    dbconnect::connectDb();
    $link = mysqli_connect("localhost","root","","webdev");
    $sql = "SELECT * FROM purchaseorderitem WHERE (purchaseorderitemid='$id')";
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
				if(document.userform.purchaseorderitemid.value==""){
					document.getElementById('purchaseorderitemidmsg').innerHTML = "Please Enter Purchase Order Item Id.";
					flag = 1;
				}else{
					document.getElementById('purchaseorderitemidmsg').innerHTML = "";
				}
				if(document.userform.purchaseorderid.value==""){
					document.getElementById('purchaseorderidmsg').innerHTML = "Please Enter Purchase Order Id.";
					flag = 1;
				}else{
					document.getElementById('purchaseorderidmsg').innerHTML = "";
				}
				if(document.userform.productid.value==""){
					document.getElementById('productidmsg').innerHTML = "Please Enter Product Id.";
					flag = 1;
				}else{
					document.getElementById('productidmsg').innerHTML = "";
				}
				if(document.userform.quantity.value==""){
					document.getElementById('quantitymsg').innerHTML = "Please Enter Quantity.";
					flag = 1;
				}else{
					document.getElementById('quantitymsg').innerHTML = "";
				}
				
				if(document.userform.price.value==""){
					document.getElementById('pricemsg').innerHTML = "Please Enter Price.";
					flag = 1;
				}else{
					document.getElementById('pricemsg').innerHTML = "";
				}
				if(/^[0-9]{10}.test(document.userform.price.value)){
					document.getElementById('pricemsg').innerHTML = "";
				}else{
					document.getElementById('pricemsg').innerHTML = "Please Enter Price.";
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
			<a href="purchase.php">Purchases</a>
			<a href="purchaseitem.php">Purchase Item</a>
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
					<form name="userform" method="POST" action="purchaseItem.php" onSubmit="return testUserForm()" enctype="multipart/form-data">
					<h2>Order Registration Form</h2>
						<table border="0">
							<tr>
								<td>Purchase Order Item Id : </td>
								<td><input type="text" name="purchaseorderitemid" <?php if(isset($_POST['select'])){echo "value=".$userdata['purchaseorderitemid'];}?>>
								<font color="#ff0000"><span id="purchaseorderitemidmsg"></span></font></td>
							</tr>
							
							<tr>
								<td>Purchase Order Id : </td>
								<td><input type="text" name="purchaseorderid" <?php if(isset($_POST['select'])){echo "value=".$userdata['purchaseorderid'];}?>>
								<font color="#ff0000"><span id="purchaseorderidmsg"></span></font></td>
							</tr>
							<tr>
								<td>Product Id : </td>
								<td><input type="text" name="productid" <?php if(isset($_POST['select'])){echo "value=".$userdata['productid'];}?>>
								<font color="#ff0000"><span id="productidmsg"></span></font></td>
							</tr>
							<tr>
								<td>Quantity : </td>
								<td><input type="text" name="quantity" <?php if(isset($_POST['select'])){echo "value=".$userdata['quantity'];}?>>
								<font color="#ff0000"><span id="quantitymsg"></span></font></td>
							</tr>
							<tr>
								<td>Price : </td>
								<td><input type="text" name="price" <?php if(isset($_POST['select'])){echo "value=".$userdata['price'];}?>>
								<font color="#ff0000"><span id="pricemsg"></span></font></td>
							</tr>
							
							
							<tr>
								<td></td>
								<td><?php if(isset($_POST['select'])){echo  "<button type='submit' name='update' value='".$userdata['purchaseorderitemid']."'>Update</button>";}else{echo "<input type='submit' name='save' value='Save'>";}?><input type="reset" name="clear" value="Clear" onclick="window.location.href='purchaseItem.php'"></td>
							</tr>
                        </table>
                    </form>
                </td>
                <td>
                <h2>Registered Orders</h2>
					<form name="usertable" method="POST" action="purchaseItem.php">
					<table border='1' width='100%'>
						<tr>
							<th>Purchase Order Item Id</th>
							<th>Purchase Order</th>
							<th>Product Id</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					<?php
						commonFunc6::userTable();
					?>
					</table>
                    </form>
                </td>
            </tr>
        </table>
    </body>
</html>