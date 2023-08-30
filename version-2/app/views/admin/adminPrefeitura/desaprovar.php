<?php
    include '../verifica.php';
?>

<head> 
    <title>Sistema Administrativo | Aprovado</title>
    <link rel="icon" type="imagem/png" href="img/32x32.png" />
    <meta-name="robots" content="noindex">
    
    </head>
    <body>
        
    <?php
        include '../../include/conexao.php';
        $pegavalores = "UPDATE comercio SET status='2' where idcomercio=$_REQUEST[cod]";
        $result = $conexao->query($pegavalores);
    ?>
        <center>
            Registro <?php echo $_REQUEST["cod"];?> desaprovado, porém, continua ativo para ser aprovado.
            <div class="question">
                <div class="btn-block">
                    <a href="./index.php" class="btcad"> Voltar</a>
                </div>
            </div>
        </center>
    
    </body>
</html>
