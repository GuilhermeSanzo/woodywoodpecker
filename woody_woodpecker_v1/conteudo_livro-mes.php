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

	// Inserindo os valores no banco

	$botao = "Salvar";
	$titulo = null;
	$status = null;

	$livro_temp = "Escolha um livro";
	$livro = 0;

	if (isset($_REQUEST['btn_enviar'])) {
		$titulo = $_REQUEST["txt_livro"];
		$status = $_REQUEST["txt_status"];

		// Enviando os arquivos
		if ($_REQUEST['btn_enviar'] == "Salvar") {
			$sql = "insert into livro_mes (cod_livro, status) values (".$titulo.", ".$status.")";
		}

		// Editando os arquivos
		if ($_REQUEST['btn_enviar'] == "Editar") {
			$sql = "update livro_mes set cod_livro = ".$titulo.", status = ".$status." where cod_livro_mes = ".$_SESSION["codigo"]."";
		}

		//echo($sql);
		mysql_query($sql);
		header("location:conteudo_livro-mes.php");

	}

	// Modo
	if (isset($_REQUEST['modo'])) {
		$modo = $_REQUEST['modo'];

		if ($modo == "excluir") {
			$codigo = $_REQUEST['codigo'];
			$sql = "delete from livro_mes where cod_livro_mes=".$codigo."";
			//echo($sql);
			mysql_query($sql);
			header("location:conteudo_livro-mes.php");
		}

		if ($modo == "editar") {
			$_SESSION["codigo"] = $_REQUEST['codigo'];
			
			$sql = "select ad.*, a.titulo from livro_mes as ad inner join livro as a on(ad.cod_livro = a.cod_livro) where cod_livro_mes=".$_SESSION['codigo']."";
			
			$query = mysql_query($sql);
			$rs = mysql_fetch_array($query);

			$titulo = $rs["cod_livro"];
			$status = $rs["status"];

			$livro = $rs["cod_livro"];

			$livro_temp = $rs["titulo"];

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
			<h2 id="titulo_gerenciamento">Livros do Mês</h2>

			<div id="inserir">
				<form name="produto_distribuidora_form" method="post">
					<table id="tbl_cms_usuarios">
						<thead>
							<tr>
								<th colspan="2">Cadastro de Livros do Mês</th>
							</tr>
						</thead>
						<tbody>
							<tr> 
								<td>livros</td>
								<td>
									<select name="txt_livro" class="estilo_input" required>
										<option value="<?php echo($livro) ?>"><?php echo($livro_temp) ?></option>
										<?php
											// SQL resgatando os livros
											$sql = "select * from livro order by cod_livro desc";
											$select = mysql_query($sql);

											while($rs = mysql_fetch_array($select)) {

										?>
										<option value="<?php echo($rs['cod_livro']) ?>"><?php echo($rs['titulo']) ?></option>
										<?php

											}

										?>
									</select>
								</td>
							</tr>
							<tr>
								<td>Status</td>
								<td>
									<select name="txt_status">
										<option value="1">Ativado</option>
										<option value="0">Desativado</option>
									</select>
								</td>
							</tr>
							<tr>
								<td><input type="submit" name="btn_enviar" value="<?php echo($botao) ?>"></td>
								<td><input type="reset" name="btn_limpar" value="Limpar"></td>
							</tr>
						</tbody>
					</table>
				</form>
			</div>

			<!-- Consulta de Distribuidoras -->
			<div id="consulta">
				<table id="tblconsulta">
					<thead>
						<tr>
							<th>Nome</th>
							<th>Status</th>
							<th colspan="2">Opções</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td colspan="2">&nbsp;</td>
						</tr>
					
						<?php
							$sql = "select lm.*, l.titulo from livro_mes as lm inner join livro as l on(lm.cod_livro = l.cod_livro) order by cod_livro_mes desc";
							$select = mysql_query($sql);

							$cont = 0;
							$estilo = 1000;
							while($rs = mysql_fetch_array($select)) {
								$cont++;
								if ($cont >= 7) $estilo = 1000 + $cont * 5;
								if ($rs['status'] == true) {
									$status = "Ativado";
								} else {
									$status = "Desativado";
								}
						?>
						<tr>
							<td><?php echo($rs['titulo']) ?></td>
							<td><?php echo($status) ?></td>

							<td class="linha_opcoes">
								<a class="opcoes_link" href="conteudo_livro-mes.php?modo=excluir&codigo=<?php echo($rs['cod_livro_mes']) ?>">Excluir</a>					
							</td>
							<td class="linha_opcoes">
								<a class="opcoes_link" href="conteudo_livro-mes.php?modo=editar&codigo=<?php echo($rs['cod_livro_mes']) ?>">Editar</a>
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