<?php
class commonFunc3{
	/* this class contains all the functions necessary to this system */
	public static function saveUser(){

		$id = $_POST['productid'];
		$name = $_POST['name'];
		$description = $_POST['description'];
		
		$price = $_POST['price'];
		
		$supid = $_POST['supplierid'];
		
		

		
		

		dbconnect::connectDb();
        $link = mysqli_connect("localhost","root","","webdev");
		$sql = "INSERT INTO product (productid,name,description,price,supplierid) VALUES ('$id','$name','$description','$price','$supid')";
		$query = mysqli_query($link,$sql) or die ("sql error");

		if($query){
		echo "Successfully saved";
		header( "refresh:3; url=product.php" );
		}else{
		echo "Error";
		header( "refresh:3; url=product.php" );
		}
		//dbconnect::closeDb();
	}

	public static function deleteUser($id){
		/* deleteUser function is used to delete the member details on the database */
		dbconnect::connectDb();
		$sql = "DELETE FROM product WHERE (productid='$id');";
		 $link = mysqli_connect("localhost","root","","webdev");
		$query = mysqli_query($link,$sql) or die ("sql error");
		if($query){
		echo "Successfully Deleted";
		header( "refresh:3; url=product.php" );
		}else{
		echo "Error";
		header( "refresh:3; url=product.php" );
		}
		//dbconnect::closeDb();
	}

	public static function selectMember($id){
		/* selectMember function is used to select the member details from the database and show them on the form */
		dbconnect::connectDb();
        $link = mysqli_connect("localhost","root","","webdev");
		$sql = "SELECT * FROM product WHERE (productid='$id')";
		$query = mysqli_query($link,$sql) or die ("sql error");
		$userdata = mysqli_fetch_array($query);
		//dbconnect::closeDb();
	}

	public static function updateMember($id){
		/* updateMember function is used to update the member details on the database */
		$id = $_POST['productid'];
		$name = $_POST['name'];
		$description = $_POST['description'];
		
		
		$price = $_POST['price'];
		
		$supid = $_POST['supplierid'];
		
		
		

		
		

		
			$sql = "UPDATE product SET productid = '$id',name ='$name', price ='$price', supplierid ='$supid', description = '$description' WHERE productid = '$id'";
		

		dbconnect::connectDb();
        $link = mysqli_connect("localhost","root","","webdev");
		$query = mysqli_query($link,$sql) or die ("sql error");

		if($query){
		echo "<font color=#00FF00'>Successfully Updated</font>";
		header( "refresh:3; url=product.php" );
		}else{
		echo "Error";
		header( "refresh:3; url=product.php" );
		}
		//dbconnect::closeDb();
	}

	public static function reportGen(){
		/* reportGen function is used to generate report about the members */
		dbconnect::connectDb();
        $link = mysqli_connect("localhost","root","","webdev");
		$sql = "SELECT * FROM product";
		$query = mysqli_query($link,$sql) or die ("sql error");

		while ($row = mysqli_fetch_array($query)) {
								 echo "<tr>";

								 echo "<td>".$row['productid']."</td>";
								 echo "<td>".$row['name']."</td>";
								 echo "<td>".$row['description']."</td>";
								 echo "<td>".$row['price']."</td>";
								 echo "<td>".$row['supplierid']."</td>";
								 
								 
								
								 echo "</tr>";
						 }
		//dbconnect::closeDb();
	}

	public static function userTable(){
		/* memberTable function is used to display member on a table */
		dbconnect::connectDb();
        $link = mysqli_connect("localhost","root","","webdev");
		$sql = "SELECT * FROM product";
		$query = mysqli_query($link,$sql) or die ("sql error");

		while ($row = mysqli_fetch_array($query)) {
								 echo "<tr>";
								 echo "<td>".$row['productid']."</td>";
								 echo "<td>".$row['name']."</td>";
								 echo "<td>".$row['description']."</td>";
								 echo "<td>".$row['price']."</td>";
								 echo "<td>".$row['supplierid']."</td>";
								 echo "<td><button type='submit' name='select' value='".$row['productid']."'>Edit</button></td>";
								 echo "<td><button type='submit' name='delete' value='".$row['productid']." '>Delete</button></td>";
								 echo "</tr>";
						 }
		//dbconnect::closeDb();
	}

}

?>
 