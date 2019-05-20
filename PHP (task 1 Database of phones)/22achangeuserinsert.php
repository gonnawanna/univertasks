<html>
<head>
	<title>Add user</title>
	<p><a href="pr.php">Home</a></p>
	<p><a href="16a.php">Admin</a></p>
</head>
<body>
<form action="" method="post">
	login: <input type="text" name="newlogin"/>
	password: <input type="text" name="newpassword"/>
	root(0 or 1): <input type="text" name="newroot"/>
	user: <input type="text" name="newuser"/>
	<input type="submit" name="input" value="Input"/>
</form>
</body>
</html>

<?php
if (isset($_POST['input'])) {
	$link = mysql_connect('localhost', 'root');
	if (!$link) {
		die('Could not connect:' . mysql_error());
    }
	mysql_select_db('student', $link)
	or die("Could not select DB: " . mysql_error());
	
	$id= mysql_insert_id ($link);
	$login=$_POST['newlogin'];
	$p=$_POST['newpassword'];
	$root=$_POST['newroot'];
	$u=$_POST['newuser'];
	//записываем в переменную значение зашифрованного пароля
	$password=md5($p);
	
	$query1 = "SELECT idworker FROM workers
	WHERE worker='$u'";
    $result1 = mysql_query($query1)
    or die(mysql_error());
	$data1 = mysql_fetch_array($result1);
	$user=$data1['idworker'];
	
	if ($root == 1 || $root == 0) {
		$query = "INSERT INTO users
		VALUES ($id, '$login', '$password', $user, $root, '2017-01-01 00:00:00')";
		$result = mysql_query($query)
		or die(mysql_error());
	
		print 'Created';
	}
	else {
		print "Error: root can be 1 or 0";
	}
	//echo $query;
	mysql_close($link);
}
?>