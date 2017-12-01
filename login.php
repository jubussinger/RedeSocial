<?php
	session_start();
	
	if(isset($_SESSION['usuario'])){
		header('Location:home.php');
	}
	else{

		require_once 'funcoes.php';

		if($_SERVER["REQUEST_METHOD"]=="POST"){

			$usu=$_POST['user'];

			if( hash('sha512', $_POST['senha']) == hash('sha512', "") || $usu == ""){

				
				header ("Location: erro.php?erro=5");

			}
			else{

				$conexao = mysqli_connect("localhost", "root", "","redeSocial");

				if (mysqli_connect_errno()) {
					printf("Connect failed: %s\n", mysqli_connect_error());
					exit();	
				}

				$confirmacaoU ="SELECT * FROM perfil WHERE nomeUsuario = '$usu'";

				$existe = FALSE;

				if ($resposta = mysqli_query($conexao,$confirmacaoU)){

					foreach ($resposta as $dado){
						
						if( hash('sha512', $_POST['senha']) == $dado['senha']) {

							$user=[];

							$user['id'] = $dado['idPerfil'];
							$user['nome'] =$dado['nome'];
							$user['sobrenome'] = $dado['sobrenome'];
							$user['sexo'] = $dado['sexo'];
							$user['email'] = $dado['email'];
							$user['username'] = $usu;
							$user['datanasc'] = $dado['datanasc'];
							$user['perfil'] = "./dados/".$usu."/portrait.jpeg";
							$user['fundo'] = "./dados/".$usu."/background.jpeg";

							logar($user);

							header('Location:home.php');
							$existe = TRUE;

						}
					}

					if( $existe == FALSE){
						
						header ("Location: erro.php?erro=6");
					}


				}else{
					echo "<pre>";
					print_r(mysqli_error_list($conexao));
					echo "</pre>";
				}
				
				mysqli_close($conexao);
			}
		}
	}
?>	
