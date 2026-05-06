<?php 

	require_once __DIR__ . '/../src/database.php';

	$sql = "select l.*, a.nome as autor, d.nome as distribuidora, e.nome as editora 
	from livro as l
	inner join autor as a on(l.cod_autor = a.cod_autor)
	inner join distribuidora as d on(l.cod_distribuidora = d.cod_distribuidora)
	inner join editora as e on(l.cod_editora = e.cod_editora)
	order by cod_livro asc;";

	$query = mysql_query($sql);
	
	$livro = array();

	while ($rs = mysql_fetch_array($query)) {
		
		$array = array(
			"cod_livro" => $rs["cod_livro"],
			"titulo"  => $rs["titulo"],
			"subtitulo"  => $rs["subtitulo"],
			"descricao" => $rs["descricao"],
			"imagem"    => $rs["imagem"],
			"autor"  => $rs["autor"],
			"distribuidora"  => $rs["distribuidora"],
			"editora" => $rs["editora"],
			"preco" => $rs["preco"]
		);

		$livro[] = $array;

	}

	echo (json_encode($livro));
	




?>
