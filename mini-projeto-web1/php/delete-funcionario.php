<?php
require_once 'db.php';
require_once 'authenticate.php';

$id = $_GET['id'];

// Prepara a instrução SQL para excluir o professor pelo ID
$stmt = $pdo->prepare("DELETE FROM funcionarios WHERE id = ?");
$stmt->execute([$id]);

// Redireciona de volta para a lista de professores após a exclusão
header('Location: index-funcionario.php');
exit();
?>
