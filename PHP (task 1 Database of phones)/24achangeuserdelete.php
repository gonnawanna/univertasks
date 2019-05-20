<html>
<head>
	<title>Delete user</title>
	<p><a href="pr.php">Home</a></p>
	<p><a href="16a.php">Admin</a></p>
</head>
<body>
<form action="" method="post">
	<b>Delete</b> user: <input type="text" name="deluser"/>
	<input type="submit" name="delete" value="OK"/>
</form>
</body>
</html>

<?php
$link = mysql_connect('localhost', 'root');
if (!$link) {
    die('Could not connect:' . mysql_error());
}
mysql_select_db('student', $link)
or die("Could not select DB: " . mysql_error());
	
if (isset($_POST['delete'])) {
	$deluser=$_POST['deluser'];
	
	$query = "DELETE FROM users
	WHERE user='$deluser'";
	$result = mysql_query($query)
    or die(mysql_error());
	
	echo $query;
	print '&nbsp;is executed';
}
$query1 = "SELECT user, worker, root 
FROM users INNER JOIN workers
ON users.idworker=workers.idworker
GROUP BY root, worker, user";
$result1 = mysql_query($query1)
or die(mysql_error());
print '<table border="1" rules="all">';
print '<thead>';
print '<tr>';
print '<th>users</th>';
print '<th>workers</th>';
print '<th>root</th>';
print '</tr>';
print '</thead>';
print '<tbody>';
while($data1 = mysql_fetch_array($result1)){ 
    print '<tr>';
    print '<td>' . $data1['user'] . '</td>';
	print '<td>' . $data1['worker'] . '</td>';
	print '<td>' . $data1['root'] . '</td>';
    print '</tr>';
}
print '</tbody>';
print '</table>';
mysql_close($link);
?>