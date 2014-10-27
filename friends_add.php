<?php
//データベースに接続する
$dsn = 'mysql:dbname=FriendsDB;host=localhost';
$user = 'root';
$password = 'mangoshake';
$dbh = new PDO($dsn,$user,$password);
$dbh->query('SET NAMES utf8');

if (isset($_POST['name'])){
	echo 'POST送信された！';
	// インサート文を入れる
	// $id = $_POST['id'];
	$area_table_id = $_POST['area_table_id'];
	$gender = $_POST['gender'];
	$age = $_POST['age'];
	$name = $_POST['name'];

	$sql = 'INSERT INTO friends_tabele (area_table_id,name,gender,age)';
	$sql .='VALUES("'.$area_table_id.'","'.$name.'","'.$gender.'","'.$age.'")';

	$stmt = $dbh->prepare($sql);
	$stmt->execute();

	// すべて処理が終わった後都道府県一覧に戻る
	header('Location: http://'. $_SERVER['HTTP_HOST'].'/friends/index.php');

}else{
	echo 'POST送信されてない！';
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>FriendSystem</title>
</head>
<body>
<?php
	//2.sqlで指令を出す
	$sql = 'SELECT * FROM `area_table`';

	$stmt = $dbh->prepare($sql);
	$stmt->execute();



?>

	<form method="post"action="friends_add.php">
		名前<br/>
		<input name="name" type="text" style="width:100px"><br/>
		出身地<br/>
		<select name="area_table_id">
			<?php
				while(1){
					$rec = $stmt->fetch(PDO::FETCH_ASSOC);
					if ($rec == false){
						break;
					}
					echo '<option value ="'.$rec['id'].'">';
					echo $rec['name'];
					echo '</option>';

				}
			?>
		</select><br />
		性別<br/>
		<select name="gender">
			<option value="男">男性</option>
			<option value="女">女性</option>
		</select> <br/>
		
		年齢<br/>
		<input name="age" type="text" style="width:100px"><br/>
        
        <br/>
		<input type="submit" value="保存"> 
		<input type="submit" value="キャンセル">

	</form>

</body>
</html>


	




