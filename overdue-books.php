<?php
session_start();
if (!isset($_SESSION['loggedIn'])) {
	header('Location: index.php');
	//echo"session not set";
}?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>overdue books</title>
<?php
	include ('../../connect/db-connect-bookinfo-phase-2.php');
?>
</head>

<body>
<h2>Users with overdue books</h2>
<?php
	$query="SELECT DISTINCT usrFirstName, usrLastName FROM loans, users WHERE loans.loanDue<CURRENT_DATE() AND loans.loanUsrID=users.usrID AND loanReturned=0";
	$result = mysqli_query($link, $query);
	while ($data=mysqli_fetch_row($result)) {
			echo "<p>First Name: ".$data[0]."</p>";
			echo "<p>Last Name: ".$data[1]."</p><hr>";
		}
		echo "<p>Logout</p>";
	echo "<form method='post' action='index.php'>";
	echo "<input type='submit' value='Log out' name='logout'>";
	echo "</form>";
?>
<a href="index.php">Home</a><br>
<a href="return-book.php">Return a book</a>

<h2>$_SESSION</h2> 
<pre> 
<?php print_r($_SESSION); ?> 
</pre> 
<h2>$_COOKIE</h2> 
<pre> 
<?php print_r($_COOKIE); ?> 
</pre> 
<?php show_source(__FILE__); ?>
</body>
</html>
