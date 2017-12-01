<?php
	if($_SERVER['REQUEST_METHOD']=="POST"){
			$userExist = false;
			$nome = $_POST['nome'];
			$snome = $_POST['snome'];
			$email = $_POST['email'];
			$cemail = $_POST['cemail'];
			$usernome = $_POST['usernome'];
			$passw = $_POST['senha'];
			$cpassw = $_POST['csenha'];
			$sexo = $_POST['sexo'];
			$data = $_POST['data'];
			$ftPer = $_FILES['ftPer'];
			$ftFun = $_FILES['ftFun'];

			/** conexao banco de dados **/
			$conexao = mysqli_connect("localhost", "root", "","redeSocial");

			if (mysqli_connect_errno()) {
				printf("Connect failed: %s\n", mysqli_connect_error());
				exit();
			}

			//inserir os dados na tabela
			if(isset($nome) || isset($snome) || isset($email) || isset($cemail) || isset($usernome) || isset($passw) || isset($cpassw) || isset($sexo) || isset($data) || isset($ftPer) || isset($ftFun)){
				if($passw == $cpassw && $email == $cemail){
					$datarray = explode("-",$data);
					$y = $datarray[0];
					$m = $datarray[1];
					$d = $datarray[2];
					if(checkdate($m, $d, $y) || filter_var($email, FILTER_VALIDATE_EMAIL) || substr_count($_POST['senha'], " ") == 0){
						$passw =  hash("sha512", $_POST['senha']);

						$verificacao = mysqli_query ($conexao,'SELECT * FROM perfil');
						$novoId = mysqli_num_rows($verificacao);

						while($linha = mysqli_fetch_array($verificacao, MYSQLI_ASSOC)){
							if($linha["nomeUsuario"] == $usernome){
								$userExist = true;
								break;
							}
						}
						mysqli_close($conexao);

						$conexao = mysqli_connect("localhost", "root", "","redeSocial");

						if (mysqli_connect_errno()) {
							printf("Connect failed: %s\n", mysqli_connect_error());
							exit();
						}

						if($userExist==false){
							$novoId++;
							$usernome = mysqli_real_escape_string($conexao, $usernome);
							$nome = mysqli_real_escape_string($conexao, $nome);
							$snome = mysqli_real_escape_string($conexao, $snome);
							$query = "INSERT INTO perfil VALUES ('$novoId','$nome','$snome','$sexo','$email','$usernome','$passw','$data')";

							if (mysqli_query($conexao,$query)===TRUE){
								mkdir('dados/'.$usernome);

								$caminho= getcwd()."/dados/".$usernome;

								move_uploaded_file($ftPer['tmp_name'], $caminho."/portrait.jpeg");
								move_uploaded_file($ftFun['tmp_name'], $caminho."/background.jpeg");

								echo "deu certo amem";
								header("Location: index.php");
							}else {
								echo "erros: ";
								echo "<pre>";
								print_r(mysqli_error_list($conexao));
								echo "</pre>";
							}

						}
						else{
							header ("Location: erro.php?erro=2");
						}
						mysqli_close($conexao);

					}else{
						header ("Location: erro.php?erro=4");
					}
				}
				else{
					header ("Location: erro.php?erro=1");
				}
			}else{
				header ("Location: erro.php?erro=3");
			}


	}

?>
