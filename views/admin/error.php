<?php

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
		$_SESSION["tipo-usuario"] = $rs["tipo"];

		header("location: /views/admin/home.php");
	} else {
		echo("<script>alert('O nome de usuario ou a senha está errada!')</script>");
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
	<link type="text/css" rel="stylesheet" href="/public/css/admin/estilo_error.css">
</head>
<body>
	<header>
		<div id="centraliza_cabecalho">
			<div id="cx_logo_cms">
				<a href="/"><img src="/public/images/admin/woody_woodpecker_logo.png" alt="Logo"></a>
				<h1><a href="/views/admin/home.php">CMS Woody Woodpecker</a></h1>
			</div>
			<form id="formulario_login" method="post">
				<label>Usuário:</label>
				<input type="text" name="usuario" required>
				<label>Senha:</label>
				<input type="password" name="senha" required>
				<input type="submit" name="btn_entrar" id="btn_entrar" value="Entrar">
			</form>
		</div>
	</header>
	<section id="corpo">
		<img src="/public/images/admin/error.png" alt="Error" id="img_erro">
		<h2>Você está tentando acessar uma página restrita</h2>
		<p>Faça o login, ou clique <a href="/">aqui</a> para voltar à página inicial</p>
	</section>
	<footer>
		<div id="centraliza_rodape">
			<p>Desenvolvido por: Guilherme Santos Souza</p>
		</div>
	</footer>
</body>
</html>
