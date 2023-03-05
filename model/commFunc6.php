<?php
class commonFunc6{
	/* this class contains all the functions necessary to this system */
	public static function saveUser(){
		$purchaseorderitemid = $_POST['purchaseorderitemid'];
		$quantity = $_POST['quantity'];
		$productid = $_POST['productid'];
		$purchaseorderid = $_POST['purchaseorderid'];
		$price = $_POST['price'];
		

		dbconnect::connectDb();
        $link = mysqli_connect("localhost","root","","webdev");
		$sql = "INSERT INTO `purchaseorderitem` (purchaseorderitemid,purchaseorderid,productid,quantity,price) VALUES ('$purchaseorderitemid','$purchaseorderid','$productid','$quantity','$price')";
		$query = mysqli_query($link,$sql) or die ("sql error");

		if($query){
		echo "Successfully saved";
		header( "refresh:3; url=purchaseItem.php" );
		}else{
		echo "Error";
		header( "refresh:3; url=purchaseItem.php" );
		}
		//dbconnect::closeDb();
	}

	public static function deleteUser($purchaseorderitemid){
		/* deleteUser function is used to delete the member details on the database */
		dbconnect::connectDb();
		$sql = "DELETE FROM `purcchaseorderitem` WHERE (purchaseorderitemid='$purchaseorderitemid');";
		 $link = mysqli_connect("localhost","root","","webdev");
		$query = mysqli_query($link,$sql) or die ("sql error");
		if($query){
		echo "Successfully Deleted";
		header( "refresh:3; url=purchaseItem.php" );
		}else{
		echo "Error";
		header( "refresh:3; url=purchaseItem.php" );
		}
		//dbconnect::closeDb();
	}

	public static function selectMember($purchaseorderitemid){
		/* selectMember function is used to select the member details from the database and show them on the form */
		dbconnect::connectDb();
        $link = mysqli_connect("localhost","root","","webdev");
		$sql = "SELECT * FROM `purchaseorderitem` WHERE (purchaseorderitemid='$purchaseorderitemid')";
		$query = mysqli_query($link,$sql) or die ("sql error");
		$userdata = mysqli_fetch_array($query);
		//dbconnect::closeDb();
	}

	public static function updateMember($purchaseorderitemid){
		/* updateMember function is used to update the member details on the database */
		$purchaseorderitemid = $_POST['purchaseorderitemid'];
		$purchaseorderid = $_POST['purchaseorderid'];
		
		
		$productid = $_POST['productid'];
		$quantity = $_POST['quantity'];
		$price = $_POST['price'];
			$sql = "UPDATE `purchaseorderitem` SET purchaseorderitemid ='$purchaseorderitemid', purchaseorderid ='$purchaseorderid', productid ='$productid', price = '$price' WHERE purchaseorderitemid = '$purchaseorderitemid'";
		

		dbconnect::connectDb();
        $link = mysqli_connect("localhost","root","","webdev");
		$query = mysqli_query($link,$sql) or die ("sql error");

		if($query){
		echo "<font color=#00FF00'>Successfully Updated</font>";
		header( "refresh:3; url=purchaseItem.php" );
		}else{
		echo "Error";
		header( "refresh:3; url=purchaseItem.php" );
		}
		//dbconnect::closeDb();
	}

	public static function reportGen(){
		/* reportGen function is used to generate report about the members */
		dbconnect::connectDb();
        $link = mysqli_connect("localhost","root","","webdev");
		$sql = "SELECT * FROM `purchaseorderitem`";
		$query = mysqli_query($link,$sql) or die ("sql error");

		while ($row = mysqli_fetch_array($query)) {
								 echo "<tr>";
								 echo "<td>".$row['purchaseorderitemid']."</td>";
								 echo "<td>".$row['purchaseorderid']."</td>";
								 echo "<td>".$row['productid']."</td>";
								 echo "<td>".$row['quantity']."</td>";
								 echo "<td>".$row['price']."</td>";
								 echo "</tr>";
						 }
		//dbconnect::closeDb();
	}

	public static function userTable(){
		/* memberTable function is used to display member on a table */
		dbconnect::connectDb();
        $link = mysqli_connect("localhost","root","","webdev");
		$sql = "SELECT * FROM `purchaseorderitem`";
		$query = mysqli_query($link,$sql) or die ("sql error");

		while ($row = mysqli_fetch_array($query)) {
								 echo "<tr>";
								 echo "<td>".$row['purchaseorderitemid']."</td>";
								 echo "<td>".$row['purchaseorderid']."</td>";
								 echo "<td>".$row['productid']."</td>";
								 echo "<td>".$row['quantity']."</td>";
								 echo "<td>".$row['price']."</td>";
								 echo "<td><button type='submit' name='select' value='".$row['purchaseorderitemid']."'>Edit</button></td>";
								 echo "<td><button type='submit' name='delete' value='".$row['purchaseorderitemid']." '>Delete</button></td>";
								 echo "</tr>";
						 }
		//dbconnect::closeDb();
	}

}

?>
 