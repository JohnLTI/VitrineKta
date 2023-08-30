function checkCnpj(cnpj) {
    $.ajax({
        url: "https://www.receitaws.com.br/v1/cnpj/" + cnpj.replace(/[^0-9]/g, '') + "",
        type: "POST",
        dataType: "jsonp",
        //JSONP ou "JSON with padding" é um complemento ao formato de dados JSON. 
        //Ele provê um método para enviar requisições de dados de um servidor para um 
        //domínio diferente, uma coisa proibida pelos navegadores típicos por causa da 
        //Política de mesma origem.
        success: function(data) {
            console.log(data);
            if (data.nome == undefined) {
                alert(data.status + ' ' + data.message);
            } else {
                document.getElementById('razaoSocial').value = data.nome;
                document.getElementById('fantasia').value = data.fantasia;
                document.getElementById('rua').value = data.logradouro;
                document.getElementById('numero').value = data.numero;
                document.getElementById('bairro').value = data.bairro;
                document.getElementById('cep').value = data.cep;
            }
        }
    });
}