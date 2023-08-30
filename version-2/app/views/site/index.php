<?php
//Inicia sessão
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Banco de dados
include "../include/conexao.php";

//Busca todos os Dados com um limite de 5 (limit 5) E aleatorios (ORDER BY RAND) que possui id par e impar
$sqlPar = "SELECT * FROM `comercio`, `segmento` WHERE comercio.status = 1 AND (comercio.idcomercio % 2) = 0 AND (comercio.segmento_idsegmento) = (segmento.idsegmento) ORDER BY RAND() limit 5;";

$sqlImpar = "SELECT * FROM `comercio`, `segmento` WHERE comercio.status = 1 AND (comercio.idcomercio % 2) <> 0 AND (comercio.segmento_idsegmento) = (segmento.idsegmento) ORDER BY RAND() limit 5;";

//Roda a query
$resultadoPar = $conexao->query($sqlPar);

$resultadoImpar = $conexao->query($sqlImpar);


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
    <title>VitrineKta</title>
    <link rel="icon" type="imagem/png" href="../../../public/img/32x32.png" />
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="../../../public/css/index.css" rel="stylesheet">
</head>

<body>
    <!-- Cabeçalho -->
    <?php include "../include/cabecalho.php"; ?>
    <main>
        <!-- Carrossel -->
        <div id="carouselExampleControls" class="carousel slide banner" data-bs-ride="carousel">
            <div class="carousel-inner banner-max">
                <!-- Loop de fotos para o carrossel -->
                <?php for($k = 1; $k < 8; $k++): ?>
                    
                    <div class="carousel-item <?php if($k == 1) echo 'active'?>">
                        <img src="../../../public/img/carrossel0<?= $k; ?>.png" class="d-block w-100 image-carousel" alt="...">
                    </div>
                    
                <?php endfor; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon span-carousel" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon span-carousel" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <!-- Cards -->
        <div class="content">
            <div class="container">
                <div class="linha">
                    <div class="coluna">

                        <?php while ($row_linha = mysqli_fetch_assoc($resultadoPar)) { ?>
                            <div class="card-comercio">
                                <a href="individual.php?id=<?php echo $row_linha['idcomercio']; ?>" class="link-individual">
                                    <div class="logo-comercio">
                                        <img class="logo-comercio" src="../../../public/assets/<?= $row_linha['imagem'];?>">
                                    </div>
                                    <div class="card-body-comercio">
                                        <h2 class="nome-comercio"><?= $row_linha['nome_fantasia']; ?></h2>
                                        <small class="small-card"><?= $row_linha['nome']; ?></small>                          
                                    </div>
                                    
                                    <!-- Delivery -->
                                    <?php if($row_linha['delivery'] == 1){?>
                                        <div class="card-final-comercio">
                                            <small class="small-card">Delivery</small>
                                        </div>
                                    <?php } 

                                    else if($row_linha['delivery'] == 2){?>
                                        <div class="card-final-comercio">
                                            <small class="small-card">Domicílio</small>
                                        </div>
                                    <?php } ?>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                    <!------------------------------------------->
                    <div class="coluna" id="coluna-2">
                        <?php while ($row_linha = mysqli_fetch_assoc($resultadoImpar)) { ?>
                            <div class="card-comercio">
                                <a href="individual.php?id=<?php echo $row_linha['idcomercio'];?>" class="link-individual">
                                    <div class="logo-comercio">
                                        <img class="logo-comercio" src="../../../public/assets/<?= $row_linha['imagem'];?>">
                                    </div>
                                    <div class="card-body-comercio">
                                        <h2 class="nome-comercio"><?= $row_linha['nome_fantasia']; ?></h2>
                                        <small class="small-card"><?= $row_linha['nome']; ?></small>
                                    </div>

                                    <!-- Delivery -->
                                    <?php if($row_linha['delivery'] == 1){?>
                                        <div class="card-final-comercio">
                                            <small class="small-card">Delivery</small>
                                        </div>
                                    <?php } 

                                    else if($row_linha['delivery'] == 2){?>
                                        <div class="card-final-comercio">
                                            <small class="small-card">Domicílio</small>
                                        </div>
                                    <?php } ?>
                                </a>
                            </div>
                        <?php } ?>

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