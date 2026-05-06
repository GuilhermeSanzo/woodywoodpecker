<?php 

/* Conexão com o banco de dados */
include "../conexao.php";


if (empty($_SESSION["login"])) {
	echo "<script> alert('Você está tentando acessar uma página restrita'); location = 'error.php' </script>";
} else {

	if (isset($_REQUEST["btn_logout"])) {

	?>
		<script>
			var certeza_logout = confirm('Tem certeza que deseja sair?');
			if (certeza_logout == true) {
				document.location = '../woody_woodpecker_v0/home.php';
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
			<a href="../woody_woodpecker_v0/home.php"><img src="/public/images/admin/woody_woodpecker_logo.png" alt="Logo"></a>
			<h1><a href="home.php">CMS Woody Woodpecker</a></h1>
			<form method="post">
				<div id="usuario_logado">
					<p>Bem vindo, <?php echo($_SESSION["nome"]) ?></p>
					<img id="img_perfil" src="<?php echo($_SESSION['imagem']) ?>" alt="<?php echo($_SESSION['imagem']) ?>">
					<input type="submit" name="btn_logout" id="btn_logout" value="Logout">
				</div>
			</form>
		</div>
	</header>
	<section id="corpo">
		<nav id="menu">
			<ul>
				<li>
					<a href="cms_conteudo.php">
						<div class="cx_menu">
							<img src="/public/images/admin/content.png" alt="Administração de Conteúdo">
							<p>Adm. de Conteúdo</p>
						</div>
					</a>
				</li>
				<li>
					<a href="cms_fale-conosco.php">
						<div class="cx_menu">
							<img src="/public/images/admin/headset.png" alt="Administração do Fale Conosco">
							<p>Adm. do Fale Conosco</p>
						</div>
					</a>
				</li>
				<li>
					<a href="cms_produto.php">
						<div class="cx_menu">
							<img src="/public/images/admin/bag.png" alt="Administração dos Produtos">
							<p>Adm. de Produtos</p>
						</div>
					</a>
				</li>
				<li>
					<a href="cms_usuarios.php">
						<div class="cx_menu">
							<img src="/public/images/admin/user.png" alt="Administração de Usuários">
							<p>Adm. de Usuários</p>
						</div>
					</a>
				</li>
			</ul>
		</nav>
		<section id="conteudo">
			<div>
				<h1>Seja bem vindo ao CMS da Woody Woodpecker, <?php echo($_SESSION["nome"]) ?></h1>
				<h1>Abaixo segue a lista das permissões que você possui aqui</h1>
				
				<?php

					$sql = "select u.*, tu.tipo from usuario as u inner join tipo_usuario as tu on(u.codTipoUsuario = tu.codTipoUsuario) where u.login = '".$_SESSION["login"]."'";
					$query = mysql_query($sql);
					$rs = mysql_fetch_array($query);


				?>

				<div>
					<p>Nome: <?php echo($rs['nome']) ?></p>
					<p>Usuario: <?php echo($rs['login']) ?></p>
					<p>Email: <?php echo($rs['email']) ?></p>
					<p>Nível de Usuário: <?php echo($rs['tipo']) ?></p>
				</div>

				<!-- Lista de permissões -->
				<?php
				if ($rs['codTipoUsuario'] == 1 || $rs['codTipoUsuario'] == 2) {
				?>
				<div class="opcoes">
					<div class="cx_opcao">
						<img src="/public/images/admin/content.png" alt="Sobre">
						<p>Adm. de Conteúdo</p>
					</div>
					<ul class="gerenciamento">
						<li>Inserir em sobre</li>
						<li>Editar em sobre</li>
						<li>Excluir em sobre</li>
						<li>Visualizar em sobre</li>
					</ul>
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
					<ul class="gerenciamento">
						<li>Inserir em sobre</li>
						<li>Editar em sobre</li>
						<li>Excluir em sobre</li>
						<li>Visualizar em sobre</li>
					</ul>
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
					<ul class="gerenciamento">
						<li>Inserir em sobre</li>
						<li>Editar em sobre</li>
						<li>Excluir em sobre</li>
						<li>Visualizar em sobre</li>
					</ul>
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
					<ul class="gerenciamento">
						<li>Inserir em sobre</li>
						<li>Editar em sobre</li>
						<li>Excluir em sobre</li>
						<li>Visualizar em sobre</li>
					</ul>
				</div>
				<?php 
				}
				?>
			</div>
		</section>
	</section>
	<footer>
		<div id="centraliza_rodape">
			<p>Desenvolvido por: Guilherme Santos Souza</p>
		</div>
	</footer>
</body>
</html>