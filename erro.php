<!doctype html>  
<html>
	<head>
		<title>ERROR</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" href="./css/error.css"/>
		<link href="https://fonts.googleapis.com/css?family=Barlow+Condensed" rel="stylesheet">

	</head>
	<body>
	<?php
		$erro=$_GET['erro'];
		
		if($erro==1){
	?>
			<div class="erro1">
				<p> Erro de confirmação de senha ou de e-mail</p>
			</div>
		
	<?php
		}elseif($erro==2){
	?>
			<div class="erro">
				<p> Usuário já existente</p>
			</div>
	
	<?php
		}elseif($erro==3){
	?>
			<div class="erro">
				<p> Algum campo não foi preenchido</p>
			</div>	
	<?php
		}elseif($erro=4){
	?>
			<div class="erro">
				<p> Dados inválidos</p>
			</div>
	<?php
		}elseif($erro==5){
	?>
			<div class="erro">
				<p> Dados inválidos</p>
			</div>
	<?php
		}elseif($erro==6){
	?>
			<div class="erro">
				<p> Não está cadastrado ainda</p>
			</div>
	
	<?php
		}elseif($erro==7){
	?>
			<div class="erro">
				<p> Não logado</p>
			</div>
	<?php
		}
	?>
	
		<a href="index.php">Voltar</a>
	</body>
</html>