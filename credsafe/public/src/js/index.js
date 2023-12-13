const botaoEntrar = document.querySelector("#botaoEntrar");
const botaoPrevia = document.querySelector("#botaoPrevia");

botaoEntrar.addEventListener("click", () =>{
    window.location.href = './login.php';
});

botaoPrevia.addEventListener("click", () =>{
    window.location.href = './visualizar.php';
});