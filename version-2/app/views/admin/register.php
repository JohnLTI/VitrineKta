<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if ((isset($_SESSION['email']) == true) and (isset($_SESSION['senha']) == true)) {
    header('location:../site/index.php');
}
include "../include/conexao.php";
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VitrineKta | Cadastre Aqui</title>
    <link rel="stylesheet" href="./assets/css/styleRegister.css">

    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>

<body class="body-register">

    <header class="header-nav">
        <nav class="register-nav">
            <div class="nav-container">
                <a href="../site/index.php">
                    <img id="logo" src="../../../public/img/vitrine.png" alt="LogoVitrine">
                </a>
                <ul>
                    <li><a href="../site/index.php">Voltar para o site</a></li>
                </ul>
            </div>
        </nav>
    </header>


    <div id="main-container">
        <h1>Cadastre-se</h1>
        <form id="register-form" method="POST">
            <div class="full-box">
                <label class="Lbemail" for="email">E-mail</label>         
                <input class="form-control mb-3" type="email" id="email" name="txtEmail"  placeholder="Digite seu e-mail"  required="required"  data-min-length="2" data-email-validate minlength="5" maxlength="150">
            </div>

            <div class="full-box spacing">
                <label class="Lbnome" for="name">Nome do Responsável</label>

                <input class="form-control mb-3" type="nome" id="nome" name="txtNome"  placeholder="Digite seu nome"  data-required data-min-length="3" data-max-length="16" minlength="5" maxlength="150" required="required" >
            </div>

            <div class="half-box spacing">
                <label class="Lbsenha" for="password">Senha</label>
                <input class="form-control mb-3" type="password" id="pass" name="txtSenha"  placeholder="Digite sua senha"  require="required" data-password-validate data-required >


            </div>
            <div class="half-box">
                <label class="LbConfirmacao" for="passwordconfirmation">Confirmação de Senha</label>
                <input class="form-control mb-3" type="password" id="re_pass" name="txtCSenha"  placeholder="Confirme a senha"  require="required" data-equal="password">


            </div>

            <div class="full-box">
                <input type="checkbox" name="agreement" id="agreement" required>
                <label class="Lbtermos" for="agreement" id="agreement-label">Concordo com os <a href="#">Termos e Serviços</a></label>
            </div>

            <div class="full-box">
                <input type="submit" id="btn-submit" name="btGravar" value="Registrar" class="form-submit">

            </div>

        </form>
    </div>

    <!-- Conexão Cadastrar -->

    <?php
    if (isset($_POST["btGravar"])) {

        $nome = $_POST["txtNome"];
        $email = $_POST["txtEmail"];
        $senha = md5($_POST["txtSenha"]);
        $Csenha = md5($_POST["txtCSenha"]);
        $servidor = 1;
        if (isset($senha) and isset($Csenha) and isset($email)) {
            $testeEmail = $conexao->query("SELECT * FROM usuario WHERE email='$email' ");
            if (mysqli_num_rows($testeEmail) > 1) {
                echo "<script>alert('Este email já existe!');</script>";
            } else {
                if ($senha == $Csenha) {
                    $sql = "INSERT INTO `usuario` (`nome_responsavel`,`email`, `senha`,`servidor`) VALUES ('$nome','$email', '$senha','$servidor') ";
                    $conexao->query($sql);
                    if ($conexao->errno > 0) {
                        echo "<script>alert('Erro ao cadastrar o registro, verifique os campos.');</script>";
                    } else {
                        $_SESSION['email'] = $email;
                        $_SESSION['senha'] = $senha;
                        $testeEmail = $conexao->query("SELECT idusuario FROM usuario WHERE email='$email' ");
                        $linha = $testeEmail->fetch_array();
                        $_SESSION['id'] = $linha['idusuario'];
                        echo "<script>alert('Registro cadastrado com sucesso!');</script>";
                        echo "<script>document.location='formulario.php'</script>";
                    }
                } else {
                    echo "<script>alert('Senha não compatível');</script>";
                }
            }
        }
    } ?>

    <!-- <p class="error-validation template"></p>
    <script src="./Sistema/scripts.js"></script>  -->
</body>

</html>