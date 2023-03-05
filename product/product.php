<?php
  session_start();
  if(!isset($_SESSION['uname'])) {
    header("Location: index.php");
  } 

  include '../database/dbconnect.php';
  include '../model/commFunc3.php';

  if(isset($_POST['save'])) {
    commonFunc3::saveUser();
  }

  if(isset($_POST['delete'])) {
    $id = $_POST['delete'];
    commonFunc3::deleteUser($id);
  }

  if(isset($_POST['update'])) {
    $id = $_POST['update'];
    commonFunc3::updateMember($id);
  }

  if(isset($_POST['select'])){
    
    $id=$_POST['select'];
    dbconnect::connectDb();
    $link = mysqli_connect("localhost","root","","webdev");
    $sql = "SELECT * FROM product WHERE (productid='$id')";
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
				
				if(document.userform.productid.value==""){
					document.getElementById('productidmsg').innerHTML = "Please Enter Product Id.";
					flag = 1;
				}else{
					document.getElementById('productidmsg').innerHTML = "";
				}
				if(document.userform.name.value==""){
					document.getElementById('namemsg').innerHTML = "Please Enter Name.";
					flag = 1;
				}else{
					document.getElementById('namemsg').innerHTML = "";
				}
				if(document.userform.description.value==""){
					document.getElementById('descriptionmsg').innerHTML = "Please Enter description.";
					flag = 1;
				}else{
					document.getElementById('descriptionmsg').innerHTML = "";
				}
				if(document.userform.price.value==""){
					document.getElementById('pricemsg').innerHTML = "Please Enter Price.";
					flag = 1;
				}else{
					document.getElementById('pricemsg').innerHTML = "";
				}
				if(/^[0-9]{10}test(document.userform.price.value)){
					document.getElementById('pricemsg').innerHTML = "";
				}else{
					document.getElementById('pricemsg').innerHTML = "Please Enter a Valide Price number.";
					flag = 1;
				}
				
				if(document.userform.supplierid.value==""){
					document.getElementById('supplieridmsg').innerHTML = "Please Enter Supplier id.";
					flag = 1;
				}else{
					document.getElementById('supplieridmsg').innerHTML = "";
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
			<a href="product.php">Product</a>
			<a href="../orders/order.php">Orders</a>
			<a href="../purchases/purchase.php">Purchases</a>
			<a href="../purchases/purchaseitem.php">Purchase Item</a>
		</div>
	</li>
		<li class="dropdown"><a href="javascript:void(0)" class="dropbtn">Report</a>
		<div class="dropdown-content">
			<a href="../report.php">User</a>
			<a href="../customers/report_custom.php">Customer</a>
			<a href="../suppliers/report_supplier.php">Supplier</a>
			<a href="report_product.php">Product</a>
			<a href="orders/report_order.php">Order</a>
		</div>
	</li>
		<li><a href="../backup.php">Backup</a></td>
		</ul>
        
        <table width='100%'>
			<tr>
				<td>
					<form name="userform" method="POST" action="product.php" onSubmit="return testUserForm()" enctype="multipart/form-data">
					<h2>Supplier Registration Form</h2>
						<table border="0">

							<tr>
								<td>Product Id : </td>
								<td><input type="text" name="productid" <?php if(isset($_POST['select'])){echo "value=".$userdata['productid'];}?>>
								<font color="#ff0000"><span id="productidmsg"></span></font></td>
							</tr>
							<tr>
								<td>Product Name : </td>
								<td><input type="text" name="name" <?php if(isset($_POST['select'])){echo "value=".$userdata['name'];}?>>
								<font color="#ff0000"><span id="namemsg"></span></font></td>
							</tr>
							<tr>
								<td>Product Description : </td>
								<td><textarea type="text" name="description" ><?php if(isset($_POST['select'])){echo $userdata['description'];}?></textarea>
								<font color="#ff0000"><span id="descriptionmsg"></span></font></td>
							</tr>

							<tr>
								<td>Price : </td>
								<td><input type="text" name="price" maxlength="10" <?php if(isset($_POST['select'])){echo "value=".$userdata['price'];}?>>
								<font color="#ff0000"><span id="pricemsg"></span></font></td>
							</tr>

							<tr>
								<td>Supplier ID : </td>
								<td><input type="text" name="supplierid" <?php if(isset($_POST['select'])){echo "value=".$userdata['supplierid'];}?>>
								<font color="#ff0000"><span id="supplieridmsg"></span></font></td>
							</tr>
							
							
							<tr>
								<td></td>
								<td><?php if(isset($_POST['select'])){echo  "<button type='submit' name='update' value='".$userdata['productid']."'>Update</button>";}else{echo "<input type='submit' name='save' value='Save'>";}?><input type="reset" name="clear" value="Clear" onclick="window.location.href='product.php'"></td>
							</tr>
                        </table>
                    </form>
                </td>
                <td>
                <h2>Registered Products</h2>
					<form name="usertable" method="POST" action="product.php">
					<table border='1' width='100%'>
						<tr>
							<th>Product Id</th>
							<th>Name</th>
							<th>Description</th>
							<th>Price</th>
							<th>Supplier ID</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					<?php
						commonFunc3::userTable();
					?>
					</table>
                    </form>
                </td>
            </tr>
        </table>
    </body>
</html>