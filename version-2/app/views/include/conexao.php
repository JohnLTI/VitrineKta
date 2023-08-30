<?php
    $dbname="vitrinekta_com_br_"; // Indique o nome do banco de dados que será aberto
 
    $usuario="ifsudeste.site"; // Indique o nome do usuário que tem acesso
     
    $password="!fsud3st3.4l3x.pr3fpr0j"; // Indique a senha do usuário
    
    $hostname="localhost:3306";

    //Estabelecendo Conexão BD
    $conexao = new mysqli($hostname, $usuario, $password, $dbname);
    
    //verificando se houve erros
    if(mysqli_connect_errno()){
        $dbname="ktaemksa_novo"; // Indique o nome do banco de dados que será aberto
 
        $usuario="root"; // Indique o nome do usuário que tem acesso
        
        $password=""; // Indique a senha do usuário
        
        $hostname="localhost";

        //Estabelecendo Conexão BD
        $conexao = new mysqli($hostname, $usuario, $password, $dbname);
        if(mysqli_connect_errno()){
            echo "Erro ao conectar com o banco";
            exit();
        }
    } 

?>          