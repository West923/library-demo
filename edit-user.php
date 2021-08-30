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
	$userID=$_POST['userEdit'];
	$query="SELECT * from users WHERE usrID = ".$userID." LIMIT 1";
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
	
	
	echo "<p>Logout</p>";
	echo "<form method='post' action='index.php'>";
	echo "<input type='submit' value='Log out' name='logout'>";
	echo "</form>";
	//mysqli_free_result($result);
	mysqli_close($link);
	?> 
    <a href="index.php">Home</a><br>
</body>
</html>
