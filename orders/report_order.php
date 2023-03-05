<?php
	session_start();
	if(!isset($_SESSION['uname'])){
		header("Location: index.php");
	}

	include '../database/dbconnect.php';
	include '../model/commFunc4.php';
?>

<htmL>
	<head>
		<title>Web Application Development</title>
			<link rel="stylesheet" type="text/css" href="../home.css">
	</head>
	<body background="../4.jpg">
		<h1>Supply Chain Management System</h1>
		<ul>
		<li style="float:right"><a href="../logout.php">Logout <?php echo $_SESSION['uname']?></a></li>

		<li><a href="../home.php">Home</a></td>
		<li class="dropdown"><a href="javascript:void(0)" class="dropbtn">Members</a>
		<div class="dropdown-content">
			<a href="../members.php">Users</a>
			<a href="customer.php">Customers</a>
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
			<a href="report_custom.php">Customer</a>
			<a href="../suppliers/report_supplier.php">Supplier</a>
			<a href="../product/report_product.php">Product</a>
			<a href="report_order.php">Order</a>
		</div>
	</li>
		<li><a href="../backup.php">Backup</a></td>
		</ul>

		<h1>Orders Report</h1>
		<table border='1' width='100%'>
			<tr>
				<th>Order Id</th>
				<th>Order Date</th>
				
				<th>Customer Id</th>
				
				<th>Total amount</th>
				
			</tr>
		<?php
			commonFunc4::reportGen();
		?>
		</table>
	</body>
</htmL>
