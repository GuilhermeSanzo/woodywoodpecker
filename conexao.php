<?php
/* Conexão compatível com PHP 8+ usando mysqli + polyfill mysql_* */

session_start();

$connect = mysqli_connect("localhost", "root", "", "woody_woodpecker");
if (!$connect) {
    die("Erro de conexão: " . mysqli_connect_error());
}
mysqli_set_charset($connect, "utf8");

/* Polyfills para manter chamadas mysql_* existentes funcionando */
if (!function_exists('mysql_query')) {
    function mysql_query($query) { return mysqli_query($GLOBALS['connect'], $query); }
}
if (!function_exists('mysql_fetch_array')) {
    function mysql_fetch_array($result) { return mysqli_fetch_array($result); }
}
if (!function_exists('mysql_connect')) {
    function mysql_connect($host, $user, $pass) {
        $GLOBALS['connect'] = mysqli_connect($host, $user, $pass);
        return $GLOBALS['connect'];
    }
}
if (!function_exists('mysql_select_db')) {
    function mysql_select_db($db) { return mysqli_select_db($GLOBALS['connect'], $db); }
}
if (!function_exists('mysql_set_charset')) {
    function mysql_set_charset($charset) { return mysqli_set_charset($GLOBALS['connect'], $charset); }
}
