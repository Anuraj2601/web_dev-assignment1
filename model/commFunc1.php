<?php
class commonFunc1{
	/* this class contains all the functions necessary to this system */
	public static function saveUser(){

		$id = $_POST['customerid'];
		$name = $_POST['name'];
		$address = $_POST['address'];
		
		$phone = $_POST['phone'];
		
		$email = $_POST['email'];
		
		$username = $_POST['username'];
		$pass = $_POST['pass'];

		
		

		dbconnect::connectDb();
        $link = mysqli_connect("localhost","root","","webdev");
		$sql = "INSERT INTO customer (customerid,name,mobile,email,address, username, password) VALUES ('$id','$name','$phone','$email','$address', '$username', '$pass')";
		$query = mysqli_query($link,$sql) or die ("sql error");

		if($query){
		echo "Successfully saved";
		header( "refresh:3; url=customer.php" );
		}else{
		echo "Error";
		header( "refresh:3; url=customer.php" );
		}
		//dbconnect::closeDb();
	}

	public static function deleteUser($id){
		/* deleteUser function is used to delete the member details on the database */
		dbconnect::connectDb();
		$sql = "DELETE FROM customer WHERE (customerid='$id');";
		 $link = mysqli_connect("localhost","root","","webdev");
		$query = mysqli_query($link,$sql) or die ("sql error");
		if($query){
		echo "Successfully Deleted";
		header( "refresh:3; url=customer.php" );
		}else{
		echo "Error";
		header( "refresh:3; url=customer.php" );
		}
		//dbconnect::closeDb();
	}

	public static function selectMember($id){
		/* selectMember function is used to select the member details from the database and show them on the form */
		dbconnect::connectDb();
        $link = mysqli_connect("localhost","root","","webdev");
		$sql = "SELECT * FROM customer WHERE (customerid='$id')";
		$query = mysqli_query($link,$sql) or die ("sql error");
		$userdata = mysqli_fetch_array($query);
		//dbconnect::closeDb();
	}

	public static function updateMember($id){
		/* updateMember function is used to update the member details on the database */
		$id = $_POST['customerid'];
		$name = $_POST['name'];
		$address = $_POST['address'];
		
		
		$phone = $_POST['phone'];
		
		$email = $_POST['email'];
		
		$username = $_POST['username'];
		$pass = $_POST['pass'];
		

		
		

		
			$sql = "UPDATE customer SET customerid = '$id',name ='$name', mobile ='$phone', email ='$email', address = '$address', password = '$pass', username = '$username' WHERE customerid = '$id'";
		

		dbconnect::connectDb();
        $link = mysqli_connect("localhost","root","","webdev");
		$query = mysqli_query($link,$sql) or die ("sql error");

		if($query){
		echo "<font color=#00FF00'>Successfully Updated</font>";
		header( "refresh:3; url=customer.php" );
		}else{
		echo "Error";
		header( "refresh:3; url=customer.php" );
		}
		//dbconnect::closeDb();
	}

	public static function reportGen(){
		/* reportGen function is used to generate report about the members */
		dbconnect::connectDb();
        $link = mysqli_connect("localhost","root","","webdev");
		$sql = "SELECT * FROM customer";
		$query = mysqli_query($link,$sql) or die ("sql error");

		while ($row = mysqli_fetch_array($query)) {
								 echo "<tr>";
								 echo "<td>".$row['customerid']."</td>";
								 echo "<td>".$row['name']."</td>";
								 echo "<td>".$row['mobile']."</td>";
								 echo "<td>".$row['email']."</td>";
								 echo "<td>".$row['address']."</td>";
								 
								 
								
								 echo "</tr>";
						 }
		//dbconnect::closeDb();
	}

	public static function userTable(){
		/* memberTable function is used to display member on a table */
		dbconnect::connectDb();
        $link = mysqli_connect("localhost","root","","webdev");
		$sql = "SELECT * FROM customer";
		$query = mysqli_query($link,$sql) or die ("sql error");

		while ($row = mysqli_fetch_array($query)) {
								 echo "<tr>";
								 echo "<td>".$row['customerid']."</td>";
								 echo "<td>".$row['name']."</td>";
								 echo "<td>".$row['mobile']."</td>";
								 echo "<td>".$row['email']."</td>";
								 echo "<td>".$row['address']."</td>";
								 echo "<td><button type='submit' name='select' value='".$row['customerid']."'>Edit</button></td>";
								 echo "<td><button type='submit' name='delete' value='".$row['customerid']." '>Delete</button></td>";
								 echo "</tr>";
						 }
		//dbconnect::closeDb();
	}

}

?>
 