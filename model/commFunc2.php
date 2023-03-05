<?php
class commonFunc2{
	/* this class contains all the functions necessary to this system */
	public static function saveUser(){

		$id = $_POST['supplierid'];
		$name = $_POST['name'];
		$address = $_POST['address'];
		
		$phone = $_POST['phone'];
		
		$email = $_POST['email'];
		
		

		
		

		dbconnect::connectDb();
        $link = mysqli_connect("localhost","root","","webdev");
		$sql = "INSERT INTO supplier (supplierid,name,address,phone,email) VALUES ('$id','$name','$address','$phone','$email')";
		$query = mysqli_query($link,$sql) or die ("sql error");

		if($query){
		echo "Successfully saved";
		header( "refresh:3; url=supplier.php" );
		}else{
		echo "Error";
		header( "refresh:3; url=supplier.php" );
		}
		//dbconnect::closeDb();
	}

	public static function deleteUser($id){
		/* deleteUser function is used to delete the member details on the database */
		dbconnect::connectDb();
		$sql = "DELETE FROM supplier WHERE (supplierid='$id');";
		 $link = mysqli_connect("localhost","root","","webdev");
		$query = mysqli_query($link,$sql) or die ("sql error");
		if($query){
		echo "Successfully Deleted";
		header( "refresh:3; url=supplier.php" );
		}else{
		echo "Error";
		header( "refresh:3; url=supplier.php" );
		}
		//dbconnect::closeDb();
	}

	public static function selectMember($id){
		/* selectMember function is used to select the member details from the database and show them on the form */
		dbconnect::connectDb();
        $link = mysqli_connect("localhost","root","","webdev");
		$sql = "SELECT * FROM supplier WHERE (supplierid='$id')";
		$query = mysqli_query($link,$sql) or die ("sql error");
		$userdata = mysqli_fetch_array($query);
		//dbconnect::closeDb();
	}

	public static function updateMember($id){
		/* updateMember function is used to update the member details on the database */
		$name = $_POST['name'];
		$address = $_POST['address'];
		
		
		$phone = $_POST['phone'];
		
		$email = $_POST['email'];
		
		
		

		
		

		
			$sql = "UPDATE supplier SET supplierid = '$id',name ='$name', phone ='$phone', email ='$email', address = '$address' WHERE supplierid = '$id'";
		

		dbconnect::connectDb();
        $link = mysqli_connect("localhost","root","","webdev");
		$query = mysqli_query($link,$sql) or die ("sql error");

		if($query){
		echo "<font color=#00FF00'>Successfully Updated</font>";
		header( "refresh:3; url=supplier.php" );
		}else{
		echo "Error";
		header( "refresh:3; url=supplier.php" );
		}
		//dbconnect::closeDb();
	}

	public static function reportGen(){
		/* reportGen function is used to generate report about the members */
		dbconnect::connectDb();
        $link = mysqli_connect("localhost","root","","webdev");
		$sql = "SELECT * FROM supplier";
		$query = mysqli_query($link,$sql) or die ("sql error");

		while ($row = mysqli_fetch_array($query)) {
								 echo "<tr>";
								 echo "<td>".$row['supplierid']."</td>";
								 echo "<td>".$row['name']."</td>";
								 echo "<td>".$row['address']."</td>";
								 echo "<td>".$row['phone']."</td>";
								 echo "<td>".$row['email']."</td>";
								 
								 
								
								 echo "</tr>";
						 }
		//dbconnect::closeDb();
	}

	public static function userTable(){
		/* memberTable function is used to display member on a table */
		dbconnect::connectDb();
        $link = mysqli_connect("localhost","root","","webdev");
		$sql = "SELECT * FROM supplier";
		$query = mysqli_query($link,$sql) or die ("sql error");

		while ($row = mysqli_fetch_array($query)) {
								 echo "<tr>";
								 echo "<td>".$row['supplierid']."</td>";
								 echo "<td>".$row['name']."</td>";
								 echo "<td>".$row['address']."</td>";
								 echo "<td>".$row['phone']."</td>";
								 echo "<td>".$row['email']."</td>";
								 echo "<td><button type='submit' name='select' value='".$row['supplierid']."'>Edit</button></td>";
								 echo "<td><button type='submit' name='delete' value='".$row['supplierid']." '>Delete</button></td>";
								 echo "</tr>";
						 }
		//dbconnect::closeDb();
	}

}

?>
 