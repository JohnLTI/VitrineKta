<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
include "../../include/conexao.php";

$servidor = $_SESSION['servidor'];

include '../verifica.php';

if ($servidor != 2) {
    header('location:../index.php');
}

//Capturar os dados do comércio
$array = $conexao->query("SELECT * FROM comercio,segmento WHERE idcomercio=$_REQUEST[cod] and segmento_idsegmento = idsegmento");
if ($array->num_rows == 1) {
    $linha = $array->fetch_array();
} else {
    header("location: ./index.php");
}

?>

<?php

if (isset($_GET["cod"])) {
    $idcomercio = $_REQUEST['cod'];
} else {
    header('location:./index.php');
}

if (isset($_POST["btCadastrar"])) {
    $nomeComercio = $_POST["txtnomeComercio"];
    $razaoSocial = $_POST["txtrazaoSocial"];
    $cnpj = $_POST["txtcnpj"];
    $telefone = $_POST["txttelefone"];
    $site = $_POST["txtsite"];
    $facebook = $_POST["txtfacebook"];
    $instagram = $_POST["txtinstagram"];
    $wpp = $_POST["txtwppLink"];
    $rua = $_POST["txtendereco"];
    $numero = $_POST["txtnumeroendereco"];
    $complemento = $_POST["txtcomplemento"];
    $bairro = $_POST["txtbairro"];
    $delivery = $_POST["delivery"];
    $cep = $_POST["txtcep"];
    $descricao = $_POST["txtdescricao"];
    $cnpj = $_POST["txtcnpj"];
    $CDL = 0;
    $categoria = $_POST['categoria'];

    //enviar a imagem
    if ($_FILES["txtimagem"]["error"] != 0) {

        //Query Atualizar
        $sql = "UPDATE `comercio` SET 
            `nome_fantasia` = '$nomeComercio',
            `razao_social` = '$razaoSocial',  
            `telefone` = '$telefone',
            `instagram` = '$instagram', 
            `facebook` = '$facebook', 
            `rua` = '$rua', 
            `numero` = '$numero',
            `complemento` = '$complemento',
            `link` = '$site', 
            `bairro` = '$bairro',
            `segmento_idsegmento` = '$categoria', 
            `descricao_negocio` = '$descricao', 
            `Whatsapp` = '$wpp',
            `CEP` = '$cep',
            `cnpj` = '$cnpj',
            `CDL` = '$CDL',
            `delivery` = '$delivery' WHERE `comercio`.`idcomercio` = $idcomercio";
        $conexao->query($sql);
    } else {
        //ARQUIVOS
        $imagemTmp = $_FILES["txtimagem"]["tmp_name"];
        $imagem = date("dmyHis") . $_FILES["txtimagem"]["name"];
        move_uploaded_file($imagemTmp, "../images/" . $imagem);

        //Query Atualizar
        $sql = "UPDATE `comercio` SET 
            `nome_fantasia` = '$nomeComercio',
            `razao_social` = '$razaoSocial',  
            `instagram` = '$instagram', 
            `facebook` = '$facebook',
            `rua` = '$rua', 
            `numero` = '$numero',
            `complemento` = '$complemento',
            `link` = '$site', 
            `imagem` = '$imagem',
            `bairro` = '$bairro',
            `segmento_idsegmento` = '$categoria', 
            `descricao_negocio` = '$descricao', 
            `Whatsapp` = '$wpp',
            `CEP` = '$cep',
            `cnpj` = '$cnpj',
            `CDL` = '$CDL'
            `imagem` = '$imagem'
            `delivery` = '$delivery' WHERE `comercio`.`idcomercio` = $idcomercio";

        $conexao = $conexao->query($sql);
    }

    if ($conexao->errno == 0) {

        //Apagar todos os dias armazenados e cadastrar novos
        $sql = "DELETE FROM `funcionamento` WHERE `comercio_idcomercio`= $idcomercio";
        $conexao->query($sql);

        //Capturando os dias da semana e os horários
        //Segunda
        if (isset($_POST["txtSegunda"])) {
            $inicio = $_POST["txtInicioSeg"];
            $fim = $_POST["txtFimSeg"];

            $sql = "INSERT INTO `funcionamento` ( `comercio_idcomercio`, `dia_semana`, `abertura`, `fechamento`) VALUES ( '$idcomercio', 1, '$inicio', '$fim') ";
            $conexao->query($sql);
        }

        //Terça
        if (isset($_POST["txtTerca"])) {
            $inicio = $_POST["txtInicioTer"];
            $fim = $_POST["txtFimTer"];

            $sql = "INSERT INTO `funcionamento` ( `comercio_idcomercio`, `dia_semana`, `abertura`, `fechamento`) VALUES ( '$idcomercio', 2, '$inicio', '$fim') ";

            $conexao->query($sql);
        }

        //Quarta
        if (isset($_POST["txtQuarta"])) {
            $inicio = $_POST["txtInicioQua"];
            $fim = $_POST["txtFimQua"];

            $sql = "INSERT INTO `funcionamento` ( `comercio_idcomercio`, `dia_semana`, `abertura`, `fechamento`)  VALUES ( '$idcomercio', 3, '$inicio', '$fim') ";

            $conexao->query($sql);
        }

        //Quinta
        if (isset($_POST["txtQuinta"])) {
            $inicio = $_POST["txtInicioQui"];
            $fim = $_POST["txtFimQui"];

            $sql = "INSERT INTO `funcionamento` ( `comercio_idcomercio`, `dia_semana`, `abertura`, `fechamento`) VALUES ( '$idcomercio', 4, '$inicio', '$fim') ";

            $conexao->query($sql);
        }

        //Sexta
        if (isset($_POST["txtSexta"])) {
            $inicio = $_POST["txtInicioSex"];
            $fim = $_POST["txtFimSex"];

            $sql = "INSERT INTO `funcionamento` ( `comercio_idcomercio`, `dia_semana`, `abertura`, `fechamento`) VALUES ( '$idcomercio', 5, '$inicio', '$fim') ";

            $conexao->query($sql);
        }

        //Sábado
        if (isset($_POST["txtSabado"])) {
            $inicio = $_POST["txtInicioSab"];
            $fim = $_POST["txtFimSab"];

            $sql = "INSERT INTO `funcionamento` ( `comercio_idcomercio`, `dia_semana`, `abertura`, `fechamento`) VALUES ( '$idcomercio', 6, '$inicio', '$fim') ";

            $conexao->query($sql);
        }

        //Domingo
        if (isset($_POST["txtDomingo"])) {
            $inicio = $_POST["txtInicioDom"];
            $fim = $_POST["txtFimDom"];

            $sql = "INSERT INTO `funcionamento` ( `comercio_idcomercio`, `dia_semana`, `abertura`, `fechamento`) VALUES ( '$idcomercio', 0, '$inicio', '$fim') ";

            $conexao->query($sql);
        }

        echo "<script>alert('Registro cadastrado com sucesso!');</script>";
        header("location: ./index.php");
    } else {
        echo "<script>alert('Erro ao atualizar o registro');</script>";
    }
}
?>
<!-- ./Fazendo as alterações no Banco -->

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="../../../../public/css/index.css" rel="stylesheet">
    <link rel="icon" type="imagem/png" href="img/32x32.png" />
    <script type="text/javascript" src="js/cep.js"></script>
    <link rel="icon" type="imagem/png" href="img/32x32.png" />
    <title>VitrineKta | <?php echo $linha['nome_fantasia']; ?></title>
    <script type="text/javascript" src="js/cadastro.js"></script>
</head>

<body>

    <!--formulario-->
    <main>
        <!--formulario-->
        <main>

            <div class="head">
                <h2 class="title-head">Editando Empresa: <?php echo $linha["nome_fantasia"]; ?></h2>
                <tr></tr>
            </div>
            <div class="container bloco">
                <div class="conteudo">
                    <form method='POST' enctype="multipart/form-data">
                        <div class="item">

                            <div class="content-input">
                                <label for="cnpj">CNPJ:<span class="required">*</span></label>
                                <input type="text" name="txtcnpj" value='<?php echo $linha["cnpj"]; ?>' placeholder="Nome do Comércio" class='phone-ddd-mask' maxlength="14" required="required" />
                            </div>

                            <div class="content-input">
                                <label for="cnpj">Razão Social:<span class="required">*</span></label>
                                <input type="text" value='<?php echo $linha["razao_social"]; ?>' name="txtrazaoSocial" id="formcad" placeholder="Insira o nome jurídico(denominação social) da empresa" maxlength="30" minlenght="5" required="required" />
                            </div>

                            <div class="content-input">
                                <label for="fantasia">Nome Fantasia <span class="required">*</span></label>
                                <input type="text" value='<?php echo $linha["nome_fantasia"]; ?>' name="txtnomeComercio" id="formcad" placeholder="Insira o nome comercial da empresa" maxlength="33" minlenght="5" required="required" />
                            </div>

                            <div class="content-input">
                                <label class="form-label" for="customFile">Sua Logomarca: (.jpg OU .png)<span class="required">*</span></label>
                                <input type="file" name="txtimagem" class="form-control" id="customFile" accept=".png,.jpg" />
                            </div>

                            <div class="content-input">
                                <label class="form-label" for="categoria">Categoria do Estabelecimento:<span class="required">*</span></label>
                                <select name="categoria" id="categoria" class="form-select" required>
                                    <option value='<?php echo $linha["segmento_idsegmento"]; ?>'> <?php echo $linha['nome']; ?></option>
                                    <?php
                                    $pegavalores = "SELECT * FROM segmento order by nome";
                                    $result = $conexao->query($pegavalores);
                                    while ($row_linha = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <option value='<?php echo $row_linha["idsegmento"]; ?>'><?php echo $row_linha['nome']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="content-input">
                                <label for="telefone" class="control-label">Telefone <span class="required">*</span></label>
                                <input type="text" value='<?php echo $linha["telefone"]; ?>' placeholder="Telefone" name="txttelefone" id="txttelefone" maxlength="12" required="required" />
                            </div>

                            <div class="content-input">
                                <label for="link">Site ou Aplicativo</label>
                                <input type="url" value='<?php echo $linha["link"]; ?>' placeholder="Link do seu site, catálogo ou outros. ex: https://exemplo.com.br" name="txtsite" pattern="https://.*" minlength="5" />
                            </div>

                            <div class="content-input">
                                <label for="facebook">Facebook</label>
                                <input type="url" value='<?php echo $linha["facebook"]; ?>' placeholder="Link para o facebook" name="txtfacebook" />
                            </div>

                            <div class="content-input">
                                <label for="instagram">Instagram</label>
                                <input type="url" value='<?php echo $linha["instagram"]; ?>' placeholder="Link para o instagram" name="txtinstagram" />
                            </div>

                            <div class="content-input">
                                <label for="whatsapp">Whatsapp </label>
                                <input type="text" value='<?php echo $linha["Whatsapp"]; ?>' placeholder="Número do Whatsapp" name="txtwppLink" maxlength="12" />
                            </div>

                            <div class="content-input">
                                <label class="form-label" for="delivery">Faz Delivery ou atende em Domicílio?</label>
                                <select name="delivery" id="delivery" class="form-select" required>
                                    <option value="0" <?php if ($linha["delivery"] == 0) echo "selected"; ?>>Não</option>
                                    <option value="1" <?php if ($linha["delivery"] == 1) echo "selected"; ?>>Sim, Faço Delivery</option>
                                    <option value="2" <?php if ($linha["delivery"] == 2) echo "selected"; ?>>Sim, Atendo em Domicilio</option>
                                </select>
                            </div>

                            <div class="content-input">
                                <label for="cep">CEP</label>
                                <input type="text" id="cep" value='<?php echo $linha["CEP"]; ?>' placeholder="CEP" name="txtcep" minlength="9" maxlength="9" placeholder="CEP" onblur="pesquisacep(this.value);" />
                            </div>

                            <div class="content-input">
                                <label for="rua">Rua</label>
                                <input type="text" id="rua" value='<?php echo $linha["rua"]; ?>' placeholder="Rua" name="txtendereco" placeholder="Endereço" />
                            </div>

                            <div class="content-input">
                                <label for="numero">Número</label>
                                <input type="text" id="numero" value='<?php echo $linha["numero"]; ?>' placeholder="Numero" name="txtnumeroendereco" placeholder="Número" />
                            </div>

                            <div class="content-input">
                                <label for="complemento">Complemento</label>
                                <input type="text" id="rua" placeholder="Complemento" value='<?php echo $linha["complemento"]; ?>' name="txtcomplemento" placeholder="Endereço" />
                            </div>

                            <div class="content-input">
                                <label for="bairro">Bairro/Distrito</label>
                                <input type="text" id="bairro" value='<?php echo $linha["bairro"]; ?>' name="txtbairro" placeholder="Bairro" />
                            </div>

                            <div class="item">
                                <!-- necessário os inputs abaixo para a busca do cep funcionar, porém não é cadastrado no banco -->
                                <input type="text" id="ibge" name="txtbairro" hidden />
                                <input type="text" id="uf" name="txtbairro" hidden disabled />
                                <input type="text" id="cidade" name="txtbairro" hidden disabled />
                                <!-- fim -->
                            </div>


                            <div class="content-input">
                                <p>Descrição breve da sua empresa ou estabelecimento:</p>
                                <textarea id="descricao" placeholder="uma descrição breve sobre o seu estabelecimento." name="txtdescricao" rows="5" cols="89" class="form-textarea" maxlength="200"><?php echo $linha["descricao_negocio"]; ?></textarea>
                            </div>
                            <!-- Funcionamento -->
                            <?php
                            $sql = "SELECT * FROM funcionamento WHERE comercio_idcomercio = $idcomercio ORDER BY dia_semana";

                            $resultado = $conexao->query($sql);
                            $linha2 = $resultado->fetch_array();
                            ?>
                            <div class="form-group row">

                                <div class="col-3 col-sm-4 col-md-8">

                                    <!-- Tabela -->
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Dia</th>
                                                <th>Abertura</th>
                                                <th>Fechamento</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Domingo -->
                                            <?php if (@$linha2["dia_semana"] == 0) { ?>
                                                <tr>
                                                    <td class="text-left"><input class="form-check-input" type="checkbox" id="domingo" value="0" name="txtDomingo" checked="true"><label class="form-check-label" for="domingo">Domingo</label></td>
                                                    <td><input type="time" name="txtInicioDom" class="campo form-control" value="<?php echo $linha2["abertura"] ?>" /></td>
                                                    <td><input type="time" name="txtFimDom" class="campo form-control" value="<?php echo $linha2["fechamento"] ?>" /></td>
                                                </tr>
                                            <?php
                                                $linha2 = $resultado->fetch_array();
                                            } else {
                                            ?>
                                                <tr>
                                                    <td class="text-left"><input class="form-check-input" type="checkbox" id="domingo" value="0" name="txtDomingo"><label class="form-check-label" for="domingo">Domingo</label></td>
                                                    <td><input type="time" name="txtInicioDom" class="campo form-control" value="<?php echo $linha2["abertura"] ?>" /></td>
                                                    <td><input type="time" name="txtFimDom" class="campo form-control" value="<?php echo $linha2["fechamento"] ?>" /></td>
                                                    <?php echo $linha2["fechamento"] ?>
                                                </tr>
                                            <?php } ?>
                                            <!-- ./Domingo -->
                                            <!-- Segunda -->
                                            <?php if (@$linha2["dia_semana"] == 1) {  ?>
                                                <tr>
                                                    <td class="text-left"><input class="form-check-input" type="checkbox" id="segunda" value="1" name="txtSegunda" checked="true"><label class="form-check-label" for="segunda">Segunda-Feira</label></td>
                                                    <td><input type="time" name="txtInicioSeg" class="campo form-control" value="<?php echo $linha2["abertura"] ?>" /></td>
                                                    <td><input type="time" name="txtFimSeg" class="campo form-control" value="<?php echo $linha2["fechamento"] ?>" /></td>
                                                </tr>
                                            <?php
                                                $linha2 = $resultado->fetch_array();
                                            } else {
                                            ?>
                                                <tr>
                                                    <td class="text-left"><input class="form-check-input" type="checkbox" id="segunda" value="1" name="txtSegunda"><label class="form-check-label" for="segunda">Segunda-Feira</label></td>
                                                    <td><input type="time" name="txtInicioSeg" class="campo form-control" /></td>
                                                    <td><input type="time" name="txtFimSeg" class="campo form-control" /></td>
                                                </tr>
                                            <?php } ?>
                                            <!-- ./Segunda -->
                                            <!-- Terça -->
                                            <?php if (@$linha2["dia_semana"] == 2) { ?>
                                                <tr>
                                                    <td class="text-left"><input class="form-check-input" type="checkbox" id="terca" value="2" name="txtTerca" checked="true"><label class="form-check-label" for="terca">Terça-Feira</label></td>
                                                    <td><input type="time" name="txtInicioTer" class="campo form-control" value="<?php echo $linha2["abertura"] ?>" /></td>
                                                    <td><input type="time" name="txtFimTer" class="campo form-control" value="<?php echo $linha2["fechamento"] ?>" /></td>
                                                </tr>
                                            <?php
                                                $linha2 = $resultado->fetch_array();
                                            } else {
                                            ?>
                                                <tr>
                                                    <td class="text-left"><input class="form-check-input" type="checkbox" id="terca" value="2" name="txtTerca"><label class="form-check-label" for="terca">Terça-Feira</label></td>
                                                    <td><input type="time" name="txtInicioTer" class="campo form-control" /></td>
                                                    <td><input type="time" name="txtFimTer" class="campo form-control" /></td>
                                                </tr>
                                            <?php } ?>
                                            <!-- ./Terça -->
                                            <!-- Quarta -->
                                            <?php if (@$linha2["dia_semana"] == 3) { ?>
                                                <tr>
                                                    <td class="text-left"><input class="form-check-input" type="checkbox" id="quarta" value="3" name="txtQuarta" checked="true"><label class="form-check-label" for="quarta">Quarta-Feira</label></td>
                                                    <td><input type="time" name="txtInicioQua" class="campo form-control" value="<?php echo $linha2["abertura"] ?>" /></td>
                                                    <td><input type="time" name="txtFimQua" class="campo form-control" value="<?php echo $linha2["fechamento"] ?>" /></td>
                                                </tr>
                                            <?php
                                                $linha2 = $resultado->fetch_array();
                                            } else {
                                            ?>
                                                <tr>
                                                    <td class="text-left"><input class="form-check-input" type="checkbox" id="quarta" value="3" name="txtQuarta"><label class="form-check-label" for="quarta">Quarta-Feira</label></td>
                                                    <td><input type="time" name="txtInicioQua" class="campo form-control" /></td>
                                                    <td><input type="time" name="txtFimQua" class="campo form-control" /></td>
                                                </tr>
                                            <?php } ?>
                                            <!-- ./Quarta -->
                                            <!-- Quinta -->
                                            <?php if (@$linha2["dia_semana"] == 4) { ?>
                                                <tr>
                                                    <td class="text-left"><input class="form-check-input" type="checkbox" id="quinta" value="4" name="txtQuinta" checked="true"><label class="form-check-label" for="quinta">Quinta-Feira</label></td>
                                                    <td><input type="time" name="txtInicioQui" class="campo form-control" value="<?php echo $linha2["abertura"] ?>" /></td>
                                                    <td><input type="time" name="txtFimQui" class="campo form-control" value="<?php echo $linha2["fechamento"] ?>" /></td>
                                                </tr>
                                            <?php
                                                $linha2 = $resultado->fetch_array();
                                            } else {
                                            ?>
                                                <tr>
                                                    <td class="text-left"><input class="form-check-input" type="checkbox" id="quinta" value="4" name="txtQuinta"><label class="form-check-label" for="quinta">Quinta-Feira</label></td>
                                                    <td><input type="time" name="txtInicioQui" class="campo form-control" /></td>
                                                    <td><input type="time" name="txtFimQui" class="campo form-control" /></td>
                                                </tr>
                                            <?php } ?>
                                            <!-- ./Quinta -->
                                            <!-- Sexta -->
                                            <?php if (@$linha2["dia_semana"] == 5) { ?>
                                                <tr>
                                                    <td class="text-left"><input class="form-check-input" type="checkbox" id="sexta" value="5" name="txtSexta" checked="true"><label class="form-check-label" for="sexta">Sexta-Feira</label></td>
                                                    <td><input type="time" name="txtInicioSex" class="campo form-control" value="<?php echo $linha2["abertura"] ?>" /></td>
                                                    <td><input type="time" name="txtFimSex" class="campo form-control" value="<?php echo $linha2["fechamento"] ?>" /></td>
                                                </tr>
                                            <?php
                                                $linha2 = $resultado->fetch_array();
                                            } else {
                                            ?>
                                                <tr>
                                                    <td class="text-left"><input class="form-check-input" type="checkbox" id="sexta" value="5" name="txtSexta"><label class="form-check-label" for="sexta">Sexta-Feira</label></td>
                                                    <td><input type="time" name="txtInicioSex" class="campo form-control" /></td>
                                                    <td><input type="time" name="txtFimSex" class="campo form-control" /></td>
                                                </tr>
                                            <?php } ?>
                                            <!-- ./Sexta -->
                                            <!-- Sábado -->
                                            <?php if (@$linha2["dia_semana"] == 6) { ?>
                                                <tr>
                                                    <td class="text-left"><input class="form-check-input" type="checkbox" id="sabado" value="6" name="txtSabado" checked="true"><label class="form-check-label" for="sabado">Sábado</label></td>
                                                    <td><input type="time" name="txtInicioSab" class="campo form-control" value="<?php echo $linha2["abertura"] ?>" /></td>
                                                    <td><input type="time" name="txtFimSab" class="campo form-control" value="<?php echo $linha2["fechamento"] ?>" /></td>
                                                </tr>
                                            <?php
                                                $linha2 = $resultado->fetch_array();
                                            } else {
                                            ?>
                                                <tr>
                                                    <td class="text-left"><input class="form-check-input" type="checkbox" id="sabado" value="6" name="txtSabado"><label class="form-check-label" for="sabado">Sábado</label></td>
                                                    <td><input type="time" name="txtInicioSab" class="campo form-control" /></td>
                                                    <td><input type="time" name="txtFimSab" class="campo form-control" /></td>
                                                </tr>
                                            <?php } ?>
                                            <!-- ./Sábado -->
                                        </tbody>
                                    </table>
                                    <!-- ./Tabela -->
                                </div>
                            </div>

                            <div class="content-input">
                                <div class="button">
                                    <button type="submit" name="btCadastrar" class="btcad">Atualizar</button>
                                </div>
                                <div>
                                    <center style="margin-top: 15px;"><a href="index.php" class="btcad"> Voltar</a></center>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>
</body>

</html>