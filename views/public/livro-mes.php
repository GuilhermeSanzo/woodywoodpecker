<?php

/* Conexão com o banco de dados */
include __DIR__ . "/../../src/database.php";


if(isset($_REQUEST["btn_entrar"])) {

$login = $_REQUEST["usuario"];
$senha = $_REQUEST["senha"];

$_SESSION["login"] = $login;


	$sql = " select u.*, tu.tipo from usuario as u inner join tipo_usuario as tu on(u.codTipoUsuario = tu.codTipoUsuario) where login = '".$login."' and senha = '".$senha."' ";
	$verificacao = mysql_query($sql);
	
	
	if ($rs = mysql_fetch_array($verificacao)) {		
		$_SESSION["nome"] = $rs["nome"];

		header("location: /views/admin/home.php");
	} else {
		echo("<script>alert('O nome de usuario ou a senha está errada!')</script>");
	}


}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Livro do Mês - Woody Woodpecker</title>
	<link type="text/css" rel="stylesheet" href="/public/css/site/estilo_geral.css">
	<link rel="stylesheet" type="text/css" href="/public/css/site/estilo_livro-mes.css">
	<link type="image/x-icon" rel="shortcut icon" href="/public/images/site/shortcut_icon.png">
	<script type="text/javascript" src="/views/public/Efeitos/jquery-2.1.3.js"></script>
    <script type="text/javascript" src="/views/public/Efeitos/efeito.js"></script>
    <meta charset="utf-8">
</head>
<body>
	<!-- Cabeçalho -->
	<header>
		<div id="centraliza_cabecalho">
			<!-- Logo da página -->
			<a href="/" id="logo"><img src="/public/images/site/woody_woodpecker_logo.png" alt="Icon" title="Livraria Woody Woodpecker"></a>
			<!-- Caixa de pesquisa -->
			
			<form id="formulario_pesquisa">
				<input type="text" name="pesquisa" placeholder="Pesquisar">	
				<input type="submit" name="btn_pesquisa" value="&nbsp;">
			</form>
			<!-- Novas caixas para entrada -->
			<div class="caixa_entrada">
				<a href="#">Cadastrar</a>
			</div>
			<div class="caixa_entrada">
				<a href="/views/public/login.php">Login</a>
			</div>
			<!-- Menu de navegação -->
			<nav id="menu">
				<ul>
					<li><a href="/">Home</a></li>
					<li><a href="/views/public/autores-destaque.php">Autores em destaque</a></li>
					<li><a href="/views/public/sobre.php">Sobre</a></li>
					<li><a href="/views/public/promocoes.php">Promoções</a></li>
					<li><a href="/views/public/nossas-lojas.php">Nossas Lojas</a></li>
					<li><a href="/views/public/livro-mes.php" class="menu_page">Livro do mês</a></li>
					<li><a href="/views/public/fale-conosco.php">Fale conosco</a></li>
				</ul>
		  </nav>
		</div>
	</header>
	<!-- Corpo da página -->
	<section id="corpo">
		<!-- Banner -->
		<?php 

		include __DIR__ . "/php/slider.php";

		?>
		<!-- Barra lateral -->
		<?php 

		include __DIR__ . "/php/barra_categorias.php";

		?>
		<!-- Conteúdo principal -->
		<section id="principal">
			<h3>Livros do mês</h3>
			<!-- Primeira lista -->
			<?php 
				$sql = "select lm.*, l.*, a.conhecido as autor, g.nome as genero from livro_mes as lm 
				inner join livro as l on(lm.cod_livro = l.cod_livro)
				inner join autor as a on(l.cod_autor = a.cod_autor)
				inner join genero as g on(l.cod_genero = g.cod_genero)
				where status = 1 order by cod_livro_mes desc";

				$select = mysql_query($sql);

				while ($rs = mysql_fetch_array($select)) {

				$traco = null;
				if ($rs["subtitulo"] != null) {
					$traco = " - ";
				}
			?>
			<div class="produtos">
				<img src="<?php echo str_replace(['../woody_woodpecker_v1/', 'Arquivos/'], ['', '/public/images/uploads/'], $rs['imagem']) ?>" alt="<?php echo str_replace(['../woody_woodpecker_v1/', 'Arquivos/'], ['', '/public/images/uploads/'], $rs['imagem']) ?>">
				<ul>
					<li><strong>Título:</strong> <?php echo($rs["titulo"] . $traco . $rs["subtitulo"])?></li>
					<li><strong>Autor:</strong> <?php echo($rs["autor"]) ?></li>
					<li><strong>Gênero:</strong> <?php echo($rs["genero"]) ?></li>
				</ul>
				<a href="#" title="Detalhes">Detalhes</a>
			</div>
			<?php

				}

			?>
		</section>
	</section>	
	<!-- Redes Sociais -->
	<div id="redes_sociais">
		<div id="facebook"></div>
		<div id="twitter"></div>
		<div id="google_plus"></div>
	</div>
	<!-- Rodapé -->
	<footer>
		<div id="rodape">
			<div id="lado1">
				<div id="rodape_logo">
					<a href="/">
						<img src="/public/images/site/woody_woodpecker_logo.png" alt="Icon" title="Livraria Woody Woodpecker">
						<h2>Woody Woodpecker</h2>
					</a>
				</div>
	            <div id="sitemap">
	                <h3>Sitemap</h3>
	                    <ul>
	                        <li>The Store</li>
	                        <li>Company</li>
	                        <li>Terms & Conditions</li>
	                        <li>Privacy Policy</li>
	                    </ul>
	            </div>
	            <div id="customer">
	                <h3>Customer Info</h3>
	                    <ul>
	                        <li>Order Tracking</li>
	                        <li>Shipping & Handling</li>
	                        <li>Payment</li>
	                        <li>Refund Policy</li>
	                        <li>FAQ</li>
	                        <li>Help</li>
	                    </ul>
	            </div>
	            <div id="newsletter">
	                <h3>Newsletter</h3>
	                <input type="text" name="mail" placeholder="Mail adress....">
	                <input type="button" name="go" value="GO">
	                <p>We guarantee that your mail adress<br>will be used for and only for our<br>newsletter</p>
	            </div>
	            <div id="social">
	                <h3>Social</h3>
	                <ul>
	                    <li>Facebook</li>
	                    <li>Youtube</li>
	                    <li>RSS Feeds</li>
	                    <li>Twitter</li>
	                </ul>
	            </div>
	            <div id="patrocinios">
	                <img src="/public/images/site/patrocinios.png" alt="Patrocínios">
	            </div>
	        </div>
	        <div id="copyright">
	            <div id="lado2">
	            <p>© Copyright 2016 Woody Woodpecker - All Rights Reserved</p>
	            </div>
	        </div>
        </div>
	</footer>
</body>
</html>
