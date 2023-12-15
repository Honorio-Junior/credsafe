<?php
    session_start();

    if (!isset($_SESSION['user'])) {
        header("location: ./home");
        die();
    }

    require_once '../app/php/controllers.php';

    $ControllerPerfis = new ControllerPerfis();


    $funcoes = $ControllerPerfis->getFuncoes($_SESSION['user'][0]['id']);


    $perfis = $ControllerPerfis->getAll($_SESSION['user'][0]['id']);
    echo '<script> const Perfis = ' . json_encode($perfis) . '</script>';

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $_SESSION['user'][0]['ambiente'] . '- CredSafe' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="bg-dark">


    <!-- NavBar -->
    <nav class="navbar navbar-expand-sm bg-body-tertiary text-center" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand text-warning" href="home/">CredSafe</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contato</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Nome do ambiente -->
    <h1 class="text-primary text-center mt-3">
        <?= $_SESSION['user'][0]['ambiente'] ?>
    </h1>

    <!-- Seletores de funcao -->
    <select disabled id='select' class="col-1 form-select justify-self-center mx-auto my-3" aria-label="Default select example" data-bs-theme="dark" style="width: auto;">
        <option value='Todos' selected>Todos</option>

        <?php foreach ($funcoes as $funcao) : ?>

            <option value="<?= $funcao['funcao'] ?>"> <?= $funcao['funcao'] ?> </option>

        <?php endforeach; ?>


    </select>

    <!-- Campo de pesquisa  -->
    <div class="input-group mx-auto mb-3" style="max-width: 25rem; width: 80%;">
        <input disabled id='inputNome' type="text" class="form-control" placeholder="Pesquisar por Todos" aria-label="Recipient's username with two button addons">
        <button disabled class="btn btn-outline-secondary" type="button">Buscar</button>
    </div>


    <!-- Perfis -->
    <?php foreach($perfis as $perfil): ?>
    <div class="card container justify-self-center" style="width: 18rem">
        <img src="src/img/person.svg" class="card-img-top" alt="exemplo" title="exemplo" />
        <div class="card-body mb">
            <strong>
                <h5 class="card-title text-success"> <?= $perfil['nome'] ?> </h5>
            </strong>
            <p class="card-text text-secondary mb-1"> <?= $perfil['bio'] ?> </p>
            <strong>
                <p class="card-text text-primary"><span class="text-dark">Função: </span> <?= $perfil['funcao'] ?> </p>
            </strong>
            <strong>
                <p class="card-text text-danger"><span class="text-dark">ID: </span> <?= $perfil['id'] ?> </p>
            </strong>
        </div>
    </div>
    <hr>
    <?php endforeach; ?>


    <!-- Navegação entre perfis -->
    <div class="container mt-3 text-center">
        <button class="btn btn-secondary me-1 px-4"> < </button>
        <button class="btn btn-secondary ms-1 px-4"> > </button>
        <p class=" mt-1 text-light mx-auto">Total: <?= count($perfis) ?> </p>
    </div>

    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!-- scripts da pagina -->
    <script>
        document.querySelector('#select').addEventListener('change', () => {
            document.querySelector('#inputNome').placeholder = 'Pesquisar por ' + document.querySelector('#select').value
        })

    </script>

</body>
</html>
