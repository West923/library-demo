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
<title>Search results</title>
<?php
	include ('../../connect/db-connect-bookinfo-phase-2.php');
?>
</head>

<body>

<?php
	echo "<h2>Sarch results for ".$_POST['searchTerm']."</h2>";
	if ($_POST['searchType']=="title") {
		$query = "SELECT bookID, title, authorText, isbnThirteen, language, physicalDescription, editionInfo FROM books WHERE title LIKE '%".$_POST['searchTerm']."%'";//.$_POST['searchTerm'].
		$result = mysqli_query($link, $query);
		while ($data=mysqli_fetch_row($result)) {
			echo $data[0];//testing
			echo "<ul><li>Title: ".$data[1]."</li>";
			echo "<li>Author: ".$data[2]."</li>";
			echo "<li>ISBN: ".$data[3]."</li>";
			echo "<li>Language: ".$data[4]."</li>";
			echo "<li>Physical description: ".$data[5]."</li>";
			echo "<li>Edition information: ".$data[6]."</li></ul>";
			echo "<p>Sign out this book</p>";
			echo "<form method='post' action='signout-book.php'>";
			echo "<input type='hidden' name='bookID' value='".$data[0]."'>";
			if ($_SESSION['userStatus']==="Admin") {
				echo "<p>Select user to check out book</p>";
				$queryUsers = "SELECT usrID, usrFirstName, usrLastName FROM users";
				$resultUsers = mysqli_query($link, $queryUsers);
				echo '<select name ="userDropdown">';
				while ($dataUser=mysqli_fetch_row($resultUsers)) {
					echo '<option value="'.$dataUser[0].'">'.$dataUser[1].' '.$dataUser[2].'</option>';
				}
				echo "</select>";
			}
			echo "<input type='submit' value='Sign out' name='signout'></form>";
			if ($_SESSION['userStatus']==="Admin") {
				echo "<p>Admin option: set book condition</p>";
				echo "<form method='post' action='set-condition.php'>";
				echo "<label><input type='radio' name='bookCondition' value='excellent' checked/>Excellent</label><br>";
				echo "<label><input type='radio' name='bookCondition' value='fair'/>Fair</label><br>";
				echo "<label><input type='radio' name='bookCondition' value='poor'/>Poor</label><br>";
				echo "<input type='hidden' name='conditionBookID' value='".$data[0]."'>";
				echo "<input type='submit'></form>";
			}
			echo "<hr>";
			
		}
	} elseif($_POST['searchType']=="author"){
		
		$queryAuthor = "SELECT * FROM authors WHERE CONCAT_WS(' ', authorFirstName, authorLastName) LIKE '%".$_POST['searchTerm']."%' LIMIT 1";
		$resultAuthor = mysqli_query($link, $queryAuthor);
		while ($data=mysqli_fetch_row($resultAuthor)) {
			$authorID=$data[0];
			echo "<h2>Author</h2>";
			echo "<ul><li>First Name: ".$data[1]."</li>";
			echo "<li>Last Name: ".$data[2]."</li>";
			echo "<li>Dates: ".$data[3]."</li>";
			echo "<li>Bio: ".$data[4]."</li></ul>";
		}
		$queryAuthorsBooks = "SELECT DISTINCT books.bookID, books.title FROM books, bookAuthors WHERE bookAuthors.baBookID=books.bookID AND bookAuthors.baAuthorID = ".$authorID;
		$resultAuthorsBooks = mysqli_query($link, $queryAuthorsBooks);
		echo "<h2>Books by this author</h2>";
		while ($data=mysqli_fetch_row($resultAuthorsBooks)) {
			$currentBookID=$data[0];
			echo "<p>Title: ".$data[1]."<p>";
			echo "<p>Sign out this book</p>";
			echo "<form method='post' action='signout-book.php'>";
			echo "<input type='hidden' name='bookID' value='".$data[0]."'>";
			if ($_SESSION['userStatus']==="Admin") {
				echo "<p>Select user to check out book</p>";
				$queryUsers = "SELECT usrID, usrFirstName, usrLastName FROM users";
				$resultUsers = mysqli_query($link, $queryUsers);
				echo '<select name ="userDropdown">';
				while ($data=mysqli_fetch_row($resultUsers)) {
					echo '<option value="'.$data[0].'">'.$data[1].' '.$data[2].'</option>';
				}
				echo "</select>";
			}
			echo "<input type='submit' value='Sign out' name='signout'></form>";
			if ($_SESSION['userStatus']==="Admin") {
				echo "<p>Admin option: set book condition</p>";
				echo "<form method='post' action='set-condition.php'>";
				echo "<label><input type='radio' name='bookCondition' value='excellent' checked/>Excellent</label><br>";
				echo "<label><input type='radio' name='bookCondition' value='fair'/>Fair</label><br>";
				echo "<label><input type='radio' name='bookCondition' value='poor'/>Poor</label><br>";
				echo "<input type='hidden' name='conditionBookID' value='".$currentBookID."'>";	
				echo "<input type='submit'></form>";
			}
			echo "<hr>";
		}
			
	} else {
		echo "error: search type unrecognized";
	}
	//echo "post searchterm=".$_POST['searchTerm'];
	//echo "post searchtype=".$_POST['searchType'];
	echo "<p>Logout</p>";
	echo "<form method='post' action='index.php'>";
	echo "<input type='submit' value='Log out' name='logout'>";
	echo "</form>";
?>
<a href="index.php">Home</a><br>
<a href="return-book.php">Return a book</a>

</body>
</html>
