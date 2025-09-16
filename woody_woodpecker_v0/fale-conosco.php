<?php

/* Conexão com o banco de dados */
include "../conexao.php";

//Codigo para inserir no Banco de Dados
if(isset($_REQUEST["btnSalvar"])){
	$nome = $_REQUEST["txt_nome"];
	$telefone = $_REQUEST["txt_telefone"];
	$celular = $_REQUEST["txt_celular"];;
	$email = $_REQUEST["txt_email"];
	$homepage = $_REQUEST["txt_homepage"];
	$perfil_facebook = $_REQUEST["txt_perfil_facebook"];
	$info_produtos = $_REQUEST["txt_info_produtos"];
	$sexo = $_REQUEST["txt_sexo"];
	$profissao = $_REQUEST["txt_profissao"];
	$sugestao = $_REQUEST["txt_sugestao"];
	
	
	//Linha de comando para inserir um registro
	$sql="insert into fale_conosco (nome, telefone, celular, email, homepage, perfil_facebook, info_produtos, sexo, profissao, sugestao) values ('".$nome."', '".$telefone."', '".$celular."', '".$email."', '".$homepage."', '".$perfil_facebook."', '".$info_produtos."', '".$sexo."', '".$profissao."', '".$sugestao."');";
	mysql_query($sql);
	
	echo "<script>alert('Obrigado pela sua opinião!');</script>";
	
	//header("location:fale-conosco.php");
	
}


if(isset($_REQUEST["btn_entrar"])) {

$login = $_REQUEST["usuario"];
$senha = $_REQUEST["senha"];

$_SESSION["login"] = $login;


	$sql = " select u.*, tu.tipo from usuario as u inner join tipo_usuario as tu on(u.codTipoUsuario = tu.codTipoUsuario) where login = '".$login."' and senha = '".$senha."' ";
	$verificacao = mysql_query($sql);
	
	
	if ($rs = mysql_fetch_array($verificacao)) {		
		$_SESSION["nome"] = $rs["nome"];

		header("location:../woody_woodpecker_v1/home.php");
	} else {
		echo("<script>alert('O nome de usuario ou a senha está errada!')</script>");
	}


}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Fale conosco - Woody Woodpecker</title>
	<link type="text/css" rel="stylesheet" href="Estilo/estilo_geral.css">
	<link rel="stylesheet" type="text/css" href="Estilo/estilo_fale-conosco.css">
	<link type="image/x-icon" rel="shortcut icon" href="Imagens/shortcut_icon.png">
	<script type="text/javascript" src="Efeitos/jquery-2.1.3.js"></script>
	<script type="text/javascript" src="Efeitos/efeito.js"></script>
	<!-- Espaço deixado para criação dos efeitos JavaScript -->
    <script>
    function rg(objeto) {
    	if (objeto.value.length == 2 || objeto.value.length == 6) {
    		objeto.value = objeto.value+".";
    	} 
    	if (objeto.value.length == 10) {
    		objeto.value = objeto.value+"-";
    	}
    }

    function cpf(objeto) {
    	if (objeto.value.length == 3 || objeto.value.length == 7) {
    		objeto.value = objeto.value+".";	
    	}
    	if (objeto.value.length == 11) {
    		objeto.value = objeto.value+"-";
    	}
    }

    function cep(objeto) {
    	if (objeto.value.length == 5) {
    		objeto.value = objeto.value+"-";
    	}
    }

    function telefone(objeto) {
    	if (objeto.value.length == 0) {
    		objeto.value = objeto.value+"(";
    	}
    	if (objeto.value.length == 3) {
    		objeto.value = objeto.value+")";
    	}
    	if (objeto.value.length == 8) {
    		objeto.value = objeto.value+"-";
    	}
    }

    function celular(objeto) {
    	if (objeto.value.length == 0) {
    		objeto.value = objeto.value+"(";
    	}
    	if (objeto.value.length == 3) {
    		objeto.value = objeto.value+")";
    	}
    	if (objeto.value.length == 9) {
    		objeto.value = objeto.value+"-";
    	}

    function rg_incorreto(el) {
    	alert("O valor " + el.value + " não é um RG");
    	return false;
    }

    function cpf_incorreto(el) {
    	alert("O valor " + el.value + " não é um CPF");
    	return false;
    }

    function cep_incorreto(el) {
    	alert("O valor " + el.value + " não é um CEP");
    	return false;
    }

    function telefone_incorreto(el) {
    	alert("O valor " + el.value + " não é um telefone");
    	return false;
    }

    function celular_incorreto(el) {
    	alert("O valor " + el.value + " não é um celular");
    	return false;
    }

    }

    </script>
    <meta charset="utf-8">
</head>
<body>
	<!-- Cabeçalho -->
	<header>
		<div id="centraliza_cabecalho">
			<!-- Logo da página -->
			<a href="home.php" id="logo"><img src="Imagens/woody_woodpecker_logo.png" alt="Icon" title="Livraria Woody Woodpecker"></a>
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
				<a href="login.php">Login</a>
			</div>
			<!-- Menu de navegação -->
			<nav id="menu">
				<ul>
					<li><a href="home.php">Home</a></li>
					<li><a href="autores-destaque.php">Autores em destaque</a></li>
					<li><a href="sobre.php">Sobre</a></li>
					<li><a href="promocoes.php">Promoções</a></li>
					<li><a href="nossas-lojas.php">Nossas Lojas</a></li>
					<li><a href="livro-mes.php">Livro do mês</a></li>
					<li><a href="fale-conosco.php" class="menu_page">Fale conosco</a></li>
				</ul>
		  </nav>
		</div>
	</header>
	<!-- Corpo da página -->
	<section id="corpo">
		<!-- Banner -->
		<?php 

		include "php/slider.php";

		?>
		<!-- Barra lateral -->
		<?php 

		include "php/barra_categorias.php";

		?>
		<!-- Conteúdo principal -->
		<section id="principal">
			<h3>Fale conosco</h3>
			<!-- Primeira lista -->
			<form name="cadatro_fale-conosco" action="fale-conosco.php" method="post">
				<table id="tbl_fale_conosco">
					<thead>
						<tr>
							<th colspan="2">Envie-nos a sua opinião sobre esse site</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Nome:* </td>
							<td><input type="text" name="txt_nome" class="estilo_input" required></td>
						</tr>
						<tr>
							<td>Telefone: </td>
							<td><input type="text" name="txt_telefone" class="estilo_input" onKeyUp="telefone(this)" maxLength="13"></td>
						</tr>
						<tr>
							<td>Celular:* </td>
							<td><input type="text" name="txt_celular" class="estilo_input" onKeyUp="celular(this)" maxLength="14" required></td>
						</tr>
						<tr>
							<td>Email:* </td>
							<td><input type="email" name="txt_email" class="estilo_input" required></td>
						</tr>
						<tr>
							<td>Homepage: </td>
							<td><input type="text" name="txt_homepage" class="estilo_input"></td>
						</tr>
						<tr>
							<td>Link do perfil no Facebook: </td>
							<td><input type="text" name="txt_perfil_facebook" class="estilo_input"></td>
						</tr>
						<tr>
							<td>Informações de produtos: </td>
							<td><input type="text" name="txt_info_produtos" class="estilo_input"></td>
						</tr>
						<tr>
							<td rowspan="2">Sexo:* </td>
							<td><label>Masculino: </label><input type="radio" name="txt_sexo" value="Masculino" required></td>
						</tr>
						<tr>
							<td><label>Feminino: </label><input type="radio" name="txt_sexo" value="Feminino" required></td>
						</tr>
						<tr>
							<td>Profissão:* </td>
							<td><input type="text" name="txt_profissao" class="estilo_input" required></td>
						</tr>
						<tr>
							<td>Sugestões / Críticas: </td>
							<td><textarea name="txt_sugestao" class="estilo_input"></textarea></td>
						</tr>
						<tr>
							<td><input type="submit" value="Enviar" name="btnSalvar" class="estilo_input"></td>
							<td><input type="reset" value="Limpar" name="btnLimpar" class="estilo_input"></td>
						</tr>
						<tr>
							<td colspan="2"><p class="obs"><strong>Observação: </strong>As opções marcadas com * são de uso obrigatório</p></td>
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
					<a href="home.php">
						<img src="Imagens/woody_woodpecker_logo.png" alt="Icon" title="Livraria Woody Woodpecker">
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
	                <img src="Imagens/patrocinios.png" alt="Patrocínios">
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