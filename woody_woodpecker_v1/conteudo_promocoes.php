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
	$botao2 = "Salvar";
	$nome = null;
	$status = null;

	$livro_temp = "Escolha um livro";
	$livro = 0;
	$promocao_temp = "Escolha uma promoção";
	$promocao = 0;
	
	$dt_inicial = null;
	$dt_final = null;

	if (isset($_REQUEST['btn_enviar'])) {
		$nome = $_REQUEST["txt_nome"];
		$status = $_REQUEST["txt_status"];
		$dt_inicial = $_REQUEST["dt_inicial"];
		$dt_final = $_REQUEST["dt_final"];

		// Enviando os arquivos
		if ($_REQUEST['btn_enviar'] == "Salvar") {
			$sql = "insert into promocao (nome, status, dt_inicial, dt_final) values ('".$nome."', ".$status.", '".$dt_inicial."', '".$dt_final."')";
		}

		// Editando os arquivos
		if ($_REQUEST['btn_enviar'] == "Editar") {
			$sql = "update promocao set nome = '".$nome."', status = ".$status.", dt_inicial = '".$dt_inicial."', dt_final = '".$dt_final."' where cod_promocao = ".$_SESSION["codigo"]."";
		}

		//echo($sql);
		mysql_query($sql);
		header("location:conteudo_promocoes.php");

	}

	// Modo
	if (isset($_REQUEST['modo'])) {
		$modo = $_REQUEST['modo'];

		if ($modo == "excluir") {
			$codigo = $_REQUEST['codigo'];
			$sql = "delete from promocao where cod_promocao=".$codigo."";
			//echo($sql);
			mysql_query($sql);
			header("location:conteudo_promocoes.php");
		}

		if ($modo == "editar") {
			$_SESSION["codigo"] = $_REQUEST['codigo'];
			
			$sql = "select * from promocao where cod_promocao=".$_SESSION['codigo']."";
			
			$query = mysql_query($sql);
			$rs = mysql_fetch_array($query);

			$nome = $rs["nome"];
			$status = $rs["status"];
			$dt_inicial = $rs["dt_inicial"];
			$dt_final = $rs["dt_final"];

			$botao = "Editar";
		}

	}

	// Para a tabela de livros com promoções

	if (isset($_REQUEST['btn_enviar2'])) {
		$livro = $_REQUEST["txt_livro"];
		$promocao = $_REQUEST["txt_promocao"];

		// Enviando os arquivos
		if ($_REQUEST['btn_enviar2'] == "Salvar") {
			$sql = "insert into livro_promocao (cod_livro, cod_promocao) values (".$livro.", ".$promocao.")";
		}

		// Editando os arquivos
		if ($_REQUEST['btn_enviar2'] == "Editar") {
			$sql = "update livro_promocao set cod_livro = ".$livro.", cod_promocao = ".$promocao." where cod_livro_promocao = ".$_SESSION["codigo"]."";
		}

		//echo($sql);
		mysql_query($sql);
		header("location:conteudo_promocoes.php");

	}

	// Modo
	if (isset($_REQUEST['modo2'])) {
		$modo2 = $_REQUEST['modo2'];

		if ($modo2 == "excluir") {
			$codigo = $_REQUEST['codigo'];
			$sql = "delete from livro_promocao where cod_livro_promocao=".$codigo."";
			//echo($sql);
			mysql_query($sql);
			header("location:conteudo_promocoes.php");
		}

		if ($modo2 == "editar") {
			$_SESSION["codigo"] = $_REQUEST['codigo'];
			
			$sql = "select lm.*, l.titulo as livro, p.nome as promocao from livro_promocao as lm
			inner join livro as l on(lm.cod_livro = l.cod_livro)
			inner join promocao as p on(lm.cod_promocao = p.cod_promocao)
			where cod_livro_promocao=".$_SESSION['codigo']."";
			
			$query = mysql_query($sql);
			$rs = mysql_fetch_array($query);

			$livro = $rs["cod_livro"];
			$promocao = $rs["cod_promocao"];
			
			$livro_temp = $rs["livro"];
			$promocao_temp = $rs["promocao"];

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
	<link type="text/css" rel="stylesheet" href="/public/css/admin/estilo_cms-produto.css">

	<!-- Efeito / Estilo das Tabs -->
	<link rel="stylesheet" href="Efeitos/jquery-ui/jquery-ui.css">
	<script src="Efeitos/jquery-1.10.2.js"></script>
	<script src="Efeitos/jquery-ui/jquery-ui.js"></script>

	<script type="text/javascript">
		$(function(){
			$( "#tabs").tabs();
			$( "#accordion").accordion();
			$( "#accordion_two").accordion();

			/*
			$("#ui-id-1").click(function(){
				location = "http://localhost/woody_woodpecker/woody_woodpecker_v1/conteudo_promocoes.php#tabs-1";
			});

			$("#ui-id-2").click(function(){
				location = "http://localhost/woody_woodpecker/woody_woodpecker_v1/conteudo_promocoes.php#tabs-2";
			});
			*/

			$("#ui-id-4").css("height", "inherit");
			$("#ui-id-6").css("height", "inherit");
			$("#ui-id-8").css("height", "inherit");
			$("#ui-id-10").css("height", "inherit");
		});
	</script>
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
			<h2 id="titulo_gerenciamento">Promoções</h2>

			<div id="tabs">
			 	<ul>
			    	<li><a href="#tabs-1">Administração de Promoções</a></li>
			    	<li><a href="#tabs-2">Administração de Livros nas Promoções</a></li>
			  	</ul>
			  	<div id="tabs-1">
			  		<div id="accordion">
			  			<h3>Cadastro de Promoções</h3>
			  			<div>
					  		<div id="inserir">
								<form name="produto_distribuidora_form" method="post">
									<table id="tbl_cms_usuarios">
										<thead>
											<tr>
												<th colspan="2">Cadastro de Promoções</th>
											</tr>
										</thead>
										<tbody>
											<tr> 
												<td></td>
												<td></td>
											</tr>
											<tr>
												<td>Nome</td>
												<td><input type="text" name="txt_nome" class="estilo_input" value="<?php echo($nome) ?>" required></td>
											</tr>
											<tr>
												<td>Status</td>
												<td>
													<select name="txt_status" class="estilo_input" >
														<option value="1">Ativado</option>
														<option value="0">Desativado</option>	
													</select>
												</td>
											</tr>
											<tr>
												<td>Data Inicial</td>
												<td><input type="date" name="dt_inicial" class="estilo_input" value="<?php echo($dt_inicial) ?>" required></td>
											</tr>
											<tr>
												<td>Data Final</td>
												<td><input type="date" name="dt_final" class="estilo_input" value="<?php echo($dt_final) ?>" required></td>
											</tr>
											<tr>
												<td><input type="submit" name="btn_enviar" value="<?php echo($botao) ?>"></td>
												<td><input type="reset" name="btn_limpar" value="Limpar"></td>
											</tr>
										</tbody>
									</table>
								</form>
							</div>
						</div>
						<!-- Consulta -->
						<h3>Consulta de Promoções</h3>
						<div>
							<!-- Consulta de Promoções -->
							<div id="consulta">
								<table id="tblconsulta">
									<thead>
										<tr>
											<th>Nome</th>
											<th>Status</th>
											<th>Data Inicial</th>
											<th>Data Final</th>
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
											$sql = "select * from promocao order by cod_promocao desc";
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
											<td><?php echo($rs['nome']) ?></td>
											<td><?php echo($status) ?></td>
											<td><?php echo($rs['dt_inicial']) ?></td>
											<td><?php echo($rs['dt_final']) ?></td>

											<td class="linha_opcoes">
												<a class="opcoes_link" href="conteudo_promocoes.php?modo=excluir&codigo=<?php echo($rs['cod_promocao']) ?>">Excluir</a>					
											</td>
											<td class="linha_opcoes">
												<a class="opcoes_link" href="conteudo_promocoes.php?modo=editar&codigo=<?php echo($rs['cod_promocao']) ?>">Editar</a>
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
						</div>
					</div>
			  	</div>
			  	<div id="tabs-2">
			  		<div id="accordion_two">
			  			<h3>Cadastro de Livros em Promoções</h3>
			  			<div>
			  				<div id="inserir">
								<form name="produto_distribuidora_form" method="post">
									<table id="tbl_cms_usuarios">
										<thead>
											<tr>
												<th colspan="2">Cadastro de Livros nas Promoções</th>
											</tr>
										</thead>
										<tbody>
											<td>Autor:</td>
											<td>
												<select name="txt_livro" class="estilo_input" required>
													<option value="<?php echo($livro) ?>"><?php echo($livro_temp) ?></option>
													<?php
														// SQL resgatando os autores
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
											<tr>
												<td>Promoção</td>
												<td>
													<select name="txt_promocao" class="estilo_input" required>
														<option value="<?php echo($promocao) ?>"><?php echo($promocao_temp) ?></option>
														<?php
															// SQL resgatando os autores
															$sql = "select * from promocao order by cod_promocao desc";
															$select = mysql_query($sql);

															while($rs = mysql_fetch_array($select)) {

														?>
														<option value="<?php echo($rs['cod_promocao']) ?>"><?php echo($rs['nome']) ?></option>
														<?php

															}

														?>
													</select>
												</td>
											</tr>
											<tr>
												<td><input type="submit" name="btn_enviar2" value="<?php echo($botao2) ?>"></td>
												<td><input type="reset" name="btn_limpar2" value="Limpar"></td>
											</tr>
										</tbody>
									</table>
								</form>
							</div>
					  	</div>
					  	<h3>Consulta de Livros em Promoções</h3>
			  			<div>
			  				<!-- Consulta de Distribuidoras -->
							<div id="consulta">
								<table id="tblconsulta">
									<thead>
										<tr>
											<th>Livro</th>
											<th>Promoção</th>
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
											$sql = "select lm.*, l.titulo as livro, p.nome as promocao from livro_promocao as lm
											inner join livro as l on(lm.cod_livro = l.cod_livro)
											inner join promocao as p on(lm.cod_promocao = p.cod_promocao)
											order by cod_promocao desc";
											$select = mysql_query($sql);

											$cont = 0;
											$estilo = 1000;
											while($rs = mysql_fetch_array($select)) {
												$cont++;
												if ($cont >= 7) $estilo = 1000 + $cont * 5;
										?>
										<tr>
											<td><?php echo($rs['livro']) ?></td>
											<td><?php echo($rs['promocao']) ?></td>

											<td class="linha_opcoes">
												<a class="opcoes_link" href="conteudo_promocoes.php?modo2=excluir&codigo=<?php echo($rs['cod_promocao']) ?>">Excluir</a>					
											</td>
											<td class="linha_opcoes">
												<a class="opcoes_link" href="conteudo_promocoes.php?modo2=editar&codigo=<?php echo($rs['cod_promocao']) ?>">Editar</a>
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
			  			</div>
			  		</div>			  			
			  	</div>  		
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