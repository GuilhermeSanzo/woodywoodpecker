<?php

/* Conexão com o banco de dados */
include "../conexao.php";


if(isset($_REQUEST["btn_entrar"])) {

$login = $_REQUEST["usuario"];
$senha = $_REQUEST["senha"];

$_SESSION["login"] = $login;


	$sql = " select u.*, tu.tipo from usuario as u inner join tipo_usuario as tu on(u.codTipoUsuario = tu.codTipoUsuario) where login = '".$login."' and senha = '".$senha."' ";
	$verificacao = mysql_query($sql);
	
	
	if ($rs = mysql_fetch_array($verificacao)) {		
		$_SESSION["nome"] = $rs["nome"];

		header("location:../woody_woodpecker_v1/home.php");
	} else {
		echo("<script>alert('O nome de usuario ou a senha está errada!')</script>");
	}


}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Sobre - Woody Woodpecker</title>
	<link type="text/css" rel="stylesheet" href="/public/css/site/estilo_geral.css">
	<link rel="stylesheet" type="text/css" href="/public/css/site/estilo_sobre.css">
	<link type="image/x-icon" rel="shortcut icon" href="/public/images/site/shortcut_icon.png">
	<script type="text/javascript" src="Efeitos/jquery-2.1.3.js"></script>
    <script type="text/javascript" src="Efeitos/efeito.js"></script>
    <meta charset="utf-8">
</head>
<body>
	<!-- Cabeçalho -->
	<header>
		<div id="centraliza_cabecalho">
			<!-- Logo da página -->
			<a href="home.html" id="logo"><img src="/public/images/site/woody_woodpecker_logo.png" alt="Icon" title="Livraria Woody Woodpecker"></a>
			<!-- Caixa de pesquisa -->
			<form id="formulario_pesquisa">
				<input type="text" name="pesquisa" placeholder="Pesquisar">	
				<input type="submit" name="btn_pesquisa" value="&nbsp;">
			</form>
			<!-- Novas caixas para entrada -->
			<div class="caixa_entrada">
				<a href="#">Cadastrar</a>
			</div>
			<div class="caixa_entrada">
				<a href="login.php">Login</a>
			</div>
			<!-- Menu de navegação -->
			<nav id="menu">
				<ul>
					<li><a href="home.php">Home</a></li>
					<li><a href="autores-destaque.php">Autores em destaque</a></li>
					<li><a href="sobre.php" class="menu_page">Sobre</a></li>
					<li><a href="promocoes.php">Promoções</a></li>
					<li><a href="nossas-lojas.php">Nossas Lojas</a></li>
					<li><a href="livro-mes.php">Livro do mês</a></li>
					<li><a href="fale-conosco.php">Fale conosco</a></li>
				</ul>
		  </nav>
		</div>
	</header>
	<!-- Corpo da página -->
	<section id="corpo">
		<!-- Banner -->
		<?php 

		include "php/slider.php";

		?>
		<!-- Barra lateral -->
		<?php 

		include "php/barra_categorias.php";

		?>
		<!-- Conteúdo principal -->
		<section id="principal">
			<h3>Sobre</h3>
			<!-- Primeira lista -->
			<div id="sobre">
				<h4>Histórico</h4>
				<p>Nosso histórico demonstra nossa tradição, pioneirismo e flexibilidade na atuação nos mercados editorial e varejista de livros no Brasil.</p>
				<h4>Fundação</h4>
				<p>Nossa história teve o seu início em 2016, quando Sr. Marcel Neves Teixeira, professor de Programação Web do SENAI Professor Vicente Amato, fundou em Jandira, São Paulo, uma pequena livraria destinada ao comércio de livros usados. Em virtude da localização da livraria, muito próxima ao SENAI Jandira, do interesse pessoal e conhecimento da literatura de programação que o Sr. Marcel possuía, a então denominada "Livraria Woody" tornou-se conhecida dos professores e estudantes de programação frequentadores da região e especializou-se no comércio de livros de programação, que representa, até os dias de hoje, um segmento importante nos nossos negócios.</p>
				<h4>Início</h4>
				<p>Na mesma década, Marcel edita o primeiro livro, "Programação Web", inaugurando a fase editorial da livraria. Nos trinta anos seguintes, a livraria teria como prioridade a área de programação. A editora estende suas atividade comerciais e começa a editar também livros didáticos, literatura geral, ciências, etc., ao mesmo tempo em que amplia as atividades editoriais no campo de programação e se torna a mais conceituada editora desse tipo de obra no Brasil.</p>
				<h4>Empresa de sociedade anônima</h4>
				<p>Em 2016 a empresa transforma-se em sociedade anônima, com a denominação Woody Woodpecker - Livreiros Editores. Um grande números de ex-estudantes encaminham-se à livraria para subscrever ações da empresa em homenagem ao seu fundador, o conselheiro Woody. A partir de 2016, passamoms a editar livros didáticos e livros paradidáticos e, em 1972, a Woody Woodpecker transformou-se numa companhia aberta.</p>
				<h4>Segunda Woody Woodpecker</h4>
				<p>Ao longo de 2016, o processo de crescimento e formação de uma rede de lojas se iniciou concretamente com a abertura da segunda Livraria Woody Woodpecker, na Praça da Sé, marco central da capital de São Palo. Na década de 2016, com o crescimento do número de títulos publicados, viabiliza-se um serviço próprio de distribuição de livros da Editora Woody Woodpecker. Em 2016, iniciou-se o processo de expansão da rede de estabelecimentos da Livraria, com a abertura de diversas lojas em outros estados brasileiros e em shoppings center.</p>
				<h4>Pioneirismo</h4>
				<p>Enquantos que os anos 2016, reafirmando seu pioneirismo com as publicações de programação, a Woody Woodpecker passa a editar livros paradidáticos, obras de complementação do ensino fundamental e médio. Ao final da década, a Woody Woodpecker passa a editar livros nas áreas de programação desktop, programação mobile e banco de dados destinados ao currículo do ensino de terceiro grau. Enquanto a unidade de varejo abre a primeira de uma série de megalivrarias, totalmente informatizadas.</p>
				<h4>Entrando na internet</h4>
				<p>Em 2016, a Woody Woodpecker conclui a aquisição da Editora Atual. E passa a comercializar seus produtos por meio da internet através do site www.woodywoodpecker.com.br. Um dos primeiros sites de e-commerce do Brasil.</p>
				<h4>Novas práticas</h4>
				<p>Em 2016, houve a adesão às práticas diferenciadas de governança corporativa nível 2 da BOVESPA e em abril do mesmo ano a realização bem sucesidade de uma distribuição primária de três milhões de ações preferenciais, fortalecendo a posição financeira da companhia para o desenvolvimento de estudos e implementação de projetos de investimento.</p>
				<h4>Conteúdos didáticos e digitais</h4>
				<p>Em 2016, a Woody Woodpecker adquiriu a Pigmento Editoral S.A., responsável pela comercialização do ético sistema de ensino, composto por uma linha de materiais didáticos editados com absoluto rigor conceitual e por uma linha e serviços de apoio pedagógico de reconhecida qualidade. Nesse mesmo ano, dando um passo a mais rumo ao futuro, a Woody Woodpecker cria produtos para atender as demandas do mercado educacional por conteúdos digitais.</p>
				<h4>Ampliando os negócios e nova era digital</h4>
				<p>Em 2016, a Woody Woodpecker amplia significativamente o seu potencial de atuação no mercado editoral e livreiro com a aquisição de 100% do controle acionário do grupo siciliano e passa a operar todas as lojas físicas e site desta rede.</p>
				<h4>Um olhar para a educação</h4>
				<p>Em 2010, a Editora Woody Woodpecker lança o Agora , sistema de ensino para a educação publica. No início de 2008, com a aquisição do grupo Siciliano, os selos Arx e Caramelo foram incorporados ao catálogo da Editora. Em 2010 foi criado o selo Benvirá para publicação de obras de ficção e não ficção. em 2010, a Woody Woodpecker.com lança o Woody Woodpecker Digital Reader, uma plataforma que permite a venda de livros digitais (e-books). Nesse mesmo ano, a fabricante de televisores LG lança uma linha de produtos com opção de acesso à internet que utiliza de forma nativa a plataforma de comercialização de filmes digitais da Woody Woodpecker. Em abril de 2010 é inaugurada a primeira loja iTown, uma operação da livraria totalmente dedicada à venda de produtos da Apple.</p>
			</div>
		</section>
	</section>
	<!-- Redes Sociais -->
	<div id="redes_sociais">
		<div id="facebook"></div>
		<div id="twitter"></div>
		<div id="google_plus"></div>
	</div>
	<!-- Rodapé -->
	<footer>
		<div id="rodape">
			<div id="lado1">
				<div id="rodape_logo">
					<a href="home.php">
						<img src="/public/images/site/woody_woodpecker_logo.png" alt="Icon" title="Livraria Woody Woodpecker">
						<h2>Woody Woodpecker</h2>
					</a>
				</div>
	            <div id="sitemap">
	                <h3>Sitemap</h3>
	                    <ul>
	                        <li>The Store</li>
	                        <li>Company</li>
	                        <li>Terms & Conditions</li>
	                        <li>Privacy Policy</li>
	                    </ul>
	            </div>
	            <div id="customer">
	                <h3>Customer Info</h3>
	                    <ul>
	                        <li>Order Tracking</li>
	                        <li>Shipping & Handling</li>
	                        <li>Payment</li>
	                        <li>Refund Policy</li>
	                        <li>FAQ</li>
	                        <li>Help</li>
	                    </ul>
	            </div>
	            <div id="newsletter">
	                <h3>Newsletter</h3>
	                <input type="text" name="mail" placeholder="Mail adress....">
	                <input type="button" name="go" value="GO">
	                <p>We guarantee that your mail adress<br>will be used for and only for our<br>newsletter</p>
	            </div>
	            <div id="social">
	                <h3>Social</h3>
	                <ul>
	                    <li>Facebook</li>
	                    <li>Youtube</li>
	                    <li>RSS Feeds</li>
	                    <li>Twitter</li>
	                </ul>
	            </div>
	            <div id="patrocinios">
	                <img src="/public/images/site/patrocinios.png" alt="Patrocínios">
	            </div>
	        </div>
	        <div id="copyright">
	            <div id="lado2">
	            <p>© Copyright 2016 Woody Woodpecker - All Rights Reserved</p>
	            </div>
	        </div>
        </div>
	</footer>
</body>
</html>