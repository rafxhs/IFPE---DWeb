<?php
require_once 'db.php';

$stmt = $pdo->query("SELECT * FROM livros");
$livros = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Livros</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Bem-vindo ao Sistema de Gerenciamento de Livros</h1>
        <nav>
            <ul>
                <li><a href="../index.php">Home</a></li>
                <li><a href="index-livro.php">Listar Livros</a></li>
                <li><a href="create-livro.php">Adicionar Livro</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Lista de Livros</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Ano</th>
                    <th>Gênero</th>
                    <th>Editora</th>
                    <th>Páginas</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($livros as $livro): ?>
                    <tr>
                        <td><?= $livro['id'] ?></td>
                        <td><?= $livro['titulo'] ?></td>
                        <td><?= $livro['autor'] ?></td>
                        <td><?= $livro['ano'] ?></td>
                        <td><?= $livro['genero'] ?></td>
                        <td><?= $livro['editora'] ?></td>
                        <td><?= $livro['paginas'] ?></td>
                        <td>
                            <a href="update-livro.php?id=<?= $livro['id'] ?>">Editar</a>
                            <a href="delete-livro.php?id=<?= $livro['id'] ?>">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>

    <footer>
        <p>&copy; 2024 - Sistema de Gerenciamento de Livros</p>
    </footer>
</body>
</html>
