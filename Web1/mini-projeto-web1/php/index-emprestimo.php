<?php
require_once 'db.php';
require_once 'authenticate.php';

// Seleciona todas as emprestimos
$stmt = $pdo->query("SELECT emprestimos.*, clientes.nome AS cliente_nome FROM emprestimos LEFT JOIN clientes ON emprestimos.cliente_id = clientes.id");
$emprestimos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include_once 'head.php';?>
<body>
    <?php include_once 'header.php';?>
    <main>
    <div class="table-responsive">
    <table class="table table-hover caption-top">
        
        <div class="table-title">
                <div class="content-title3">            
                    <h2 class="titulo-index">Lista de Empréstimos</h2>
                </div>
        </div>
        <div class="button-add">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="button" class="btn btn-outline-primary btn-bd-primary"><a class="link-offset-2 link-underline link-underline-opacity-0" href="/php/create-emprestimo.php">Adicionar Empréstimo</a></button>
            </div>
        </div>
    <div>
        <thead>
            <tr class="index-table-thead-items">
                    <th scope="col">#ID</th>
                    <th scope="col">F-ID</th>
                    <th scope="col">C-ID</th>
                    <th scope="col">Data de Empréstimo</th>
                    <th scope="col">Data de Devolução</th>
                    <th scope="col">Visualizar</th>
                    <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($emprestimos as $emprestimo): ?>
            <tr class="index-table-body-items">
                    <td><?= $emprestimo['id'] ?></td>
                    <td><?= $emprestimo['funcionario_id'] ?></td>
                    <td><?= $emprestimo['cliente_id'] ?></td>
                    <td><?= $emprestimo['data_emprestimo'] ?></td>
                    <td><?= $emprestimo['data_devolucao'] ?></td>
                    <td>
                            <div class="icon-cloud-moon">
                                <a href="read-emprestimo.php?id=<?= $emprestimo['id'] ?>"><i class="fa-solid fa-cloud-moon"></i></a>
                            </div>
                    </td>
                    <td class="books-list">
                        <!-- Links para visualizar, editar e excluir o cliente -->
                    <div class="d-grid gap-2 d-md-block">
                            <button class="btn btn-outline-secondary btn-bd-primary" type="button"><a class="link-offset-2 link-underline link-underline-opacity-0" href="update-emprestimo.php?id=<?= $emprestimo['id'] ?>">Editar</a></button>
                            <button class="btn btn-outline-danger btn-bd-primary" type="button"><a class="link-offset-2 link-underline link-underline-opacity-0" href="delete-emprestimo.php?id=<?= $emprestimo['id'] ?>">Excluir</a></button>
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
    <script src="JavaScript/index.js"></script>
</body>
</html>
