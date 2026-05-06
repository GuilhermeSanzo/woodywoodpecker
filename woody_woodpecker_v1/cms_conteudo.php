<?php 

/* Conexão com o banco de dados */
include "../src/database.php";


// Autenticação do Usuário
if (empty($_SESSION["login"])) {
	echo "<script> alert('Você está tentando acessar uma página restrita'); location = 'error.php' </script>";
} else {

	// Autenticação de nível de usuário
	$sql = "select * from usuario where login = '".$_SESSION["login"]."'";
	$query = mysql_query($sql);
	$rs = mysql_fetch_array($query);

	// Só o administrador e o operador básico tem acesso
	if ($rs["codTipoUsuario"] == 3) {
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
	<link type="image/x-icon" rel="shortcut icon" href="/public/images/admin/shortcut_icon.png">
	<link type="text/css" rel="stylesheet" href="/public/css/admin/estilo_geral.css">
	<link type="text/css" rel="stylesheet" href="/public/css/admin/estilo_cms-conteudo.css">
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
				<li class="menu-ativo">					
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
			<div class="opcoes">
				<a href="conteudo_autores-destaque.php">
					<div class="cx_opcao">
						<img src="/public/images/admin/author.png" alt="Autores em Destaque">
						<p>Autores em Destaque</p>
					</div>
					<ul class="gerenciamento">
						<li>Inserir em autores</li>
						<li>Editar em autores</li>
						<li>Excluir em autores</li>
						<li>Visualizar em autores</li>
					</ul>
				</a>
			</div>
			<div class="opcoes">
				<a href="conteudo_promocoes.php">
					<div class="cx_opcao">
						<img src="/public/images/admin/gender.png" alt="Promoções">
						<p>Promocões</p>
					</div>
					<ul class="gerenciamento">
						<li>Inserir em Promoções</li>
						<li>Editar em Promoções</li>
						<li>Excluir em Promoções</li>
						<li>Visualizar em Promoções</li>
					</ul>
				</a>
			</div>
			<div class="opcoes">
				<a href="conteudo_sobre.php">
					<div class="cx_opcao">
						<img src="/public/images/admin/about.png" alt="Sobre">
						<p>Sobre</p>
					</div>
					<ul class="gerenciamento">
						<li>Inserir em sobre</li>
						<li>Editar em sobre</li>
						<li>Excluir em sobre</li>
						<li>Visualizar em sobre</li>
					</ul>
				</a>
			</div>
			<div class="opcoes">
				<a href="conteudo_nossas-lojas.php">
					<div class="cx_opcao">
						<img src="/public/images/admin/store.png" alt="Nossas Lojas">
						<p>Nossas Lojas</p>
					</div>
					<ul class="gerenciamento">
						<li>Inserir em nossas lojas</li>
						<li>Editar em nossas lojas</li>
						<li>Excluir em nossas lojas</li>
						<li>Visualizar em nossas lojas</li>
					</ul>
				</a>
			</div>
			<div class="opcoes">
				<a href="conteudo_livro-mes.php">
					<div class="cx_opcao">
						<img src="/public/images/admin/book.png" alt="Livro do Mês">
						<p>Livro do Mês</p>
					</div>
					<ul class="gerenciamento">
						<li>Inserir em livro do mês</li>
						<li>Editar em livro do mês</li>
						<li>Excluir em livro do mês</li>
						<li>Visualizar em livro do mês</li>
					</ul>
				</a>
			</div>
			<h2 id="titulo_gerenciamento">Gerenciamento do conteúdo</h2>
		</section>
	</section>
	<footer>
		<div id="centraliza_rodape">
			<p>Desenvolvido por: Guilherme Santos Souza</p>
		</div>
	</footer>
</body>
</html>