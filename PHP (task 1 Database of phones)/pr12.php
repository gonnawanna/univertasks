<html>
<head>
	<title>Phone card</title>
	<p><a href="pr.php">Home</a></p>
</head>
<body>
<form action="" method="post">
    <input type="text" name="aboutphone"/>
	<input type="submit" name="submit2" value="View phone card"/>
</form>
</body>
</html>

<?php
//запуск действия при нажатии кнопки отправки данных
if (isset($_POST['submit2'])) {
	$number=$_POST['aboutphone'];
	
	$link = mysql_connect('localhost', 'root');
	if (!$link) {
		die('Could not connect:' . mysql_error());
    }
	mysql_select_db('student', $link)
	or die("Could not select DB: " . mysql_error());
	
	$query = "SELECT phone, description, subdivision, worker
	FROM telephone_directory INNER JOIN subdivisions INNER JOIN workers
    ON telephone_directory.idworker=workers.idworker AND telephone_directory.idsubdivision=subdivisions.idsubdivision
	WHERE phone=$number";
    $result = mysql_query($query)
    or die(mysql_error());
	
	print '<table border="1">';
	print '<thead>';
	print '<tr>';
	print '<th>phone</th>';
	print '<th>subdivision</th>';
	print '<th>description</th>';
	print '<th>responsible</th>';
	print '</tr>';
	print '</thead>';
	print '<tbody>';
    //выводим в HTML-таблицу все данные клиентов из таблицы MySQL
	while($data = mysql_fetch_array($result)){ 
		print '<tr>';
		print '<td>' . $data['phone'] . '</td>';
		print '<td>' . $data['subdivision'] . '</td>';
		print '<td>' . $data['description'] . '</td>';
		print '<td>' . $data['worker'] . '</td>';
		print '</tr>';
	}
	print '</tbody>';
	print '</table>';
	
	mysql_close($link);
}
?>