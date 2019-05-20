<html>
<head>
	<p><a href="pr.php">Home</a></p>
	<title>Phones of the worker</title>
</head>
<body>
<form action="" method="post">
    <input type="text" name="worker"/>
	<input type="submit" name="submit4" value="View list of phones"/>
</form>
</body>
</html>

<?php
if (isset($_POST['submit4'])) {
	$w=$_POST['worker'];
	
	$link = mysql_connect('localhost', 'root');
	if (!$link) {
		die('Could not connect:' . mysql_error());
    }
	mysql_select_db('student', $link)
	or die("Could not select DB: " . mysql_error());
	
	$query = "SELECT phone, worker
	FROM telephone_directory INNER JOIN workers
    ON telephone_directory.idworker=workers.idworker
	WHERE worker='$w'";
	//запуск запроса
    $result = mysql_query($query)
    or die(mysql_error());
	
	print '<table border="1">';
	print '<thead>';
	print '<tr>';
	print '<th>phone</th>';
	print '<th>worker</th>';
	print '</tr>';
	print '</thead>';
	print '<tbody>';
	while($data = mysql_fetch_array($result)){ 
		print '<tr>';
		print '<td>' . $data['phone'] . '</td>';
		print '<td>' . $data['worker'] . '</td>';
		print '</tr>';
	}
	print '</tbody>';
	print '</table>';
	
	mysql_close($link);
}
?>