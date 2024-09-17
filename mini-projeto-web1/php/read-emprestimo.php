<?php
require_once 'db.php';
require_once 'authenticate.php';


$id = $_GET['id'];


// Selecionar o empréstimo pelo ID, com as informações do cliente e do funcionário
$stmt = $pdo->prepare("
    SELECT emprestimos.id AS emprestimo_id, 
           clientes.id AS cliente_id, 
           clientes.nome AS cliente_nome, 
           funcionarios.id AS funcionario_id, 
           funcionarios.nome AS funcionario_nome, 
           emprestimos.* 
    FROM emprestimos 
    LEFT JOIN clientes ON emprestimos.cliente_id = clientes.id 
    LEFT JOIN funcionarios ON emprestimos.funcionario_id = funcionarios.id 
    WHERE emprestimos.id = ?
");

$stmt->execute([$id]);
$emprestimo = $stmt->fetch(PDO::FETCH_ASSOC);


// Verificação se o empréstimo foi encontrado
if (!$emprestimo) {
    die("Empréstimo não encontrado!");
}


?>


<?php include_once 'head.php'; ?>
<body>
    <?php include_once 'header.php'; ?>
    <main>
        <div class="card card-read-borrowing">
            <?php if ($emprestimo): ?>
                <div class="botao-download">
                        <a class="botao-download-item" href="export-emprestimo-pdf.php?id=<?= $emprestimo['emprestimo_id'] ?>" target="_blank">
                            <i class="fa-solid fa-cloud-arrow-down fa-xl" style="color: #6147aa;"></i>
                        </a>
                </div>
                <div class="card-body">
                    <h5 class="card-title title-read-borrowing"> Biblioteca Dream - Empréstimo de Livro</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><p><strong>Código - Empréstimo: </strong> <?= $emprestimo['emprestimo_id'] ?></p></li>
                    
                    <!-- Exibir o funcionário responsável -->
                    <li class="list-group-item"><p><strong>Funcionário: </strong> <?= $emprestimo['funcionario_nome'] ?></p></li>


                    <!-- Exibir o cliente que fez o empréstimo -->
                    <li class="list-group-item"><p><strong>Cliente: </strong> <?= $emprestimo['cliente_nome'] ?></p></li>


                    <li class="list-group-item"><p><strong>Data do Empréstimo: </strong> <?= $emprestimo['data_emprestimo'] ?></p></li>
                    <li class="list-group-item"><p><strong>Data de Devolução: </strong> <?= $emprestimo['data_devolucao'] ?></p></li>


                    <div class="card-body botao-read-borrowing">
                        <button class="btn btn-outline-secondary btn-bd-primary" type="button">
                            <a class="link-offset-2 link-underline link-underline-opacity-0" href="update-emprestimo.php?id=<?= $emprestimo['emprestimo_id'] ?>">Editar</a>
                        </button>
                        <button class="btn btn-center btn-outline-danger btn-bd-primary" type="button">
                            <a class="link-offset-2 link-underline link-underline-opacity-0" href="delete-emprestimo.php?id=<?= $emprestimo['emprestimo_id'] ?>">Excluir</a>
                        </button>
                    </div>
                </ul>
            <?php else: ?>
                <p>Empréstimo não encontrado.</p>
            <?php endif; ?>
        </div>
    </main>


    <?php include_once 'footer.php'; ?>                  
    <script src="JavaScript/index.js"></script>
</body>
</html>




