<?php

    require_once '../app/php/controllers.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        $dadosCliente = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        $controllers = new ControllerClientes();
        echo $controllers->validaCliente($dadosCliente);
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CredSafe - Home</title>
        <link rel="stylesheet" href="src/css/login.css">
    </head>
    <body>
        
        <div class="div-nav">
            <nav>
                <ul class="nav-links">
                    <li><a href="./">Home</a></li>|
                    <li><a href="#">Sobre</a></li>|
                    <li><a href="#">Contato</a></li>
                </ul>
            </nav>
        </div>
        
        <h1><a href="./">CredSafe</a></h1>
        
        <div class="div-form">
            <form action="./login.php" method="POST">
                <label>
                    Email<br>
                    <input name="email" class="input-form" type="email" placeholder="Seu email">
                </label><br>
                <label>
                    Senha<br>
                    <input name="password" class="input-form" type="password" placeholder="Sua senha">
                </label>
                <label style="margin-top: 4%; display: flex; font-size: 0.8rem; align-items: center; gap: 5px;">
                    <input name="checkbox" type="checkbox" id="checkbox">
                    Lembrar-me
                </label>
                <div class="div-bt">
                    <input type="submit" id="botao_entrar" value="Entrar">
                </div>
            </form>
        </div>
    <script src="src/js/login.js"></script>
    </body>
</html>
