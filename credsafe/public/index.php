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
                        <a class="nav-link" href="#">Admin - <?= $_SESSION['user'][0]['nome'] ?></a>
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
    <div class="input-group mx-auto mb-5" style="max-width: 25rem; width: 80%;">
        <input disabled id='inputNome' type="text" class="form-control" placeholder="Pesquisar por Todos" aria-label="Recipient's username with two button addons">
        <button disabled class="btn btn-outline-secondary" type="button">Buscar</button>
    </div>


    <!-- Perfis -->     
    <div id="carouselExampleIndicators" class="carousel slide mx-auto" style="max-width: 50rem;">
        <div id='divCard' class="carousel-inner">
            <!-- cards criados aqui via js -->
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Quantidade perfis (dinamico) -->
    <p id='quantidadePerfis' class=" mt-1 text-center text-light mx-auto mt-3">Total: <?= count($perfis) ?> </p>

    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!-- scripts da pagina -->
    <script>
        const carousel = document.querySelector('#divCard')
        const quantidadePerfis = document.querySelector('#quantidadePerfis')

        function quantidadePerfisFuncao(funcao)
        {   
            if(funcao != 'Todos'){
                const qFuncoes = Perfis.filter(pessoa => pessoa.funcao === funcao);
                return qFuncoes.length
            }else{
                return Perfis.length
            }
        }

        document.querySelector('#select').addEventListener('change', () => {
            document.querySelector('#inputNome').placeholder = 'Pesquisar por ' + document.querySelector('#select').value
            document.querySelector('#quantidadePerfis').innerHTML = 'Total: ' + quantidadePerfisFuncao(document.querySelector('#select').value)
        })


        function card(nome, bio, funcao, id, ativo = false)
        {   
            // <div class="carousel-item">
            const divCarouselItem = document.createElement('div')
            divCarouselItem.classList.add('carousel-item')
            if (ativo) { divCarouselItem.classList.add('active') }

            // <div class="card container justify-self-center" style="width: 18rem">
            const card = document.createElement('div')
            card.classList.add('card', 'container', 'justify-self-center');
            card.style.width = '18rem'

            // <img src="src/img/person.svg" class="card-img-top" alt="exemplo" title="exemplo" />
            const img = document.createElement('img')
            img.src = 'src/img/person.svg'
            img.classList.add('card-img-top')

            // <div class="card-body mb">
            const cardBody = document.createElement('div')
            cardBody.classList.add('card-body', 'mb')

            // <strong> - nome
            const strongNome = document.createElement('strong')
            // <h5 class="card-title text-success">  </h5>
            const h5 = document.createElement('h5')
            h5.classList.add('card-title', 'text-success')
            h5.innerText = nome

            // <p class="card-text text-secondary mb-1">  </p>
            const pBio = document.createElement('p')
            pBio.classList.add('card-text', 'text-secondary', 'mb-1')
            pBio.innerText = bio

            // <strong> - funcao
            const strongFuncao = document.createElement('strong')
            // <p class="card-text text-primary"><span class="text-dark">Função: </span>  </p>
            const pFuncao = document.createElement('p')
            pFuncao.classList.add('card-text', 'text-primary')
                                // pFuncao.innerText = funcao
            // <span> - funcao - <span class="text-dark">Função: </span>
            const spanFuncao = document.createElement('span')
            spanFuncao.classList.add('text-dark')
            spanFuncao.innerText = 'Função: '

            // <strong> - id
            const strongId = document.createElement('strong')
            // <p class="card-text text-danger"><span class="text-dark">ID: </span>  </p>
            const pId = document.createElement('p')
            pId.classList.add('card-text', 'text-danger')
                                // pId.innerText = id
            // <span> - id - <span class="text-dark">ID: </span>
            const spanId = document.createElement('span')
            spanId.classList.add('text-dark')
            spanId.innerText = 'ID: '


            // Montando o elemento final
            strongNome.appendChild(h5)
            //
            pFuncao.appendChild(spanFuncao)
            pFuncao.innerHTML += funcao
            strongFuncao.appendChild(pFuncao)
            //
            pId.appendChild(spanId)
            pId.innerHTML += id
            strongId.appendChild(pId)
            //
            cardBody.appendChild(strongNome)
            cardBody.appendChild(pBio)
            cardBody.appendChild(strongFuncao)
            cardBody.appendChild(strongId)
            //
            card.appendChild(img)
            card.appendChild(cardBody)
            //
            divCarouselItem.appendChild(card)

            return divCarouselItem

        }

        function cardTodosPerfis()
        {
            let perfisEscolhas = []
            Perfis.forEach( perfil => {
                perfisEscolhas.push(perfil.id)
            })
            const indiceAleatorio = Math.floor(Math.random() * perfisEscolhas.length);
            const perfilEscolhido = perfisEscolhas[indiceAleatorio]

            Perfis.forEach( perfil => {
                
                if(perfil.id === perfilEscolhido){
                    carousel.appendChild(card(perfil.nome, perfil.bio, perfil.funcao, perfil.id, true))
                }else{
                    carousel.appendChild(card(perfil.nome, perfil.bio, perfil.funcao, perfil.id, false))
                }
            })
        }

        cardTodosPerfis()
        

    </script>

</body>
</html>
