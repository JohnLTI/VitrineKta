function envia() {
    var time_email = document.getElementById("txtEmail").value;
    var time_senha = document.getElementById("txtSenha").value;
    if(time_email == '' || time_senha == '') {
        alert("Preencha todos os campos!");
    }
    else {
        document.getElementById("login-form").submit();
    }   
}