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
<title>return book</title>
<?php
	include ('../../connect/db-connect-bookinfo-phase-2.php');
?>
</head>

<body>

<?php
	if (!isset($_POST['returnBooks'])){
		if ($_SESSION['userStatus']==="Admin") {
		echo "<p>Admin - Return any user's book</p>";
		$query = "SELECT books.title, loans.loanID FROM books, loans WHERE loanReturned = 0 AND books.bookID=loans.loanBookID";
		} else {
			$query = "SELECT books.title, loans.loanID FROM books, loans WHERE loanUsrID = ".$_SESSION['userID']." AND loanReturned = 0 AND books.bookID=loans.loanBookID";
		}
			
		$result = mysqli_query($link, $query);
		//SELECT DISTINCT books.bookID, books.title FROM books, bookAuthors WHERE bookAuthors.baBookID=books.bookID AND bookAuthors.baAuthorID = ".$authorID;
		echo "<h2>Select the books you would like to return</h2>";
		echo "<form method='post' action='".$_SERVER['PHP-SELF']."'>";
		while ($data=mysqli_fetch_row($result)) {
			echo "<label><input type='radio' name='returnBooks' value='".$data[1]."' />".$data[0]."</label><br>";	
		}//switch it for a radio button
		echo "<input type='submit'></form>";
		echo "<p>Logout</p>";
		echo "<form method='post' action='index.php'>";
		echo "<input type='submit' value='Log out' name='logout'>";
		echo "</form>";
	} else {
		$queryReturn = "UPDATE loans SET loanReturned = 1 WHERE loanID = ".$_POST['returnBooks'];//.$_POST['searchTerm'].
		$resultReturn = mysqli_query($link, $queryReturn);//change loanReturned=1
		echo "<p>Book marked as returned</p>";
		echo "<a href='return-book.php'>Reload</a><br>";
		echo "<p>Logout</p>";
		echo "<form method='post' action='index.php'>";
		echo "<input type='submit' value='Log out' name='logout'>";
		echo "</form>";
		
	}
	
?>
<a href="index.php">Home</a><br>

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