<?php 
    $task_id = strip_tags( $_POST['task_id'] );
	require_once "../../config/db1.php";
	session_start(); 
    mysql_query("UPDATE task SET progress=100 WHERE task_id = $task_id");
?>