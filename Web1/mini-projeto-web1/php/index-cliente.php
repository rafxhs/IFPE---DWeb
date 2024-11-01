<?php
// Inclui o arquivo de conexão com o banco de dados

require_once 'db.php';
require_once 'authenticate.php';
// Executa a consulta para obter todos os clientes
$stmt = $pdo->query("SELECT * FROM clientes");

$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include_once 'head.php';?>
<body>
    <?php include_once 'header.php';?>

<main>
    <div class="table-responsive">
    <table class="table table-hover caption-top">
        
        <div class="table-title">
                <div class="content-title3">            
                    <h2 class="titulo-index">Lista de Clientes</h2>
                </div>
        </div>
        <div class="button-add">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="button" class="btn btn-outline-primary btn-bd-primary"><a class="link-offset-2 link-underline link-underline-opacity-0" href="/php/create-cliente.php">Adicionar Cliente</a></button>
            </div>
        </div>
    <div>
        <thead>
            <tr class="index-table-thead-items">
                    <th scope="col">#ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">CPF</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Data de Nascimento</th>
                    <th scope="col">Visualizar</th>
                    <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($clientes as $cliente): ?>
            <tr class="index-table-body-items">
                    <td><?= $cliente['id'] ?></td>
                    <td><?= $cliente['nome'] ?></td>
                    <td><?= $cliente['cpf'] ?></td>
                    <td><?= $cliente['email'] ?></td>
                    <td><?= $cliente['data_nascimento'] ?></td>
                    <td>
                            <div class="icon-cloud-moon">
                                <a href="read-cliente.php?id=<?= $cliente['id'] ?>"><i class="fa-solid fa-cloud-moon"></i></a>
                            </div>
                    </td>
                    <td class="books-list">
                        <!-- Links para visualizar, editar e excluir o cliente -->
                    <div class="d-grid gap-2 d-md-block">
                            <button class="btn btn-outline-secondary btn-bd-primary" type="button"><a class="link-offset-2 link-underline link-underline-opacity-0" href="update-cliente.php?id=<?= $cliente['id'] ?>">Editar</a></button>
                            <button class="btn btn-outline-danger btn-bd-primary" type="button"><a class="link-offset-2 link-underline link-underline-opacity-0" href="delete-cliente.php?id=<?= $cliente['id'] ?>">Excluir</a></button>
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
