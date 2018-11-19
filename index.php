<?php 
if (!empty($_POST['query']))
	include('query.php');

if (isset($_GET['log'])){
	include ('log.php');
	exit;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Тестовое задание</title>
	<link rel="stylesheet" type="text/css" href="style.css"/>
	<meta charset="utf-8"/>
</head>
<body>
	<div class="content">
		<form>
			<div v-if="error" class="error-block">{{error}}</div>
			<input v-model="textjob" type="text" placeholder="Новая задача" /> 
			<button @click.prevent="sendNewTask">добавить задачу</button>
		</form>
		<a href="?log">Лог операций</a>
		<table v-if='list' border="1">
			<thead>
				<tr>
					<th>Номер записи</th>
					<th>Текст</th>
					<th>Удалить</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="(l,key) in list">
					<td>{{key+1}}</td>
					<td>{{l.name}}</td>
					<td><button @click="itemRemove(l.id);">Бахнуть!</button></td>
				</tr>
			</tbody>
		</table>

	</div>
	<script type="text/javascript" defer="defer" src="https://ru.vuejs.org/js/vue.js"></script>
	<script type="text/javascript" defer="defer" src="axios.min.js"></script>
	<script type="text/javascript" defer="defer" src="script.js"></script>
</body>
</html>