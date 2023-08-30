const btnMenu = document.getElementById('checkbox-menu');

function MenuClicado(){
    const nav = document.getElementById('nav');
    nav.classList.toggle('active');
}

btnMenu.addEventListener('click',MenuClicado)