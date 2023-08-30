<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
    if ((isset($_SESSION['email']) == true)) $id = $_SESSION['id'];
}
include "../include/conexao.php";
$delete = "DELETE FROM blog WHERE blog.data_envio<DATE_ADD(CURRENT_DATE(), INTERVAL -30 DAY)";
$result = $conexao->query($delete);

?>
<!doctype html>
<html lang="pt-br" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" type="imagem/png" href="../../../public/img/32x32.png" />
    <title>Últimas Notícias | VitrineKta</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Dashboard CSS-->
    <link href="../admin/assets/css/dashboard.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="../../../public/css/index.css" rel="stylesheet">
</head>

<body>
    <?php include "../include/cabecalho.php"; ?>
    <div class="page">
        <div class="page-main">
            <div class="my-3 my-md-5">
                <div class="container">
                    <div class="page-header">
                        <h1 class="page-title">
                            Últimas Notícias
                        </h1>
                    </div>

                    <div class="row row-cards row-deck">

                        <?php
                        //Busca todos os Dados com um limite de 8 caracteres (limit 8) E aleatorios (ORDER BY RAND), por isso cada vez que atualiza muda os cards
                        $pegavalores = "SELECT b.comercio_idcomercio,b.titulo,b.descricao,b.link,b.imagem_blog,b.data_envio,c.idcomercio,c.imagem,c.nome_fantasia,b.ranking  FROM blog b INNER JOIN comercio c ON b.comercio_idcomercio = c.idcomercio  ORDER BY b.ranking ASC";
                        //Resultado da busca
                        $result = $conexao->query($pegavalores);
                        $data_hoje = date("d-m-Y");
                        //Roda o laço enquanto houver resultados
                        while ($row_linha = mysqli_fetch_assoc($result)) {
                            //A data está no formato y-m-d 
                            $data_sql = $row_linha['data_envio'];
                            //Converto para d-m-y para subtrair
                            $data_convertida = (int)date("d-m-Y", strtotime($data_sql));
                            //Obtem a diferença das datas em segundo
                            $segundos = strtotime($data_hoje) - strtotime($data_sql);
                            // Transforma os segundos em dias 
                            $dias = ($segundos / (60 * 60 * 24));

                        ?>

                            <div class="col-12 col-sm-6 col-md-4 col-xl-3">
                                <a href="<?php echo $row_linha['link']; ?>" target="_blank" class="link-blog">
                                    <div class="card" id="card-blog">
                                        <img class="card-img-top" src="<?php echo "../../../public/assets/" . $row_linha['imagem_blog']; ?>" alt="Imagem da notícia">
                                        <div class="card-body d-flex flex-column">
                                            <h4 class="titulo-blog"><?php echo $row_linha['titulo']; ?></h4>
                                            <!-- Descrição -->
                                            <div class="text-muted"><?php echo $row_linha['descricao']; ?></div>

                                            <div class="d-flex align-items-center pt-5 mt-auto proprietario-blog">
                                                <div class="avatar avatar-md mr-3">
                                               
                                                <img class="card-avatar" src="../../../public/assets/<?php echo $row_linha['imagem']; ?>">
                                                </div>
                                                <div>
                                                    <a href="./individual.php?id=<?php echo $row_linha['idcomercio']; ?>" class="text-default"><?php echo $row_linha['nome_fantasia'] ?></a>
                                                    <?php if ($dias > 0) : ?>
                                                        <small class="d-block text-muted"><?php echo $dias; ?> dias atrás</small>
                                                    <?php else :
                                                        echo '<small class="d-block text-muted">Hoje</small>';
                                                    endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <?php include "../include/footer.php"; ?>
        <!-- Fonte -->
        <script src="https://kit.fontawesome.com/b6471a517e.js" crossorigin="anonymous"></script>
        <!-- Carrossel -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>


</html>