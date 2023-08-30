<?php
    include '../include/conexao.php'; 
    $pegavalores = "DELETE FROM fotos WHERE idfotos=$_REQUEST[id]";
    $result = $conexao->query($pegavalores);
    if ($result === TRUE) {  
        header("Location: ./AdmEditar.php?idcomercio=$_REQUEST[idcomercio]");
    } else {
        header("Location: ./AdmEditar.php?idcomercio=$_REQUEST[idcomercio]");
    }
?>