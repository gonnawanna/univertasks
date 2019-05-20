<html>
<head>
	<title>Delete info about the phone</title>
	<p><a href="pr.php">Home</a></p>
	<p><a href="16a.php">Admin</a></p>
</head>
<body>
<form action="" method="post">
	<b>Delete</b> info about phone number: <input type="text" name="delphone"/>
	<input type="submit" name="delete" value="OK"/>
</form>
</body>
</html>

<?php
if (isset($_POST['delete'])) {
	$dolphin=$_POST['delphone'];
	
	$link = mysql_connect('localhost', 'root');
	if (!$link) {
		die('Could not connect:' . mysql_error());
    }
	mysql_select_db('student', $link)
	or die("Could not select DB: " . mysql_error());
	
	$query = "DELETE FROM telephone_directory
	WHERE phone=$dolphin";
	$result = mysql_query($query)
    or die(mysql_error());
	echo $query;
	print '&nbsp;is executed';
	
	mysql_close($link);
}
?>