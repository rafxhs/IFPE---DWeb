<?php
    // Inclui o arquivo de conexão com o banco de dados
    require_once 'db.php';
    require_once 'authenticate.php';

    // Obtém o ID do livro a partir da URL usando o método GET
    $id = $_GET['id'];

    $stmt = $pdo->prepare("SELECT livros.*, imagens.path
                       FROM livros
                       LEFT JOIN imagens ON livros.imagem_id = imagens.id 
                       WHERE livros.id = ?");

    // Executa a instrução SQL, passando o ID do livro como parâmetro
    $stmt->execute([$id]);

    // Recupera os dados do livro como um array associativo
    $livro = $stmt->fetch(PDO::FETCH_ASSOC);

    // Definir imagem padrão se não houver imagem associada
    if ($livro['path']) {
        $imagemPath = '/storage/' . $livro['path'];
    } else {
        $imagemPath = '/storage/profile.jpg'; // Imagem padrão
    }
?>

<?php include_once 'head.php';?>
<body>
    <?php include_once 'header.php';?>

    <main>

        <div class="card" style="width: 25rem;">
        <?php if ($livro): ?>
  <img src="<?= $imagemPath ?>" class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title text-center"><strong><?= $livro['titulo'] ?></strong></h5>
                    <p>
                        <p><strong>ID:</strong> <?= $livro['id'] ?></p>
                        <p><strong>Autor:</strong> <?= $livro['autor'] ?></p>
                        <p><strong>Ano:</strong> <?= $livro['ano'] ?></p>
                        <p><strong>Gênero:</strong> <?= $livro['genero'] ?></p>
                        <p><strong>Editora:</strong> <?= $livro['editora'] ?></p>
                        <p><strong>Páginas:</strong> <?= $livro['paginas'] ?></p>
                    </p>
                <a href="update-livro.php?id=<?= $livro['id'] ?>" class="btn btn-primary">Editar</a>
                <a href="delete-livro.php?id=<?= $livro['id'] ?>" class="btn btn-primary">Excluir</a>
  </div>
        <?php else: ?>
                    <!-- Exibe uma mensagem caso o livro não seja encontrado -->
                    <p>Livro não encontrado!!</p>
        <?php endif; ?>
</div>
    </main>

    <script src="../JavaScript/index.js"></script>
    <?php include_once 'footer.php';?>
</body>
</html>
