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
	$conhecido = "";
	$imagem = "";
	$data_nasc = "";
	$data_morte = "";
	$descricao = "";
	
	$data_nasc_replace = null;
	$data_nasc_sql = null;

	$data_morte_replace = null;
	$data_morte_sql = null;

	if (isset($_REQUEST['btn_enviar'])) {
		$nome = $_REQUEST["txt_nome"];
		$conhecido = $_REQUEST["txt_conhecido"];
		$data_nasc = $_REQUEST["txt_data_nasc"];
		$data_morte = $_REQUEST["txt_data_morte"];
		$descricao = $_REQUEST["txt_descricao"];

		// Convertendo o tipo data dd-mm-yyyy para yyyy-mm-dd
		$data_nasc_replace = str_replace('/', '-', $data_nasc);
		$data_nasc_sql = date('Y-m-d', strtotime($data_nasc_replace));

		$data_morte_replace = str_replace('/', '-', $data_morte);
		$data_morte_sql = date('Y-m-d', strtotime($data_morte_replace));

		// Upload do diretório
		$upload_dir = "/public/images/uploads/";

		// Nome do arquivo
		$nome_arq = basename($_FILES["arq_foto"]["name"]);

		// Concatenação do endereço e nome
		$upload_file = $upload_dir . $nome_arq;

		// Enviando os arquivos

		if ($_REQUEST['btn_enviar'] == "Salvar") {
			if (strstr($nome_arq, ".png") || strstr($nome_arq, ".jpg")) {
				if (move_uploaded_file($_FILES["arq_foto"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . $upload_file)) {
					// Enviando dados de forma diferente, caso o autor tenha morrido
					if ($data_morte != null) {
						$sql = "insert into autor (nome, conhecido, imagem, data_nasc, data_morte, descricao) values ('".$nome."', '".$conhecido."', '".$upload_file."', '".$data_nasc_sql."', '".$data_morte_sql."', '".$descricao."')";
					} else {
						$sql = "insert into autor (nome, conhecido, imagem, data_nasc, descricao) values ('".$nome."', '".$conhecido."', '".$upload_file."', '".$data_nasc_sql."','".$descricao."')";
					}

					
				}
			} else {
				// Foto padrão, caso não tenha foto
				// Enviando dados de forma diferente, caso o autor tenha morrido
				if ($data_morte != null) {
					$sql = "insert into autor (nome, conhecido, imagem, data_nasc, data_morte, descricao) values ('".$nome."', '".$conhecido."', '/public/images/uploads/imagem_padrao.jpg', '".$data_nasc_sql."', '".$data_morte_sql."', '".$descricao."')";
				} else {
					$sql = "insert into autor (nome, conhecido, imagem, data_nasc, descricao) values ('".$nome."', '".$conhecido."', '/public/images/uploads/imagem_padrao.jpg', '".$data_nasc_sql."','".$descricao."')";
				}
				
			}

		}

		// Editando os arquivos
		if ($_REQUEST['btn_enviar'] == 'Editar') {
			if (strstr($nome_arq, ".png") || strstr($nome_arq, ".jpg")) {
				if (move_uploaded_file($_FILES["arq_foto"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . $upload_file)) {
					// Enviando dados de forma diferente, caso o autor tenha morrido
					if ($data_morte != null) {
						$sql = "update autor set nome = '".$nome."', conhecido = '".$conhecido."', imagem = '".$upload_file."', data_nasc = '".$data_nasc_sql."', data_morte = '".$data_morte_sql."', descricao = '".$descricao."' where cod_autor = ".$_SESSION['codigo']."";
					} else {
						$sql = "update autor set nome = '".$nome."', conhecido = '".$conhecido."', imagem = '".$upload_file."', data_nasc = '".$data_nasc_sql."', descricao = '".$descricao."' where cod_autor = ".$_SESSION['codigo']."";
					}

				}
			} else {
				// Foto padrão, caso não tenha foto
				if ($data_morte != null) {
					$sql = "update autor set nome = '".$nome."', conhecido = '".$conhecido."', data_nasc = '".$data_nasc_sql."', data_morte = '".$data_morte_sql."', descricao = '".$descricao."' where cod_autor = ".$_SESSION['codigo']."";
				} else {
					$sql = "update autor set nome = '".$nome."', conhecido = '".$conhecido."', data_nasc = '".$data_nasc_sql."', descricao = '".$descricao."' where cod_autor = ".$_SESSION['codigo']."";
				}
			}
		}

		//echo($sql);
		mysql_query($sql);
		header("location: /views/admin/produto_autor.php");

	}

	if (isset($_REQUEST['modo'])) {
		$modo = $_REQUEST['modo'];

		if ($modo == "excluir") {
			$codigo = $_REQUEST['codigo'];
			$sql = "delete from autor where cod_autor=".$codigo."";
			mysql_query($sql);
			header("location: /views/admin/produto_autor.php");
		}

		if ($modo == "editar") {
			$_SESSION["codigo"] = $_REQUEST['codigo'];
			
			$sql = "select * from autor where cod_autor=".$_SESSION['codigo']."";
			
			$query = mysql_query($sql);
			$rs = mysql_fetch_array($query);

			$nome = $rs["nome"];
			$conhecido = $rs["conhecido"];
			$imagem = $rs["imagem"];
			$data_nasc = str_replace('-', '/', date('d-m-Y', strtotime($rs["data_nasc"])));
			if ($rs["data_morte"] != null) $data_morte = str_replace('-', '/', date('d-m-Y', strtotime($rs["data_morte"])));
			$descricao = $rs["descricao"];

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
	<script type="text/javascript" src="/views/admin/Efeitos/jquery-2.1.3.js"></script>

	<!-- Caixa do Upload -->
	<link href="/views/admin/Efeitos/jQuery.filer-1.0.5/css/jquery.filer.css" type="text/css" rel="stylesheet" />
	<link href="/views/admin/Efeitos/jQuery.filer-1.0.5/css/themes/jquery.filer-dragdropbox-theme.css" type="text/css" rel="stylesheet" />
	<script src="/views/admin/Efeitos/jQuery.filer-1.0.5/js/jquery.filer.min.js"></script>

	<!-- jQuery do tipo data -->
	<link rel="stylesheet" href="/views/admin/Efeitos/jquery-ui/jquery-ui.css">
	<script src="/views/admin/Efeitos/jquery-ui/jquery-ui.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {
		    
			$( "#accordion").accordion();

		   	$('#filer_input').filer({
		    	changeInput: '<div class="jFiler-input-dragDrop"><div class="jFiler-input-inner"><div class="jFiler-input-icon"><i class="icon-jfi-folder"></i></div><div class="jFiler-input-text"><h3>Click on this box</h3> <span style="display:inline-block; margin: 15px 0">or</span></div><a class="jFiler-input-choose-btn blue">Browse Files</a></div></div>',
			    showThumbs: true,
			    theme: "dragdropbox",
			    templates: {
			        box: '<ul class="jFiler-items-list jFiler-items-grid"></ul>',
			        item: '<li class="jFiler-item">\
			                    <div class="jFiler-item-container">\
			                        <div class="jFiler-item-inner">\
			                            <div class="jFiler-item-thumb">\
			                                <div class="jFiler-item-status"></div>\
			                                <div class="jFiler-item-info">\
			                                    <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
			                                    <span class="jFiler-item-others">{{fi-size2}}</span>\
			                                </div>\
			                                {{fi-image}}\
			                            </div>\
			                            <div class="jFiler-item-assets jFiler-row">\
			                                <ul class="list-inline pull-left"></ul>\
			                                <ul class="list-inline pull-right">\
			                                    <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
			                                </ul>\
			                            </div>\
			                        </div>\
			                    </div>\
			                </li>',
			        itemAppend: '<li class="jFiler-item">\
			                        <div class="jFiler-item-container">\
			                            <div class="jFiler-item-inner">\
			                                <div class="jFiler-item-thumb">\
			                                    <div class="jFiler-item-status"></div>\
			                                    <div class="jFiler-item-info">\
			                                        <span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
			                                        <span class="jFiler-item-others">{{fi-size2}}</span>\
			                                    </div>\
			                                    {{fi-image}}\
			                                </div>\
			                                <div class="jFiler-item-assets jFiler-row">\
			                                    <ul class="list-inline pull-left">\
			                                        <li><span class="jFiler-item-others">{{fi-icon}}</span></li>\
			                                    </ul>\
			                                    <ul class="list-inline pull-right">\
			                                        <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
			                                    </ul>\
			                                </div>\
			                            </div>\
			                        </div>\
			                    </li>',
			        itemAppendToEnd: false,
			        removeConfirmation: true,
			        _selectors: {
			            list: '.jFiler-items-list',
			            item: '.jFiler-item',
			            remove: '.jFiler-item-trash-action'
		        	}
		   		}
			});

		   $( ".data_class" ).datepicker({dateFormat: 'dd/mm/yy'});
		});
	</script>

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
			<h2 id="titulo_gerenciamento">Autor</h2>

			<div id="inserir">
				<form name="produto_autor_form" method="post" enctype="multipart/form-data">
					<table id="tbl_cms_usuarios">
						<thead>
							<tr>
								<th colspan="5">Cadastro de Autores</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Nome:</td>
								<td><input type="text" name="txt_nome" class="estilo_input" value="<?php echo($nome) ?>" required></td>
							</tr>
							<tr>
								<td>Conhecido:</td>
								<td><input type="text" name="txt_conhecido" class="estilo_input" value="<?php echo($conhecido) ?>"></td>
							</tr>
							<tr>
								<td>Foto:</td>
								<td><input type="file" name="arq_foto" id="filer_input" multiple="multiple" data-jfiler-limit="1"></td>
							</tr>
							<tr>
								<td>Data de Nascimento:</td>
								<td><input type="text" class="data_class" name="txt_data_nasc" class="estilo_input" value="<?php echo($data_nasc) ?>" required></td>
							</tr>
							<tr>
								<td>Data de Falecimento:</td>
								<td><input type="text" class="data_class" name="txt_data_morte" class="estilo_input" value="<?php echo($data_morte) ?>"></td>
							</tr>
							<tr>
								<td>Descrição:</td>
								<td>
									<textarea name="txt_descricao" class="estilo_input" required> <?php echo($descricao) ?> </textarea>
								</td>
							</tr>
							
							<?php if ($imagem != null) { ?>
							<tr>
								<td>Foto atual:</td>
								<td><img src="<?php echo str_replace(['../woody_woodpecker_v1/', 'Arquivos/'], ['', '/public/images/uploads/'], $imagem) ?>" alt="<?php echo str_replace(['../woody_woodpecker_v1/', 'Arquivos/'], ['', '/public/images/uploads/'], $imagem) ?>" style="width:200px;"></td>
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
			<!-- Tabela de Consulta -->
			<div id="consulta">
				<table id="tblconsulta">
					<thead>
						<tr>
							<th>Nome</th>
							<th>Conhecido</th>
							<th>Foto</th>
							<th>Data de Nascimento</th>
							<th>Data de Falecimento</th>
							<th>Descrição</th>
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
							<td colspan="2">&nbsp;</td>
						</tr>
					
						<?php
							$sql = "select * from autor order by cod_autor desc";
							$select = mysql_query($sql);

							$cont = 0;
							$estilo = 1000;
							while($rs = mysql_fetch_array($select)) {
								$cont++;
								if ($cont >= 7) $estilo = 1000 + $cont * 25;

						?>
						<tr>
							<td><?php echo($rs['nome']) ?></td>
							<td><?php echo($rs['conhecido']) ?></td>
							<td><img src="<?php echo str_replace(['../woody_woodpecker_v1/', 'Arquivos/'], ['', '/public/images/uploads/'], $rs['imagem']) ?>" alt="<?php echo str_replace(['../woody_woodpecker_v1/', 'Arquivos/'], ['', '/public/images/uploads/'], $rs['imagem']) ?>" style="width: 60px;"></td>
							<td><?php echo(date( 'd/m/Y', strtotime( $rs['data_nasc']) ) ) ?></td>
							<td><?php if ($rs['data_morte'] != null) echo(date( 'd/m/Y', strtotime( $rs['data_morte']) ) ) ?></td>
							<td><?php echo($rs['descricao']) ?></td>

							<td class="linha_opcoes">
								<a class="opcoes_link" href="/views/admin/produto_autor.php?modo=excluir&codigo=<?php echo($rs['cod_autor']) ?>">Excluir</a>					
							</td>
							<td class="linha_opcoes">
								<a class="opcoes_link" href="/views/admin/produto_autor.php?modo=editar&codigo=<?php echo($rs['cod_autor']) ?>">Editar</a>
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
