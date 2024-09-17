<?php
require_once 'db.php';
require '../vendor/autoload.php'; // Inclui o autoload do Composer

use Dompdf\Dompdf;

// Obter o ID do empréstimo da URL
$id = isset($_GET['id']) ? $_GET['id'] : null;

if (!$id) {
    die("Parâmetro ID não fornecido!");
}

// Seleciona o empréstimo pelo ID
$stmt = $pdo->prepare("SELECT emprestimos.*, clientes.nome AS cliente_nome FROM emprestimos LEFT JOIN clientes ON emprestimos.cliente_id = clientes.id WHERE emprestimos.id = ?");
$stmt->execute([$id]);
$emprestimo = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$emprestimo) {
    die("Empréstimo não encontrado!");
}

// Busca os funcionários e clientes
$stmt = $pdo->query("SELECT id, nome FROM funcionarios");
$funcionarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->query("SELECT id, nome FROM clientes");
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Inicializa as informações dos funcionários e clientes
$infoFuncionarios = '';
foreach ($funcionarios as $funcionario) {
    $infoFuncionarios .= '<p>ID: ' . $funcionario['id'] . ' - Nome de Usuário: ' . $funcionario['nome'] . '</p>';
}

$infoClientes = '';
foreach ($clientes as $cliente) {
    $infoClientes .= '<p>ID: ' . $cliente['id'] . ' - Nome de Usuário: ' . $cliente['nome'] . '</p>';
}

// Inicializa o domPDF
$dompdf = new Dompdf();

// Cria o conteúdo HTML do PDF
$html = '
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Dream - Empréstimo</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Biblioteca Dream - Empréstimo de Livro</h1>
    <p><strong>Código - Empréstimo:</strong> ' . $emprestimo['id'] . '</p>
    <p><strong>Funcionário:</strong> ' . $funcionario['nome']. '</p>
    <p><strong>Cliente:</strong> ' . $cliente['nome'] . '</p>
    <p><strong>Data do Empréstimo:</strong> ' . $emprestimo['data_emprestimo'] . '</p>
    <p><strong>Data de Devolução:</strong> ' . $emprestimo['data_devolucao'] . '</p>
</body>
</html>';

// Carrega o HTML no domPDF
$dompdf->loadHtml($html);

// Define o tamanho do papel e a orientação
$dompdf->setPaper('A4', 'portrait');

// Renderiza o HTML como PDF
$dompdf->render();

// Envia o PDF gerado para o navegador
$dompdf->stream('emprestimo_' . $emprestimo['id'] . '.pdf', array("Attachment" => false));

exit;
?>
