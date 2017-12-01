<!doctype html>  
<html>
	<head>
		<title>Photography</title>		
		<meta charset="utf-8"/>	
		
		<link rel="shortcut icon" href="favicon.ico" />
		<link rel="stylesheet" type="text/css" href="./css/indexx.css"/>
		<link href="https://fonts.googleapis.com/css?family=Vollkorn+SC" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Quicksand|Raleway" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Alex+Brush" rel="stylesheet">
		
		<script src="./js/jquery.min.js"></script>
		<script>
			$(function(){
				$("#fechaCadastro").hide();
				$("#fechaLogin").hide();
				
				$("#Cadastrar").click(function(){
					$(".flip-container").fadeOut();
					$(".botao").fadeOut();
					$(".login").fadeOut();
					$(".cadastro").fadeIn();
					var altura = $(window).innerHeight();
					var alturaDiv = $(".cadastro").innerHeight();
					var novaAltura = (altura - alturaDiv)/2;
					$(".cadastro").css("top",novaAltura);
					var largura = $(window).innerWidth();
					var larguraDiv = $(".cadastro").innerWidth();
					var novalargura = (largura- larguraDiv)/2;
					$(".cadastro").css("left",novalargura);
					$("#fechaCadastro").show();

				})
				$("#Entrar").click(function(){
					$(".flip-container").fadeOut();
					$(".botao").fadeOut();
					$("#Cadastrar").fadeIn();
					$(".cadastro").fadeOut();
					$(".login").fadeIn();
					var altura = $(window).innerHeight();
					var alturaDiv = $(".login").innerHeight();
					var novaAltura = (altura - alturaDiv)/2;
					$(".login").css("top",novaAltura);
					var largura = $(window).innerWidth();
					var larguraDiv = $(".login").innerWidth();
					var novalargura = (largura- larguraDiv)/2;
					$(".login").css("left",novalargura);
					$("#fechaLogin").show();
				})
				
				//botão fechar
				
				$("#fechaLogin").on("click", function() {
					$(".login").hide();
					$("#fechaLogin").hide();
					$(".botao").fadeIn();
					$(".flip-container").show();
				});
				
				$("#fechaCadastro").on("click", function() {
					$(".cadastro").hide();
					$("#fechaCadastro").hide();
					$(".botao").fadeIn();
					$(".flip-container").show();
				});
			});
		</script>
	</head>
	<body>
	
	 	<img src="./img/camera2.gif" id="gif"/>
	
		<div class="botao">
			<button class="entrar-cadastrar" id="Cadastrar"> Register </button>
			<button class="entrar-cadastrar" id="Entrar"> Login </button>
		</div>
		
		
		<div class="login">
		<span class="close" id="fechaLogin">&times;</span>
			<form action="login.php" method="post">
				<input placeholder="Username" type="text" name="user" required/><br/><br/>
				<input placeholder="Senha" type="password" name="senha" required/><br/><br/>
				<input class="sub" type="submit" value="Entrar"/><br/>
				
			</form>
		</div>
		
		
		
		<!-- animação com css na escrita de bem-vindo-->
		
		<div class="flip-container" ontouchstart="this.classList.toggle('hover');">  	
			<div class="flipper">  		
				<div class="front">  			
					<p class="welcome">Welcome</p>		
				</div>  		
				<div class="back">  			
					<p class="welcome">Bem-vindo</p>  		
				</div>  	
			</div>  
		</div>

		
		
		<div class="cadastro">
		<span class="close" id="fechaCadastro">&times;</span>
			<form action="cadastrar.php" method="POST" enctype="multipart/form-data">
				<input placeholder="Name" type="text" name="nome" required/><br/><br/>
				<input placeholder="Last Name" type="text" name="snome" required/><br/><br/>
				<input placeholder="E-mail" type="email" name="email" required/><br/><br/>
				<input placeholder="E-mail confirmation" type="email" name="cemail" required/><br/><br/>
				<input placeholder="Username" type="text" name="usernome" required/><br/><br/>
				<input placeholder="Password" type="password" name="senha" required/><br/><br/>
				<input placeholder="Password Confirmation" type="password" name="csenha" required/><br/><br/>
				<p> Gender :</p><br/>
				<input type="radio" name="sexo" value="Male" class="sexo"> Male<br/>
				<input type="radio" name="sexo" value="Female"class="sexo"> Female<br/>
				<input type="radio" name="sexo" value="Other"class="sexo"> Other<br/><br/>
				<p> Date of birth: </p><br/>
				<input type="date" name="data" required/><br/><br/>
				<p>Perfil's Picture:</p><br/>
				<input type="file" class="foto" name="ftPer" required/><br/>
				<p>Background's picture:</p><br/>
				<input type="file" class="foto" name="ftFun" required/><br/>
				<input class="sub" type="submit" value="Registrar" /><br/>

			</form>
		</div>
		

	</body>
</html>

