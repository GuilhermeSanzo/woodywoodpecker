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
	$nome = null;
	$logradouro = null;
	$endereco = null;
	$numero = null;
	$bairro = null;
	$cidade = null;
	$estado = null;

	$livro_temp = "Escolha um livro";
	$livro = 0;

	if (isset($_REQUEST['btn_enviar'])) {

		$nome = $_REQUEST["txt_nome"];
		$logradouro = $_REQUEST["txt_logradouro"];
		$endereco = $_REQUEST["txt_endereco"];
		$numero = $_REQUEST["txt_numero"];
		$bairro = $_REQUEST["txt_bairro"];
		$cidade = $_REQUEST["txt_cidade"];
		$estado = $_REQUEST["txt_estado"];

		// Enviando os arquivos
		if ($_REQUEST['btn_enviar'] == "Salvar") {
			$sql = "insert into nossa_loja (nome, logradouro, endereco, numero, bairro, cidade, estado) values ('".$nome."', '".$logradouro."', '".$endereco."', '".$numero."', '".$bairro."', '".$cidade."', '".$estado."' )";
		}

		// Editando os arquivos
		if ($_REQUEST['btn_enviar'] == "Editar") {
			$sql = "update nossa_loja set nome = '".$nome."', logradouro = '".$logradouro."', endereco = '".$endereco."', numero = '".$numero."', bairro = '".$bairro."', cidade = '".$cidade."', estado = '".$estado."' where cod_nossa_loja = ".$_SESSION["codigo"]."";
		}

		//echo($sql);
		mysql_query($sql);
		header("location:conteudo_nossas-lojas.php");

	}

	// Modo
	if (isset($_REQUEST['modo'])) {
		$modo = $_REQUEST['modo'];

		if ($modo == "excluir") {
			$codigo = $_REQUEST['codigo'];
			$sql = "delete from nossa_loja where cod_nossa_loja=".$codigo."";
			//echo($sql);
			mysql_query($sql);
			header("location:conteudo_nossas-lojas.php");
		}

		if ($modo == "editar") {
			$_SESSION["codigo"] = $_REQUEST['codigo'];
			
			$sql = "select * from nossa_loja where cod_nossa_loja=".$_SESSION['codigo']."";
			
			$query = mysql_query($sql);
			$rs = mysql_fetch_array($query);

			$nome = $rs["nome"];
			$logradouro = $rs["logradouro"];
			$endereco = $rs["endereco"];
			$numero = $rs["numero"];
			$bairro = $rs["bairro"];
			$cidade = $rs["cidade"];
			$estado = $rs["estado"];

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
								<th colspan="2">Cadastro de Nossas Lojas</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Nome</td>
								<td><input type="text" name="txt_nome" class="estilo_input" value="<?php echo($nome) ?>" required></td>
							</tr>
							<tr>
								<td>Logradouro</td>
								<td>
									<select name="txt_logradouro" class="estilo_input" required>
										<option value="Rua">Rua</option>
										<option value="Avenida">Avenida</option>
										<option value="Alameda">Alameda</option>
										<option value="Praça">Praça</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>Endereco</td>
								<td><input type="text" name="txt_endereco" class="estilo_input" value="<?php echo($endereco) ?>" required></td>
							</tr>
							<tr>
								<td>Numero</td>
								<td><input type="number" name="txt_numero" class="estilo_input" value="<?php echo($numero) ?>" required></td>
							</tr>
							<tr>
								<td>Bairro</td>
								<td><input type="text" name="txt_bairro" class="estilo_input" value="<?php echo($bairro) ?>" required></td>
							</tr>
							<tr>
								<td>Cidade</td>
								<td><input type="text" name="txt_cidade" class="estilo_input" value="<?php echo($cidade) ?>" required></td>
							</tr>
							<tr>
								<td>Estado</td>
								<td>
									<select name="txt_estado" class="estilo_input" required="">
										<option value="SP">SP</option>
										<option value="RJ">RJ</option>	
										<option value="MG">MG</option>	
										<option value="RS">RS</option>	
										<option value="SC">SC</option>	
										<option value="AM">AM</option>
										<option value="BA">BA</option>	
										<option value="MS">MS</option>	
										<option value="PE">PE</option>	
										<option value="CE">CE</option>	
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
							<th>Logradouro</th>
							<th>Endereco</th>
							<th>Numero</th>
							<th>Bairro</th>
							<th>Cidade</th>
							<th>Estados</th>
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
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td colspan="2">&nbsp;</td>
						</tr>
					
						<?php
							$sql = "select * from nossa_loja order by cod_nossa_loja desc";
							$select = mysql_query($sql);

							$cont = 0;
							$estilo = 1000;
							while($rs = mysql_fetch_array($select)) {
						?>
						<tr>
							<td><?php echo($rs['nome']) ?></td>
							<td><?php echo($rs['logradouro']) ?></td>
							<td><?php echo($rs['endereco']) ?></td>
							<td><?php echo($rs['numero']) ?></td>
							<td><?php echo($rs['bairro']) ?></td>
							<td><?php echo($rs['cidade']) ?></td>
							<td><?php echo($rs['estado']) ?></td>

							<td class="linha_opcoes">
								<a class="opcoes_link" href="conteudo_nossas-lojas.php?modo=excluir&codigo=<?php echo($rs['cod_nossa_loja']) ?>">Excluir</a>					
							</td>
							<td class="linha_opcoes">
								<a class="opcoes_link" href="conteudo_nossas-lojas.php?modo=editar&codigo=<?php echo($rs['cod_nossa_loja']) ?>">Editar</a>
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