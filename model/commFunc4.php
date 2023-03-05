<?php
class commonFunc4{
	/* this class contains all the functions necessary to this system */
	public static function saveUser(){
		$orderid = $_POST['orderid'];
		$date = $_POST['date'];
		
		$customerid = $_POST['customerid'];
		
		$amount = $_POST['amount'];
		
		

		
		

		dbconnect::connectDb();
        $link = mysqli_connect("localhost","root","","webdev");
		$sql = "INSERT INTO `order` (orderid,orderdate,customerid,total_amount) VALUES ('$orderid','$date','$customerid','$amount')";
		$query = mysqli_query($link,$sql) or die ("sql error");

		if($query){
		echo "Successfully saved";
		header( "refresh:3; url=order.php" );
		}else{
		echo "Error";
		header( "refresh:3; url=order.php" );
		}
		//dbconnect::closeDb();
	}

	public static function deleteUser($id){
		/* deleteUser function is used to delete the member details on the database */
		dbconnect::connectDb();
		$sql = "DELETE FROM `order` WHERE (orderid='$id');";
		 $link = mysqli_connect("localhost","root","","webdev");
		$query = mysqli_query($link,$sql) or die ("sql error");
		if($query){
		echo "Successfully Deleted";
		header( "refresh:3; url=order.php" );
		}else{
		echo "Error";
		header( "refresh:3; url=order.php" );
		}
		//dbconnect::closeDb();
	}

	public static function selectMember($id){
		/* selectMember function is used to select the member details from the database and show them on the form */
		dbconnect::connectDb();
        $link = mysqli_connect("localhost","root","","webdev");
		$sql = "SELECT * FROM `order` WHERE (orderid='$id')";
		$query = mysqli_query($link,$sql) or die ("sql error");
		$userdata = mysqli_fetch_array($query);
		//dbconnect::closeDb();
	}

	public static function updateMember($id){
		/* updateMember function is used to update the member details on the database */
		$orderid = $_POST['orderid'];
		$date = $_POST['date'];
		
		
		$customerid = $_POST['customerid'];
		
		$amount = $_POST['amount'];
			$sql = "UPDATE `order` SET orderid ='$orderid', orderdate ='$date', customerid ='$customerid', total_amount = '$amount' WHERE orderid = '$id'";
		

		dbconnect::connectDb();
        $link = mysqli_connect("localhost","root","","webdev");
		$query = mysqli_query($link,$sql) or die ("sql error");

		if($query){
		echo "<font color=#00FF00'>Successfully Updated</font>";
		header( "refresh:3; url=order.php" );
		}else{
		echo "Error";
		header( "refresh:3; url=order.php" );
		}
		//dbconnect::closeDb();
	}

	public static function reportGen(){
		/* reportGen function is used to generate report about the members */
		dbconnect::connectDb();
        $link = mysqli_connect("localhost","root","","webdev");
		$sql = "SELECT * FROM `order`";
		$query = mysqli_query($link,$sql) or die ("sql error");

		while ($row = mysqli_fetch_array($query)) {
								 echo "<tr>";
								 echo "<td>".$row['orderid']."</td>";
								 echo "<td>".$row['orderdate']."</td>";
								 echo "<td>".$row['customerid']."</td>";
								 echo "<td>".$row['total_amount']."</td>";
								 echo "</tr>";
						 }
		//dbconnect::closeDb();
	}

	public static function userTable(){
		/* memberTable function is used to display member on a table */
		dbconnect::connectDb();
        $link = mysqli_connect("localhost","root","","webdev");
		$sql = "SELECT * FROM `order`";
		$query = mysqli_query($link,$sql) or die ("sql error");

		while ($row = mysqli_fetch_array($query)) {
								 echo "<tr>";
								 echo "<td>".$row['orderid']."</td>";
								 echo "<td>".$row['orderdate']."</td>";
								 echo "<td>".$row['customerid']."</td>";
								 echo "<td>".$row['total_amount']."</td>";
								 echo "<td><button type='submit' name='select' value='".$row['orderid']."'>Edit</button></td>";
								 echo "<td><button type='submit' name='delete' value='".$row['orderid']." '>Delete</button></td>";
								 echo "</tr>";
						 }
		//dbconnect::closeDb();
	}

}

?>
 