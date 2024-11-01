<?php
require_once 'db.php';
require_once 'authenticate.php';

$id = $_GET['id'];
// Seleciona o cliente específico pelo ID, incluindo o nome de usuário associado
$stmt = $pdo->prepare("SELECT id, nome, cpf, email, data_nascimento FROM clientes WHERE id = ?");
$stmt->execute([$id]);
$cliente = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<?php include_once 'head.php';?>
<body>
    <?php include_once 'header.php';?>

  <main>
    <div class="card card-read-client">
    <?php if ($cliente): ?>
    <div class="card-body">
      <h5 class="card-title title-read-client"><strong><?= $cliente['nome'] ?></strong></h5>
    </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item"><p><strong>ID</strong> <?= $cliente['id'] ?></p></li>
          <li class="list-group-item"><p><strong>E-mail</strong> <?= $cliente['email'] ?></p></li>
          <li class="list-group-item"><p><strong>CPF</strong> <?= $cliente['data_nascimento'] ?></p></li>

    <div class="card-body botao-read-client">
        <button class="btn btn-outline-secondary btn-bd-primary" type="button"><a class="link-offset-2 link-underline link-underline-opacity-0" href="update-cliente.php?id=<?= $cliente['id'] ?>">Editar</a></button>
        <button class="btn btn-center btn-outline-danger btn-bd-primary" type="button"><a class="link-offset-2 link-underline link-underline-opacity-0" href="delete-cliente.php?id=<?= $cliente['id'] ?>">Excluir</a></button>
    </div>
        </ul>
    <?php else: ?>
        <p>Cliente não encontrado.</p>
    <?php endif; ?>
    </div>    
  </main>
    <?php include_once 'footer.php';?>
</body>
</html>
