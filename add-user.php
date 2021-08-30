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
<title>Add user</title>
</head>

<body>
<h2>Please fill out the information for the new user</h2>

	<?php
	if (empty($_POST)) {
		echo '<form action="'.$_SERVER["PHP_SELF"].'" method="post">
		<p>First Name: <input type="text" name="firstName"></p>
		<p>Last Name: <input type="text" name="lastName"></p>
		<p>Date of birth  - exact format: yyyy-mm-dd: <input type="text" name="dateOfBirth"></p>
		<p>Address: <input type="text" name="address"></p>
		<p>City: <input type="text" name="city"></p>
		<p>Province: <input type="text" name="province"></p>
		<p>Postal Code: <input type="text" name="postalCode"></p>
		<p>User Status: <input type="radio" name="userStatus" value="Patron">Patron</p>
		<p>User Status: <input type="radio" name="userStatus" value="Admin">Admin</p>
		<p>Password: <input type="text" name="pass"></p>

		<input type="submit">
		</form>';
	} else {//UPDATE `users` SET `usrDateOfBirth`='2014-12-02' WHERE usrID=1
		$firstName=mysqli_real_escape_string($link, $_POST['firstName']);
		$lastName=mysqli_real_escape_string($link, $_POST['lastName']);
		$dateOfBirth=$_POST['dateOfBirth'];
		$address=mysqli_real_escape_string($link, $_POST['address']);
		$city=mysqli_real_escape_string($link, $_POST['city']);
		$province=mysqli_real_escape_string($link, $_POST['province']);
		$postalCode=mysqli_real_escape_string($link, $_POST['postalCode']);
		$userStatus=mysqli_real_escape_string($link, $_POST['userStatus']);//Admin/Patron radio
		$pass=mysqli_real_escape_string($link, $_POST['pass']);
		//echo "Date ofbirth: ".$dateOfBirth." post: ".$_POST['dateOfBirth'];
		
		//INSERT INTO `users` (`usrID`, `usrFirstName`, `usrLastName`, `usrDateOfBirth`, `usrAddress`, `usrCity`, `usrProvince`, `usrPostalCode`, `usrStatus`, `usrPass`) VALUES (NULL, 'Erica', 'Ell', '1950-11-09', '59 Fourth', 'Regina', 'SK', 'A4A4A9', 'Admin', 'Ell');
		
		
		$insertUser="INSERT INTO users VALUES(NULL, '$firstName','$lastName', '$dateOfBirth', '$address', '$city', '$province',  '$postalCode', '$userStatus', '$pass')";
		if ($result = @mysqli_query($link, $insertUser)) {
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
		echo "<p>Logout</p>";
		echo "<form method='post' action='index.php'>";
		echo "<input type='submit' value='Log out' name='logout'>";
		echo "</form>";
		//mysqli_free_result($result);
		mysqli_close($link);
	}
	?> 
    <a href="index.php">Home</a><br>
</body>
</html>
