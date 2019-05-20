<?php
//запускаем сессию php
session_start();
?>

<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title>Log in</title>
	<p><a href="pr.php">Home</a></p>
</head>
<body>
<form action="" method="post" >
	<p>Login: &nbsp; &nbsp; &nbsp; <input  type="text" name="login"/></p>
	<p>Password: <input type="text" name="password"/></p>
	<p><input type="submit" name="enter" value="Log in"/></p>
</form>
</body>
</html>

<?php
//сохраняем имя пользователя в глобальном массиве
$_SESSION['loginas'] = $_POST['login'];
//определяем пременную, хранящую текущее время в заданном фомате
$t=date("Y-m-d H:i:s");
if (isset ($_POST['enter'])){
	$log=$_POST['login'];
	$pas=$_POST['password'];
	$password=md5($pas);
	
	$link = mysql_connect('localhost', 'root');
	if (!$link) {
		die('Could not connect:' . mysql_error());
    }
	
	mysql_select_db('student', $link)
	or die("Could not select DB: " . mysql_error());
	
	$query1 = "SELECT password FROM users
	WHERE user='$log'";
    $result1 = mysql_query($query1)
    or die(mysql_error());
	$data1 = mysql_fetch_array($result1);
	$p1=$data1['password'];
	
	$query2 = "SELECT root FROM users
	WHERE user='$log'";
    $result2 = mysql_query($query2)
    or die(mysql_error());
	$data2 = mysql_fetch_array($result2);
	$r=$data2['root'];
	
	//сравниваем хеш введенного пароля с хешом, хранящимся в базе
	if ($p1==$password){
		print "<i>You entered as&nbsp;</i>";
		echo $_SESSION['loginas'];
		print ".&nbsp;";
		
		//обновляем время последнего доступа к системе для текущего пользователя
		$query3 = "UPDATE users
		SET lastappearance = '$t'
		WHERE user='$log'";
		$result3 = mysql_query($query3)
		or die(mysql_error());
		
		//определяем условие суперпользователя
		if ($r==1) {
			$file1 = file_get_contents("16a.php");
			echo $file1;
		}
		//определяем условие обычного пользователя
		elseif ($r==0) {
			$file2 = file_get_contents("25u.php");
			echo $file2;
		}
	}
	else {
		print 'Incorrect';
	}
}
?>