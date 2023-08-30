<?php 
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

?>
<html lang="pt-br">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Catálogo empresarial da cidade de Cataguases - MG. O site funciona como uma grande vitrine digital que aproxima potenciais consumidores dos comerciantes e prestadores de serviços.">
    <meta name="keywords" content="Comércio local, Cataguases,Catálogo, Vitrine, Marketing Digital, Empresas, Comércio, Prestadores de serviço, <?php echo $NomeTitulo ?>">
    <meta name="author" content="Prefeitura de Cataguases">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VitrineKta | Sobre Nós</title>
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="../../../public/css/index.css" rel="stylesheet">
    <link rel="icon" type="imagem/png" href="../../../public/img/32x32.png" />
</head>

<body>
    <!-- Cabeçalho -->
    <?php include "../include/cabecalho.php"; ?>

    <!-- Conteudo -->
    <main>
        <div class="container bloco">
            <div class="conteudo">
                <div class="texto">
                    <h2 class="titulo-h1">Sobre nós</h2>
                    <p class="paragrafo-p">
                        O site VitrineKta é fruto de uma parceria técnica entre a Prefeitura Municipal de Cataguases e IF Sudeste MG Campus Avançado Cataguases além dos colaboradores: Câmara dos Dirigentes Lojistas de Cataguases (CDL), Associação Comercial e Industrial de Cataguases (ACIC) e do Serviço Brasileiro de Apoio às Micro e Pequenas Empresas (SEBRAE), Embaixada GV Cataguases.
                        <br> Nosso projeto é totalmente gratuito e possui finalidade exclusivamente social destinada a dar visibilidade aos comerciantes e prestadores de serviços legalizados da cidade de Cataguases, Minas Gerais, ou seja, propõe-se a dar destaque a esses atores com intuito de fortalecimento do comércio e econômica local.
                        <br> O site funciona como uma grande vitrine digital que aproxima potenciais consumidores dos comerciantes e prestadores de serviços exclusivamente através de publicidade virtual em que há exposição das informações cadastradas e atualizadas pelos comerciantes sobre o seu estabelecimento comercial, área de cobertura de atendimento e produtos oferecidos. O site VitrineKta não faz qualquer tipo de cobrança pecuniária ou intermediação das negociações e vendas.
                    </p>
                </div>

                <div class="texto">
                    <h2 class="titulo-h1">Parceiros</h2>
                    <p class="paragrafo-p">
                        Nosso projeto é totalmente gratuito e possui finalidade exclusivamente social destinada a dar visibilidade aos comerciantes e prestadores de serviços legalizados da cidade de Cataguases, Minas Gerais, ou seja, propõe-se a dar destaque a esses atores com intuito de fortalecimento do comércio e econômica local.
                        <br>
                        Site funciona como uma grande vitrine digital que aproxima potenciais consumidores dos comerciantes e prestadores de serviços exclusivamente através de publicidade virtual em que há exposição das informações cadastradas e atualizadas pelos comerciantes sobre o seu estabelecimento comercial, área de cobertura de atendimento e produtos oferecidos. O site VitrineKta não faz qualquer tipo de cobrança pecuniária ou intermediação das negociações e vendas.
                    </p>
                    <div class="divlogoparceiros">
                        <a href="https://cataguases.mg.gov.br/" target="_blank"><img class="mglogosparceiros" id="logo_cataguases" src="../../../public/img/LOGO PREFEITURA SEDEGI.jpg" alt="Prefeitura de Cataguases"></a>
                        <a href="https://www.ifsudestemg.edu.br/cataguases" target="_blank"><img class="mglogosparceiros" src="../../../public/img/logomarca IF SUDESTE.png" alt="Logo do Instituto Federal"></a>
                        <a href="https://cataguases.cdls.org.br/" target="_blank"><img class="mglogosparceiros" src="../../../public/img/CDL.png" alt="Logo da CDL"></a>
                        <a href="https://pt-br.facebook.com/pages/category/Consulting-Agency/ACIC-Associa%C3%A7%C3%A3o-Comercial-e-Industrial-de-Cataguases-422881014559226/" target="_blank"><img class="mglogosparceiros" src="../../../public/img/Acic.png" alt="Logo da ACIC"></a>
                        <a href="https://www.instagram.com/gvcataguases/" target="_blank"><img class="mglogosparceiros" src="../../../public/img/Logo-Embaixada-GV-Cataguases.png" alt="Prefeitura de Cataguases"></a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include "../include/footer.php"; ?>

    <!-- Fonte -->
    <script src="https://kit.fontawesome.com/b6471a517e.js" crossorigin="anonymous"></script>
    <!-- Carrossel -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>