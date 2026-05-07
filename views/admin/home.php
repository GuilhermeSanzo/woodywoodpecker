<?php 

/* Conexão com o banco de dados */
include __DIR__ . "/../../src/database.php";


if (empty($_SESSION["login"])) {
	echo "<script> alert('Você está tentando acessar uma página restrita'); location = '/views/admin/error.php' </script>";
} else {

	if (isset($_REQUEST["btn_logout"])) {

	?>
		<script>
			var certeza_logout = confirm('Tem certeza que deseja sair?');
			if (certeza_logout == true) {
				document.location = '/';
			} 
		</script>

<?php

	}
}

?>




<!DOCTYPE html>
<html>
<head>
	<title>CMS Woody Woodpecker</title>
	<meta charset="utf-8">
	<link type="image/x-icon" rel="shortcut icon" href="/public/images/admin/shortcut_icon.png">
	<link type="text/css" rel="stylesheet" href="/public/css/admin/estilo_geral.css">
	<link type="text/css" rel="stylesheet" href="/public/css/admin/estilo_home.css">
</head>
<body>
	<header>
		<div id="centraliza_cabecalho">
			<a href="/"><img src="/public/images/admin/woody_woodpecker_logo.png" alt="Logo"></a>
			<h1><a href="/views/admin/home.php">CMS Woody Woodpecker</a></h1>
			<form method="post">
				<div id="usuario_logado">
					<p>Bem vindo, <?php echo($_SESSION["nome"]) ?></p>
					<img id="img_perfil" src="<?php echo str_replace(['../woody_woodpecker_v1/', 'Arquivos/'], ['', '/public/images/uploads/'], $_SESSION['imagem']) ?>" alt="<?php echo str_replace(['../woody_woodpecker_v1/', 'Arquivos/'], ['', '/public/images/uploads/'], $_SESSION['imagem']) ?>">
					<input type="submit" name="btn_logout" id="btn_logout" value="Logout">
				</div>
			</form>
		</div>
	</header>
	<section id="corpo">
		<nav id="menu">
			<ul>
				<li>
					<a href="/views/admin/cms_conteudo.php">
						<div class="cx_menu">
							<img src="/public/images/admin/content.png" alt="Administração de Conteúdo">
							<p>Adm. de Conteúdo</p>
						</div>
					</a>
				</li>
				<li>
					<a href="/views/admin/cms_fale-conosco.php">
						<div class="cx_menu">
							<img src="/public/images/admin/headset.png" alt="Administração do Fale Conosco">
							<p>Adm. do Fale Conosco</p>
						</div>
					</a>
				</li>
				<li>
					<a href="/views/admin/cms_produto.php">
						<div class="cx_menu">
							<img src="/public/images/admin/bag.png" alt="Administração dos Produtos">
							<p>Adm. de Produtos</p>
						</div>
					</a>
				</li>
				<li>
					<a href="/views/admin/cms_usuarios.php">
						<div class="cx_menu">
							<img src="/public/images/admin/user.png" alt="Administração de Usuários">
							<p>Adm. de Usuários</p>
						</div>
					</a>
				</li>
			</ul>
		</nav>
		<section id="conteudo">
			<div id="cx_apresentacao">
				<h1 class="titulo">Bem vindo: <?php echo $_SESSION["nome"]; ?></h1>
				<h3 class="subtitulo">ao CMS da Woody Woodpecker</h3>
				<img class="logo_apresentacao" src="/public/images/admin/big_logo.png" alt="Logo">
				<h3 class="subtitulo">Abaixo segue a lista das seções onde você tem permissão de acesso</h3>

				<!-- Precisa ser trocado -->
				<?php

					$sql = "select u.*, tu.tipo from usuario as u inner join tipo_usuario as tu on(u.codTipoUsuario = tu.codTipoUsuario) where u.login = '".$_SESSION["login"]."'";
					$query = mysql_query($sql);
					$rs = mysql_fetch_array($query);


				?>

				<!-- Lista de permissões -->
				<?php
				if ($rs['codTipoUsuario'] == 1 || $rs['codTipoUsuario'] == 2) {
				?>
				<div class="opcoes">
					<div class="cx_opcao">
						<img src="/public/images/admin/content.png" alt="Sobre">
						<p>Adm. de Conteúdo</p>
					</div>
				</div>
				<?php
				}
				if ($rs['codTipoUsuario'] == 1) {
				?>
				<div class="opcoes">
					<div class="cx_opcao">
						<img src="/public/images/admin/headset.png" alt="Sobre">
						<p>Adm. de Fale Conosco</p>
					</div>
				</div>
				<?php
				}
				if ($rs['codTipoUsuario'] == 1 || $rs['codTipoUsuario'] == 3) {
				?>
				<div class="opcoes">
					<div class="cx_opcao">
						<img src="/public/images/admin/bag.png" alt="Sobre">
						<p>Adm. de Produtos</p>
					</div>
				</div>
				<?php
				}
				if ($rs['codTipoUsuario'] == 1) {
				?>
				<div class="opcoes">
					<div class="cx_opcao">
						<img src="/public/images/admin/user.png" alt="Sobre">
						<p>Adm. de Usuários</p>
					</div>
				</div>
				<?php 
				}
				?>
				</div>

				<style type="text/css">
					.opcoes {
						outline: 1px solid #000;
						height: 100px;
					}	
				</style>
			<!-- Precisa ser trocado -->

			</div>
		</section>
		<style type="text/css">
			#cx_apresentacao {
				background-color: white;
				text-align: center;
				margin-top: 30px;
				padding-bottom: 100px;
			}
			.titulo {
				font-size: 36px;
				color: #4d4d4d;
			}
			.subtitulo {
				font-weight: normal;
				color: #8c8c8c;
			}
			.logo_apresentacao {
				width: 200px;
			}
		</style>
	</section>
	<footer>
		<div id="centraliza_rodape">
			<p>Desenvolvido por: Guilherme Santos Souza</p>
		</div>
	</footer>
</body>
</html>
