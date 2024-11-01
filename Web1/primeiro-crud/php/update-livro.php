<?php
require_once 'db.php';

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM livros WHERE id = ?");
$stmt->execute([$id]);
$livro = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $ano = $_POST['ano'];
    $genero = $_POST['genero'];
    $editora = $_POST['editora'];
    $paginas = $_POST['paginas'];
    $stmt = $pdo->prepare("UPDATE livros SET titulo = ?, autor = ?, ano = ?, genero = ?, editora = ?, paginas = ? WHERE id = ?");
    $stmt->execute([$titulo, $autor, $ano, $genero, $editora, $paginas, $id]);
    header('Location: read-livro.php');
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Livro</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Bem-vindo ao Sistema de Gerenciamento de Livros</h1>
        <nav>
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="read-livro.php">Listar Livros</a></li>
                <li><a href="create-livro.php">Adicionar Livro</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Editar Livro</h2>
        <form method="POST">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" required>
            <label for="autor">Autor:</label>
            <input type="text" id="autor" name="autor" required>
            <label for="ano">Ano:</label>
            <input type="date" id="ano" name="ano" required>
            <label for="genero">Gênero:</label>
            <input type="text" id="genero" name="genero" required>
            <label for="editora">Editora:</label>
            <input type="text" id="editora" name="editora" required>
            <label for="paginas">Páginas:</label>
            <input type="paginas" id="paginas" name="paginas" required>
            <button type="submit">Atualizar</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2024 - Sistema de Gerenciamento de Livros</p>
    </footer>
</body>
</html>
