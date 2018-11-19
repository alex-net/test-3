<?php 
$ret=['s'=>'ok'];
include ('db.php');
// запрос данных лога .. 
$q=$pdo->query('select * from log');
$q=$q->fetchAll(PDO::FETCH_ASSOC);
$operset=['added'=>'Добавлена','killed'=>'Удалена'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>Лог</title>
	<link rel="stylesheet" type="text/css" href="style.css"/>
	<meta charset="utf-8"/>
</head>
<body>
	<div class="content">
		<h2>Лог</h2>	
		<table border="1">
			<tr><th>Дата</th><th>Ip</th><th>Операция</th></tr>
			<?php foreach($q as $v):?>
				<tr>
					<td><?=$v['date']?></td>
					<td><?=$v['ip'];?></td>
					<td><?=$operset[$v['action']];?></td></tr>
			<?php endforeach;?>
		</table>
	</div>
</body>
</html>