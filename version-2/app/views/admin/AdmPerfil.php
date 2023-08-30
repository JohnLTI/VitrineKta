<?php 
//Inicia sessão
if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}

$id = $_SESSION['id'];

include '../include/conexao.php';

include 'verifica.php';

if (isset($_POST["btCadastrar"])) {
  $nome = $_POST['txtNome'];
  $senha = $_POST["txtSenha"];
  $senhaAtual = md5($_POST['txtSenhaAtual']);
  $testeSenhaAtual = $conexao->query("SELECT senha FROM usuario WHERE senha='$senhaAtual'");
  if (mysqli_num_rows($testeSenhaAtual) > 0) {
      if($senha == ''){
        $sql ="UPDATE `usuario` SET `nome_responsavel` = '$nome' WHERE `usuario`.`idusuario` = $id";
        $conexao->query($sql);
        echo "<script>alert('Usuario alterado com Sucesso!');</script>";
      }
      else{
        $senha = md5($senha);
        $Csenha = md5($_POST["txtCSenha"]);
        if ($senha == $Csenha) {
          $_SESSION['senha'] = $senha;
          $sql ="UPDATE `usuario` SET
          `nome_responsavel` = '$nome',
          `senha` = '$senha'
          WHERE `usuario`.`idusuario` = $id";
          $conexao->query($sql);
          echo "<script>alert('Usuario alterado com sucesso!');</script>";
        }
        else{
          echo "<script>alert('Senhas diferentes, por favor, digite as senha igualmente.');</script>";
        }
      }  
  }else{
    echo "<script>alert('Senha atual incorreta! Escreva a sua senha atual corretamente.');</script>";
  }
  
}
?>
<!doctype html>
<html lang="pt-br" dir="ltr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta http-equiv="Content-Language" content="en" />
  <meta name="msapplication-TileColor" content="#2d89ef">
  <meta name="theme-color" content="#4188c9">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="HandheldFriendly" content="True">
  <meta name="MobileOptimized" content="320">
  <link rel="icon" href="../../public/img/32x32.png" type="image/x-icon" />
  <link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
  <!-- Generated: 2018-04-16 09:29:05 +0200 -->
  <title>Meu Perfil</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
  <script src="./assets/js/require.min.js"></script>
  <script>
    requirejs.config({
      baseUrl: '.'
    });
  </script>
  <!-- CSS e JS para menu do cabeçalho -->
  <link href="./assets/css/dashboard.css" rel="stylesheet" />
  <script src="./assets/js/dashboard.js"></script>
</head>
<?php include "./include/cabecalho.php";?>

<body class="">
  <div class="page">
    <div class="page-main">
      <div class="my-3 my-md-5">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Meu Perfil</h3>
                </div>
                <div class="card-body">
                  <form method="POST">
                    <div class="row">
                      <div class="col">
                        <div class="form-group">
                          <label class="form-label">Email</label>
                          <input class="form-control" value="<?php echo $linha_usuario['email']?>" disabled />
                        </div>
                      </div>
                    </div>    
                    <div class="form-group">
                      <label class="form-label">Nome do Responsável</label>
                      <input class="form-control" name='txtNome' required value="<?php echo $linha_usuario['nome_responsavel']?>" placeholder="Nome do Responsável" />
                    </div>
                    <div id="header-senha">
                      <h3 class="card-title" id='h3-Senha-acesso'>Senha de acesso</h3>
                      <p class="text-muted mb-0">Para alterar sua senha, insira uma nova.</p>
                    </div>
                    <div class="form-group">
                    <label class="form-label">Nova Senha</label>
                      <input type="password" class="form-control" name='txtSenha' placeholder="Nova Senha" />
                      <label class="form-label">Digite Novamente</label>
                      <input type="password" class="form-control" name='txtCSenha' placeholder="Digite Novamente a nova senha" />
                    </div>
                    <div id="header-senha">
                      <h3 class="card-title" id='h3-Senha-acesso'>Confirme sua Senha</h3>
                      <p class="text-muted mb-0">Para alterar seu dados, confirme sua senha atual..</p>
                    </div>
                    <div class="form-group">
                      <label class="form-label">Senha Atual<span class="required"> *</span></label>
                        <input type="password" class="form-control" name='txtSenhaAtual' placeholder="Sua Senha Atual" />
                    </div>
                    <div class="form-footer">
                      <button name='btCadastrar' class="btn btn-primary btn-block">Salvar</button>
                    </div>
                  </form>

                </div>
              </div>
              <div class="card">
                <div class="card-body">
                  <div class="media">
                    <span class="avatar avatar-xxl mr-5" style="background-image: url(../../public/img/32x32.png)"></span>
                    <div class="media-body">
                      <h4 class="m-0">Olá, <?php echo $linha_usuario['nome_responsavel']?></h4>
                      <p class="text-muted mb-0">Mantenha seus dados atualizados para clientes terem as melhores informações sobre o seu comércio. E também, se atente aos <a href="../termos de uso.php">Termos e Condições</a></a></p>
                     
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </body>
  <?php include 'include/footer.php'; ?>
</html>