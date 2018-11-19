<?php 
try{
	$pdo=new PDO('pgsql:host=localhost;dbname=test1;port=5432','test1','test1');
}catch(PDOException $e){
	$ret=['s'=>'err','mess'=>$e->getmessage()];
}