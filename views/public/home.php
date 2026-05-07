<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

/* Conexão com o banco de dados */
include __DIR__ . "/../../src/database.php";

$_SESSION["login"] = "";

// Zerando o login, caso ele tenha vindo de outra sessão
if($_SESSION["login"] != null) {
	session_destroy();
}


if(isset($_REQUEST["btn_entrar"])) {

$login = $_REQUEST["usuario"];
$senha = $_REQUEST["senha"];

$_SESSION["login"] = $login;


	$sql = " select u.*, tu.tipo from usuario as u inner join tipo_usuario as tu on(u.codTipoUsuario = tu.codTipoUsuario) where login = '".$login."' and senha = '".$senha."' ";
	$verificacao = mysql_query($sql);
	
	
	if ($rs = mysql_fetch_array($verificacao)) {		
		$_SESSION["nome"] = $rs["nome"];
		$_SESSION["imagem"] = $rs["imagem"];

		header("location: /views/admin/home.php");
	} else {
		echo("<script>alert('O nome de usuario ou a senha está errada!')</script>");
	}


}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Woody Woodpecker</title>
	<link type="text/css" rel="stylesheet" href="/public/css/site/estilo_geral.css">
	<link type="text/css" rel="stylesheet" href="/public/css/site/estilo_home.css">
	<link rel="stylesheet" type="text/css" href="/public/css/site/mobile/estilo_home.css">
	<link type="image/x-icon" rel="shortcut icon" href="/public/images/site/shortcut_icon.png">
    <script type="text/javascript" src="/views/public/Efeitos/jquery-2.1.3.js"></script>
	<!--<script type="text/javascript" src="/views/public/Efeitos/efeito.js"></script>-->
    <meta charset="utf-8">
	<script type="text/javascript">
		jQuery(window).load(function() {
		
		jQuery("#loader").delay(4000).fadeOut("slow");
		});
	</script>
	<style>
		#loader{
		position: fixed;
		width: 100%;
		height: 100%;
		background-color: #000;
		background-image: url('/public/images/site/loader.gif');
		background-size: auto;
		background-position: center;
		background-repeat: no-repeat;
		z-index: 2;
	}
	</style>
</head>
<body>
	<div id="loader" style="display: none;"></div>
	<!-- Cabeçalho -->
	<header>
		<div id="centraliza_cabecalho">
			<!-- Logo da página -->
			<a href="/" id="logo"><img src="/public/images/site/woody_woodpecker_logo.png" alt="Icon" title="Livraria Woody Woodpecker"></a>
			
			<!-- Novas caixas para entrada -->
			<div class="caixa_entrada">
				<a href="#">Cadastrar</a>
			</div>
			<div class="caixa_entrada">
				<a href="/views/public/login.php">Login</a>
			</div>
			
			<!-- Caixa de pesquisa -->
			<form id="formulario_pesquisa">
				<input type="text" name="pesquisa" placeholder="Pesquisar">	
				<input type="submit" name="btn_pesquisa" value="&nbsp;">
			</form>
			

			<nav id="menu">
				<ul>
					<li><a href="/" class="menu_page">Home</a></li>
					<li><a href="/views/public/autores-destaque.php">Autores em destaque</a></li>
					<li><a href="/views/public/sobre.php">Sobre</a></li>
					<li><a href="/views/public/promocoes.php">Promoções</a></li>
					<li><a href="/views/public/nossas-lojas.php">Nossas Lojas</a></li>
					<li><a href="/views/public/livro-mes.php">Livro do mês</a></li>
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
			<h3>Livros mais vendidos</h3>
			<!-- Primeira lista -->
			<?php 

				$sql = filtro();
				
				$select = mysql_query($sql);

				while ($rs = mysql_fetch_array($select)) {

			?>
			<div class="produtos">
				<img src="<?php echo str_replace(['../woody_woodpecker_v1/', 'Arquivos/'], ['', '/public/images/uploads/'], $rs['imagem']) ?>" alt="<?php echo str_replace(['../woody_woodpecker_v1/', 'Arquivos/'], ['', '/public/images/uploads/'], $rs['imagem']) ?>">
				<ul>
					<?php
						if ($rs["subtitulo"] != null) {
					?>
					<li><strong>Nome:</strong> <?php echo($rs["titulo"] . ": " . $rs["subtitulo"]);?></li>
					<?php
						} else {
					?>
					<li><strong>Nome:</strong> <?php echo($rs["titulo"]);?></li>
					<?php
						}
					?>
					
					<li><strong>Autor:</strong> <?php echo($rs["autor"]) ?></li>
					<li><strong>Preço:</strong> <?php echo ("R$ " . str_replace('.', ',', $rs["preco"]) ); ?></li>
				</ul>
				<a href="#" title="Detalhes">Comprar</a>
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
					<a href="/"><img src="/public/images/site/woody_woodpecker_logo.png" alt="Icon" title="Livraria Woody Woodpecker">
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