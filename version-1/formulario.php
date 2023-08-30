<?php
include "include/tstconexao.php";
session_start();
// Pega o id do usuario
$id = $_SESSION['id'];
//Caso não esteja logado será redirecionado
if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('location:index.php');
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="style/style.css" rel="stylesheet">
    <link rel="icon" type="imagem/png" href="../../public/img/32x32.png" />
    <script type="text/javascript" src="js/cep.js"></script>
    <title>VitrineKta | Cadastro Empresa</title>
    <!-- Style -->
    <link href="../../public/css/style.css" rel="stylesheet">
    
</head>

<body>
    <!--Navigation Bar (CABEÇALHO)-->
    <?php include "./include/cabecalhoInicial.php"; ?>
    </div>
    <!--formulario-->
    <div class="caixaformulario">
        <div class="testbox">
            <div class="titulologocad">
                <img class="logoform" src="img/cadastroentrar.png" alt="Logo do site">
                <h2 class="titulocad">Cadastre aqui sua Empresa</h2>
            </div>
            <form method='POST' enctype="multipart/form-data">
                <div class="item">
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label>CNPJ:<span class="required">*</span></label>
                            <input type="text" name="txtcnpj" minlength="18" maxlength="18" placeholder="Informe o CNPJ" onblur="checkCnpj(this.value)" class="form-control" data-mask="00.000.000/0000-00">
                        </div>
                        <!-- Input não visivel da razaõ social do comercio -->
                        <input type="text" name="txtrazaoSocial" id="razaoSocial" class="form-control" hidden>
                    </div>
                    <div class="form-grou row">
                        <div class="col-md-6">
                            <label>Nome Fantasia <span class="required">*</span></label>
                            <input type="text" name="txtnomeComercio" placeholder="Nome Fantasia da sua empresa" id="fantasia" class="form-control" required>
                        </div>

                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label>CEP</label>
                            <input type="text" name="txtcep" placeholder="CEP do estabelecimento" id="cep" minlenght="8" maxlength="11" class="form-control" onblur="pesquisacep(this.value);" required>
                        </div>
                    </div>
                    <div class="form-group row">

                        <div class="col-md-3">
                            <label>Rua</label>
                            <input type="text" id="rua" placeholder="Rua" name="txtendereco" class="form-control">
                        </div>
                        <div class="col-md-1">
                            <label>Número</label>
                            <input type="text" id="numero" placeholder="Número" name="txtnumeroendereco" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label>Bairro/Distrito</label>
                            <input type="text" name="txtbairro" placeholder="Bairro" id="bairro" class="form-control">
                        </div>
                        <!-- necessário os inputs abaixo para preenchimento automatico do ceps -->
                        <input type="text" id="ibge" name="txtbairro" placeholder="Bairro" hidden />
                        <input type="text" id="uf" name="txtbairro" placeholder="Bairro" hidden disabled />
                        <input type="text" id="cidade" name="txtbairro" placeholder="Bairro" hidden disabled />
                        <!-- fim -->
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label>Complemento</label>
                            <input type="text" placeholder="Complemento do local" name="txtcomplemento" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="form-label">Categoria do Estabelecimento:<span class="required">*</span></label>
                            <select name="categoria" id="categoria" class="form-select" required>
                                <option selected>Escolha a sua categoria</option>
                                <?php
                                $pegavalores = "SELECT * FROM segmento order by nome";
                                $result = $conexao->query($pegavalores);

                                while ($row_linha = mysqli_fetch_assoc($result)) {
                                ?>
                                    <option value='<?php echo $row_linha["idsegmento"]; ?>'> <?php echo $row_linha['nome']; ?></option>
                                <?php }  ?>
                            </select>
                        </div>

                        <div class="col-md-6">

                            <label class="form-label" for="customFile">Sua Logomarca: (.jpg OU .png)<span class="required">*</span></label>
                            <input type="file" name="txtimagem" class="form-control" id="customFile" accept=".png,.jpg" />

                            <!--Formatos aceitos para png e jpg -->
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="control-label">Telefone <span class="required">*</span></label>
                            <input type="text" class="form-control" placeholder="Telefone para contato" name="txttelefone" id="txttelefone" minlength="8" maxlength="15">
                        </div>
                        <div class="col-md-6">
                            <label>Whatsapp </label>
                            <input type="text" class="form-control" placeholder="Whatsapp para contato" name="txtwppLink" id="txtwppLink" minlength="8" maxlength="15" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label>Site ou Aplicativo</label>
                            <input type="url" class="form-control" name="txtsite" placeholder="Link do seu site, catálogo ou outros. ex: https://exemplo.com.br" pattern="https://.*" minlength="5">
                        </div>
                        <div class="col-md-6">
                            <label>Instagram</label>
                            <input type="url" name="txtinstagram" class="form-control" placeholder="Link do Instagram" maxlength="50" minlength="5" pattern="https://.*">
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label>Facebook</label>
                            <input type="url" placeholder="Link do Facebook" class="form-control" name="txtfacebook" maxlength="50" minlength="5" pattern="https://.*">
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
                                    <td class="text-left"><input class="form-check-input" type="checkbox" id="segunda" value="1" name="txtSegunda">
                                        <label class="form-check-label" for="segunda">Segunda-Feira

                                        </label>
                                    </td>
                                    <td><input type="time" name="txtInicioSeg" class="campo form-control" /></td>
                                    <td><input type="time" name="txtFimSeg" class="campo form-control" /></td>
                                </tr>
                                <tr>
                                    <td class="text-left"><input class="form-check-input" type="checkbox" id="terca" value="2" name="txtTerca">
                                        <label class="form-check-label" for="terca">Terça-Feira</label>
                                    </td>
                                    <td><input type="time" name="txtInicioTer" class="campo form-control" /></td>
                                    <td><input type="time" name="txtFimTer" class="campo form-control" /></td>
                                </tr>
                                <tr>
                                    <td class="text-left"><input class="form-check-input" type="checkbox" id="quarta" value="3" name="txtQuarta"><label class="form-check-label" for="quarta">Quarta-Feira</label></td>
                                    <td><input type="time" name="txtInicioQua" class="campo form-control" /></td>
                                    <td><input type="time" name="txtFimQua" class="campo form-control" /></td>
                                </tr>
                                <tr>
                                    <td class="text-left"><input class="form-check-input" type="checkbox" id="quinta" value="4" name="txtQuinta"><label class="form-check-label" for="quinta">Quinta-Feira</label></td>
                                    <td><input type="time" name="txtInicioQui" class="campo form-control" /></td>
                                    <td><input type="time" name="txtFimQui" class="campo form-control" /></td>
                                </tr>
                                <tr>
                                    <td class="text-left"><input class="form-check-input" type="checkbox" id="sexta" value="5" name="txtSexta"><label class="form-check-label" for="sexta">Sexta-Feira</label></td>
                                    <td><input type="time" name="txtInicioSex" class="campo form-control" /></td>
                                    <td><input type="time" name="txtFimSex" class="campo form-control" /></td>
                                </tr>
                                <tr>
                                    <td class="text-left"><input class="form-check-input" type="checkbox" id="sabado" value="6" name="txtSabado"><label class="form-check-label" for="sabado">Sábado</label></td>
                                    <td><input type="time" name="txtInicioSab" class="campo form-control" /></td>
                                    <td><input type="time" name="txtFimSab" class="campo form-control" /></td>
                                </tr>
                                <tr>
                                    <td class="text-left"><input class="form-check-input" type="checkbox" id="domingo" value="0" name="txtDomingo"><label class="form-check-label" for="domingo">Domingo</label></td>
                                    <td><input type="time" name="txtInicioDom" class="campo form-control" /></td>
                                    <td><input type="time" name="txtFimDom" class="campo form-control" /></td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- ./Tabela -->
                    </div>

                    <div class="form-group">
                        <div class="col-md-8">
                            <label for="exampleFormControlTextarea1">Descrição breve da sua empresa ou estabelecimento</label>
                            <textarea class="form-control" name="txtdescricao" id="descricao" rows="5" cols="30" maxlength="200"></textarea>
                        </div>
                    </div>

                    <div class="question">
                        <label>Política de privacidade<span class="required">*</span></label>
                        <div class="form-check ">
                            <input class="form-check-input" type="checkbox" value="none" id="check_1" name="check" required />
                            <label class="form-check-label"><span>Eu aceito os <a href="termos de uso.php">termos da política e privacidade.</a></span></label>
                        </div>

                        <div class="btn-block">
                            <button type="submit" name="btCadastrar" class="btcad">Cadastrar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>

    <!--formulario-->
    <!--Cadastro back-end-->
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
                move_uploaded_file($imagemTmp, "../../public/uploads/" . $imagem);
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
                `segmento_idsegmento`,`CDL`,`usuario_idusuario`) VALUES ('$nomeComercio','$razaoSocial','$telefone', '$instagram',
                '$facebook','$endereco','$numero','$complemento','$site','$bairro','$descricao', '$wpp', '$cep','$status',
                '$imagem','$cnpj','$categoria','$CDL','$id') ";

                $conexao->query($sql);

                if ($conexao->errno == 0) {
                    $idcomercio = $conexao->insert_id;

                    //Capturando os dias da semana e os horários
                    //Segunda
                    if (isset($_POST["txtSegunda"])) {
                        $inicio = $_POST["txtInicioSeg"];
                        $fim = $_POST["txtFimSeg"];

                        $sql = "INSERT INTO `funcionamento` ( `comercio_idcomercio`, `dia_semana`, `abertura`, `fechamento`) 
                        VALUES ( '$idcomercio', 1, '$inicio', '$fim') ";

                        $conexao->query($sql);
                    }
                    //Terça
                    if (isset($_POST["txtTerca"])) {
                        $inicio = $_POST["txtInicioTer"];
                        $fim = $_POST["txtFimTer"];

                        $sql = "INSERT INTO `funcionamento` ( `comercio_idcomercio`, `dia_semana`, `abertura`, `fechamento`) 
                        VALUES ( '$idcomercio', 2, '$inicio', '$fim') ";

                        $conexao->query($sql);
                    }

                    //Quarta
                    if (isset($_POST["txtQuarta"])) {
                        $inicio = $_POST["txtInicioQua"];
                        $fim = $_POST["txtFimQua"];

                        $sql = "INSERT INTO `funcionamento` ( `comercio_idcomercio`, `dia_semana`, `abertura`, `fechamento`) 
                        VALUES ( '$idcomercio', 3, '$inicio', '$fim') ";

                        $conexao->query($sql);
                    }

                    //Quinta
                    if (isset($_POST["txtQuinta"])) {
                        $inicio = $_POST["txtInicioQui"];
                        $fim = $_POST["txtFimQui"];

                        $sql = "INSERT INTO `funcionamento` ( `comercio_idcomercio`, `dia_semana`, `abertura`, `fechamento`) 
                        VALUES ( '$idcomercio', 4, '$inicio', '$fim') ";

                        $conexao->query($sql);
                    }

                    //Sexta
                    if (isset($_POST["txtSexta"])) {
                        $inicio = $_POST["txtInicioSex"];
                        $fim = $_POST["txtFimSex"];

                        $sql = "INSERT INTO `funcionamento` ( `comercio_idcomercio`, `dia_semana`, `abertura`, `fechamento`) 
                        VALUES ( '$idcomercio', 5, '$inicio', '$fim') ";

                        $conexao->query($sql);
                    }

                    //Sábado
                    if (isset($_POST["txtSabado"])) {
                        $inicio = $_POST["txtInicioSab"];
                        $fim = $_POST["txtFimSab"];

                        $sql = "INSERT INTO `funcionamento` ( `comercio_idcomercio`, `dia_semana`, `abertura`, `fechamento`) 
                        VALUES ( '$idcomercio', 6, '$inicio', '$fim') ";

                        $conexao->query($sql);
                    }

                    //Domingo
                    if (isset($_POST["txtDomingo"])) {
                        $inicio = $_POST["txtInicioDom"];
                        $fim = $_POST["txtFimDom"];

                        $sql = "INSERT INTO `funcionamento` ( `comercio_idcomercio`, `dia_semana`, `abertura`, `fechamento`) 
                        VALUES ( '$idcomercio', 0, '$inicio', '$fim') ";

                        $conexao->query($sql);
                    }
                    $id = $conexao->insert_id;
                    echo "<script>alert('Registro cadastrado com sucesso, aguarde autorização dos responsáveis!');</script>";
                    echo "<script>document.location='./AdmUser.php'</script>";
                } else {
                    echo "<script>alert('Erro ao cadastrar o registro, verifique os campos.');</script>";
                }
            }
        }
    }
    ?>
    <!-- Footer -->

    <?php
    include '../site/include/footer.php';
    ?>
    <script type="text/javascript" src="./assets/js/cadastro.js"></script>
    <!-- Formulario mascara -->
    <script type="text/javascript" src="./assets/js/mascaraTel.js"></script>
    <!-- Preenchimento do CNPJ-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
    <script type="text/javascript" src="./assets/js/cnpj.js"></script>
    <!-- Preenchimento do CEP -->
    <script type="text/javascript" src="./assets/js/cep.js"></script>
    <!-- Menu -->
    <script src="../../public/js/main.js"></script>
</body>

</html>