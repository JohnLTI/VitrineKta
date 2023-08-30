<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if ((isset($_SESSION['email']) == true) and (isset($_SESSION['senha']) == true)) {
    header('location:../site/index.php');
}
include "../include/conexao.php";
?>

<html lang="pt-br">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="./assets/css/styleEntrar.css">

    <title>VitrineKta | Entrar</title>
</head>

<body>

    <header>
        <nav>
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

    <div class="card-body">
        <h1>Entrar</h1>
        <form method="POST">
            <label class="LbEntrar" for="email">E-mail</label>
            <input class="form-control mb-3" type="email" name="txtEmail" id="txtEmail" placeholder="Digite seu email" autocomplete="off" required="required">
            <label class="LbSenha" for="password">Senha</label>
            <input class="form-control mb-3" type="password"  name="txtSenha" id="txtSenha" placeholder="Digite a sua senha" required="required">
            <!-- <a href="#" id="forgot-pass">Esqueceu a Senha?</a> -->
            <input type="submit" value="Login" onclick="return envia()" name="btLogar" id="signin" class="form-submit">
        </form>
        <!-- <div id="social-container">
            <p class="tex-Redes">Ou entre pelas suas redes sociais</p>
            <i class="fa fa-facebook-f"></i>
            <i class="fa fa-instagram"></i>
        </div> -->
        <div id="register-container">
            <p>Ainda não tem uma conta ?</p>
            <a href="./register.php">Cadastre-se</a> 
        </div>
    </div>


     <!-- Conexão Entrar -->
    <?php
    if (isset($_POST["btLogar"])) {
        $email = $_POST["txtEmail"];
        $senha = $_POST["txtSenha"];

        if (isset($email) and isset($senha)) {
            $senha = md5($senha);
            $sql = "SELECT * FROM usuario WHERE email='$email' and senha='$senha'";
            $retorno = $conexao->query($sql);
            if ($retorno->num_rows > 0) {
                $line = $retorno->fetch_array();
                $_SESSION['email'] = $email;
                $_SESSION['senha'] = $senha;
                $_SESSION['id'] = $line['idusuario'];
                $_SESSION['servidor'] = $line['servidor'];
                if(isset($_POST['remember'])){
                    self::remember($email);
                }
                if($_SESSION['servidor']==1){
                    echo "<script>document.location='./AdmUser.php'</script>";
                }
               
                else if($_SESSION['servidor']==2){
                    echo "<script>document.location='./adminPrefeitura/index.php'</script>";
                }
            }else if(!$email || !$senha)
            {
                echo "<script>alert('Preencha todos os campos');</script>";
                exit;
            }
             else {
                echo "<script>alert('Usuário ou senha incorreto');</script>";
            }
        }
    }
    ?>


</body>

</html>