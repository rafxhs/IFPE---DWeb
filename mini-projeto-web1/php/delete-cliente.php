<?php
// Inclui o arquivo de conexão com o banco de dados
require_once 'db.php';
require_once 'authenticate.php';

// Obtém o ID do cliente a ser excluído a partir da URL usando o método GET
$id = $_GET['id'];

// Prepara a instrução SQL para excluir o cliente pelo ID
$stmt = $pdo->prepare("DELETE FROM clientes WHERE id = ?");

// Executa a instrução SQL com o ID do cliente
$stmt->execute([$id]);

// Redireciona para a página de listagem de clientes após a exclusão
header('Location: index-cliente.php');
?>
