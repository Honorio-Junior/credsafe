<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("location: ./home");
    die();
}


require_once '../app/php/controllers.php';
$ControllerPerfis = new ControllerPerfis();
$funcoes = $ControllerPerfis->getFuncoes($_SESSION['user'][0]['id']);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $dadosPerfil = null;

    $dadosPerfil = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    $perfil = array();
    $perfil = [
        'nome' => $dadosPerfil['nome'],
        'bio' => $dadosPerfil['bio']
    ];

    if ($dadosPerfil['select-funcao'] === 'new') {
        $perfil['funcao'] = $dadosPerfil['nova-funcao'];
    } else {
        $perfil['funcao'] = $dadosPerfil['select-funcao'];
    }

    $result = $ControllerPerfis->create($_SESSION['user'][0]['id'], $perfil);

    if ($result == true) {
        header("Location: ".$_SERVER['PHP_SELF']); // Redireciona para a mesma página
        die();
    }
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title><?= $_SESSION['user'][0]['ambiente'] . '- Admin' ?></title>
</head>

<body data-bs-theme="dark">

    <!-- NavBar -->
    <nav class="navbar navbar-expand-sm bg-body-tertiary text-center mb-5" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand text-warning" href="home/">CredSafe</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/">Perfis - <?= $_SESSION['user'][0]['ambiente'] ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contato</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <br>

    <form action="" method="POST" class=" row g-3 mx-auto border rounded p-3" style="max-width: 550px; width: 90%" ">
        <p class=" text-center text-warning my-0 fs-2">Cadastrar perfil</p>
        <hr class="mb-0">

        <div class=" col-md-6">
            <label for="inputEmail4" class="form-label">Nome</label>
            <input name='nome' required type="text" class="form-control" id="inputEmail4" placeholder="Nome do perfil">
        </div>

        <div class="col-md-6">
            <label for="select-funcao" class="form-label">Função</label>
            <select name='select-funcao' id="select-funcao" class="form-select" aria-label="Default select example">
                <?php foreach ($funcoes as $funcao) : ?>

                    <option value="<?= $funcao['funcao'] ?>"> <?= $funcao['funcao'] ?> </option>

                <?php endforeach; ?>
                <option value="new">Nova função</option>
            </select>
        </div>

        <div id="div-nova-funcao" class="col-12" style="display: none;">
            <label for="inputAddress" class="form-label">* Nova função</label>
            <input name='nova-funcao' id='nova-funcao' type="text" class="form-control" id="inputAddress" placeholder="Escreva o nome da nova função">
        </div>

        <div class="col-6">
            <label for="inputAddress" class="form-label">Bio</label>
            <input name='bio' required type="text" class="form-control" id="inputAddress" placeholder="Uma pequena biografia">
        </div>

        <div class="col-6">
            <label for="inputAddress" class="form-label">Foto</label>
            <input name='foto' type="file" class="form-control" id="inputAddress">
        </div>

        <div class="col-12">
            <button type="submit" class="btn btn-warning" style="width: 100%;">Cadastrar</button>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script>
        document.querySelector('#select-funcao').addEventListener('change', () => {
            if (document.querySelector('#select-funcao').value === 'new') {
                document.querySelector('#div-nova-funcao').style.display = 'block'
                document.querySelector('#nova-funcao').required = true
            } else {
                document.querySelector('#div-nova-funcao').style.display = 'none'
                document.querySelector('#nova-funcao').required = false
            }
        })

        function novaFuncao() {
            if (document.querySelector('#select-funcao').value === 'new') {
                document.querySelector('#div-nova-funcao').style.display = 'block'
                document.querySelector('#nova-funcao').required = true
            } else {
                document.querySelector('#div-nova-funcao').style.display = 'none'
                document.querySelector('#nova-funcao').required = false
            }
        }

        novaFuncao();
    </script>
</body>

</html>