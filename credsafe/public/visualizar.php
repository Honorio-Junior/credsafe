<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="src/css/visualizar.css" media="screen" />
    <title>CredSafe - Visualizar</title>
  </head>
  <body>
    
    <div class="div-nav">
    	<nav>
	    	<h1><a href="./">CredSafe</a></h1>
	        <ul class="nav-links">
	        	<li><a href="./">Home</a></li>|
	          	<li><a href="#">Sobre</a></li>|
	          	<li><a href="#">Contato</a></li>
	        </ul>
    	</nav>
    </div>
    
    <h2>Buscar credencial</h2>
    
    <div class="div-buscar">
    	<select id="select">
    		<option value="todos">Todos</option>
    		<option value="staff">Staff</option>
    		<option value="produtor">Produtor</option>
    		<option value="diretor">Diretor</option>
    		<option value="segurança">Segurança</option>
    	</select>
    	<input type="text" id="inputPesquisar" placeholder="Pesquisar todos">
    	<button id="botaoBuscar">Buscar</button>
    </div>
    
    <div class="div-vazio">
    	<img src="" alt="vazio" title="vazio">
    </div>
    
	<div class="div-cred">
    	<img id="fotoCred" src="src/img/user.png" alt="imagem usuário" title="imagem usuário">
    	<div class="div-cred-info">
    		<label style="color: #17D100;">Nome</label>
    		<input class="info" type="text" id="nome" value="Cesar Augusto" readonly>
    		<label style="color: #FF9D00;">Função</label>
    		<input class="info" type="text" id="funcao" value="Staff" readonly>
    		<label style="color: #FF0045;">Identificação</label>
    		<input class="info" type="text" id="id" value="27666" readonly>
    	</div>
	</div>
    
    
    
 
<script src="src/js/visualizar.js"></script>
</body>
</html>
