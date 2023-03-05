<?php
class commonFunc5{
	/* this class contains all the functions necessary to this system */
	public static function saveUser(){
		$purchaseid = $_POST['purchaseid'];
		$supplierid = $_POST['supplierid'];
		$orderdate = $_POST['orderdate'];
		
		$deliverydate = $_POST['deliverydate'];
		
		$amount = $_POST['amount'];
		
		

		
		

		dbconnect::connectDb();
        $link = mysqli_connect("localhost","root","","webdev");
		$sql = "INSERT INTO purchaseorder (purchaseorderid,supplierid,orderdate,deliverydate,total_amount) VALUES ('$purchaseid','$supplierid','$orderdate','$deliverydate','$amount')";
		$query = mysqli_query($link,$sql) or die ("sql error");

		if($query){
		echo "Successfully saved";
		header( "refresh:3; url=purchase.php" );
		}else{
		echo "Error";
		header( "refresh:3; url=purchase.php" );
		}
		//dbconnect::closeDb();
	}

	public static function deleteUser($id){
		/* deleteUser function is used to delete the member details on the database */
		dbconnect::connectDb();
		$sql = "DELETE FROM purchaseorder WHERE (purchaseorderid='$id');";
		 $link = mysqli_connect("localhost","root","","webdev");
		$query = mysqli_query($link,$sql) or die ("sql error");
		if($query){
		echo "Successfully Deleted";
		header( "refresh:3; url=purchase.php" );
		}else{
		echo "Error";
		header( "refresh:3; url=purchase.php" );
		}
		//dbconnect::closeDb();
	}

	public static function selectMember($id){
		/* selectMember function is used to select the member details from the database and show them on the form */
		dbconnect::connectDb();
        $link = mysqli_connect("localhost","root","","webdev");
		$sql = "SELECT * FROM `purchaseorder` WHERE (purchaseorderid='$id')";
		$query = mysqli_query($link,$sql) or die ("sql error");
		$userdata = mysqli_fetch_array($query);
		//dbconnect::closeDb();
	}

	public static function updateMember($id){
		/* updateMember function is used to update the member details on the database */
		$purchaseid = $_POST['purchaseid'];
		$supplierid = $_POST['supplierid'];
		$orderdate = $_POST['orderdate'];
		$deliverydate = $_POST['deliverydate'];
		
		
		
		$amount = $_POST['amount'];
			$sql = "UPDATE `purchaseorder` SET purchaseorderid ='$purchaseid', supplierid = '$supplierid', orderdate ='$orderdate', deliverydate ='$deliverydate', total_amount = '$amount' WHERE purchaseorderid = '$id'";
		

		dbconnect::connectDb();
        $link = mysqli_connect("localhost","root","","webdev");
		$query = mysqli_query($link,$sql) or die ("sql error");

		if($query){
		echo "<font color=#00FF00'>Successfully Updated</font>";
		header( "refresh:3; url=purchase.php" );
		}else{
		echo "Error";
		header( "refresh:3; url=purchase.php" );
		}
		//dbconnect::closeDb();
	}

	public static function reportGen(){
		/* reportGen function is used to generate report about the members */
		dbconnect::connectDb();
        $link = mysqli_connect("localhost","root","","webdev");
		$sql = "SELECT * FROM `purchaseorder`";
		$query = mysqli_query($link,$sql) or die ("sql error");

		while ($row = mysqli_fetch_array($query)) {
								 echo "<tr>";
								 echo "<td>".$row['purchaseorderid']."</td>";
								 echo "<td>".$row['supplierid']."</td>";
								 echo "<td>".$row['orderdate']."</td>";
								 echo "<td>".$row['deliverydate']."</td>";
								 echo "<td>".$row['total_amount']."</td>";
								 echo "</tr>";
						 }
		//dbconnect::closeDb();
	}

	public static function userTable(){
		/* memberTable function is used to display member on a table */
		dbconnect::connectDb();
        $link = mysqli_connect("localhost","root","","webdev");
		$sql = "SELECT * FROM `purchaseorder`";
		$query = mysqli_query($link,$sql) or die ("sql error");

		while ($row = mysqli_fetch_array($query)) {
								 echo "<tr>";
								 echo "<td>".$row['purchaseorderid']."</td>";
								 echo "<td>".$row['supplierid']."</td>";
								 echo "<td>".$row['orderdate']."</td>";
								 echo "<td>".$row['deliverydate']."</td>";
								 echo "<td>".$row['total_amount']."</td>";
								 echo "<td><button type='submit' name='select' value='".$row['purchaseorderid']."'>Edit</button></td>";
								 echo "<td><button type='submit' name='delete' value='".$row['purchaseorderid']." '>Delete</button></td>";
								 echo "</tr>";
						 }
		//dbconnect::closeDb();
	}

}

?>
 