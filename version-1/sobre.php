<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="icon" type="imagem/png" href="img/32x32.png" />  


    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="../../public/css/style.css" rel="stylesheet">
    <title>VitrineKta</title>
    
</head>

<body>




    <!--Navigation Bar (CABEÇALHO)-->
    <?php include "include/tstconexao.php"; ?>
    <?php include "include/cabecalho.php"; ?>


    <!--formulario-->
    <div class="caixasobre">
        <div class="containersobre">
            <div class="logosobre">
                <img class="logosb" src="img/imgsobrenos.png" alt="Logo do site">
            </div>
            <div class="titulosobre">
                <h2 class="titulosb">Sobre Nós</h2>
            </div>
           <div class="divpsobre">
            <p class="p_sobre">O site VitrineKta é fruto de uma parceria técnica entre a Prefeitura Municipal de Cataguases e IF Sudeste
                MG Campus Avançado Cataguases além dos colaboradores: Câmara dos Dirigentes Lojistas de Cataguases
                (CDL), Associação Comercial e Industrial de Cataguases (ACIC) e do Serviço Brasileiro de Apoio às Micro e Pequenas Empresas (SEBRAE), Embaixada GV Cataguases.</p>
            <p class="p_sobre">Nosso projeto é totalmente gratuito e possui finalidade exclusivamente social destinada a dar
                visibilidade aos comerciantes e prestadores de serviços legalizados da cidade de Cataguases, Minas
                Gerais, ou seja, propõe-se a dar destaque a esses atores com intuito de fortalecimento do comércio e
                econômica local. </p>
            <p class="p_sobre">O site funciona como uma grande vitrine digital que aproxima potenciais consumidores dos comerciantes e
                prestadores de serviços exclusivamente através de publicidade virtual em que há exposição das
                informações cadastradas e atualizadas pelos comerciantes sobre o seu estabelecimento comercial, área de
                cobertura de atendimento e produtos oferecidos. O site VitrineKta não faz qualquer tipo de cobrança
                pecuniária ou intermediação das negociações e vendas.
            </p>
            </div>
        </div>
    </div>

    <!--formulario-->
    <?php
    include './include/footer.php';
    ?>
    <!--Cadastro back-end-->


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js" type="text/javascript"></script>
    <script>
        window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')
    </script>
    <script src="js/main.js"></script>

</body>

</html>