<?php
	session_start();
	require_once 'funcoes.php';

	if($_SERVER["REQUEST_METHOD"]=="POST"){
		$user=obterUsurLogado();

		$id_amigo= $_POST['id'];

		$id_pessoa = $user['id'];
			
		if($id_amigo==$id_pessoa){
			header("Location: home.php");
			exit();
		}
		else{
			$conexao = mysqli_connect("localhost", "root", "","redeSocial");

			$solicitacao="INSERT INTO amigos VALUES ($id_pessoa, $id_amigo)";

			if (mysqli_query($conexao,$solicitacao)===TRUE){

				mysqli_close($conexao);

				header("Location: home.php");

			} else {
					
				mysqli_close($conexao);
				echo "não foi possivel";
				//header("Location: home.php");
			}
		}
			

	}else{

		if(isset($_SESSION['usuario']) == FALSE && isset($_GET['uid'])== FALSE){

			header('Location: erro.php?erro=7');

		}
		else{

			$user=obterUsurLogado();

		}
	}
?>
<!doctype html>  
<html>
	<head>
		<meta charset="utf-8"/>	
		<link rel="shortcut icon" href="favicon.ico" />
		<title>Página inicial </title>
		<link rel="stylesheet" href="./css/homee.css"/>
		<link href="https://fonts.googleapis.com/css?family=Glegoo" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Quicksand|Raleway" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Quicksand|Raleway" rel="stylesheet">
		<script src="./js/jquery.min.js"></script>
		<script>
			$(function(){
				$("#dados").hide();
				$("#div-amigos").hide();
				$("#dado-nomeSobrenome").click(function(){
					$("#seta-baixo-dados").hide();
					$("#dados").show();
				});
				$("#Ocultar-dados").click(function(){
					$("#seta-baixo-dados").show();
					$("#dados").hide();
				});
				$("#amigos").click(function(){
					$("#seta-baixo-amigos").hide();
					$("#div-amigos").show();
				});
				$("#Ocultar-amigos").click(function(){
					$("#div-amigos").hide();
					$("#seta-baixo-amigos").show();
				});
			
			});
		</script>
	</head>
	<body>
		<div id="topo"> 
			<a href="https://pt.wikipedia.org/wiki/Fotografia"><img src="./img/logo.png" id="topo-logo"/></a> 
			<a id="signout" href="signout.php">Sign Out</a>
		</div>
		<div id="pag-inicial">
	<?php
			if(isset($_SESSION['usuario'])){

				if(isset($_GET['uid'])){
					$conexao = mysqli_connect("localhost", "root", "","redeSocial");

					if(mysqli_connect_errno()){
						header('Location: index.php');
					}

					$idprocurado = $_GET['uid'];

					$confirmacaoUser = "SELECT * FROM perfil WHERE idPerfil = $idprocurado";

					if($resposta = mysqli_query($conexao,$confirmacaoUser)){
						
						$existe= mysqli_affected_rows($conexao);
						
						if($existe == 0){
							header("Location: home.php");
						}
						
						foreach ($resposta as $dado) {
							$id= $dado['idPerfil'];
							$nome= $dado['nome'];
							$sobrenome= $dado['sobrenome'];
							$usuario = $dado['nomeUsuario'];
							$sexo= $dado['sexo'];
							$dataNasc = $dado['datanasc'];
							$email = $dado['email'];
						}
					}
					else{
						echo "<pre>";
						print_r(mysqli_error_list($conexao));
						echo "</pre>";
					}

					mysqli_free_result($resposta);
					$fotoFund = "./dados/".$usuario."/background.jpeg";
					$fotoPerfil = "./dados/".$usuario."/portrait.jpeg";
	?>
					<div id="fundo">
						<img src="<?php echo $fotoFund; ?>" id="img-fundo"/>
					</div>
					<div id="perfil">
						<img src="<?php echo $fotoPerfil; ?>" id="img-perfil"/>
						<h1 class="nome-usuario"> @<?php echo $usuario; ?> </h1>
						<div class="add">
								<form method="POST" action="home.php">
									<input class="id" type="number" name="id" value="<?php echo $id; ?>"/>
									<input type="submit" name="enviar" value = "ADICIONAR AOS AMIGOS" class="amigo"/>
								</form>
						</div>
						<p id="dado-nomeSobrenome"> <?php echo $nome." ".$sobrenome; ?> <img src="./img/seta-baixo.png" id="seta-baixo-dados" class="seta"/></p>
						<div id="dados">
							<p id="dado-email"> <?php echo $email; ?></p>
							<p id="dado-sexo"> Sexo: <?php echo $sexo; ?></p>
							<p id="dado-dataNasc"> Data de nascimento: <?php $dataArray=explode("-",$dataNasc);
																			echo $dataArray[2]."/".$dataArray[1]."/".$dataArray[0]; ?>
							</p>
							<p id="Ocultar-dados"> Mostrar menos <img src="./img/seta-cima.png" class="seta"/></p>
						</div>
						<p id="amigos">Amigos<img src="./img/seta-baixo.png" id="seta-baixo-amigos" class="seta"/></p>
						<div id="div-amigos">
	<?php
							$mostrarAmigos ="SELECT * FROM amigos WHERE id_pessoa = $idprocurado";
							if($resposta = mysqli_query($conexao,$mostrarAmigos)){
								$numAmigos = mysqli_affected_rows($conexao);	
								if ($numAmigos == 0){
	?>
									<p style="font-weight: bold;">Não há amigos</p>
	<?php
								}else{
									foreach ($resposta as $dado){

										$id= $dado['id_amigo'];

										$confirmacaoUser ="SELECT * FROM perfil WHERE idPerfil = $id ";

										if($resposta = mysqli_query($conexao,$confirmacaoUser)){

											foreach ($resposta as $dado){
												$nomeAmigo = $dado['nome'];
												$sNomeAmigo = $dado['sobrenome'];
												$userAmigo = $dado['nomeUsuario'];
												$perfilAmigo = "./dados/".$userAmigo."/portrait.jpeg";
											}
	?>
											<div class="div-amigos-ind">
												<img src="<?php echo $perfilAmigo;?>" class="img-amigo"/>
												<p class="nome-amigo"><?php echo $nomeAmigo." ".$sNomeAmigo."<br/> (@".$userAmigo.")"; ?></p>
											</div>
	<?php
										}
									}
									mysqli_free_result($resposta);
								}
							}	
	?>
							<p id="Ocultar-amigos"> Mostrar menos <img src="./img/seta-cima.png" class="seta"/></p>
						</div>	
					</div>
	<?php
				}
				elseif(!isset($_GET['uid'])){
					$conexao = mysqli_connect("localhost", "root", "","redeSocial");

					if(mysqli_connect_errno()){
						header('Location: index.php');
					}
	?>
					<div id="fundo">
						<img src="<?php echo $user['fundo']; ?>" id="img-fundo"/>
					</div>
					<div id="perfil">
						<img src="<?php echo $user['perfil']; ?>" id="img-perfil"/>
						<h1 class="nome-usuario"> @<?php echo $user['username']; ?> </h1>
						<p id="dado-nomeSobrenome"> <?php echo $user['nome']." ".$user['sobrenome'];?> <img src="./img/seta-baixo.png" id="seta-baixo-dados" class="seta"/></p>
						<div id="dados">
							<p id="dado-email">  <?php echo $user['email']; ?></p>
							<p id="dado-sexo"> Sexo: <?php echo $user['sexo']; ?></p>
							<p id="dado-dataNasc"> Data de nascimento: <?php $dataNasc=$user['datanasc'];
																				$dataArray=explode("-",$dataNasc);
																				echo $dataArray[2]."/".$dataArray[1]."/".$dataArray[0]; ?>
							</p>
							<p id="Ocultar-dados"> Mostrar menos <img src="./img/seta-cima.png" class="seta"/></p>
						</div>
						<p id="amigos">Amigos<img src="./img/seta-baixo.png" id="seta-baixo-amigos" class="seta"/></p>
						<div id="div-amigos">
	<?php
							$userId= $user['id'];
							$mostrarAmigos ="SELECT * FROM amigos WHERE id_pessoa = $userId";
							if($resposta = mysqli_query($conexao,$mostrarAmigos)){
								$numAmigos = mysqli_affected_rows($conexao);	
								if ($numAmigos == 0){
	?>
									<p style="font-weight: bold;">Não há amigos</p>
	<?php
								}else{
									foreach ($resposta as $dado){

										$id= $dado['id_amigo'];

										$confirmacaoUser ="SELECT * FROM perfil WHERE idPerfil = $id ";

										if($resposta = mysqli_query($conexao,$confirmacaoUser)){

											foreach ($resposta as $dado){
												$nomeAmigo = $dado['nome'];
												$sNomeAmigo = $dado['sobrenome'];
												$userAmigo = $dado['nomeUsuario'];
												$perfilAmigo = "./dados/".$userAmigo."/portrait.jpeg";
											}
	?>
											<div class="div-amigos-ind">
												<img src="<?php echo $perfilAmigo;?>" class="img-amigo"/>
												<p class="nome-amigo"><?php echo $nomeAmigo." ".$sNomeAmigo."<br/> (@".$userAmigo.")"; ?></p>
											</div>
											
	<?php
										}
									}
									mysqli_free_result($resposta);
								}
							}
	?>
							<p id="Ocultar-amigos"> Mostrar menos <img src="./img/seta-cima.png" class="seta"/></p>
						</div>	
					</div>
	<?php							
				}	
			}			
	?>
		</div>
		
		<img src="./img/camera2.gif" id="gif-final"/>
		
		

	
	</body>
</html>