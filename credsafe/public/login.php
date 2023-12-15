<?php
    session_start();
    require_once '../app/php/controllers.php';

    if(isset($_SESSION['user'])){
        unset($_SESSION['user']);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        $dadosCliente = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        $ControllerClientes = new ControllerClientes();

        $user = $ControllerClientes->validaCliente($dadosCliente);

        if($user){
            $_SESSION['user'] = $user;
            header("location: ./index.php");
            die();
        }else{
            $erro = 'Login inválido!';
            session_destroy();
        }
    }
?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="bg-dark">

    <nav class="navbar navbar-expand-sm bg-body-tertiary text-center" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand text-warning" href="home/">CredSafe</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Adquirir</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Sobre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contato</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <h1 class="text-warning text-center mt-5 mb-4">
        CredSafe<br />
    </h1>
    <p class='text-danger text-center'><?php echo $erro = !empty($erro) ? $erro : '' ?></p>
    <form class="border border-secondary border-opacity-25 rounded p-3 container col-11 justify-content-center mx-auto"
        style="max-width: 30em;"
        method="POST" action="./login.php">
        <div class="mb-3 text-light" data-bs-theme="dark">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">Insira seu email de login</div>
        </div>
        <div class="mb-3 text-light" data-bs-theme="dark">
            <label for="exampleInputPassword1" class="form-label">Senha</label>
            <input name="password" type="password" class="form-control" id="exampleInputPassword1">
        </div>
        <div class="mb-3 form-check text-light" data-bs-theme="dark">
            <input type="checkbox" class="form-check-input" id="exampleCheck1">
            <label class="form-check-label" for="exampleCheck1">Lembrar-me</label>
        </div>
        <button type="submit" class="btn btn-warning col-12">Entrar</button>
    </form>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>
