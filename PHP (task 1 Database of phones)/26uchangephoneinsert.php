<?php
session_start();
if (isset($_POST['input'])) {
	$link = mysql_connect('localhost', 'root');
	if (!$link) {
		die('Could not connect:' . mysql_error());
    }
	mysql_select_db('student', $link)
	or die("Could not select DB: " . mysql_error());
	
	$idnew= mysql_insert_id ($link);
	$who=$_SESSION['loginas'];
	$snamenew=$_POST['snamenew'];
	$phonenew=$_POST['phonenew'];
	$descrnew=$_POST['descrnew'];
	
	$query1 = "SELECT idworker FROM users
	WHERE user='$who'";
    $result1 = mysql_query($query1)
    or die(mysql_error());
	$data1 = mysql_fetch_array($result1);
	$w=$data1['idworker'];
	
	$query2 = "SELECT idsubdivision from subdivisions
	WHERE subdivision='$snamenew'";
    $result2 = mysql_query($query2)
    or die(mysql_error());
	$data2 = mysql_fetch_array($result2);
	$s=$data2['idsubdivision'];
	
	$query = "INSERT INTO telephone_directory
	VALUES ($idnew, '$w', '$s', '$phonenew', '$descrnew')";
    $result = mysql_query($query)
    or die(mysql_error());
	print 'Success';
	
	mysql_close($link);
}
?>

<html>
<head>
	<title>Add new phone</title>
	<p><a href="pr.php">Home</a></p>
	<p><a href="25u.php">Menu</a></p>
</head>
<body>
<form action="" method="post">
	<p>subdivision:<br><input type="text" name="snamenew"/></p>
	<p>phone:<br><input type="text" name="phonenew"/></p>
	<p>description:<br><input type="text" name="descrnew"/></p>
	<p><input type="submit" name="input" value="Input"/></p>
</form>
</body>
</html>
