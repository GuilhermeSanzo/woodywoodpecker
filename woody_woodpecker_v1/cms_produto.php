<?php 

/* Conexão com o banco de dados */
include "../conexao.php";


// Autenticação do Usuário
if (empty($_SESSION["login"])) {
	echo "<script> alert('Você está tentando acessar uma página restrita'); location = 'error.php' </script>";
} else {

	// Autenticação de nível de usuário
	$sql = "select * from usuario where login = '".$_SESSION["login"]."'";
	$query = mysql_query($sql);
	$rs = mysql_fetch_array($query);

	// Só o administrador e o cataloguista tem acesso
	if ($rs["codTipoUsuario"] == 2) {
		echo "<script>alert('Você não tem permissão para entrar aqui!'); location = 'home.php' </script>";
	}

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
	<link type="image/x-icon" rel="shortcut icon" href="Imagens/shortcut_icon.png">
	<link type="text/css" rel="stylesheet" href="Estilo/estilo_geral.css">
	<link type="text/css" rel="stylesheet" href="Estilo/estilo_cms-produto.css">

	<!-- Efeito / Estilo das Tabs -->
	<link rel="stylesheet" href="Efeitos/jquery-ui/jquery-ui.css">
	<script src="Efeitos/jquery-1.10.2.js"></script>
	<script src="Efeitos/jquery-ui/jquery-ui.js"></script>
</head>
<body>
	<header>
		<div id="centraliza_cabecalho">
			<a href="../woody_woodpecker_v0/home.php"><img src="Imagens/woody_woodpecker_logo.png" alt="Logo"></a>
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
							<img src="Imagens/content.png" alt="Administração de Conteúdo">
							<p>Adm. de Conteúdo</p>
						</div>
					</a>
				</li>
				<li>
					<a href="cms_fale-conosco.php">
						<div class="cx_menu">
							<img src="Imagens/headset.png" alt="Administração do Fale Conosco">
							<p>Adm. do Fale Conosco</p>
						</div>
					</a>
				</li>
				<li class="menu-ativo">
					<a href="cms_produto.php">
						<div class="cx_menu">
							<img src="Imagens/bag.png" alt="Administração dos Produtos">
							<p>Adm. de Produtos</p>
						</div>
					</a>
				</li>
				<li>
					<a href="cms_usuarios.php">
						<div class="cx_menu">
							<img src="Imagens/user.png" alt="Administração de Usuários">
							<p>Adm. de Usuários</p>
						</div>
					</a>
				</li>
			</ul>
		</nav>
		<section id="conteudo">
			<div class="opcoes">
				<a href="produto_livro.php">
					<div class="cx_opcao">
						<img src="Imagens/book.png" alt="Livros">
						<p>Livros</p>
					</div>
					<ul class="gerenciamento">
						<li>Inserir em Livros</li>
						<li>Editar em Livros</li>
						<li>Excluir em Livros</li>
						<li>Visualizar em Livros</li>
					</ul>
				</a>
			</div>
			<div class="opcoes">
				<a href="produto_autor.php">
					<div class="cx_opcao">
						<img src="Imagens/author.png" alt="Autores">
						<p>Autores</p>
					</div>
					<ul class="gerenciamento">
						<li>Inserir em Autores</li>
						<li>Editar em Autores</li>
						<li>Excluir em Autores</li>
						<li>Visualizar em Autores</li>
					</ul>
				</a>
			</div>
			<div class="opcoes">
				<a href="produto_genero.php">
					<div class="cx_opcao">
						<img src="Imagens/gender.png" alt="Gêneros">
						<p>Gêneros</p>
					</div>
					<ul class="gerenciamento">
						<li>Inserir em Gêneros</li>
						<li>Editar em Gêneros</li>
						<li>Excluir em Gêneros</li>
						<li>Visualizar em Gêneros</li>
					</ul>
				</a>
			</div>
			<div class="opcoes">
				<a href="produto_distribuidora.php">
					<div class="cx_opcao">
						<img src="Imagens/truck.png" alt="Distribuidoras">
						<p>Distribuidoras</p>
					</div>
					<ul class="gerenciamento">
						<li>Inserir em Distribuidoras</li>
						<li>Editar em Distribuidoras</li>
						<li>Excluir em Distribuidoras</li>
						<li>Visualizar em Distribuidoras</li>
					</ul>
				</a>
			</div>
			<div class="opcoes">
				<a href="produto_editora.php">
					<div class="cx_opcao">
						<img src="Imagens/publisher.png" alt="Editora">
						<p>Editoras</p>
					</div>
					<ul class="gerenciamento">
						<li>Inserir em Editoras</li>
						<li>Editar em Editoras</li>
						<li>Excluir em Editoras</li>
						<li>Visualizar em Editoras</li>
					</ul>
				</a>
			</div>
			<h2 id="titulo_gerenciamento">Gerenciamento dos produtos</h2>
		</section>
	</section>
	<footer>
		<div id="centraliza_rodape">
			<p>Desenvolvido por: Guilherme Santos Souza</p>
		</div>
	</footer>
</body>
</html>