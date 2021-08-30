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

	$query = "UPDATE `books` SET `condition`='".$_POST['bookCondition']."' WHERE bookID=".$_POST['conditionBookID'];
	$result = mysqli_query($link, $query);
	echo "<p>Book condition updated</p>";
	
	
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
<pre> 
<?php print_r($_POST); ?> 
</pre>
<h2>$_COOKIE</h2> 
<pre> 
<?php print_r($_COOKIE); ?> 
</pre> 
<?php show_source(__FILE__); ?>
</body>
</html>
