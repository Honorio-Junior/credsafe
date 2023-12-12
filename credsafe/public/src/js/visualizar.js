const select = document.querySelector("#select");
const inputPesquisar = document.querySelector("#inputPesquisar");
const botaoBuscar = document.querySelector("#botaoBuscar");
const divCred = document.querySelector(".div-cred");
const divVazio = document.querySelector(".div-vazio");

let nome = document.querySelector("#nome");
let funcao = document.querySelector("#funcao");
let id = document.querySelector("#id");

select.addEventListener("change", () => {
	inputPesquisar.placeholder = `Pesquisar ${select.value}`;
});

botaoBuscar.addEventListener("click", () => {

	divCred.style.display = "flex";
	divVazio.style.display = "none";
	divCred.style.animation = "cred .2s linear";

});
