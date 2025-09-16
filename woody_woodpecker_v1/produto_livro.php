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
	$subtitulo = null;
	$descricao = null;
	$imagem = null;
	$preco = null;

	$autor_temp = "Selecione o autor";
	$genero_temp = "Selecione o gênero";
	$distribuidora_temp = "Selecione a distribuidora";
	$editora_temp = "Selecione a editora";

	$autor = 0;
	$genero = 0;
	$distribuidora = 0;
	$editora = 0;
	
	if (isset($_REQUEST['btn_enviar'])) {
		$titulo = $_REQUEST["txt_titulo"];
		$subtitulo = $_REQUEST["txt_subtitulo"];
		$descricao = $_REQUEST["txt_descricao"];
		$preco = $_REQUEST["preco"];

		$autor = $_REQUEST["txt_autor"];
		$genero = $_REQUEST["txt_genero"];
		$distribuidora = $_REQUEST["txt_distribuidora"];
		$editora = $_REQUEST["txt_editora"];

		// Upload do diretório
		$upload_dir = "Arquivos/";

		// Nome do arquivo
		$nome_arq = basename($_FILES["arq_foto"]["name"]);

		// Concatenação do endereço e nome
		$upload_file = $upload_dir . $nome_arq;

		// Enviando os arquivos

		if ($_REQUEST['btn_enviar'] == "Salvar") {
			if (strstr($nome_arq, ".png") || strstr($nome_arq, ".jpg")) {
				if (move_uploaded_file($_FILES["arq_foto"]["tmp_name"], $upload_file)) {
					$sql = "insert into livro (titulo, subtitulo, descricao, imagem, cod_autor, cod_genero, cod_distribuidora, cod_editora, preco) values ('".$titulo."', '".$subtitulo."', '".$descricao."', '".$upload_file."', ".$autor.", ".$genero.", ".$distribuidora.", ".$editora.", ".$preco.")";
				}
			}
		}

		// Editando os arquivos
		if ($_REQUEST['btn_enviar'] == 'Editar') {
			if (strstr($nome_arq, ".png") || strstr($nome_arq, ".jpg")) {
				if (move_uploaded_file($_FILES["arq_foto"]["tmp_name"], $upload_file)) {
					$sql = "update livro set titulo = '".$titulo."', subtitulo = '".$subtitulo."', descricao = '".$descricao."',imagem = '".$upload_file."', cod_autor = ".$autor.", cod_genero = ".$genero.", cod_distribuidora = ".$distribuidora.", cod_editora = ".$editora.", preco = ".$preco." where cod_livro = ".$_SESSION['codigo']."";

				}
			} else {
				$sql = "update livro set titulo = '".$titulo."', subtitulo = '".$subtitulo."', descricao = '".$descricao."', cod_autor = ".$autor.", cod_genero = ".$genero.", cod_distribuidora = ".$distribuidora.", cod_editora = ".$editora.", preco = ".$preco." where cod_livro = ".$_SESSION['codigo']."";
			}
		}

		//echo($sql);
		mysql_query($sql);
		header("location:produto_livro.php");

	}

	if (isset($_REQUEST['modo'])) {
		$modo = $_REQUEST['modo'];

		if ($modo == "excluir") {
			$codigo = $_REQUEST['codigo'];
			$sql = "delete from livro where cod_livro=".$codigo."";
			mysql_query($sql);
			header("location:produto_livro.php");
		}

		if ($modo == "editar") {
			$_SESSION["codigo"] = $_REQUEST['codigo'];

			$sql = "select l.*, a.nome as autor, g.nome as genero, d.nome as distribuidora, e.nome as editora
			from livro as l 
			inner join autor as a on(l.cod_autor = a.cod_autor)
			inner join genero as g on(l.cod_genero = g.cod_genero)
			inner join distribuidora as d on(l.cod_distribuidora = d.cod_distribuidora)
			inner join editora as e on(l.cod_editora = e.cod_editora)
			where cod_livro = ".$_SESSION['codigo']."";
			
			$query = mysql_query($sql);
			$rs = mysql_fetch_array($query);

			$titulo = $rs["titulo"];
			$subtitulo = $rs["subtitulo"];
			$descricao = $rs["descricao"];
			$imagem = $rs["imagem"];
			$preco = $rs["preco"];

			$autor = $rs["cod_autor"];
			$genero = $rs["cod_genero"];
			$distribuidora = $rs["cod_distribuidora"];
			$editora = $rs["cod_editora"];

			$autor_temp = $rs["autor"];
			$genero_temp = $rs["genero"];
			$distribuidora_temp = $rs["distribuidora"];
			$editora_temp = $rs["editora"];

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
	<link type="image/x-icon" rel="shortcut icon" href="Imagens/shortcut_icon.png">
	<link type="text/css" rel="stylesheet" href="Estilo/estilo_geral.css">
	<link type="text/css" rel="stylesheet" href="Estilo/estilo_cms-produto.css">
</head>
<body>
	<header>
		<div id="centraliza_cabecalho">
			<a href="../woody_woodpecker_v0/home.php"><img src="Imagens/woody_woodpecker_logo.png" alt="Logo"></a>
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
							<img src="Imagens/content.png" alt="Administração de Conteúdo">
							<p>Adm. de Conteúdo</p>
						</div>
					</a>
				</li>
				<li>
					<a href="cms_fale-conosco.php">
						<div class="cx_menu">
							<img src="Imagens/headset.png" alt="Administração do Fale Conosco">
							<p>Adm. do Fale Conosco</p>
						</div>
					</a>
				</li>
				<li class="menu-ativo">
					<a href="cms_produto.php">
						<div class="cx_menu">
							<img src="Imagens/bag.png" alt="Administração dos Produtos">
							<p>Adm. de Produtos</p>
						</div>
					</a>
				</li>
				<li>
					<a href="cms_usuarios.php">
						<div class="cx_menu">
							<img src="Imagens/user.png" alt="Administração de Usuários">
							<p>Adm. de Usuários</p>
						</div>
					</a>
				</li>
			</ul>
		</nav>
		<section id="conteudo">
			<h2 id="titulo_gerenciamento">Livro</h2>

			<div id="inserir">
				<form name="cms_usuario_form" method="post" enctype="multipart/form-data">
					<table id="tbl_cms_usuarios">
						<thead>
							<tr>
								<th colspan="5">Cadastro de Livros</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Título:</td>
								<td><input type="text" name="txt_titulo" class="estilo_input" value="<?php echo($titulo) ?>" required></td>
							</tr>
							<tr>
								<td>Subtítulo:</td>
								<td><input type="text" name="txt_subtitulo" class="estilo_input" value="<?php echo($subtitulo) ?>"></td>
							</tr>
								<td>Descrição:</td>
								<td><input type="text" name="txt_descricao" class="estilo_input" value="<?php echo($descricao) ?>" required></td>
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
								<td>Autor:</td>
								<td>
									<select name="txt_autor" class="estilo_input" required>
										<option value="<?php echo($autor) ?>"><?php echo($autor_temp) ?></option>
										<?php
											// SQL resgatando os autores
											$sql = "select * from autor order by cod_autor desc";
											$select = mysql_query($sql);

											while($rs = mysql_fetch_array($select)) {

										?>
										<option value="<?php echo($rs['cod_autor']) ?>"><?php echo($rs['nome']) ?></option>
										<?php

											}

										?>
									</select>
								</td>
							</tr>
							<tr>
								<td>Gênero:</td>
								<td>
									<select name="txt_genero" class="estilo_input" required>
										<option value="<?php echo($genero) ?>"><?php echo($genero_temp) ?></option>
										<?php
											// SQL resgatando os autores
											$sql = "select * from genero order by cod_genero desc";
											$select = mysql_query($sql);

											while($rs = mysql_fetch_array($select)) {

										?>
										<option value="<?php echo($rs['cod_genero']) ?>"><?php echo($rs['nome']) ?></option>
										<?php

											}

										?>
									</select>
								</td>
							</tr>
							<tr>
								<td>Distribuidora:</td>
								<td>
									<select name="txt_distribuidora" class="estilo_input" required>
										<option value="<?php echo($distribuidora) ?>"><?php echo($distribuidora_temp) ?></option>
										<?php
											// SQL resgatando os autores
											$sql = "select * from distribuidora order by cod_distribuidora desc";
											$select = mysql_query($sql);

											while($rs = mysql_fetch_array($select)) {

										?>
										<option value="<?php echo($rs['cod_distribuidora']) ?>"><?php echo($rs['nome']) ?></option>
										<?php

											}

										?>
									</select>
								</td>
							</tr>
							<tr>
								<td>Editora:</td>
								<td>
									<select name="txt_editora" class="estilo_input" required>
										<option value="<?php echo($editora) ?>"><?php echo($editora_temp) ?></option>
										<?php
											// SQL resgatando os autores
											$sql = "select * from editora order by cod_editora desc";
											$select = mysql_query($sql);

											while($rs = mysql_fetch_array($select)) {

										?>
										<option value="<?php echo($rs['cod_editora']) ?>"><?php echo($rs['nome']) ?></option>
										<?php

											}

										?>
									</select>
								</td>
							</tr>
							</tr>
								<td>Preco:</td>
								<td><input type="text" name="preco" class="estilo_input" value="<?php echo($preco) ?>" required></td>
							<tr>
							<tr>
								<td><input type="submit" name="btn_enviar" value="<?php echo($botao) ?>"></td>
								<td><input type="reset" name="btn_limpar" value="Limpar"></td>
							</tr>
						</tbody>
					</table>
				</form>
			</div>

			<!-- Tabela de Consulta -->
			<div id="consulta">
				<table id="tblconsulta">
					<thead>
						<tr>
							<th>Titulo</th>
							<th>Subtitulo</th>
							<th>Descricao</th>
							<th>Foto</th>
							<th>Autor</th>
							<th>Gênero</th>
							<th>Distribuidora</th>
							<th>Editora</th>
							<th>Preço</th>
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
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td colspan="2">&nbsp;</td>
						</tr>
					
						<?php
							$sql = "select l.*, a.nome as autor, g.nome as genero, d.nome as distribuidora, e.nome as editora
							from livro as l 
							inner join autor as a on(l.cod_autor = a.cod_autor)
							inner join genero as g on(l.cod_genero = g.cod_genero)
							inner join distribuidora as d on(l.cod_distribuidora = d.cod_distribuidora)
							inner join editora as e on(l.cod_editora = e.cod_editora)
							order by cod_livro desc";
							$select = mysql_query($sql);

							while($rs = mysql_fetch_array($select)) {
						?>
						<tr>
							<td><?php echo($rs['titulo']) ?></td>
							<td><?php echo($rs['subtitulo']) ?></td>
							<td><?php echo($rs['descricao']) ?></td>
							<td><img src="<?php echo($rs['imagem']) ?>" alt="<?php echo($rs['imagem']) ?>" style="width: 50px;"></td>
							<td><?php echo($rs['autor']) ?></td>
							<td><?php echo($rs['genero']) ?></td>
							<td><?php echo($rs['distribuidora']) ?></td>
							<td><?php echo($rs['editora']) ?></td>
							<td><?php echo($rs['preco']) ?></td>

							<td class="linha_opcoes">
								<a class="opcoes_link" href="produto_livro.php?modo=excluir&codigo=<?php echo($rs['cod_livro']) ?>">Excluir</a>					
							</td>
							<td class="linha_opcoes">
								<a class="opcoes_link" href="produto_livro.php?modo=editar&codigo=<?php echo($rs['cod_livro']) ?>">Editar</a>
							</td>
						</tr>
						<?php
							}
						?>
					</tbody>
				</table>

		</section>
	</section>
	<footer>
		<div id="centraliza_rodape">
			<p>Desenvolvido por: Guilherme Santos Souza</p>
		</div>
	</footer>
</body>
</html>