<?php  

$sql_cat = null;

function filtro() {

if (isset($_REQUEST["categoria"])) {
	$categoria = $_REQUEST["categoria"];
	$sql_cat = "select l.*, a.conhecido as autor from livro as l
				inner join autor as a on(l.cod_autor = a.cod_autor)
				where cod_genero = ".$categoria."
				order by cod_livro desc";
} else {
	$sql_cat = "select l.*, a.conhecido as autor from livro as l
				inner join autor as a on(l.cod_autor = a.cod_autor)
				order by cod_livro desc";
}


	return $sql_cat;
}

?>

<div id="barra_lateral">
	<?php
		$sql = "select * from genero";

		$select = mysql_query($sql);

		while ($rs = mysql_fetch_array($select)) {

	?>
	<div class="caixa_barra">
		<a href="home.php?categoria=<?php echo($rs["cod_genero"]) ?>">
			<h4 class="titulos_barra"> <?php echo($rs["nome"]) ?> </h4>
		</a>
	</div>

	<?php 
		}
	?>
	
</div>