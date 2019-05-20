<html>
<head>
	<title>Insert phone into database</title>
	<p><a href="pr.php">Home</a></p>
	<p><a href="16a.php">Admin</a></p>
</head>
<body>
<form action="" method="post">
	<p>worker:<br><input type="text" name="wnamenew"/></p>
	<p>subdivision:<br><input type="text" name="snamenew"/></p>
	<p>phone:<br><input type="text" name="phonenew"/></p>
	<p>description:<br><input type="text" name="descrnew"/></p>
	<p><input type="submit" name="input" value="Input"/></p>
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
	
	//автоматически задаваемый id 
	$idnew= mysql_insert_id ($link);
	$wnamenew=$_POST['wnamenew'];
	$snamenew=$_POST['snamenew'];
	$phonenew=$_POST['phonenew'];
	$descrnew=$_POST['descrnew'];
	//выполняем запрос к базе данных, чтобы узнать id введённого в форму имени работника
	$query1 = "SELECT idworker FROM workers
	WHERE worker='$wnamenew'";
    $result1 = mysql_query($query1)
    or die(mysql_error());
	$data1 = mysql_fetch_array($result1);
	$w=$data1['idworker'];
	
	$query2 = "SELECT idsubdivision FROM subdivisions
	WHERE subdivision='$snamenew'";
    $result2 = mysql_query($query2)
    or die(mysql_error());
	$data2 = mysql_fetch_array($result2);
	$s=$data2['idsubdivision'];
	
	$query = "INSERT INTO telephone_directory
	VALUES ($idnew, '$w', '$s', '$phonenew', '$descrnew')";
    $result = mysql_query($query)
    or die("The lack of data:". mysql_error());
	
	print 'Success';
	
	mysql_close($link);
}
?>