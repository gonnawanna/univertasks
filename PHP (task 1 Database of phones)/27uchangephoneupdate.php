<?php
session_start();
if (isset($_POST['update'])) {
	$who=$_SESSION['loginas'];
	$phn=$_POST['forphone'];
	$upds=$_POST['updsubdivision'];
	$updd=$_POST['upddescription'];
	if (!empty($_POST['forphone'])) {
		$link = mysql_connect('localhost', 'root');
		if (!$link) {
			die('Could not connect:' . mysql_error());
		}
		mysql_select_db('student', $link)
		or die("Could not select DB: " . mysql_error());
		
		$query1 = "SELECT idworker FROM telephone_directory
		WHERE phone='$phn'";
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
		
		$query3 = "SELECT idsubdivision FROM subdivisions
		WHERE subdivision='$upds'";
		$result3 = mysql_query($query3)
		or die(mysql_error());
		$data3 = mysql_fetch_array($result3);
		$subd=$data3['idsubdivision'];
		
		//проверка совпадения идентификатора текущего пользователя и идентификатора лица, ответственного за данный номер
		if ($name1 == $name2) {
			if (empty($_POST['updsubdivision'])) {
				$query5 = "UPDATE telephone_directory
				SET description='$updd'
				WHERE phone=$phn";
				$result5 = mysql_query($query5)
				or die(mysql_error());
	
				print 'Updated';
				
			}
			else {
				$query4 = "UPDATE telephone_directory
				SET description='$updd', idsubdivision='$subd'
				WHERE phone=$phn";
				$result4 = mysql_query($query4)
				or die(mysql_error());
	
				print 'Updated';
				
			}
		}
		else {
			print "You have not right to update data for this phone";
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
	<title>Change info about one of my phones</title>
	<p><a href="pr.php">Home</a></p>
	<p><a href="25u.php">Menu</a></p>
</head>
<body>
<form action="" method="post">
	for phone: <input type="text" name="forphone"/>
	update subdivision:	<input type="text" name="updsubdivision"/>
	update description: <input type="text" name="upddescription"/>
	<input type="submit" name="update" value="Update"/>
</form>
</body>
</html>