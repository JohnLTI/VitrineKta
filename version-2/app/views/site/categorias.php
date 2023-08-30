<?php
//Inicia sessão
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

// Banco de dados
include "../include/conexao.php";

$sql = "SELECT nome FROM `segmento` ORDER BY nome ASC";

//Roda a query
$resultado = $conexao->query($sql);

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
    <title>VitrineKta | Todas as Categorias</title>
    <link rel="icon" type="imagem/png" href="../../../public/img/32x32.png" />
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="../../../public/css/index.css" rel="stylesheet">

</head>

<body>
    <!-- Cabeçalho -->
    <header>
        <?php include "../admin/include/navbar.php"?>
    <main>
        <div class="container">
            <ul class="list-group">
                <?php while ($row_linha = mysqli_fetch_assoc($resultado)) { ?>
                    <a class="all-links-categorias" href="./busca.php?pesquisa=<?= $row_linha['nome']; ?>" class="links-categorias">
                        <li class="list-group-item"><?= $row_linha['nome']; ?></li>
                    </a>
                <?php } ?>
            </ul>
        </div>
    </main>
    <!-- Footer -->
    <?php include "../include/footer.php"; ?>
    <!-- Fonte -->
    <script src="https://kit.fontawesome.com/b6471a517e.js" crossorigin="anonymous"></script>
    <!-- Menu -->
    <script src="../../../public/js/menu.js"></script>
</body>

</html>