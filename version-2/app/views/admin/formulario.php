<?php
//Inicia sessão
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

//Caso não esteja logado será redirecionado
if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('location:index.php');
}

// Banco de dados
include "../include/conexao.php";

//Pega o id do usuario
$id = $_SESSION['id'];

$pegavalores = "SELECT * FROM segmento order by nome";
$result = $conexao->query($pegavalores);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Catálogo empresarial da cidade de Cataguases - MG. O site funciona como uma grande vitrine digital que aproxima potenciais consumidores dos comerciantes e prestadores de serviços.">
    <meta name="keywords" content="Comércio local, Cataguases,Catálogo, Vitrine, Marketing Digital, Empresas, Comércio, Prestadores de serviço, <?php echo $NomeTitulo ?>">
    <meta name="author" content="Prefeitura de Cataguases">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VitrineKta | Cadastro Empresa</title>
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="../../../public/css/index.css" rel="stylesheet">

</head>

<body>
    <?php include "./include/navbar.php"; ?>
    <main>
        <div class="head">
            <h2 class="title-head">Cadastre seu Comércio</h2>
            <tr></tr>
        </div>
        <div class="container bloco">
            <div class="conteudo">
                <form method='POST' enctype="multipart/form-data">
                    <div class="item">
                        <div class="content-input">
                            <label for="cnpj">CNPJ:<span class="required">*</span></label>
                            <input type="text" name="txtcnpj" id="cnpj" minlength="18" maxlength="18" placeholder="Informe o CNPJ" onblur="checkCnpj(this.value)" class="form-control" data-mask="00.000.000/0000-00" required>
                        </div>
                        <!-- Input não visivel da razaõ social do comercio -->
                        <input type="text" name="txtrazaoSocial" id="razaoSocial" class="form-control" hidden>

                        <div class="content-input">
                            <label for="fantasia">Nome Fantasia <span class="required">*</span></label>
                            <input type="text" name="txtnomeComercio" placeholder="Nome Fantasia da sua empresa" id="fantasia" class="form-control" maxlength="33" required>
                        </div>

                        <div class="content-input">
                            <label class="form-label" for="categoria">Categoria do Estabelecimento:<span class="required">*</span></label>
                            <select name="categoria" id="categoria" class="form-select" required>
                                <option selected>Escolha a sua categoria</option>
                                <?php
                                while ($row_linha = mysqli_fetch_assoc($result)) {
                                ?>
                                    <option value='<?php echo $row_linha["idsegmento"]; ?>'><?php echo $row_linha['nome']; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="content-input">
                            <label class="form-label" for="customFile">Sua Logomarca: (.jpg OU .png)<span class="required">*</span></label>
                            <input type="file" name="txtimagem" class="form-control" id="customFile" accept=".png,.jpg" required />
                        </div>

                        <div class="content-input">
                            <label for="telefone" class="control-label">Telefone <span class="required">*</span></label>
                            <input type="text" id="txttelefone" class="form-control" placeholder="Telefone para contato" name="txttelefone" id="txttelefone" minlength="8" maxlength="15">
                        </div>

                        <div class="content-input">
                            <label for="whatsapp">Whatsapp </label>
                            <input type="text" class="form-control" placeholder="Whatsapp para contato" name="txtwppLink" id="txtwppLink" minlength="8" maxlength="15" />
                        </div>

                        <!--Formatos aceitos para png e jpg -->

                        <div class="content-input">
                            <label for="cep">CEP</label>
                            <input type="text" name="txtcep" placeholder="CEP do estabelecimento" id="cep" minlenght="8" maxlength="11" class="form-control" onblur="pesquisacep(this.value);" required>
                        </div>

                        <div class="content-input">
                            <label for="rua">Rua</label>
                            <input type="text" id="rua" placeholder="Rua" name="txtendereco" class="form-control">
                        </div>

                        <div class="content-input">
                            <label for="numero">Número</label>
                            <input type="text" id="numero" placeholder="Número" name="txtnumeroendereco" class="form-control">
                        </div>

                        <div class="content-input">
                            <label for="bairro">Bairro/Distrito</label>
                            <input type="text" name="txtbairro" placeholder="Bairro" id="bairro" class="form-control">
                        </div>

                        <!-- necessário os inputs abaixo para preenchimento automatico do ceps -->
                        <input type="text" id="ibge" name="txtbairro" placeholder="Bairro" hidden />
                        <input type="text" id="uf" name="txtbairro" placeholder="Bairro" hidden disabled />
                        <input type="text" id="cidade" name="txtbairro" placeholder="Bairro" hidden disabled />
                        <!-- fim -->

                        <div class="content-input">
                            <label for="complemento">Complemento</label>
                            <input type="text" id="complemento" placeholder="Complemento do local" name="txtcomplemento" class="form-control">
                        </div>

                        <div class="content-input">
                            <label class="form-label" for="delivery">Faz Delivery ou atende em Domicílio?</label>
                            <select name="delivery" id="delivery" class="form-select" required>
                                <option value="0" selected>Não</option>
                                <option value="1">Sim, Faço Delivery</option>
                                <option value="2">Sim, Atendo em Domicilio</option>
                            </select>
                        </div>

                        <div class="content-input">
                            <label for="link">Site ou Aplicativo</label>
                            <input type="url" id="link" class="form-control" name="txtsite" placeholder="Link do seu site, catálogo ou outros. ex: https://exemplo.com.br" pattern="https://.*" minlength="5">
                        </div>

                        <div class="content-input">
                            <label for="instagram">Instagram</label>
                            <input type="url" id="instagram" name="txtinstagram" class="form-control" placeholder="Link do Instagram. ex: https://www.instagram.com/" value="https://www.instagram.com/" maxlength="50" minlength="5" pattern="https://.*">
                        </div>

                        <div class="content-input">
                            <label for="facebook">Facebook</label>
                            <input type="url" id="facebook" placeholder="Link do Facebook. ex: https://exemplo.com.br" value="https://www.facebook.com/" class="form-control" name="txtfacebook" maxlength="50" minlength="5" pattern="https://.*">
                        </div>

                        <div class="content-input">
                            <div class="col-md-8">
                                <label for="exampleFormControlTextarea1" for="descricao">Descrição breve do comercio</label>
                                <textarea class="form-control" name="txtdescricao" id="descricao" rows="5" cols="30" maxlength="200" placeholder="Descrição do seu comércio de até 200 caracteres"></textarea>
                            </div>
                        </div>


                        <!-- Funcionamento -->

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
                                    <tr>
                                        <td class="text-left">
                                            <label class="form-check-label" for="segunda">Segunda-Feira</label>
                                        </td>
                                        <td><input type="time" name="txtInicioSeg" class="campo form-control" /></td>
                                        <td><input type="time" name="txtFimSeg" class="campo form-control" /></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">
                                            <label class="form-check-label" for="terca">Terça-Feira</label>
                                        </td>
                                        <td><input type="time" name="txtInicioTer" class="campo form-control" /></td>
                                        <td><input type="time" name="txtFimTer" class="campo form-control" /></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">
                                            <label class="form-check-label" for="quarta">Quarta-Feira</label>
                                        </td>
                                        <td><input type="time" name="txtInicioQua" class="campo form-control" /></td>
                                        <td><input type="time" name="txtFimQua" class="campo form-control" /></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">
                                            <label class="form-check-label" for="quinta">Quinta-Feira</label>
                                        </td>
                                        <td><input type="time" name="txtInicioQui" class="campo form-control" /></td>
                                        <td><input type="time" name="txtFimQui" class="campo form-control" /></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">                                      
                                            <label class="form-check-label" for="sexta">Sexta-Feira</label>
                                        </td>
                                        <td><input type="time" name="txtInicioSex" class="campo form-control" /></td>
                                        <td><input type="time" name="txtFimSex" class="campo form-control" /></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">
                                            <label class="form-check-label" for="sabado">Sábado</label>
                                        </td>
                                        <td><input type="time" name="txtInicioSab" class="campo form-control" /></td>
                                        <td><input type="time" name="txtFimSab" class="campo form-control" /></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">
                                            <label class="form-check-label" for="domingo">Domingo</label>
                                        </td>
                                        <td><input type="time" name="txtInicioDom" class="campo form-control" /></td>
                                        <td><input type="time" name="txtFimDom" class="campo form-control" /></td>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- ./Tabela -->
                        </div>

                        <div class="content-input">
                            <label for="checkbox">Política de privacidade<span class="required">*</span></label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="checkbox" value="none" name="check" required />
                                <label class="form-check-label" for="checkbox">Eu aceito os <a href="termos de uso.php">termos da política e privacidade.</a></label>
                            </div>
                            <div class="button">
                                <button type="submit" name="btCadastrar" class="btcad">Cadastrar</button>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </main>
    <?php
    if (isset($_POST["btCadastrar"])) {
        //Pega todos os dados atraves do metodo POST
        $nomeComercio = $_POST["txtnomeComercio"];
        $razaoSocial = $_POST["txtrazaoSocial"];
        $cnpj = $_POST["txtcnpj"];
        $telefone = $_POST["txttelefone"];
        $site = $_POST["txtsite"];
        $facebook = $_POST["txtfacebook"];
        $instagram = $_POST["txtinstagram"];
        $wpp = $_POST["txtwppLink"];
        $endereco = $_POST["txtendereco"];
        $numero = $_POST["txtnumeroendereco"];
        $complemento = $_POST["txtcomplemento"];
        $bairro = $_POST["txtbairro"];
        $cep = $_POST["txtcep"];
        $descricao = $_POST["txtdescricao"];
        $cnpj = $_POST["txtcnpj"];
        $delivery = $_POST["delivery"];
        $status = 0;
        $CDL = 0;
        $categoria = $_POST['categoria'];
        if ($conexao->errno == 0) {
            //ARQUIVOS de imagem
            $imagemTmp = $_FILES["txtimagem"]["tmp_name"];
            $imagem = date("dmyHis") . $_FILES["txtimagem"]["name"];

            //enviar a imagem
            if ($_FILES["txtimagem"]["error"] != 0) {
                $imagem = "SemLogo.png";
            } else {
                move_uploaded_file($imagemTmp, "../../../public/assets/" . $imagem);
            }

            //verifica se o cnpj é unico 
            $testecnpj = $conexao->query("SELECT cnpj FROM comercio WHERE cnpj='$cnpj' ");
            if (mysqli_num_rows($testecnpj) > 0) {
                //alerta o usuario caso já existe e não o cadastra
                echo "<script>alert('Este cnpj já existe!');</script>";
            } else {
                //Insere no banco de dados os valores 
                $sql = "INSERT INTO `comercio` (`nome_fantasia`, `razao_social`,`telefone`,`instagram`,`facebook`,`rua`,`numero`,
                `complemento`,`link`,`bairro`,`descricao_negocio`,`Whatsapp`,`CEP`,`status`,`imagem`,`cnpj`,
                `segmento_idsegmento`,`CDL`,`usuario_idusuario`,`delivery`) VALUES ('$nomeComercio','$razaoSocial','$telefone', '$instagram',
                '$facebook','$endereco','$numero','$complemento','$site','$bairro','$descricao', '$wpp', '$cep','$status',
                '$imagem','$cnpj','$categoria','$CDL','$id','$delivery') ";

                //executa a query
                $conexao->query($sql);

                if ($conexao->errno == 0) {
                    $idcomercio = $conexao->insert_id;

                    //Capturando os dias da semana e os horários
                    //Segunda
                    $inicio = $_POST["txtInicioSeg"];
                    $fim = $_POST["txtFimSeg"];

                    $sql = "INSERT INTO `funcionamento` ( `comercio_idcomercio`, `dia_semana`, `abertura`, `fechamento`) 
                        VALUES ( '$idcomercio', 1, '$inicio', '$fim') ";

                    $conexao->query($sql);

                    //Terça

                    $inicio = $_POST["txtInicioTer"];
                    $fim = $_POST["txtFimTer"];

                    $sql = "INSERT INTO `funcionamento` ( `comercio_idcomercio`, `dia_semana`, `abertura`, `fechamento`) 
                        VALUES ( '$idcomercio', 2, '$inicio', '$fim') ";

                    $conexao->query($sql);


                    //Quarta

                    $inicio = $_POST["txtInicioQua"];
                    $fim = $_POST["txtFimQua"];

                    $sql = "INSERT INTO `funcionamento` ( `comercio_idcomercio`, `dia_semana`, `abertura`, `fechamento`) 
                        VALUES ( '$idcomercio', 3, '$inicio', '$fim') ";

                    $conexao->query($sql);


                    //Quinta

                    $inicio = $_POST["txtInicioQui"];
                    $fim = $_POST["txtFimQui"];

                    $sql = "INSERT INTO `funcionamento` ( `comercio_idcomercio`, `dia_semana`, `abertura`, `fechamento`) 
                        VALUES ( '$idcomercio', 4, '$inicio', '$fim') ";

                    $conexao->query($sql);


                    //Sexta

                    $inicio = $_POST["txtInicioSex"];
                    $fim = $_POST["txtFimSex"];

                    $sql = "INSERT INTO `funcionamento` ( `comercio_idcomercio`, `dia_semana`, `abertura`, `fechamento`) 
                        VALUES ( '$idcomercio', 5, '$inicio', '$fim') ";

                    $conexao->query($sql);


                    //Sábado

                    $inicio = $_POST["txtInicioSab"];
                    $fim = $_POST["txtFimSab"];

                    $sql = "INSERT INTO `funcionamento` ( `comercio_idcomercio`, `dia_semana`, `abertura`, `fechamento`) 
                        VALUES ( '$idcomercio', 6, '$inicio', '$fim') ";

                    $conexao->query($sql);


                    //Domingo

                    $inicio = $_POST["txtInicioDom"];
                    $fim = $_POST["txtFimDom"];

                    $sql = "INSERT INTO `funcionamento` ( `comercio_idcomercio`, `dia_semana`, `abertura`, `fechamento`) 
                        VALUES ( '$idcomercio', 0, '$inicio', '$fim') ";

                    $conexao->query($sql);
                }

                echo "<script>alert('Registro cadastrado com sucesso, aguarde autorização dos responsáveis!');</script>";

                //redireciona para outra página
                $ultimoId = "SELECT idcomercio FROM comercio ORDER BY idcomercio DESC LIMIT 1";

                $resultado = $conexao->query($ultimoId);

                $linha = $resultado->fetch_array();

                $idComercio = $linha["idcomercio"];
                echo "<script>document.location='./AdmEditar.php?idcomercio=$idComercio'</script>";
            }
        } else {
            echo "<script>alert('Erro ao cadastrar o registro, verifique os campos.');</script>";
        }
    }
    ?>



    <!-- JS -->
    <script type="text/javascript" src="./assets/js/cep.js"></script>
    <!-- Formulario mascara -->
    <script type="text/javascript" src="../../../public/js/menu.js"></script>
    <script type="text/javascript" src="./assets/js/mascaraTel.js"></script>
    <script type="text/javascript" src="./assets/js/cnpj.js"></script>
    <!-- Bibliotecas cnpj -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
</body>

</html>