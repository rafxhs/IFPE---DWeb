<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="../index.php">
            <i class="fa-solid fa-book-open" id="nav_logo"> Biblioteca Dream</i>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/php/index-livro.php">Livros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/php/index-cliente.php">Clientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/php/index-funcionario.php">Funcionários</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/php/index-emprestimo.php">Empréstimos</a>
                    </li>
                    <li>
                        <button class="btn botoes-header btn-primary" type="button">
                    <li><a class="link-offset-2 link-underline link-underline-opacity-0" href="/php/logout.php">Sair (<?= $_SESSION['username'] ?>)</a></li>
                        </button>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Quem Somos</a>
                    </li>
                    <div class="col-md text-end">
                        <button class="btn botoes-header btn-primary btn-outline-light me-2" type="button">
                            <a class="link-offset-2 link-underline link-underline-opacity-0" href="./php/user-login.php">Entrar</a>
                        </button>
                        <button class="btn botoes-header btn-primary btn-outline-light me-2" type="button">
                            <a class="link-offset-2 link-underline link-underline-opacity-0" href="./php/user-login.php">Crie sua conta</a>
                        </button>
                    </div>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>