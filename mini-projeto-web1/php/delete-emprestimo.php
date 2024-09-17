<?php
require_once 'db.php';
require_once 'authenticate.php';

$id = $_GET['id'];

// Prepara a instrução SQL para excluir o emprestimo pelo ID
$stmt = $pdo->prepare("DELETE FROM emprestimos WHERE id = ?");
$stmt->execute([$id]);

// Redireciona de volta para a lista de emprestimos após a exclusão
header('Location: index-emprestimo.php');
exit();
?>
