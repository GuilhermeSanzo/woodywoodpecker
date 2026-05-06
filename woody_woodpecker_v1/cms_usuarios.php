<?php 

/* Conexão com o banco de dados */
include "../src/database.php";


// Autenticação de usuário
if (empty($_SESSION["login"])) {
	echo "<script> alert('Você está tentando acessar uma página restrita'); location = 'error.php' </script>";
} else {

	// Autenticação de nível de usuário
	$sql = "select * from usuario where login = '".$_SESSION["login"]."'";
	$query = mysql_query($sql);
	$rs = mysql_fetch_array($query);

	// Só o administrador tem acesso
	if ($rs["codTipoUsuario"] != 1) {
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

	// Inserindo os valores no banco

	$botao = "Salvar";
	$nome = "";
	$email = "";
	$login = "";
	$senha = "";
	$tipo_usuario = "";
	$imagem = "";
	$tipo_usuario_temp = "-- Escolha o tipo de usuário --";

	$botao2 = "Salvar";
	$tipo = "";

	$codUsuario = 0;

	if (isset($_REQUEST['btn_enviar'])) {
		$nome = $_REQUEST['txt_nome'];
		$email = $_REQUEST['txt_email'];
		$login = $_REQUEST['txt_login'];
		$senha = $_REQUEST['txt_senha'];
		$tipo_usuario = $_REQUEST['txt_tipo_usuario'];
		
		$upload_dir = "Arquivos/";
		
		$nome_arq = basename($_FILES["arq_foto"]["name"]);
		
		$upload_file = $upload_dir . $nome_arq;
		
		if ($_REQUEST['btn_enviar'] == "Salvar") {
			if (strstr($nome_arq, ".png") || strstr($nome_arq, ".jpg")) {
				if (move_uploaded_file($_FILES["arq_foto"]["tmp_name"], $upload_file)) {
					$sql = "insert into usuario (nome, email, login, senha, codTipoUsuario, imagem) values ('".$nome."', '".$email."', '".$login."', '".$senha."', ".$tipo_usuario.", '".$upload_file."')";
				}
			}
		}

		if ($_REQUEST['btn_enviar'] == 'Editar') {
			if (strstr($nome_arq, ".png") || strstr($nome_arq, ".jpg")) {
				if (move_uploaded_file($_FILES["arq_foto"]["tmp_name"], $upload_file)) {
					$sql = "update usuario set nome = '".$nome."', email = '".$email."', login = '".$login."', senha = '".$senha."', codTipoUsuario = ".$tipo_usuario.", imagem = '".$upload_file."' where codUsuario = ".$_SESSION['codigo']."";

				}
			} else {
				$sql = "update usuario set nome = '".$nome."', email = '".$email."', login = '".$login."', senha = '".$senha."', codTipoUsuario = ".$tipo_usuario." where codUsuario = ".$_SESSION['codigo']."";
			}
		}
		
		mysql_query($sql);
		header("location:cms_usuarios.php");
	}
	
	if (isset($_REQUEST['modo'])) {
		$modo = $_REQUEST['modo'];

		if ($modo == "excluir") {
			$codigo = $_REQUEST['codigo'];
			$sql = "delete from usuario where codUsuario=".$codigo."";
			mysql_query($sql);
			header("location:cms_usuarios.php");
		}

		if ($modo == "editar") {
			$_SESSION["codigo"] = $_REQUEST['codigo'];
			
			$sql = "select u.*, tu.tipo from usuario as u inner join tipo_usuario as tu on(u.codTipoUsuario = tu.codTipoUsuario) where codUsuario=".$_SESSION['codigo']."";
			
			$query = mysql_query($sql);
			$rs = mysql_fetch_array($query);

			$nome = $rs["nome"];
			$email = $rs["email"];
			$login = $rs["login"];
			$senha = $rs["senha"];
			$codUsuario = $rs["codTipoUsuario"];
			$tipo_usuario_temp = $rs["tipo"];
			$imagem = $rs["imagem"];

			$botao = "Editar";

		}

	}

	// Para o cadastro de niveis
	if (isset($_REQUEST['btn_enviar2'])) {
		$tipo = $_REQUEST['txt_tipo'];
		
		if ($_REQUEST['btn_enviar2'] == "Salvar") {
			$sql = "insert into tipo_usuario (tipo) values ('".$tipo."')";
		}

		if ($_REQUEST['btn_enviar2'] == 'Editar') {
			$sql = "update tipo_usuario set tipo = '".$tipo."' where codTipoUsuario = ".$_SESSION['codigo2']."";
		}
		mysql_query($sql);
		header("location:cms_usuarios.php");
	}
	
	if (isset($_REQUEST['modo2'])) {
		$modo2 = $_REQUEST['modo2'];

		if ($modo2 == "excluir") {
			$codigo2 = $_REQUEST['codigo2'];
			$sql = "delete from tipo_usuario where codTipoUsuario=".$codigo2."";
			mysql_query($sql);
			header("location:cms_usuarios.php");
		}

		if ($modo2 == "editar") {
			$_SESSION["codigo2"] = $_REQUEST['codigo2'];
			
			$sql = "select * from tipo_usuario where codTipoUsuario = ".$_SESSION['codigo2']."";
			
			$query = mysql_query($sql);
			$rs = mysql_fetch_array($query);

			$tipo = $rs["tipo"];

			$botao2 = "Editar";

		}

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
	<link type="text/css" rel="stylesheet" href="/public/css/admin/estilo_cms-usuarios.css">
	
	<!-- Efeito / Estilo das Tabs -->
	<link rel="stylesheet" href="Efeitos/jquery-ui/jquery-ui.css">
	<script src="Efeitos/jquery-1.10.2.js"></script>
	<script src="Efeitos/jquery-ui/jquery-ui.js"></script>

	<script>
	  	$(function() {
	    	$( "#tabs" ).tabs();
	    	$( "#accordion").accordion();
	    	$( "#accordion_two").accordion();
	
			$("#ui-id-8").css("height", "inherit");
			$("#ui-id-10").css("height", "inherit");
		});
	</script>

	<style type="text/css">
		#ui-id-8, #ui-id-9 {
			height: inherit;
		}
	</style>
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
				<li class="menu-ativo">
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

			<!-- Título da página -->
			<h2 id="titulo_pagina">Administração de Usuários e Níveis</h2>

			<div id="tabs">
			  <ul>
			    <li><a href="#tabs-1">Administração de Usuários</a></li>
			    <li><a href="#tabs-2">Administração de Níveis</a></li>
			  </ul>
			  <div id="tabs-1">
			  	<div id="accordion">
				  	<h3>Cadastro</h3>
					<div>
						<form name="cms_usuario_form" method="post" enctype="multipart/form-data">
							<table id="tbl_cms_usuarios">
								<thead>
									<tr>
										<th colspan="5">Cadastro de Usuários</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Nome:</td>
										<td><input type="text" name="txt_nome" class="estilo_input" value="<?php echo($nome) ?>"></td>
									</tr>
									<tr>
										<td>Email:</td>
										<td><input type="email" name="txt_email" class="estilo_input" value="<?php echo($email) ?>"></td>
									</tr>
										<td>Login:</td>
										<td><input type="text" name="txt_login" class="estilo_input" value="<?php echo($login) ?>"></td>
									<tr>
										<td>Senha:</td>
										<td><input type="password" name="txt_senha" class="estilo_input" value="<?php echo($senha) ?>"></td>
									</tr>
									<tr>
										<td>Tipo de Usuário:</td>								
										<td>
											<select name="txt_tipo_usuario" class="estilo_input">
												<option value="<?php echo($codUsuario) ?>"><?php echo($tipo_usuario_temp) ?></option>
											<?php
												// SQL resgantando todos os tipos de usuário no banco caso não tenha sido mostrado na tela
												$sql = "select * from tipo_usuario where codTipoUsuario <> ".$codUsuario." order by codTipoUsuario desc";
												$select = mysql_query($sql);

												while($rs = mysql_fetch_array($select)) {

											?>
												<option value="<?php echo($rs['codTipoUsuario']) ?>"><?php echo($rs['tipo']) ?></option>
											<?php

											}

											?>
											</select>
										</td>								
									</tr>
									<tr>
										<td>Foto:</td>
										<td><input type="file" name="arq_foto" id="arq_foto"></td>
									</tr>
									<?php if ($imagem != null) { ?>
									<tr>
										<td>Foto atual:</td>
										<td><img src="<?php echo($imagem); ?>" alt="<?php echo($imagem);?>" style="width:200px;"></td>
									</tr>
									<?php } ?>
									<tr>
										<td><input type="submit" name="btn_enviar" value="<?php echo($botao) ?>"></td>
										<td><input type="reset" name="btn_limpar" value="Limpar"></td>
									</tr>
								</tbody>
							</table>
						</form>
					</div>
					<h3>Consulta</h3>
					<div>
						<table id="tblconsulta">
							<thead>
								<tr>
									<th>Nome</th>
									<th>Email</th>
									<th>Login</th>
									<th>Tipo de Usuário</th>
									<th colspan="2">Opções</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td colspan="2">&nbsp;</td>
								</tr>
							
								<?php
									$sql = "select u.*, tp.tipo from usuario as u inner join tipo_usuario as tp on(u.codTipoUsuario = tp.codTipoUsuario) order by codTipoUsuario asc";
									$select = mysql_query($sql);

									while($rs = mysql_fetch_array($select)) {
								?>
								<tr>
									<td><?php echo($rs['nome']) ?></td>
									<td><?php echo($rs['email']) ?></td>
									<td><?php echo($rs['login']) ?></td>
									<td><?php echo($rs['tipo']) ?></td>

									<td class="linha_opcoes">
										<a class="opcoes_link" href="cms_usuarios.php?modo=excluir&codigo=<?php echo($rs['codUsuario']) ?>">Excluir</a>					
									</td>
									<td class="linha_opcoes">
										<a class="opcoes_link" href="cms_usuarios.php?modo=editar&codigo=<?php echo($rs['codUsuario']) ?>">Editar</a>
									</td>
								</tr>
								<?php
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
			  
			  </div>
			  <!-- Segunda Tab -->
			  <div id="tabs-2">
			  	<!-- Primeira Seção -->
			  	<div id="accordion_two">
					<h3>Cadastro</h3>
					<div>
						<!-- Cadastro de níveis -->
						<form name="cms_nivel_form" method="post" id="cadastro_nivel">
							<table id="tbl_cms_usuarios">
								<thead>
									<tr>
										<th colspan="5">Cadastro de Níveis</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Tipo:</td>
										<td><input type="text" name="txt_tipo" class="estilo_input" value="<?php echo($tipo) ?>"></td>
									</tr>
									<tr>
										<td><input type="submit" name="btn_enviar2" value="<?php echo($botao2) ?>"></td>
										<td><input type="reset" name="btn_limpar2" value="Limpar"></td>
									</tr>
								</tbody>
							</table>
						</form>
					</div>
					<!-- Segunda seção -->
					<h3>Consulta</h3>
					<div>
						<table id="tblconsulta">
							<thead>
								<tr>
									<th>Tipo</th>
									<th colspan="2">Opções</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>&nbsp;</td>
									<td colspan="2">&nbsp;</td>
								</tr>
							
								<?php
									$sql = "select * from tipo_usuario order by codTipoUsuario asc";
									$select = mysql_query($sql);

									while($rs = mysql_fetch_array($select)) {
								?>
								<tr>
									<td><?php echo($rs['tipo']) ?></td>

									<td class="linha_opcoes">
										<a class="opcoes_link" href="cms_usuarios.php?modo2=excluir&codigo2=<?php echo($rs['codTipoUsuario']) ?>">Excluir</a>					
									</td>
									<td class="linha_opcoes">
										<a class="opcoes_link" href="cms_usuarios.php?modo2=editar&codigo2=<?php echo($rs['codTipoUsuario']) ?>">Editar</a>
									</td>
								</tr>
								<?php
									}
								?>
							</tbody>
						</table>
					</div>
			  	</div>
			</div>

			<div id="inserir">
				
				
			</div>
			<!-- Tabela de Consulta -->
			<div id="consulta">
				
				<!-- Consulta de Níveis -->
				<div id="consulta_nivel">
					
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