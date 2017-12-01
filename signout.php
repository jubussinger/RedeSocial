<?php
	require_once 'funcoes.php';
	session_start();
	deslogar();
	session_destroy();
	header("Location:index.php");
?>