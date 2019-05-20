<html>
<head>
	<title>Update user's data</title>
	<p><a href="pr.php">Home</a></p>
	<p><a href="16a.php">Admin</a></p>
</head>
<body>
<form action="" method="post">
	login*: <input type="text" name="login"/>
	root(0 or 1)*: <input type="text" name="nroot"/>
	new password: <input type="text" name="npassword"/>
	<input type="submit" name="update" value="Update"/>
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

if (isset($_POST['update'])) {
	if (!empty($_POST['login'])) {
		$login=$_POST['login'];
		$npassword=$_POST['npassword'];
		$nroot=$_POST['nroot'];
		$newpassword=md5($npassword);
		
		$query0 = "SELECT user FROM users
		WHERE user='$login'";
		$result0 = mysql_query($query0);
		$p=mysql_num_rows($result0);
		//условие существования пользователя с введенным логином
		if ($p==1){
			//проверка правильности введенного значения поля root
			if ($nroot == '1' || $nroot == '0') {
				if (!empty($_POST['npassword'])) {
					$query = "UPDATE users
					SET password='$newpassword', root=$nroot 
					WHERE user='$login'";
					$result = mysql_query($query)
					or die(mysql_error());
					print 'Updated';
				}
				else {
					$query = "UPDATE users
					SET root=$nroot 
					WHERE user='$login'";
					$result = mysql_query($query)
					or die(mysql_error());
					print 'Updated';
				}
			}
			else {
				print "<p>Error: the field 'root' can not be empty or diffrent from binary.</p>";
				print "<p>Please enter current or new value.</p>";
				print "<p>1 - for superuser or 0 - for normal user</p>";
			}
		}
		else {
			print "No info about user '$login'";
		}
	}
	else {
		print 'Enter login';
	}
}
$query1 = "SELECT iduser, user, worker, root, lastappearance 
FROM users INNER JOIN workers
ON users.idworker=workers.idworker";
$result1 = mysql_query($query1)
or die(mysql_error());
//вывод обновляемой таблицы пользователей системы с указанием прав доступа	
print '<table border="1" rules="all">';
print '<thead>';
print '<tr>';
print '<th>id</th>';
print '<th>login</th>';
print '<th>worker</th>';
print '<th>root</th>';
print '<th>last_appearance</th>';
print '</tr>';
print '</thead>';
print '<tbody>';
while($data1 = mysql_fetch_array($result1)){ 
    print '<tr>';
    print '<td>' . $data1['iduser'] . '</td>';
	print '<td>' . $data1['user'] . '</td>';
	print '<td>' . $data1['worker'] . '</td>';
	print '<td>' . $data1['root'] . '</td>';
	print '<td>' . $data1['lastappearance'] . '</td>';
    print '</tr>';
}
print '</tbody>';
print '</table>';
mysql_close($link);
?>