-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: localhost    Database: woody_woodpecker
-- ------------------------------------------------------
-- Server version	5.6.10-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `autor`
--

DROP TABLE IF EXISTS `autor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `autor` (
  `cod_autor` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `conhecido` varchar(45) DEFAULT NULL,
  `imagem` text,
  `data_nasc` date NOT NULL,
  `data_morte` date DEFAULT NULL,
  `descricao` text NOT NULL,
  PRIMARY KEY (`cod_autor`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `autor`
--

LOCK TABLES `autor` WRITE;
/*!40000 ALTER TABLE `autor` DISABLE KEYS */;
INSERT INTO `autor` VALUES (2,'John Ronald Reuel Tolkien','J.R.R. Tolkien','Arquivos/Tolkien.jpg','1970-01-01','1973-09-02',' ... '),(3,'Joanne Rowling','J.K. Rowling','Arquivos/J_K_Rowling.jpg','1965-07-31',NULL,'...'),(4,'Joaquim Maria Machado de Assis','Machado de Assis','Arquivos/machado_de_assis.jpg','1970-01-01','1908-09-29','  ...  '),(5,'George Raymond Richard Martin','George R.R. Martin','Arquivos/George_R_R_Martin.jpg','1948-09-20',NULL,'...'),(6,'Clarice Lispector','Clarice Lispector','Arquivos/clarice_lispector.jpg','1920-12-10','1977-12-09','  ...  '),(7,'Jorge Amado','Jorge Amado','Arquivos/jorge_amado.jpg','1908-08-10','2001-08-06','  ...  '),(10,'Carlos Drummond de Andrade','Carlos Drummond de Andrade','Arquivos/carlos_drummond_de_andrade.jpg','1902-10-31','1987-08-17','  ...  '),(15,'Fernando Pessoa','Fernando Pessoa','Arquivos/fernando_pessoa.jpg','1970-01-01','1935-12-30','  ...  '),(19,'Clive Staples Lewis','C.S. Lewis','Arquivos/C_S_Lewis.jpg','1970-01-01','1963-11-22','...  '),(20,'Gilbert Keith Chesterton','G.K. Chesterton','Arquivos/chesterton.jpg','1970-01-01','1936-06-14','...  ');
/*!40000 ALTER TABLE `autor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `autor_destaque`
--

DROP TABLE IF EXISTS `autor_destaque`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `autor_destaque` (
  `cod_autor_destaque` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cod_autor` int(10) unsigned NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`cod_autor_destaque`,`cod_autor`) USING BTREE,
  KEY `cod_autor_ca` (`cod_autor`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `autor_destaque`
--

LOCK TABLES `autor_destaque` WRITE;
/*!40000 ALTER TABLE `autor_destaque` DISABLE KEYS */;
INSERT INTO `autor_destaque` VALUES (1,15,1),(2,6,1),(3,2,1),(4,0,0),(5,15,1),(6,10,1),(7,5,1);
/*!40000 ALTER TABLE `autor_destaque` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conteudo`
--

DROP TABLE IF EXISTS `conteudo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conteudo` (
  `cod_conteudo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`cod_conteudo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conteudo`
--

LOCK TABLES `conteudo` WRITE;
/*!40000 ALTER TABLE `conteudo` DISABLE KEYS */;
/*!40000 ALTER TABLE `conteudo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `distribuidora`
--

DROP TABLE IF EXISTS `distribuidora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `distribuidora` (
  `cod_distribuidora` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`cod_distribuidora`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `distribuidora`
--

LOCK TABLES `distribuidora` WRITE;
/*!40000 ALTER TABLE `distribuidora` DISABLE KEYS */;
INSERT INTO `distribuidora` VALUES (1,'Entrega Livros'),(2,'Books Express');
/*!40000 ALTER TABLE `distribuidora` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `editora`
--

DROP TABLE IF EXISTS `editora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `editora` (
  `cod_editora` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  PRIMARY KEY (`cod_editora`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `editora`
--

LOCK TABLES `editora` WRITE;
/*!40000 ALTER TABLE `editora` DISABLE KEYS */;
INSERT INTO `editora` VALUES (1,'Martins'),(2,'Saraiva'),(3,'Cultura');
/*!40000 ALTER TABLE `editora` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fale_conosco`
--

DROP TABLE IF EXISTS `fale_conosco`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fale_conosco` (
  `codFaleConosco` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `telefone` varchar(14) DEFAULT NULL,
  `celular` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `homepage` varchar(200) DEFAULT NULL,
  `perfil_facebook` varchar(200) DEFAULT NULL,
  `info_produtos` varchar(200) DEFAULT NULL,
  `sexo` varchar(9) NOT NULL,
  `profissao` varchar(60) NOT NULL,
  `sugestao` text,
  PRIMARY KEY (`codFaleConosco`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fale_conosco`
--

LOCK TABLES `fale_conosco` WRITE;
/*!40000 ALTER TABLE `fale_conosco` DISABLE KEYS */;
INSERT INTO `fale_conosco` VALUES (1,'Guilherme','(11)4142-5328','(11)97983-8264','guilherme@email.com','www.guilherme.com','www.facebook.com/guilherme','O Silmarillion','Masculino','Estudante','Poderia ser responsivo.'),(3,'Yudi','(11)4002-8922','(11)94002-8922','yudi@email.com','www.yudi.com','www.facebook.com/yudi','O guia do Playstation','Masculino','Apresentador','Está faltando livros sobre playstation!'),(5,'Zaqueu','(11)6532-4826','(11)95624-5782','zaqueu@email.com','www.zaqueu.com','www.facebook.com/zaqueu','Python para zumbis','Masculino','Entusiasta de Python','Marvel <<< DC'),(6,'Mateus','(11)2389-6235','(11)95687-4362','mateus@email.com','www.mateus.com.br','www.facebook.com/mateus','Piano man','Masculino','Pianista','Faltou mais livros sobre piano e avião.'),(7,'Augusto','(11)6568-2956','(11)96313-2746','augusto@email.com','www.augustino.com','www.facebook.com/barbarossa','Guia do curriculo','Masculino','Montador de currículos','Faltou a bíblia dos currículos por Max Gehringer'),(8,'Djeison','(11)2659-8232','(11)94778-6234','djeison@email.com','www.acrevargem.com','www.facebook.com/vargem','Manual de como viver na cidade grande','Masculino','Boiadeiro','Precisava de livros sobre como abrir um portal para chegar mais rápido em casa.'),(9,'Lucas','(11)4367-8924','(11)96476-5321','lucas@email.com','www.cinebr.com.br','www.facebook.com/lucas','Manual de la mundo','Masculino','Programador','Faltou responsividade no site e também um aplicativo web.');
/*!40000 ALTER TABLE `fale_conosco` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `genero`
--

DROP TABLE IF EXISTS `genero`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `genero` (
  `cod_genero` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`cod_genero`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genero`
--

LOCK TABLES `genero` WRITE;
/*!40000 ALTER TABLE `genero` DISABLE KEYS */;
INSERT INTO `genero` VALUES (1,'Administração'),(2,'Artes'),(3,'Autoajuda'),(4,'Aventura'),(5,'Biografias e Memórias'),(6,'Ciências'),(7,'Concurso Público'),(8,'Contos e Crônicas'),(9,'Dicionários e Manuais'),(10,'Direito'),(11,'Diversos'),(12,'Economia'),(13,'Ensaios'),(14,'Ficção Científica'),(15,'Ficção Fantástica'),(16,'Ficção Suspense'),(17,'Filosofia'),(18,'Geografia'),(19,'História'),(20,'Humor'),(21,'Infanto-Juvenil'),(22,'Linguística'),(23,'Medicina'),(24,'Poesia'),(25,'Policial'),(26,'Psicologia'),(27,'Regimes'),(28,'Religião'),(29,'Romance'),(30,'Teoria e Crítica'),(31,'Terror e Suspense'),(32,'Turismo');
/*!40000 ALTER TABLE `genero` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `livro`
--

DROP TABLE IF EXISTS `livro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `livro` (
  `cod_livro` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `subtitulo` varchar(100) DEFAULT NULL,
  `descricao` text NOT NULL,
  `imagem` text,
  `cod_autor` int(10) unsigned NOT NULL,
  `cod_genero` int(10) unsigned NOT NULL,
  `cod_distribuidora` int(10) unsigned NOT NULL,
  `cod_editora` int(10) unsigned NOT NULL,
  `preco` float(10,2) NOT NULL,
  PRIMARY KEY (`cod_livro`) USING BTREE,
  KEY `cod_autor` (`cod_autor`),
  KEY `cod_genero` (`cod_genero`),
  KEY `cod_distribuidora` (`cod_distribuidora`),
  KEY `cod_editora` (`cod_editora`),
  CONSTRAINT `cod_autor` FOREIGN KEY (`cod_autor`) REFERENCES `autor` (`cod_autor`),
  CONSTRAINT `cod_distribuidora` FOREIGN KEY (`cod_distribuidora`) REFERENCES `distribuidora` (`cod_distribuidora`),
  CONSTRAINT `cod_editora` FOREIGN KEY (`cod_editora`) REFERENCES `editora` (`cod_editora`),
  CONSTRAINT `cod_genero` FOREIGN KEY (`cod_genero`) REFERENCES `genero` (`cod_genero`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `livro`
--

LOCK TABLES `livro` WRITE;
/*!40000 ALTER TABLE `livro` DISABLE KEYS */;
INSERT INTO `livro` VALUES (1,'O Hobbit','','Numa toca no chão, vivia um hobbit...','Arquivos/o_hobbit.jpg',2,31,2,3,20.10),(2,'O Senhor dos Anéis','A Sociedade do Anel','...','Arquivos/o_senhor_dos_aneis_1.jpg',2,31,2,3,10.23),(3,'O Senhor dos Anéis','As Duas Torres','...','Arquivos/o_senhor_dos_aneis_2.jpg',2,17,2,2,50.20),(4,'O Senhor dos Anéis','O Retorno do Rei','...','Arquivos/o_senhor_dos_aneis_3.jpg',2,21,2,2,30.00),(5,'O Silmarillion','','...','Arquivos/o_silmarillion.jpg',2,32,2,3,40.00),(6,'Contos Inacabados','','...','Arquivos/contos_inacabados.jpg',2,30,2,3,34.00),(7,'As Aventuras de Tom Bombadil','','...','Arquivos/as_aventuras_de_tom_bombadil.jpg',2,30,2,3,46.00),(8,'A Última Canção de Bilbo','','...','Arquivos/a_ultima_cancao_de_bilbo.jpg',2,30,2,3,46.00),(9,'Harry Potter','E a Pedra Filosofal','...','Arquivos/harry_potter_1.jpg',3,30,2,3,36.39),(10,'Harry Potter','E a Câmara Secreta','...','Arquivos/harry_potter_2.jpg',3,30,2,3,39.00),(11,'Harry Potter','E o Prisioneiro de Askaban','...','Arquivos/harry_potter_3.jpg',3,30,2,3,30.00),(12,'Harry Potter','E o Cálice de Fogo','...','Arquivos/harry_potter_4.jpg',3,30,2,3,30.00),(13,'Harry Potter','E a Ordem da Fenix','...','Arquivos/harry_potter_5.jpg',3,30,2,3,30.00),(14,'Harry Potter','E o Enigma do Príncipe','...','Arquivos/harry_potter_6.jpg',3,30,2,3,30.00),(15,'Harry Potter','E as Relíquias da Morte','...','Arquivos/harry_potter_7.jpg',3,30,2,3,30.00),(16,'As Crônicas de Nárnia','O Leão, a Feiticeira e o Guarda-Roupa','...','Arquivos/as_cronicas_de_narnia_1.jpg',19,30,2,3,30.00),(17,'As Crônicas de Nárnia','Príncipe Caspian','...','Arquivos/as_cronicas_de_narnia_2.jpg',19,30,2,3,30.00),(18,'As Crônicas de Nárnia','A Viagem do Peregrino da Alvorada','...','Arquivos/as_cronicas_de_narnia_3.jpg',19,30,2,3,30.00),(19,'As Crônicas de Nárnia','A Cadeira de Prata','...','Arquivos/as_cronicas_de_narnia_4.jpg',19,30,2,3,30.00),(20,'As Crônicas de Nárnia','O Cavalo e seu Menino','...','Arquivos/as_cronicas_de_narnia_5.jpg',19,30,2,3,30.00),(21,'As Crônicas de Nárnia','O Sobrinho do Mago','...','Arquivos/as_cronicas_de_narnia_6.jpg',19,30,2,3,30.00),(22,'As Crônicas de Nárnia','A Última Batalha','...','Arquivos/as_cronicas_de_narnia_7.jpg',19,30,2,3,30.00);
/*!40000 ALTER TABLE `livro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `livro_autor`
--

DROP TABLE IF EXISTS `livro_autor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `livro_autor` (
  `cod_livro_autor` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cod_livro` int(10) unsigned NOT NULL,
  `cod_autor` int(10) unsigned NOT NULL,
  PRIMARY KEY (`cod_livro_autor`),
  KEY `cod_livro_la` (`cod_livro`),
  KEY `cod_autor_la` (`cod_autor`),
  CONSTRAINT `cod_autor_la` FOREIGN KEY (`cod_autor`) REFERENCES `autor` (`cod_autor`),
  CONSTRAINT `cod_livro_la` FOREIGN KEY (`cod_livro`) REFERENCES `livro` (`cod_livro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `livro_autor`
--

LOCK TABLES `livro_autor` WRITE;
/*!40000 ALTER TABLE `livro_autor` DISABLE KEYS */;
/*!40000 ALTER TABLE `livro_autor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `livro_distribuidora`
--

DROP TABLE IF EXISTS `livro_distribuidora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `livro_distribuidora` (
  `cod_livro_distribuidora` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cod_livro` int(10) unsigned NOT NULL,
  `cod_distribuidora` int(10) unsigned NOT NULL,
  PRIMARY KEY (`cod_livro_distribuidora`),
  KEY `cod_livro_ld` (`cod_livro`),
  KEY `cod_distribuidora_ld` (`cod_distribuidora`),
  CONSTRAINT `cod_distribuidora_ld` FOREIGN KEY (`cod_distribuidora`) REFERENCES `distribuidora` (`cod_distribuidora`),
  CONSTRAINT `cod_livro_ld` FOREIGN KEY (`cod_livro`) REFERENCES `livro` (`cod_livro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `livro_distribuidora`
--

LOCK TABLES `livro_distribuidora` WRITE;
/*!40000 ALTER TABLE `livro_distribuidora` DISABLE KEYS */;
/*!40000 ALTER TABLE `livro_distribuidora` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `livro_editora`
--

DROP TABLE IF EXISTS `livro_editora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `livro_editora` (
  `cod_livro_editora` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cod_livro` int(10) unsigned NOT NULL,
  `cod_editora` int(10) unsigned NOT NULL,
  PRIMARY KEY (`cod_livro_editora`),
  KEY `cod_livro_le` (`cod_livro`),
  KEY `cod_editora_le` (`cod_editora`),
  CONSTRAINT `cod_editora_le` FOREIGN KEY (`cod_editora`) REFERENCES `editora` (`cod_editora`),
  CONSTRAINT `cod_livro_le` FOREIGN KEY (`cod_livro`) REFERENCES `livro` (`cod_livro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `livro_editora`
--

LOCK TABLES `livro_editora` WRITE;
/*!40000 ALTER TABLE `livro_editora` DISABLE KEYS */;
/*!40000 ALTER TABLE `livro_editora` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `livro_genero`
--

DROP TABLE IF EXISTS `livro_genero`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `livro_genero` (
  `cod_livro_genero` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cod_livro` int(10) unsigned NOT NULL,
  `cod_genero` int(10) unsigned NOT NULL,
  PRIMARY KEY (`cod_livro_genero`),
  KEY `cod_livro_lg` (`cod_livro`),
  KEY `cod_genero_lg` (`cod_genero`),
  CONSTRAINT `cod_genero_lg` FOREIGN KEY (`cod_genero`) REFERENCES `genero` (`cod_genero`),
  CONSTRAINT `cod_livro_lg` FOREIGN KEY (`cod_livro`) REFERENCES `livro` (`cod_livro`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `livro_genero`
--

LOCK TABLES `livro_genero` WRITE;
/*!40000 ALTER TABLE `livro_genero` DISABLE KEYS */;
/*!40000 ALTER TABLE `livro_genero` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `livro_mes`
--

DROP TABLE IF EXISTS `livro_mes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `livro_mes` (
  `cod_livro_mes` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cod_livro` int(10) unsigned NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`cod_livro_mes`) USING BTREE,
  KEY `cod_livro_lm` (`cod_livro`),
  CONSTRAINT `cod_livro_lm` FOREIGN KEY (`cod_livro`) REFERENCES `livro` (`cod_livro`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `livro_mes`
--

LOCK TABLES `livro_mes` WRITE;
/*!40000 ALTER TABLE `livro_mes` DISABLE KEYS */;
INSERT INTO `livro_mes` VALUES (1,1,1),(2,3,1),(3,4,1),(5,3,1);
/*!40000 ALTER TABLE `livro_mes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `livro_promocao`
--

DROP TABLE IF EXISTS `livro_promocao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `livro_promocao` (
  `cod_livro_promocao` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cod_livro` int(10) unsigned NOT NULL,
  `cod_promocao` int(10) unsigned NOT NULL,
  PRIMARY KEY (`cod_livro_promocao`),
  KEY `cod_livro_lp` (`cod_livro`),
  KEY `cod_promocao_lp` (`cod_promocao`),
  CONSTRAINT `cod_livro_lp` FOREIGN KEY (`cod_livro`) REFERENCES `livro` (`cod_livro`),
  CONSTRAINT `cod_promocao_lp` FOREIGN KEY (`cod_promocao`) REFERENCES `promocao` (`cod_promocao`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `livro_promocao`
--

LOCK TABLES `livro_promocao` WRITE;
/*!40000 ALTER TABLE `livro_promocao` DISABLE KEYS */;
INSERT INTO `livro_promocao` VALUES (1,4,3);
/*!40000 ALTER TABLE `livro_promocao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newsletter`
--

DROP TABLE IF EXISTS `newsletter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newsletter` (
  `codNewsletter` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`codNewsletter`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newsletter`
--

LOCK TABLES `newsletter` WRITE;
/*!40000 ALTER TABLE `newsletter` DISABLE KEYS */;
/*!40000 ALTER TABLE `newsletter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nossa_loja`
--

DROP TABLE IF EXISTS `nossa_loja`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nossa_loja` (
  `cod_nossa_loja` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `logradouro` varchar(10) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `numero` varchar(9) NOT NULL,
  `bairro` varchar(45) NOT NULL,
  `cidade` varchar(45) NOT NULL,
  `estado` varchar(2) NOT NULL,
  PRIMARY KEY (`cod_nossa_loja`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nossa_loja`
--

LOCK TABLES `nossa_loja` WRITE;
/*!40000 ALTER TABLE `nossa_loja` DISABLE KEYS */;
INSERT INTO `nossa_loja` VALUES (1,'Cidade1','Rua','Endereco1','123','Bairro1','Cidade1','SP'),(3,'Cidade2','Rua','Endereco2','123','Bairro2','Cidade2','SP');
/*!40000 ALTER TABLE `nossa_loja` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produto`
--

DROP TABLE IF EXISTS `produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produto` (
  `cod_produto` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`cod_produto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produto`
--

LOCK TABLES `produto` WRITE;
/*!40000 ALTER TABLE `produto` DISABLE KEYS */;
/*!40000 ALTER TABLE `produto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promocao`
--

DROP TABLE IF EXISTS `promocao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `promocao` (
  `cod_promocao` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `dt_inicial` date NOT NULL,
  `dt_final` date NOT NULL,
  PRIMARY KEY (`cod_promocao`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promocao`
--

LOCK TABLES `promocao` WRITE;
/*!40000 ALTER TABLE `promocao` DISABLE KEYS */;
INSERT INTO `promocao` VALUES (1,'Dia das mães',1,'2016-05-01','2016-05-31'),(2,'Natal',0,'2016-12-01','2016-12-31'),(3,'Mês dos pais',1,'2016-08-01','2016-08-31');
/*!40000 ALTER TABLE `promocao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sobre`
--

DROP TABLE IF EXISTS `sobre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sobre` (
  `cod_sobre` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `texto` text NOT NULL,
  PRIMARY KEY (`cod_sobre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sobre`
--

LOCK TABLES `sobre` WRITE;
/*!40000 ALTER TABLE `sobre` DISABLE KEYS */;
/*!40000 ALTER TABLE `sobre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_usuario`
--

DROP TABLE IF EXISTS `tipo_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_usuario` (
  `codTipoUsuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` varchar(45) NOT NULL,
  PRIMARY KEY (`codTipoUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_usuario`
--

LOCK TABLES `tipo_usuario` WRITE;
/*!40000 ALTER TABLE `tipo_usuario` DISABLE KEYS */;
INSERT INTO `tipo_usuario` VALUES (1,'Administrador'),(2,'Operador'),(3,'Cataloguista');
/*!40000 ALTER TABLE `tipo_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `codUsuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `login` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `codTipoUsuario` int(10) unsigned NOT NULL,
  `imagem` text,
  PRIMARY KEY (`codUsuario`),
  KEY `codTipoUsuario` (`codTipoUsuario`),
  CONSTRAINT `codTipoUsuario` FOREIGN KEY (`codTipoUsuario`) REFERENCES `tipo_usuario` (`codTipoUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'guilherme@email.com','guilherme','emrehliug','Guilherme Santos Souza',1,'Arquivos/Tolkien.jpg'),(2,'vinicius@email.com','vinicius','1234','Vinicius Santos Souza',2,'Arquivos/J_K_Rowling.jpg'),(3,'mateus@email.com','mateus','1234','Mateus Ferreira Morelli',2,'Arquivos/J_K_Rowling.jpg'),(4,'lucas@email.com','lucas','1234','Lucas Augusto dos Santos',2,'Arquivos/C_S_Lewis.jpg'),(6,'zaqueu@python.com','zaqueu','1234','Zaqueu Moreira da Silva Júnior',3,''),(8,'djeison@email.com','djeison','1234','Djeison',3,''),(10,'emrehliug@email.com','emrehliug','1234','Emrehliug',1,'Arquivos/Tolkien.jpg'),(11,'cornelius@email.com','cornelius','1234','Cornelius',1,'Arquivos/Tolkien.jpg');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-06-01 16:54:31
