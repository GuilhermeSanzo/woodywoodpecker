<?php 

/* Conexão com o banco de dados */
include __DIR__ . "/../../src/database.php";


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
				document.location = '/';
			} 
		</script>

<?php

	}

	// Inserindo os valores no banco

	$botao = "Salvar";
	$nome = "";

	if (isset($_REQUEST['btn_enviar'])) {
		$nome = $_REQUEST["txt_nome"];

		// Enviando os arquivos
		if ($_REQUEST['btn_enviar'] == "Salvar") {
			$sql = "insert into editora (nome) values ('".$nome."')";
		}

		// Editando os arquivos
		if ($_REQUEST['btn_enviar'] == "Editar") {
			$sql = "update editora set nome = '".$nome."' where cod_editora = ".$_SESSION["codigo"]."";
		}

		//echo($sql);
		mysql_query($sql);
		header("location: /views/admin/produto_editora.php");

	}

	// Modo
	if (isset($_REQUEST['modo'])) {
		$modo = $_REQUEST['modo'];

		if ($modo == "excluir") {
			$codigo = $_REQUEST['codigo'];
			$sql = "delete from editora where cod_editora=".$codigo."";
			mysql_query($sql);
			header("location: /views/admin/produto_editora.php");
		}

		if ($modo == "editar") {
			$_SESSION["codigo"] = $_REQUEST['codigo'];
			
			$sql = "select * from editora where cod_editora=".$_SESSION['codigo']."";
			
			$query = mysql_query($sql);
			$rs = mysql_fetch_array($query);

			$nome = $rs["nome"];

			$botao = "Editar";
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
	<link type="text/css" rel="stylesheet" href="/public/css/admin/estilo_cms-produto.css">
</head>
<body>
	<header>
		<div id="centraliza_cabecalho">
			<a href="/"><img src="/public/images/admin/woody_woodpecker_logo.png" alt="Logo"></a>
			<h1><a href="/views/admin/home.php">CMS Woody Woodpecker</a></h1>
			<form method="post">
				<div id="usuario_logado">
					<p>Bem vindo, <?php echo($_SESSION["nome"]) ?></p>
					<img id="img_perfil" src="<?php echo str_replace(['../woody_woodpecker_v1/', 'Arquivos/'], ['', '/public/images/uploads/'], $_SESSION['imagem']) ?>" alt="<?php echo str_replace(['../woody_woodpecker_v1/', 'Arquivos/'], ['', '/public/images/uploads/'], $_SESSION['imagem']) ?>">
					<input type="submit" name="btn_logout" id="btn_logout" value="Logout">
				</div>
			</form>
		</div>
	</header>
	<section id="corpo">
		<nav id="menu">
			<ul>
				<li>					
					<a href="/views/admin/cms_conteudo.php">
						<div class="cx_menu">
							<img src="/public/images/admin/content.png" alt="Administração de Conteúdo">
							<p>Adm. de Conteúdo</p>
						</div>
					</a>
				</li>
				<li>
					<a href="/views/admin/cms_fale-conosco.php">
						<div class="cx_menu">
							<img src="/public/images/admin/headset.png" alt="Administração do Fale Conosco">
							<p>Adm. do Fale Conosco</p>
						</div>
					</a>
				</li>
				<li class="menu-ativo">
					<a href="/views/admin/cms_produto.php">
						<div class="cx_menu">
							<img src="/public/images/admin/bag.png" alt="Administração dos Produtos">
							<p>Adm. de Produtos</p>
						</div>
					</a>
				</li>
				<li>
					<a href="/views/admin/cms_usuarios.php">
						<div class="cx_menu">
							<img src="/public/images/admin/user.png" alt="Administração de Usuários">
							<p>Adm. de Usuários</p>
						</div>
					</a>
				</li>
			</ul>
		</nav>
		<section id="conteudo">
			<h2 id="titulo_gerenciamento">Editora</h2>

			<div id="inserir">
				<form name="produto_editora_form" method="post">
					<table id="tbl_cms_usuarios">
						<thead>
							<tr>
								<th colspan="2">Cadastro de Editoras</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Nome:</td>
								<td><input type="text" name="txt_nome" class="estilo_input" value="<?php echo($nome) ?>" required></td>
							</tr>
							<tr>
								<td><input type="submit" name="btn_enviar" value="<?php echo($botao) ?>"></td>
								<td><input type="reset" name="btn_limpar" value="Limpar"></td>
							</tr>
						</tbody>
					</table>
				</form>
			</div>

			<!-- Consulta de editora -->
			<div id="consulta">
				<table id="tblconsulta">
					<thead>
						<tr>
							<th>Nome</th>
							<th colspan="2">Opções</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>&nbsp;</td>
							<td colspan="2">&nbsp;</td>
						</tr>
					
						<?php
							$sql = "select * from editora order by cod_editora desc";
							$select = mysql_query($sql);

							$cont = 0;
							$estilo = 1000;
							while($rs = mysql_fetch_array($select)) {
								$cont++;
								if ($cont >= 7) $estilo = 1000 + $cont * 5;

						?>
						<tr>
							<td><?php echo($rs['nome']) ?></td>

							<td class="linha_opcoes">
								<a class="opcoes_link" href="/views/admin/produto_editora.php?modo=excluir&codigo=<?php echo($rs['cod_editora']) ?>">Excluir</a>					
							</td>
							<td class="linha_opcoes">
								<a class="opcoes_link" href="/views/admin/produto_editora.php?modo=editar&codigo=<?php echo($rs['cod_editora']) ?>">Editar</a>
							</td>
						</tr>
						<?php
							}
						?>
						<style type="text/css">
							#corpo {
								height: <?php echo($estilo . 'px'); ?>;
							}
						</style>
					</tbody>
				</table>
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
