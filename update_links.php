<?php
$publicDir = 'f:/portfolio/woodywoodpecker/views/public';
$adminDir = 'f:/portfolio/woodywoodpecker/views/admin';

$publicFiles = [
    'autores-destaque.php',
    'fale-conosco.php',
    'home.php',
    'livro-mes.php',
    'login.php',
    'nossas-lojas.php',
    'promocoes.php',
    'sobre.php'
];

$adminFiles = [
    'cms_conteudo.php',
    'cms_fale-conosco.php',
    'cms_produto.php',
    'cms_usuarios.php',
    'conteudo_autores-destaque.php',
    'conteudo_livro-mes.php',
    'conteudo_nossas-lojas.php',
    'conteudo_promocoes.php',
    'conteudo_sobre.php',
    'error.php',
    'home.php',
    'old.home.php',
    'produto_autor.php',
    'produto_distribuidora.php',
    'produto_editora.php',
    'produto_genero.php',
    'produto_livro.php'
];

function updateLinks($dir, $files, $type) {
    foreach ($files as $file) {
        $filePath = $dir . '/' . $file;
        if (!file_exists($filePath)) continue;
        
        $content = file_get_contents($filePath);
        $originalContent = $content;

        if ($type === 'public') {
            // home.php -> /
            $content = preg_replace('/href="home\.php(\?.*?)?"/', 'href="/$1"', $content);
            // others -> /views/public/filename.php
            $others = implode('|', array_diff($GLOBALS['publicFiles'], ['home.php']));
            $content = preg_replace('/href="(' . $others . ')(\?.*?)?"/', 'href="/views/public/$1$2"', $content);
        } elseif ($type === 'admin') {
            // home.php (admin) -> /views/admin/home.php
            $content = preg_replace('/href="home\.php(\?.*?)?"/', 'href="/views/admin/home.php$1"', $content);
            // ../woody_woodpecker_v0/home.php -> /
            $content = preg_replace('/href="\.\.\/woody_woodpecker_v0\/home\.php(\?.*?)?"/', 'href="/$1"', $content);
            // others -> /views/admin/filename.php
            $others = implode('|', array_diff($GLOBALS['adminFiles'], ['home.php']));
            $content = preg_replace('/href="(' . $others . ')(\?.*?)?"/', 'href="/views/admin/$1$2"', $content);
        }

        if ($content !== $originalContent) {
            file_put_contents($filePath, $content);
            echo "Updated: $filePath\n";
        }
    }
}

updateLinks($publicDir, $publicFiles, 'public');
updateLinks($adminDir, $adminFiles, 'admin');
?>
