<html>
<head>
	<title>Update info about phone</title>
	<p><a href="pr.php">Home</a></p>
	<p><a href="16a.php">Admin</a></p>
</head>
<body>
<form action="" method="post">
	<p>Update:</p>
	for phone: <input type="text" name="forphone"/>
	subdivision: <input type="text" name="newsubd"/>
	responsible person: <input type="text" name="newworker"/>
	description: <input type="text" name="newdescr"/>
	<input type="submit" name="update" value="Update"/>
</form>
</body>
</html>

<?php
if (isset($_POST['update'])) {
	if (!empty($_POST['forphone'])) {
		$link = mysql_connect('localhost', 'root');
		if (!$link) {
		die('Could not connect:' . mysql_error());
		}
	
		mysql_select_db('student', $link)
		or die("Could not select DB: " . mysql_error());
	
		$forphone=$_POST['forphone'];
		$newsubd=$_POST['newsubd'];
		$newworker=$_POST['newworker'];
		$newdescr=$_POST['newdescr'];
		
		$query0 = "select phone from telephone_directory
		where phone='$forphone'";
		$result0 = mysql_query($query0);
		//определяем присутствуют ли в таблице кортежи с данным номером телефона
		$p=mysql_num_rows($result0);
		if ($p!=0){
			$query1 = "select idsubdivision from subdivisions
			where subdivision='$newsubd'";
			$query2 = "select idworker from workers
			where worker='$newworker'";
			//условие наличия нового значения для поля отдел
			if (!empty($_POST['newsubd'])) {
				$result1 = mysql_query($query1)
				or die(mysql_error());
				$data1 = mysql_fetch_array($result1);
				$s=$data1['idsubdivision'];
				//условие наличия нового значения для поля сотрудник
				if(!empty($_POST['newworker'])){
					$result2 = mysql_query($query2)
					or die(mysql_error());
					$data2 = mysql_fetch_array($result2);
					$w=$data2['idworker'];
					//условие наличия нового значения для поля описание
					if (!empty($_POST['newdescr'])){
						$query = "UPDATE telephone_directory 
						SET idsubdivision=$s, idworker=$w, description='$newdescr'
						WHERE phone=$forphone";
						$result = mysql_query($query)
						or die(mysql_error());
						print "Updated";
					}
					else {
						$query = "UPDATE telephone_directory 
						SET idsubdivision=$s, idworker=$w
						WHERE phone=$forphone";
						$result = mysql_query($query)
						or die(mysql_error());
						print "Updated";
					}
				}
				else {
					if (!empty($_POST['newdescr'])){
						$query = "UPDATE telephone_directory 
						SET idsubdivision=$s, description='$newdescr'
						WHERE phone=$forphone";
						$result = mysql_query($query)
						or die(mysql_error());
						print "Updated";
					}
					else {
						$query = "UPDATE telephone_directory 
						SET idsubdivision=$s
						WHERE phone=$forphone";
						$result = mysql_query($query)
						or die(mysql_error());
						print "Updated";
					}
				}
			}
			else {
				if(!empty($_POST['newworker'])){
					$result2 = mysql_query($query2)
					or die(mysql_error());
					$data2 = mysql_fetch_array($result2);
					$w=$data2['idworker'];
					if (!empty($_POST['newdescr'])){
						$query = "UPDATE telephone_directory 
						SET idworker=$w, description='$newdescr'
						WHERE phone=$forphone";
						$result = mysql_query($query)
						or die(mysql_error());
						print "Updated";
					}
					else {
						$query = "UPDATE telephone_directory 
						SET idworker=$w
						WHERE phone=$forphone";
						$result = mysql_query($query)
						or die(mysql_error());
						print "Updated";
					}
				}
				else {
					if (!empty($_POST['newdescr'])){
						$query = "UPDATE telephone_directory 
						SET description='$newdescr'
						WHERE phone=$forphone";
						$result = mysql_query($query)
						or die(mysql_error());
						print "Updated";
					}
					else {
						print "Please enter new data";
					}
				}
			}
		}
		else {
			print "The number doesn't exist";
		}
		mysql_close($link);
	}	
	else {
		print "The query is empty";
	}
}
?>