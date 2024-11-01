<?php
require_once 'db.php';
require_once 'authenticate.php';

// Executa a consulta para obter todos os livros
$stmt = $pdo->query("SELECT * FROM livros");

$livros = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include_once 'head.php';?>
<body>
    <?php include_once 'header.php';?>

    <main>
        <div class="table-responsive">
        <table class="table table-hover caption-top">
            
            <div class="table-title">
                    <div class="content-title3">            
                        <h2 class="titulo-index">Lista de Livros</h2>
                    </div>  
            </div>
            <div class="button-add">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="button" class="btn btn-outline-primary btn-bd-primary"><a class="link-offset-2 link-underline link-underline-opacity-0" href="/php/create-livro.php">Adicionar livro</a></button>
                </div>
            </div>
        <div>
            <thead>
                <tr class="index-table-thead-items">
                        <th scope="col">#ID</th>
                        <th scope="col">Título</th>
                        <th scope="col">Autor</th>
                        <th scope="col">Ano</th>
                        <th scope="col">Gênero</th>
                        <th scope="col">Editora</th>
                        <th scope="col">Páginas</th>
                        <th scope="col">Visualizar</th>
                        <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($livros as $livro): ?>
                <tr class="index-table-body-items">
                        <td><?= $livro['id'] ?></td>
                        <td><?= $livro['titulo'] ?></td>
                        <td><?= $livro['autor'] ?></td>
                        <td><?= $livro['ano'] ?></td>
                        <td><?= $livro['genero'] ?></td>
                        <td><?= $livro['editora'] ?></td>
                        <td><?= $livro['paginas'] ?></td>
                        <td>
                            <div class="icon-cloud-moon">
                                <a href="read-livro.php?id=<?= $livro['id'] ?>"><i class="fa-solid fa-cloud-moon"></i></a>
                            </div>
                        </td>
                        <td class="books-list">
                            <!-- Links para visualizar, editar e excluir o livro -->
                            <div class="d-grid gap-2 d-md-block">
                                <button class="btn btn-outline-secondary btn-bd-primary" type="button"><a class="link-offset-2 link-underline link-underline-opacity-0" href="update-livro.php?id=<?= $livro['id'] ?>">Editar</a></button>
                                <button class="btn btn-outline-danger btn-bd-primary" type="button"><a class="link-offset-2 link-underline link-underline-opacity-0" href="delete-livro.php?id=<?= $livro['id'] ?>">Excluir</a></button>
                            </div>
                        </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            </div>    
        </table>
        </div>    
    </main>

    <?php include_once 'footer.php';?>
    <script src="../JavaScript/index.js"></script>
</body>
</html>
