<?php
session_start();
if (isset($_POST['delete'])) {
	$who=$_SESSION['loginas'];
	$delphone=$_POST['delphone'];
	if (!empty($_POST['delphone'])) {
		$link = mysql_connect('localhost', 'root');
		if (!$link) {
			die('Could not connect:' . mysql_error());
		}
		mysql_select_db('student', $link)
		or die("Could not select DB: " . mysql_error());
		
		$query1 = "SELECT idworker from telephone_directory
		WHERE phone='$delphone'";
		$result1 = mysql_query($query1)
		or die(mysql_error());
		$data1 = mysql_fetch_array($result1);
		$name1=$data1['idworker'];
		
		$query2 = "SELECT idworker FROM users
		WHERE user='$who'";
		$result2 = mysql_query($query2)
		or die(mysql_error());
		$data2 = mysql_fetch_array($result2);
		$name2=$data2['idworker'];
		
		if ($name1 == $name2) {
			$query = "DELETE FROM telephone_directory
			WHERE phone=$delphone";
			$result = mysql_query($query)
			or die(mysql_error());
		
			print 'The information about the telephone&nbsp;';
			echo $delphone;
			print '&nbsp;is deleted now';
		}
		else {
			print "You have not rights to change data of this phone";
		}
	mysql_close($link);
	}
	else {
		print "Enter number of phone";
	}
}
?>

<html>
<head>
	<title>Delete all information about phone</title>
	<p><a href="pr.php">Home</a></p>
	<p><a href="25u.php">Menu</a></p>
</head>
<body>
<form action="" method="post">
	<b>Delete</b> info about phone number: <input type="text" name="delphone"/>
	<input type="submit" name="delete" value="OK"/>
</form>
</body>
</html>