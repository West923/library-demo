<?php
session_start();

if ($_SESSION['loggedIn']&&$_POST['logout']=='Log out'){
	echo "You have logged out";
	$_SESSION['loggedIn']=false;
	$_SESSION['userID']=0;
	$_SESSION['userStatus']="";
	session_destroy();
	setcookie($_COOKIE['PHPSESSID'], "", time() - 3600);
}

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Index</title>
<?php
	include ('../../connect/db-connect-bookinfo-phase-2.php');
?>
</head>

<body>

<?php

//testing database
	//$fields=$_POST['field-names'];
	$query = "SELECT * FROM users";
	$result = mysqli_query($link, $query);
	while ($data=mysqli_fetch_row($result)) {
		if (($_POST['userName']===$data[0])&&($_POST['pass']===$data[9])) {
			//echo $_POST['userName']."==".$data[0];//testing
			//echo $_POST['pass']."==".$data[9];//testing
			echo "<p>Welcome back, ".$data[1]."</p><br>";
			$_SESSION['loggedIn']=true;
			$_SESSION['userID']=$data[0];
			$_SESSION['userStatus']=$data[8];
		}
	}
//


	if(!$_SESSION['loggedIn']){
		echo "<h2>Please login</h2>";
		echo "<form method='post' action='".$_SERVER['PHP-SELF']."'>";
		echo "<li><p>User ID:</p><label><input type='text' name='userName'></label></li>";//the unique user
		echo "<li><p>Pass:</p><label><input type='text' name='pass'></label></li>";
		echo "<input type='submit' value='submit' name='submit'>";
		echo "</form>";
		echo "<br><p>note: userID is the primary key of users table. eg: user/pass: 1/Alice or 4/admin</p>";
	} else {
		if ($_SESSION['userStatus']==="Admin") {
			echo "<h3>Administrative status</h3>";
		}
		echo "<h2>Search</h2>";
		echo "<form method='post' action='search-results.php'>";
		echo "<p>Search:</p><label><input type='text' name='searchTerm'></label><br>";
		echo "<label><input type='radio' name='searchType' value='author' checked>By author</label><br>"; 
        echo "<label><input type='radio' name='searchType' value='title'>By title</label><br>";
		echo "<input type='submit' value='submit' name='submitSearch'>";
		echo "</form>";
		echo "<br><p>Logout</p>";
		echo "<form method='post' action='".$_SERVER['PHP-SELF']."'>";
		echo "<input type='submit' value='Log out' name='logout'>";
	}

	
?>
<br>
<a href="index.php">Home</a><br>
<a href="return-book.php">Return a book</a><br><br><br><br><br><br><br><br><br><br><br><br><br>
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