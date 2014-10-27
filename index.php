<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>PHP基礎</title>
</head>
<body>
<!-- 
<table>
<tr>
<td>'id'</td>
<td>'name'</td>
<td>'group'</td>
</tr>
</table> -->

<?php
$dsn = 'mysql:dbname=FriendsDB;host=localhost';
$user = 'root';
$password = 'mangoshake';
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');


//$sql = SELECT area_table.group,area_table.gender_type, COUNT(friends_tabele.gender)AS count_genderFROM (SELECT *,'男'ASgender_typeFROM area_table UNION SELECT *,'女'FROMarea_table)area_table LEFT OUTER JOIN friends_tabeleONfriends_tabele.area_table_id = area_table.id AND friends_tabele.gender = area_table.gender_type GROUP by area_table.gender_type,area_table.groupORDER BY area_table.id



//2.sqlで指令を出す
//$sql = 'SELECT * FROM area_table WHERE1';
$sql = 'SELECT area_table.group, COUNT(friends_tabele.group)AS count_gropeFROM area_table LEFT OUTER JOIN friends_tabeleONfriends_tabele.area_table_id = area_table.id AND friends_tabele.group = area_table.grope GROUP by area_table.grope,area_table.groupORDER BY area_table.id
$stmt = $dbh->prepare($sql);
$stmt->execute();

echo '<table>';

while(1)
{
	$rec = $stmt->fetch(PDO::FETCH_ASSOC);
	if($rec==false)
	{
	  break;
	}

	echo '<tr>';
	echo '<td>'.$rec['id'].'</td>';
	echo '<td><a href="friends_list.php?id='.$rec['id'].'">'.$rec['name'].'</a></td>';
	echo '</tr>';

}
	echo '</table>';

//データベースから切断する
$dbh = null;
?>

</body>
</html>

