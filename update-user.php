<?php
session_start();
if (!isset($_SESSION['loggedIn'])) {
	header('Location: index.php');
	//echo"session not set";
}?>
<!doctype html>
<html>
<head>
<?php
	include ('../../connect/db-connect-bookinfo-phase-2.php');
?>
<meta charset="UTF-8">
<title>Update user</title>
</head>

<body>

	<?php
		$usrID=$_POST['usrID'];
		$firstName=mysqli_real_escape_string($link, $_POST['firstName']);
		$lastName=mysqli_real_escape_string($link, $_POST['lastName']);
		$dateOfBirth=$_POST['dateOfBirth'];
		$address=mysqli_real_escape_string($link, $_POST['address']);
		$city=mysqli_real_escape_string($link, $_POST['city']);
		$province=mysqli_real_escape_string($link, $_POST['province']);
		$postalCode=mysqli_real_escape_string($link, $_POST['postalCode']);
		$userStatus=mysqli_real_escape_string($link, $_POST['usrStat']);//Admin/Patron radio
		$pass=mysqli_real_escape_string($link, $_POST['pass']);
		//echo $usrID.$firstName.$lastName.$dateOfBirth.$address.$city.$province.$postalCode.$userStatus.$pass;//test
		//UPDATE `users` SET `usrFirstName`='tim' WHERE `usrID`=7
		$updateUser="UPDATE users SET usrFirstName='".$firstName."',usrLastName='".$lastName."', usrDateOfBirth='".$dateOfBirth."', usrAddress='".$address."', usrCity='".$city."', usrProvince='".$province."',  usrPostalCode='".$postalCode."', usrStatus='".$userStatus."', usrPass='".$pass."' WHERE usrID=".$usrID;
		if ($result = @mysqli_query($link, $updateUser)) {
			echo "<h2>User information</h2>";
			echo '<p>First Name: '.$firstName.'</p>
				<p>Last Name: '.$lastName.'</p>
				<p>dateOfBirth: '.$dateOfBirth.'</p>
				<p>Address: '.$address.'</p>
				<p>City: '.$city.'</p>
				<p>Province: '.$province.'</p>
				<p>Postal '.$postalCode.'</p>
				<p>User Status: '.$userStatus.'</p>
				<p>Password: '.$pass.'</p>';
		} else {
			echo "Error: ".mysqli_error($link);
		}
		
			//$updateUser="UPDATE patrons SET SIN='$SIN', FirstName='$firstName',LastName='$lastName', Address='$address', City='$city', Prov='$province', HomePhone='$phone', PostalCode='$postalCode',ProgDiv='$progDiv', UserLevel='$userLevel', PatStat='$patStat', Comments='$comments', PatEmail='$email', Lates='$lates' WHERE RecID = '$RecID'";
	/*echo $_POST['userEdit'];
	$userID=$_POST['userEdit'];
	$query="SELECT * from user WHERE usrID = ".$userID." LIMIT 1";
	//$deleteEquiptransRecords="DELETE FROM equiptrans WHERE patronID = ".$userSIN;
	//$deletePatronRecord="DELETE FROM patrons WHERE SIN = ".$userSIN;
	$result = mysqli_query($link, $query);
	$data=mysqli_fetch_assoc($result);
	//echo $data['RecID'];
	
		echo '<form action="update-user.php" method="post">
		<p>First Name: <input type="text" name="firstName" value="'.$data['usrFirstName'].'"></p>
		<p>Last Name: <input type="text" name="lastName" value="'.$data['usrLastName'].'"></p>
		<p>Date of birth: <input type="text" name="dateOfBirth" value="'.$data['usrDateOfBirth'].'"></p>
		<p>Address: <input type="text" name="address" value="'.$data['usrAddress'].'""></p>
		<p>City: <input type="text" name="city" value="'.$data['usrCity'].'""></p>
		<p>Province: <input type="text" name="province" value="'.$data['usrProvince'].'""></p>
		<p>Postal Code: <input type="text" name="postalCode" value="'.$data['usrPostalCode'].'""></p>';
		
		echo '<p>user Status: <input type="radio" name="usrStat" value="Patron" ';
		if ($data['usrStatus']==="Patron") {
			echo "checked";
		}
		echo'>Patron</p>
		<p>user status Status: <input type="radio" name="usrStat" value="Admin" ';
		if ($data['ursStatus']==="Admin") {
			echo "checked";
		}
		echo'>Admin</p>
		<p>Pass: <input type="text" name="pass" value="'.$data['usrPass'].'""></p>
		<input type="hidden" name="usrID" value="'.$data['usrID'].'">
		<input type="submit">
		</form>';
	
	*/
	echo "<p>Logout</p>";
	echo "<form method='post' action='index.php'>";
	echo "<input type='submit' value='Log out' name='logout'>";
	echo "</form>";
	//mysqli_free_result($result);
	//mysqli_close($link);
	?> 
    <a href="index.php">Home</a><br>
</body>
</html>
