<?php
require_once 'db.php';
require_once 'authenticate.php';

$id = $_GET['id'];

// Seleciona o funcionario específico pelo ID
$stmt = $pdo->prepare("SELECT funcionarios.*, usuarios.username FROM funcionarios LEFT JOIN usuarios ON funcionarios.usuario_id = usuarios.id WHERE funcionarios.id = ?");
$stmt->execute([$id]);
$funcionario = $stmt->fetch(PDO::FETCH_ASSOC);

// Pega as opções de cargo do formulário
$cargos = [
    'opcao1' => 'Bibliotecário(a)',
    'opcao2' => 'Estagiário(a)'
];
?>

<?php include_once 'head.php';?>
<body>
    <?php include_once 'header.php';?>

    <main>
        <div class="card card-read-staff">
        <?php if ($funcionario): ?>
            <div class="card-body">
            <h5 class="card-title title-read-staff"><?= $funcionario['nome'] ?></strong></h5>
            </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><p><strong>ID</strong> <?= $funcionario['id'] ?></p></li>
                    <li class="list-group-item"><p><strong>CPF</strong> <?= $funcionario['cpf'] ?></p></li>
                    <li class="list-group-item"><p><strong>Cargo</strong> <?= $funcionario['cargo'] ?></p></li>

                    <div class="card-body botao-read-staff">
                        <button class="btn btn-outline-secondary btn-bd-primary" type="button"><a class="link-offset-2 link-underline link-underline-opacity-0" href="update-funcionario.php?id=<?= $funcionario['id'] ?>">Editar</a></button>
                        <button class="btn btn-center btn-outline-danger btn-bd-primary" type="button"><a class="link-offset-2 link-underline link-underline-opacity-0" href="delete-funcionario.php?id=<?= $funcionario['id'] ?>">Excluir</a></button>
                    </div>
                </ul>
        <?php else: ?>
            <p>Funcionário não encontrado.</p>
        <?php endif; ?>
        </div>    
    </main>

    <?php include_once 'footer.php';?>
</body>
</html>
