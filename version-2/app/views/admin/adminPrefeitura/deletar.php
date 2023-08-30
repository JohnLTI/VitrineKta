<?php

include '../../include/conexao.php'; ?>
<html>

<head>
    <title>Sistema Administrativo | Deletado</title>
    <link rel="icon" type="imagem/png" href="img/32x32.png" />
    <meta-name="robots" content="noindex">

</head>

<body>
    <?php
    include '../verifica.php';
    ?>

    <head>

    </head>

    <body>

        <?php
        $pegavalores = "DELETE FROM comercio WHERE idcomercio=$_REQUEST[cod]";
        $result = $conexao->query($pegavalores);
        if ($result === TRUE) {
            echo "Registro " . $_REQUEST["cod"] . " deletado com sucesso.";
        } else {
            echo "Error deleting record: " . $conexao->error;
        }
        ?>

        <center>
            <div class="question">
                <div class="btn-block">
                    <a href="index.php" class="btcad"> Voltar</a>
                </div>
            </div>
        </center>

    </body>

</html>