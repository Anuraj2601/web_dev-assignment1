<?php
    session_start();
    if(!isset($_SESSION['uname'])) {
        header("Location: index.php");
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
                
            </tr>
        </table>
    </body>
</html>