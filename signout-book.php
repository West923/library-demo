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
<title>signout book</title>
<?php
	include ('../../connect/db-connect-bookinfo-phase-2.php');
?>
</head>

<body>

<?php
	//$currentDate=date();
	//echo "<br>".$currentDate."</br>";
	$queryBooked = "SELECT * FROM `loans` WHERE (loanBookID=".$_POST['bookID'].") AND (loanReturned=0)";
	$resultBooked = mysqli_query($link, $queryBooked);//if we find the book and it hasn't been returned we don't let them sign it out.
	if ($data=mysqli_fetch_row($resultBooked)) {
		echo "already signed out out";
	} else {
		if ($_SESSION['userStatus']==="Admin") {
			$query = "INSERT INTO `loans` (`loanID`, `loanDate`, `loanDue`, `loanReturned`, `loanUsrID`, `loanBookID`) VALUES (NULL, CURRENT_DATE(), DATE_ADD(CURRENT_DATE(), INTERVAL 21 day), '0', '".$_POST['userDropdown']."', '".$_POST['bookID']."')";
		} else {
			$query = "INSERT INTO `loans` (`loanID`, `loanDate`, `loanDue`, `loanReturned`, `loanUsrID`, `loanBookID`) VALUES (NULL, CURRENT_DATE(), DATE_ADD(CURRENT_DATE(), INTERVAL 21 day), '0', '".$_SESSION['userID']."', '".$_POST['bookID']."')";
		}
	$result = mysqli_query($link, $query);
	echo "<p>Book successfully signed out</p>";
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
