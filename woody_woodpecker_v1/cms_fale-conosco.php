<?php

/* Conexão com o banco de dados */
include "../src/database.php";


// Autenticação do usuário
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

	// Limpando variáveis
	$tipos = "";
	$botao = "Salvar";

	$rs2 = "";

	if (isset($_REQUEST['btnsalvar'])) {
		$tipos = $_REQUEST['txttipos'];

		if ($_POST['btnsalvar'] == "Salvar") {
			$sql = "insert into tblgeneros (tipos) values ('".$tipos."')";
		}

		mysql_query($sql);
		header("location:generos.php");
	}

	if (isset($_REQUEST['modo'])) {
		$modo = $_REQUEST['modo'];

		if ($modo == "excluir") {
			$codigo = $_REQUEST['codigo'];
			$sql = "delete from fale_conosco where codFaleConosco=".$codigo."";
			mysql_query($sql);
			header("location:cms_fale-conosco.php");
		}

		if ($modo == "detalhes") {
			$codigo = $_REQUEST['codigo'];
			$sql = "select * from fale_conosco where codFaleConosco = ".$codigo.";";
			$consulta = mysql_query($sql);
			$rs2 = mysql_fetch_array($consulta);
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
				<li class="menu-ativo">
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
			<!-- Título da página -->
			<h2 id="titulo_pagina">Administração do Fale Conosco</h2>
			<!-- Tabela de Consulta -->
			<div id="consulta">
				<table id="tblconsulta">
					<thead>
						<tr>
							<th>Nome</th>
							<th>Telefone</th>
							<th>Celular</th>
							<th>Email</th>
							<th>Profissão</th>
							<th colspan="2">Opções</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td colspan="2">&nbsp;</td>
						</tr>

						<?php
							$sql = "select * from fale_conosco order by codFaleConosco desc";
							$select = mysql_query($sql);

							while($rs = mysql_fetch_array($select)) {
						?>

						<tr>

							<td><?php echo($rs['nome']) ?></td>
							<td><?php echo($rs['telefone']) ?></td>
							<td><?php echo($rs['celular']) ?></td>
							<td><?php echo($rs['email']) ?></td>
							<td><?php echo($rs['profissao']) ?></td>

							<!-- Verificação para mais detalhes / menos detalhes -->
							<?php
								if ($rs2 == null || $codigo != $rs['codFaleConosco']) {
							?>
							<td class="linha_opcoes">
								<a class="opcoes_link" href="cms_fale-conosco.php?modo=detalhes&codigo=<?php echo($rs['codFaleConosco']) ?>">Detalhes</a>
							</td>
							<?php
								} else {
							?>
							<td class="linha_opcoes">
								<a class="opcoes_link" href="cms_fale-conosco.php">Menos Detalhes</a>
							</td>
							<?php
								}
							?>
							<td class="linha_opcoes">
								<a class="opcoes_link" href="cms_fale-conosco.php?modo=excluir&codigo=<?php echo($rs['codFaleConosco']) ?>">Excluir</a>
							</td>
						</tr>
						<?php
							}
						?>
					</tbody>
				</table>
			</div>
			<!-- Verificação para mostrar a tabela com os detalhes -->
			<?php
				if($rs2 != null) {
			?>
				<table id="tblconsulta">
					<tbody>
						<tr>
							<th>Nome</th>
							<td><?php echo($rs2["nome"]) ?></td>
						</tr>
						<tr>
							<th>Telefone</th>
							<td><?php echo($rs2["telefone"]) ?></td>
						</tr>
						<tr>
							<th>Celular</th>
							<td><?php echo($rs2["celular"]) ?></td>
						</tr>
						<tr>
							<th>Email</th>
							<td><?php echo($rs2["email"]) ?></td>
						</tr>
						<tr>
							<th>Homepage</th>
							<td><?php echo($rs2["homepage"]) ?></td>
						</tr>
						<tr>
							<th>Perfil do Facebook</th>
							<td><?php echo($rs2["perfil_facebook"]) ?></td>
						</tr>
						<tr>
							<th>Info. de Produtos</th>
							<td><?php echo($rs2["info_produtos"]) ?></td>
						</tr>
						<tr>
							<th>Sexo</th>
							<td><?php echo($rs2["sexo"]) ?></td>
						</tr>
						<tr>
							<th>Profissão</th>
							<td><?php echo($rs2["profissao"]) ?></td>
						</tr>
						<tr>
							<th>Sugestões / Críticas</th>
							<td><?php echo($rs2["sugestao"]) ?></td>
						</tr>
						<tr>
							<th>Opções</th>
							<td class="linha_opcoes">
								<a class="opcoes_link" href="cms_fale-conosco.php?modo=excluir&codigo=<?php echo($rs2['codFaleConosco']) ?>">Excluir</a>
							</td>
						</tr>
					</tbody>
				</table>
				<?php
					}
				?>
		</section>
	</section>
	<footer>
		<div id="centraliza_rodape">
			<p>Desenvolvido por: Guilherme Santos Souza</p>
		</div>
	</footer>
</body>
</html>
