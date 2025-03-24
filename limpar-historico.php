<?php
// Inicializando a sessão
session_start();

// Limpando o histórico
$_SESSION['historico'] = [];

// Redirecionando de volta para a página principal
header("Location: calculadora.php");
exit;
?>

