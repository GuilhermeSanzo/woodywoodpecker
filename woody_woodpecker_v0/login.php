<?php 

include "../src/database.php";

if(isset($_REQUEST["btn_entrar"])) {

$login = $_REQUEST["usuario"];
$senha = $_REQUEST["senha"];

$_SESSION["login"] = $login;

	$sql = " select u.*, tu.tipo from usuario as u inner join tipo_usuario as tu on(u.codTipoUsuario = tu.codTipoUsuario) where login = '".$login."' and senha = '".$senha."' ";
	$verificacao = mysql_query($sql);
	
	
	if ($rs = mysql_fetch_array($verificacao)) {		
		$_SESSION["nome"] = $rs["nome"];
		$_SESSION["imagem"] = $rs["imagem"];

		header("location:../woody_woodpecker_v1/home.php");
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
	<link type="text/css" rel="stylesheet" href="/public/css/site/estilo_login.css">
	<link type="image/x-icon" rel="shortcut icon" href="/public/images/site/shortcut_icon.png">
    <script type="text/javascript" src="Efeitos/jquery-2.1.3.js"></script>
    <meta charset="utf-8">
</head>
<body>
	<!-- Cabeçalho -->
	<header>
		<div id="centraliza_cabecalho">
			<!-- Logo da página -->
			<a href="home.php" id="logo"><img src="/public/images/site/woody_woodpecker_logo.png" alt="Icon" title="Livraria Woody Woodpecker"></a>
			<nav id="menu">
				<ul>
					<li><a href="home.php" class="menu_page">Home</a></li>
					<li><a href="autores-destaque.php">Autores em destaque</a></li>
					<li><a href="sobre.php">Sobre</a></li>
					<li><a href="promocoes.php">Promoções</a></li>
					<li><a href="nossas-lojas.php">Nossas Lojas</a></li>
					<li><a href="livro-mes.php">Livro do mês</a></li>
					<li><a href="fale-conosco.php">Fale conosco</a></li>
				</ul>
		  </nav>
		</div>
	</header>
	<!-- Corpo da página -->
	<section id="corpo">
		<!-- Conteúdo principal -->
		<section id="principal">
			<div id="cx_login">
				<img id="icon_login" src="/public/images/admin/big_logo.png" alt="Icon" title="Livraria Woody Woodpecker" width="200px">
				<h1>Login</h1>
			</div>
			<form method="post">
				<table id="tabela_login">
					<tbody>
						<tr>
							<td><label>Nome de Usuário</label></td>
						</tr>
						<tr>
							<td><input type="text" name="usuario" required></td>
						</tr>
						<tr>
							<td><label>Senha</label></td>
						</tr>
						<tr>
							<td><input type="password" name="senha" required></td>
						</tr>
						<tr>
							<td><input type="submit" name="btn_entrar" id="btn_entrar" value="Entrar"></td>
						</tr>
					</tbody>
				</table>
			</form>
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
					<a href="home.php"><img src="/public/images/site/woody_woodpecker_logo.png" alt="Icon" title="Livraria Woody Woodpecker">
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