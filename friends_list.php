<?php
//1.データベースに接続する

$dsn = 'mysql:dbname=FriendsDB;host=localhost';
$user = 'root';
$password = 'mangoshake';
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Friend System</title>
</head>
<body>
	お友達リスト
	<?php
		$area_id = $_GET['id'];
		//2.sqlで指令を出す
		$sql = 'SELECT * FROM `friends_tabele` WHERE `area_table_id` = '.$area_id;
		
		$stmt = $dbh->prepare($sql);
		$stmt->execute();

		$sql_gender = 'SELECT * FROM `friends_tabele` WHERE `friends_tabele`.`gender`,COUNT(`friends_tabele`.`gender`)';
        $sql_gender .= AS count_gender FROM (SELECT *,'男'AS gender_type FROM `friends_tabele` UNION SELECT *,'女'FROM `friends_tabele` area_table LEFT 

        $stmt = $dbh->prepare($sql_gender);
		$stmt->execute();


	echo '<ul>';
   while(1){
		$rec = $stmt->fetch(PDO::FETCH_ASSOC);
		if($rec == false){
		   break;
		}
		echo '<li>';
		echo $rec['name'];
		//echo '<td><a href="friends_update.php?name='.$rec.['name']'">'.$rec['name'].'</a></td>';
		// echo '<td><a href="friends_update.php?name='.$rec['name'].'">'.$rec['name'].'</a></td>';
		echo'<input type="button" value="編集" onclick="location.href= \'friends_update.php?id='.$rec['id'].'\'">' ;
		echo '</li>';
       }

       	echo '<ul>';
       	//3.データベースから切断する
		$dbh = null;
		?>
	<br />
	
	<!-- <input type="button" value="編集" onclick="location.href='friends_update.php'">  -->
</body>
</html>


	




