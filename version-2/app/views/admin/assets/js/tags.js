const ul = document.querySelector(".tags-ul"),
input = document.querySelector(".tags-input"),
tagNumb = document.querySelector(".details span");
//Pegando os valores contido no input
var tagBanco = document.querySelector("#tags");
var texto = tagBanco.value;

//Dando explode nos elementos após a vírgula
var retorno = texto.split(",");

let maxTags = 10,

tags = [];

//Verificando se há elementos
if(retorno.length > 0){
    //Adicionando elementos ao vetor tags
    for(k = 0; k < retorno.length; k++){
        tags.push(retorno[k]);
    }
}

countTags();
createTag();

function countTags(){
    input.focus();
    tagNumb.innerText = maxTags - tags.length;
}

function createTag(){
    ul.querySelectorAll("li").forEach(li => li.remove());
    tags.slice().reverse().forEach(tag =>{
        let liTag = `<li>${tag} <i class="uit uit-multiply" onclick="remove(this, '${tag}')"></i></li>`;
        ul.insertAdjacentHTML("afterbegin", liTag);
    });
    countTags();
}

function remove(element, tag){
    let index  = tags.indexOf(tag);
    tags = [...tags.slice(0, index), ...tags.slice(index + 1)];
    element.parentElement.remove();
    countTags();
}

function addTag(e){
    if(e.key == "Enter"){
        let tag = e.target.value.replace(/\s+/g, ' ');
        if(tag.length > 1 && !tags.includes(tag)){
            if(tags.length < 10){
                tag.split(',').forEach(tag => {
                    tags.push(tag);
                    document.getElementById("tags").value = tags;
                    createTag();
                });
            }
        }
        e.target.value = "";
    }
}

input.addEventListener("keyup", addTag);

const removeBtn = document.querySelector(".details button");
removeBtn.addEventListener("click", () =>{
    tags.length = 0;
    ul.querySelectorAll("li").forEach(li => li.remove());
    countTags();
});