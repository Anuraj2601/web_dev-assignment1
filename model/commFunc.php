<?php
class commonFunc{
	/* this class contains all the functions necessary to this system */
	public static function saveUser(){
		/* saveUser function is used to save the member details on the database */
		/* data received from the form are assigned to variables */
		$name = $_POST['name'];
		$address = $_POST['address'];
		$gender = $_POST['gender'];
		$date = $_POST['date'];
		$phone = $_POST['phone'];
		$nic = $_POST['nic'];
		$email = $_POST['email'];
		$country = $_POST['country'];
		$username = $_POST['username'];
		$pass = $_POST['pass'];
		if(isset($_POST['reading'])){
			$reading = 1;
		}else{
			$reading = 0;
		}
		if(isset($_POST['movies'])){
			$movies = 1;
		}else{
			$movies = 0;
		}
		if(isset($_POST['other'])){
			$other = 1;
		}else{
			$other = 0;
		}

		//Image upload

		$file = rand(1000,100000)."-".$_FILES['photo']['name'];
    $file_loc = $_FILES['photo']['tmp_name'];
		$folder="photos/";

		move_uploaded_file($file_loc,$folder.$file);

		dbconnect::connectDb();
        $link = mysqli_connect("localhost","root","","webdev");
		$sql = "INSERT INTO user (name, address, gender, date, phone, nic, email, country, reading, movie, other, username, password, photo) VALUES ('$name','$address', '$gender', '$date', '$phone','$nic','$email', '$country', '$reading', '$movies', '$other', '$username', '$pass', '$file');";
		$query = mysqli_query($link,$sql) or die ("sql error");

		if($query){
		echo "Successfully saved";
		header( "refresh:3; url=members.php" );
		}else{
		echo "Error";
		header( "refresh:3; url=members.php" );
		}
		//dbconnect::closeDb();
	}

	public static function deleteUser($id){
		/* deleteUser function is used to delete the member details on the database */
		dbconnect::connectDb();
		$sql = "DELETE FROM user WHERE (autoid='$id');";

		$query = mysqli_query($link,$sql) or die ("sql error");
		if($query){
		echo "Successfully Deleted";
		header( "refresh:3; url=members.php" );
		}else{
		echo "Error";
		header( "refresh:3; url=members.php" );
		}
		//dbconnect::closeDb();
	}

	public static function selectMember($id){
		/* selectMember function is used to select the member details from the database and show them on the form */
		dbconnect::connectDb();
        $link = mysqli_connect("localhost","root","","webdev");
		$sql = "SELECT * FROM user WHERE (autoid='$id')";
		$query = mysqli_query($link,$sql) or die ("sql error");
		$userdata = mysqli_fetch_array($query);
		//dbconnect::closeDb();
	}

	public static function updateMember($id){
		/* updateMember function is used to update the member details on the database */
		$name = $_POST['name'];
		$address = $_POST['address'];
		$gender = $_POST['gender'];
		$date = $_POST['date'];
		$phone = $_POST['phone'];
		$nic = $_POST['nic'];
		$email = $_POST['email'];
		$country = $_POST['country'];
		$username = $_POST['username'];
		$pass = $_POST['pass'];
		if(isset($_POST['reading'])){
			$reading = 1;
		}else{
			$reading = 0;
		}
		if(isset($_POST['movies'])){
			$movies = 1;
		}else{
			$movies = 0;
		}
		if(isset($_POST['other'])){
			$other = 1;
		}else{
			$other = 0;
		}

		//Image upload

		$file = rand(1000,100000)."-".$_FILES['photo']['name'];
    $file_loc = $_FILES['photo']['tmp_name'];
		$folder="photos/";

		if($file_size==0||$file_size==null){
			$sql = "UPDATE user SET name ='$name', address = '$address', gender ='$gender', date='$date', phone ='$phone', nic ='$nic', email ='$email', country = '$country', password = '$pass', username = '$username', reading = '$reading', movie = '$movies', other = '$other' WHERE autoid = '$id'";
		}else{
			move_uploaded_file($file_loc,$folder.$file);
			$sql = "UPDATE user SET name ='$name', address = '$address', gender ='$gender', date='$date', phone ='$phone', nic ='$nic', email ='$email', country = '$country', password = '$pass', username = '$username', reading = '$reading', movie = '$movies', other = '$other', photo = '$file' WHERE autoid = '$id'";
		}

		dbconnect::connectDb();
        $link = mysqli_connect("localhost","root","","webdev");
		$query = mysqli_query($link,$sql) or die ("sql error");

		if($query){
		echo "<font color=#00FF00'>Successfully Updated</font>";
		header( "refresh:3; url=members.php" );
		}else{
		echo "Error";
		header( "refresh:3; url=members.php" );
		}
		//dbconnect::closeDb();
	}

	public static function reportGen(){
		/* reportGen function is used to generate report about the members */
		dbconnect::connectDb();
        $link = mysqli_connect("localhost","root","","webdev");
		$sql = "SELECT * FROM user";
		$query = mysqli_query($link,$sql) or die ("sql error");

		while ($row = mysqli_fetch_array($query)) {
								 echo "<tr>";
								 echo "<td>".$row['name']."</td>";
								 echo "<td>".$row['address']."</td>";
								 echo "<td>".$row['gender']."</td>";
								 echo "<td>".$row['date']."</td>";
								 echo "<td>".$row['phone']."</td>";
								 echo "<td>".$row['nic']."</td>";
								 echo "<td>".$row['email']."</td>";
								 echo "<td>".$row['country']."</td>";
								 $hobby = "";
								 if($row['reading']==1){
									 $hobby = $hobby. "<li> Reading </li>";
								 }
								 if($row['movie']==1){
									 $hobby  = $hobby. "<li> Watching movies </li>";
								 }
								 if($row['other']==1){
									 $hobby  = $hobby. "<li> Others </li>";
								 }

								 echo "<td><ul>".$hobby."</ul></td>";
								 echo "<td><img src='photos/".$row['photo']."' width = '100px' alt='No Image'/></td>";
								 echo "</tr>";
						 }
		//dbconnect::closeDb();
	}

	public static function memberTable(){
		/* memberTable function is used to display member on a table */
		dbconnect::connectDb();
        $link = mysqli_connect("localhost","root","","webdev");
		$sql = "SELECT * FROM user";
		$query = mysqli_query($link,$sql) or die ("sql error");

		while ($row = mysqli_fetch_array($query)) {
								 echo "<tr>";
								 echo "<td>".$row['autoid']."</td>";
								 echo "<td>".$row['name']."</td>";
								 echo "<td>".$row['address']."</td>";
								 echo "<td>".$row['gender']."</td>";
								 echo "<td>".$row['phone']."</td>";
								 echo "<td>".$row['nic']."</td>";
								 echo "<td>".$row['email']."</td>";
								 echo "<td><button type='submit' name='select' value='".$row['autoid']."'>Edit</button></td>";
								 echo "<td><button type='submit' name='delete' value='".$row['autoid']." '>Delete</button></td>";
								 echo "</tr>";
						 }
		//dbconnect::closeDb();
	}

}

?>
