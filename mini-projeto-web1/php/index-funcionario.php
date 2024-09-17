<?php
require_once 'db.php';
require_once 'authenticate.php';

// Seleciona todos os funcionarios
$stmt = $pdo->query("SELECT funcionarios.*, usuarios.username FROM funcionarios LEFT JOIN usuarios ON funcionarios.usuario_id = usuarios.id");
$funcionarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include_once 'head.php';?>
<body>
    <?php include_once 'header.php';?>

<main>
    <div class="table-responsive">
    <table class="table table-hover caption-top">
        
        <div class="table-title">
                <div class="content-title3">            
                    <h2 class="titulo-index">Lista de Funcionários</h2>
                </div>
        </div>
        <div class="button-add">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="button" class="btn btn-outline-primary btn-bd-primary"><a class="link-offset-2 link-underline link-underline-opacity-0" href="/php/create-funcionario.php">Adicionar funcionário</a></button>
            </div>
        </div>
    <div>
        <thead>
            <tr class="index-table-thead-items">
                    <th scope="col">#ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Cargo</th>
                    <th scope="col">Usuário</th>
                    <th scope="col">Visualizar</th>
                    <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($funcionarios as $funcionario): ?>
            <tr class="index-table-body-items">
                    <td><?= $funcionario['id'] ?></td>
                    <td><?= $funcionario['nome'] ?></td>
                    <td><?= $funcionario['cpf'] ?></td>
                    <td><?= $funcionario['cargo'] ?></td>
                    <td><?= $funcionario['usuario_id'] ?></td>
                    <td>
                            <div class="icon-cloud-moon">
                                <a href="read-funcionario.php?id=<?= $funcionario['id'] ?>"><i class="fa-solid fa-cloud-moon"></i></a>
                            </div>
                    </td>
                    <td class="books-list">
                        <!-- Links para visualizar, editar e excluir o funcionario -->
                    <div class="d-grid gap-2 d-md-block">
                            <button class="btn btn-outline-secondary btn-bd-primary" type="button"><a class="link-offset-2 link-underline link-underline-opacity-0" href="update-funcionario.php?id=<?= $funcionario['id'] ?>">Editar</a></button>
                            <button class="btn btn-outline-danger btn-bd-primary" type="button"><a class="link-offset-2 link-underline link-underline-opacity-0" href="delete-funcionario.php?id=<?= $funcionario['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir este funcionario?');">Excluir</a></button>
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
