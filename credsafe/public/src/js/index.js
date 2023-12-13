const botao_entrar = document.querySelector("#botao_fazer_login");
const botao_visualizar = document.querySelector("#botao_visualizar");
const div_form = document.querySelector(".div-form");
const div_bt_option = document.querySelector('.div-bt-option');
const h1 = document.querySelector("h1");

botao_entrar.addEventListener("click", (e) =>{
    // e.preventDefault();
    div_bt_option.style.display = 'none';
    div_form.style.display = 'flex';
    h1.style.fontSize = "2.5rem";
})
botao_visualizar.addEventListener("click", (e) =>{
    // e.preventDefault();
    window.location.href = "./visualizar/";
})
