<?php 

if (empty($_POST['query']))
	exit;

$ret=['s'=>'ok'];
include ('db.php');


if ($ret['s']=='ok')
	switch($_POST['query']){
		// запрос списка задач ..
		case 'get-task-list':
			$q=$pdo->query('select * from tasks');
			$q=$q->fetchAll(PDO::FETCH_ASSOC);
			$ret['data']=$q;
		break;
		// добавление новой задачи 
		case 'add-task':
			$q=$pdo->prepare('insert into tasks (name) values (:taskname)');
			$q->execute(['taskname'=>$_POST['name']]);
			$taskid=$pdo->lastInsertId();
			// лог ..
			$q=$pdo->prepare('insert into log (ip,taskid,action) values (?,?,?)');
			$ret['log']=$q->execute([$_SERVER['REMOTE_ADDR'],$taskid,'added']);
		break;
		// удаление предыдущей .. 
		case 'kill-task':
			$q=$pdo->prepare('delete from tasks where id=?');
			$q->execute([$_POST['id']]);
			// лог ..
			$q=$pdo->prepare('insert into log (ip,taskid,action) values (?,?,?)');
			$ret['log']=$q->execute([$_SERVER['REMOTE_ADDR'],$_POST['id'],'killed']);
			if (!$ret['log'])
				$ret['err']=$q->errorinfo();
		break;


	}

header('Content-type:text/json;');
echo json_encode($ret);
exit();
