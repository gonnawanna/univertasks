<html>
<head>
	<title>All phones</title>
</head>
<body>
	<p><a href="pr.php">Home</a></p>
</body>
</html>

<?php
//подключение к серверу
$link = mysql_connect('localhost', 'root');
if (!$link) {
    die('Could not connect:' . mysql_error());
}
//подключение к БД
mysql_select_db('student', $link)
	or die("Could not select DB: " . mysql_error());
	
$query = "SELECT subdivision, phone 
FROM telephone_directory INNER JOIN subdivisions
ON telephone_directory.idsubdivision = subdivisions.idsubdivision
GROUP BY subdivision, phone";
$result = mysql_query($query)
	or die(mysql_error());
	
print '<table border="1" rules="all" bordercolor="blue">';
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
//закрываем соединение
mysql_close($link);
?>