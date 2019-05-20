<html>
<head>
	<p><a href="pr.php">Home</a></p>
	<title>Phonebook of the department</title>
</head>
<body>
<form action="" method="post">
    <input type="text" name="subd"/>
	<input type="submit" name="submit3" value="View list of phones"/>
</form>
</body>
</html>

<?php
if (isset($_POST['submit3'])) {
	$s=$_POST['subd'];
	
	$link = mysql_connect('localhost', 'root');
	if (!$link) {
		die('Could not connect:' . mysql_error());
    }
	mysql_select_db('student', $link)
	or die("Could not select DB: " . mysql_error());
	
	$query = "SELECT phone, subdivision
	FROM telephone_directory INNER JOIN subdivisions
    ON telephone_directory.idsubdivision=subdivisions.idsubdivision
	WHERE subdivision='$s'";
    $result = mysql_query($query)
    or die(mysql_error());
	
	print '<table border="1">';
	print '<thead>';
	print '<tr>';
	print '<th>phone</th>';
	print '<th>subdivision</th>';
	print '</tr>';
	print '</thead>';
	print '<tbody>';
	while($data = mysql_fetch_array($result)){ 
		print '<tr>';
		print '<td>' . $data['phone'] . '</td>';
		print '<td>' . $data['subdivision'] . '</td>';
		print '</tr>';
	}
	print '</tbody>';
	print '</table>';
	
	mysql_close($link);
}
?>