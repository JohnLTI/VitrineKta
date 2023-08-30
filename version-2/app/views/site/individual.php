<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (isset($_GET['id'])) {
    include "../include/conexao.php";

    $id = $_GET['id'];

    //buscar segmento
    $sql = "SELECT * FROM comercio, segmento WHERE idcomercio = $id and segmento_idsegmento = idsegmento";
    $resultado = $conexao->query($sql);

    $linha = $resultado->fetch_array();
    // nome do title
    $NomeTitulo = $linha['nome_fantasia'];
    if ($linha['status'] != 1) {
        echo "<div class='alert alert-icon alert-danger' role='alert'>
        <i class='fe fe-alert-triangle mr-2' aria-hidden='true'></i> <script>alert('Este comercio está em supervisão dos administradores');</script>
        </div>";

        echo "<script>document.location='index.php'</script>";
        exit;
    }

    $date = date('Y-m-d');
    $sql2 = $conexao->query("SELECT * FROM acesso WHERE data_acesso = '$date' AND acesso.comercio_idcomercio = $id");
    //Adicionando acesso a tabela acesso no BD
    if (mysqli_num_rows($sql2) > 0) {
        $banco = $sql2->fetch_array();
        $acesso_id = $banco['acesso_id'];
        $total_acesso = $banco['total_acesso'] + 1;
        $acesso = "UPDATE `acesso` SET total_acesso = $total_acesso WHERE acesso_id = $acesso_id";
    } else {
        $acesso = "INSERT INTO `acesso` (`comercio_idcomercio`,`data_acesso`,`total_acesso`) VALUES ('$id','$date',1)";
    }
    $conexao->query($acesso);
} else {
    header("location:index.php");
}
// fotos
$sqlfotos = "SELECT * FROM fotos WHERE comercio_idcomercio = $id";
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
    <title>VitrineKta | <?= $NomeTitulo ?> </title>
    <link rel="icon" type="imagem/png" href="../../../public/img/32x32.png" />
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="../../../public/css/index.css" rel="stylesheet">

    <!--SlicK Carrosel-->
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>


</head>

<body>
    <?php include "../include/cabecalho.php"; ?>

    <div class="imgcapacont" id="map">
        <?php include '../include/mapa.php'; ?>
    </div>
    <?php
    // query do segmento para buscar os dados que vão ficar no while
    $resultado->data_seek(0);
    while ($row_linha = mysqli_fetch_assoc($resultado)) {
        //Puxa o whatsapp
        $wa = $row_linha['Whatsapp'];
        //Filtra apenas os números sem os caracteres especiais
        $caracteres = $int = preg_replace('/[^0-9]/', '', $wa);
        //apaga o número 9, pois no whatsapp não pode haver o número 9
        $result = str_replace('329', '32', $caracteres)
    ?>
        <div class="container cont">
            <div class="grupcont1">
                <div class="imgperfilcont">
                    <div class="responredesociallogo">
                        <img class="imgperfil" src='<?php echo "../../../public/assets/" . $row_linha['imagem']; ?>' alt='Imagem de perfil da empresa'>
                        <div class="descricaoperfil">
                            <div class="imgindgruprs">
                                <?php
                                if ($row_linha['link'] != '') { ?>
                                    <a href="<?php echo $row_linha['link']; ?>" target="_blank"><img class="imgindrs" src="../../../public/img/www.png" alt="logo rede social facebook"></a>
                                <?php }
                                if ($row_linha['Whatsapp'] != '') { ?>
                                    <a href="<?php echo 'https://api.whatsapp.com/send?phone=55' . $result . '&text=Olá, encontrei seu comércio no VitrineKta. Você poderia me ajudar?'; ?>" target="_blank"><img class="imgindrs" src="https://image.flaticon.com/icons/png/512/2111/2111728.png" alt="logo rede social Whatsapp"></a>
                                <?php }

                                if ($row_linha['instagram'] != '') { ?>
                                    <a href="<?php echo $row_linha['instagram']; ?>" target="_blank"><img class="imgindrs" src="https://image.flaticon.com/icons/png/512/2111/2111463.png" alt="logo rede social Instagram"></a>
                                <?php }
                                if ($row_linha['facebook'] != '') { ?>
                                    <a href="<?php echo $row_linha['facebook']; ?>" target="_blank"><img class="imgindrs" src="https://image.flaticon.com/icons/png/512/733/733547.png" alt="logo rede social facebook"></a>
                                <?php }
                                ?>
                            </div>
                        </div>
                        <!-- Responsivo -->
                        <div class="imgindgruprsres">
                            <?php if ($row_linha['facebook'] != '') { ?>
                                <a href="<?php echo $row_linha['facebook']; ?>" target="_blank"><img class="imgindrs" src="https://image.flaticon.com/icons/png/512/733/733547.png" alt="logo rede social facebook"></a>
                            <?php }
                            if ($row_linha['instagram'] != '') { ?>
                                <a href="<?php echo $row_linha['instagram']; ?>" target="_blank"><img class="imgindrs" src="https://image.flaticon.com/icons/png/512/2111/2111463.png" alt="logo rede social Instagram"></a>
                            <?php }
                            if ($row_linha['Whatsapp'] != '') { ?>
                                <a href="<?php echo 'https://api.whatsapp.com/send?phone=55' . $result . '&text=Olá, encontrei seu comércio no VitrineKta. Você poderia me ajudar?'; ?>" target="_blank"><img class="imgindrs" src="https://image.flaticon.com/icons/png/512/2111/2111728.png" alt="logo rede social Whatsapp"></a>
                            <?php }
                            ?>
                        </div>
                    </div>
                    <div class="descricaoperfil" id="descricaoperfil">
                        <div class="contcomerind">
                            <!-- Nome fantasia -->
                            <div style="display:flex; ">
                                <h1><?php echo $row_linha['nome_fantasia']; ?></h1>
                                <?php if ($row_linha['delivery'] == '1') { ?>

                                    <p class="delivery-individual">Entrega Delivery

                                    <?php } else if ($row_linha['delivery'] == '2') { ?>

                                    <p class="delivery-individual">Atende Domicílio

                                    <?php } ?>
                            </div>
                            <div style="display:flex; ">
                                <p>Categoria:
                                <p class="descricoes-p"> <?php echo $row_linha['nome']; ?></p>

                                <?php if ($row_linha['telefone'] != '') { ?>
                                    <p id="what-wpp">Telefone: </p>
                                    <p class="descricoes-p"><?php echo $row_linha['telefone']; ?></p>
                                <?php } ?>

                            </div>
                            <!-- Categoria -->

                            <!-- Endereço -->
                            <?php if ($row_linha['rua'] != '' && $row_linha['numero'] != '' && $row_linha['bairro'] != '') { ?>
                                <div style="display:flex; ">
                                    <p>Endereço:</p>
                                    <p class="descricoes-p"><?php echo $row_linha['rua']; ?> <?php echo $row_linha['numero']; ?>, <?php echo $row_linha['bairro']; ?> </p>
                                </div>
                            <?php } ?>

                            <div style="display:flex; ">
                                <?php if ($row_linha['descricao_negocio'] != '') { ?>
                                    <p id="idescricaoind">Descrição:</p>
                                    <p class="descricoes-p"> <?php echo $row_linha['descricao_negocio']; ?></p>
                                <?php } ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="respondescricaoperfil">
                <h3><?php echo $row_linha['nome_fantasia']; ?></h3>
                <?php if ($row_linha['delivery'] == '1') { ?>

                    <p class="delivery-individual">Entrega Delivery

                    <?php } else if ($row_linha['delivery'] == '2') { ?>

                    <p class="delivery-individual">Atende Domicílio

                    <?php } ?>
                    <p class="descricoes-p"><?php echo $row_linha['rua']; ?> <?php echo $row_linha['numero']; ?>
                    <p>
                        <?php if ($row_linha['descricao_negocio'] != '') { ?>
                    <p class="descricoes-p"><?php echo $row_linha['descricao_negocio']; ?></p>
                <?php } ?>



            </div>


            <!--  Inicio Carrosel slick com Imagens-->
            <!--  Inicio Carrosel slick com Imagens-->
            <?php
            $conexao_fotos = $conexao->query($sqlfotos);
            if (mysqli_num_rows($conexao_fotos) > 0) { ?>
                <div class="latest">
                    <div class="swiper-container">
                        <div class="swiper-wrapper">
                            <?php
                            while ($linha = mysqli_fetch_assoc($conexao_fotos)) {
                            ?>
                                <div class="swiper-slide">
                                    <img src="../../../public/assets/<?php echo $linha['imagem']; ?>" class="comic-cover" alt="">
                                </div>
                            <?php } ?>
                        </div>


                        <div class="swiper-pagination"></div>
                    </div>
                </div>

            <?php } ?>

            <div class="divtabelaaberturafechamento">
                <?php
                $sql = "SELECT * FROM funcionamento WHERE comercio_idcomercio = $id ORDER BY dia_semana";
                $retorno = $conexao->query($sql);
                if ($retorno->num_rows > 0) {
                ?>
                    <table id="table-individual">
                        <tr id="linha-dias">
                            <td>Dias</td>
                            <td>Segunda</td>
                            <td>Terça</td>
                            <td>Quarta</td>
                            <td>Quinta</td>
                            <td>Sexta</td>
                            <td>Sabado</td>
                            <td>Domingo</td>
                        </tr>
                        <tr>
                            <td>Aberto</td>
                            <?php
                            while ($line = $retorno->fetch_array()) {
                            ?>
                                <td>
                                    <?php

                                    if ($line['abertura']) {
                                        echo $line['abertura'];
                                    } else {
                                        echo '-';
                                    }
                                    ?>
                                </td>
                            <?php } ?>
                        </tr>
                        <tr>
                            <td>Fechado</td>
                            <?php
                            //Faz o line começar do zero (domingo)
                            $retorno->data_seek(0);
                            while ($line = $retorno->fetch_array()) {
                            ?>
                                <td>
                                    <?php if ($line['abertura']) {
                                        echo $line['fechamento'];
                                    } else {
                                        echo '-';
                                    }
                                    ?>
                                </td>
                            <?php } ?>
                        </tr>
                    </table>
                <?php } ?>
            </div>
            <div class="respondivtabelaaberturafechamento">
                <table id="table-individual">
                    <tr id="linha-dias">
                        <td>Dias</td>
                        <td>Aberto</td>
                        <td>Fechado</td>
                    </tr>
                    <?php
                    // dias da semana
                    $dia = ['Domingo', 'Segunda-feira', 'Terça-Feira', 'Quarta-Feira', 'Quinta-Feira', 'Sexta-Feira', 'Sábado'];
                    // zera o retorno
                    $retorno->data_seek(0);
                    //laço gerando linha por linha
                    while ($line = $retorno->fetch_array()) { ?>
                        <tr>
                            <!-- busca os dias -->
                            <td class="text-left"><?php echo $dia[$line['dia_semana']]; ?></td>
                            <!-- abertura -->
                            <td><?php echo $line['abertura']; ?></td>
                            <!-- fechamento -->
                            <td><?php echo $line['fechamento']; ?></td>
                        </tr>
                    <?php
                    } ?>
                </table>
            </div>
        </div>
    <?php } ?>


    <!-- Footer -->
    <?php include "../include/footer.php"; ?>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper('.swiper-container', {
            effect: 'coverflow',
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: 'auto',
            coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 150,
                modifier: 1,
                slideShadows: true,
            },

            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },

            loop: true,
        });
    </script>

    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

    <!-- Fonte -->
    <script src="https://kit.fontawesome.com/b6471a517e.js" crossorigin="anonymous"></script>
    <!-- Carrossel -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>