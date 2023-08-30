<?php
//Inicia sessão
if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}

include '../include/conexao.php';
include 'verifica.php';

$id = $_SESSION['id'];
$idcomercio = $_REQUEST['idcomercio'];

$pegavalor = "SELECT * FROM comercio WHERE idcomercio = $idcomercio";
//Uploads de fotos
if (isset($_POST["enviar"])) {
  $sql = "SELECT * FROM fotos WHERE comercio_idcomercio = $idcomercio";
  $testeFotos = $conexao->query($sql);
  if (mysqli_num_rows($testeFotos) >= 3) {
    echo "<script>alert('Limite de fotos atingido!');</script>";
  } else {
    //capturar os dados do form
    $arquivos = $_FILES['arquivos'];
    //capturar os nomes dos arquivos
    $nomes = $arquivos['name'];
    for ($i = 0; $i < count($nomes); $i++) :
      $query = "INSERT INTO `fotos` (`idfotos`, `comercio_idcomercio`, `imagem`) VALUES (NULL, '$idcomercio', '$nomes[$i]')";
      $conexao->query($query);
      if (mysqli_affected_rows($conexao) > 0) :
        $mover = move_uploaded_file($_FILES['arquivos']['tmp_name'][$i], '../../../public/assets/' . $nomes[$i]);
      else :
        echo "<script>alert('Existem arquivos que não foram enviados com sucesso, tente novamente.');</script>";
      endif;
    endfor;
  }
}

//Upload de tags
if (isset($_POST["enviarTags"])) {
  $tags = $_POST["tags"]  . '\r\n';
  //Query Atualizar
  $query = "UPDATE `comercio` SET `tags` = '$tags' WHERE `comercio`.`idcomercio` = $idcomercio";
  $conexao->query($query);
}

//Upload de Delivery
if (isset($_POST["enviarDelivery"])) {
  $delivery = $_POST["delivery"];
  //Query Atualizar
  $query = "UPDATE `comercio` SET `delivery` = '$delivery' WHERE `comercio`.`idcomercio` = $idcomercio";
  $conexao->query($query);
}
?>
<html lang="pt-br" dir="ltr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta http-equiv="Content-Language" content="pt-br" />
  <meta name="msapplication-TileColor" content="#2d89ef">
  <meta name="theme-color" content="#4188c9">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="HandheldFriendly" content="True">
  <meta name="MobileOptimized" content="320">
  <link rel="icon" href="../../public/img/32x32.png" type="image/x-icon" />
  <link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
  <title>VitrineKta | Administrativo</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
  <script src="./assets/js/require.min.js"></script>

  <!-- Dashboard Core -->
  <link href="./assets/css/dashboard.css" rel="stylesheet" />

  <!-- Dashboard Core -->

  <script src="./assets/js/dashboard.js"></script>
  <!-- c3.js Charts Plugin -->

  <!-- Tags -->
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/thinline.css">

</head>

<body class="">
  <?php
  include "include/cabecalho.php";
  $valor_resultado = $conexao->query($pegavalor);
  $linha = $valor_resultado->fetch_array();
  ?>

  <div class="my-3 my-md-5">
    <div class="container">
      <div class="page-header">
        <h1 class="page-title">
          Personalize a Vitrine: <?php echo $linha['nome_fantasia']; ?>
        </h1>
      </div>
      <div class="col-12 col-md-8">
        <a href="EditComercio.php?cod=<?php echo $linha['idcomercio']; ?>">
          <div class="card">
            <div class="card-body text-center">
              <div class="table-responsive">
                <table class="table card-table table-striped table-vcenter">
                  <thead>
                    <tr>
                      <th>
                        <h3>Editar Informações Cadastrais</h3>
                      </th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </a>

        <div class="card">
          <div class="card-body text-center">
            <div class="table-responsive">
              <table class="table card-table table-striped table-vcenter">
                <thead>
                  <tr>
                    <th>
                      <?php
                      $array = $conexao->query("SELECT * FROM comercio WHERE idcomercio=$_REQUEST[idcomercio]");
                      if ($array->num_rows == 1) {
                        $linha = $array->fetch_array();
                      }
                      ?>
                      <h3>Faz Delivery ou Entrega Domicílio</h3>

                    </th>
                  </tr>
                </thead>
                <th>

                  <form method="POST">
                    <select name="delivery" id="delivery" class="form-select" required>
                      <option value="0" <?php if ($linha["delivery"] == 0) echo "selected"; ?>>Não</option>
                      <option value="1" <?php if ($linha["delivery"] == 1) echo "selected"; ?>>Sim, Faço Delivery</option>
                      <option value="2" <?php if ($linha["delivery"] == 2) echo "selected"; ?>>Sim, Atendo em Domicilio</option>
                    </select>

                    <div class="details">
                      <button id="delivery-button" name="enviarDelivery" type="submit">Salvar</button>
                    </div>
                  </form>
                </th>
              </table>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="wrapper">
            <table class="table card-table table-striped table-vcenter">
              <thead>
                <tr>
                  <th>
                    <h3>Insira Palavras-Chaves do seu Comércio</h3>
                  </th>
                </tr>
              </thead>
            </table>

            <form method="POST" id="tags-form" onkeydown="return event.key != 'Enter';">


              <div class="content">
                <label for="tag">Pressione Enter depois de cada palavra-chave</label>
                <ul class="tags-ul"><input class="tags-input" id="tag" type="text" spellcheck="false"></ul>


              </div>
              <div class="details">
                <p><span>10</span> palavras-chaves restante(s)</p>

                <button name="enviarTags" type="submit">Salvar</button>
                <button>Remover Tudo</button>
              </div>
              <input type="hidden" name="tags" value="<?= $linha['tags']; ?>" id="tags">
            </form>
          </div>
        </div>

        <div class="card">
          <div class="card-body text-center">
            <div class="table-responsive">
              <table class="table card-table table-striped table-vcenter">
                <thead>
                  <tr>
                    <th>
                      <h3>Adicione Fotos na sua Vitrine Digital</h3>
                    </th>
                    <th></th>
                  </tr>
                </thead>
                <form method="POST" enctype="multipart/form-data" style="display:flex;">
                  <tbody>
                    <tr>
                      <th>
                        <div>
                          <p><input type="file" name="arquivos[]" multiple="multiple" required accept='image/*' /> Limite de 3 fotos</p>
                        </div>
                      </th>
                    </tr>
                    <tr>
                      <th>
                        <input name="enviar" type="submit" class="upload-photos" value="Enviar ">
                      </th>
                    </tr>
                  </tbody>
                </form>
              </table>
              <p>
                <?php
                if (isset($_SESSION['erro'])) :
                  echo $_SESSION['erro'];
                elseif (isset($_SESSION['sucesso'])) :
                  echo $_SESSION['sucesso'];
                endif;
                ?>
              </p>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-body text-center">
            <div class="table-responsive">
              <table class="table card-table table-striped table-vcenter">
                <thead>
                  <tr>
                    <th>
                      <h3>Remover Fotos</h3>
                    </th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <?php
                    $fotos = $conexao->query("SELECT * FROM fotos WHERE comercio_idcomercio = '$idcomercio' ");
                    while ($row_linha = mysqli_fetch_assoc($fotos)) {
                    ?>
                      <th colspan="1" id="th-remove">
                        <div class="card p-3">
                          <a href="javascript:void(0)" class="mb-3">
                            <img src="<?php echo "../../../public/assets/" . $row_linha['imagem']; ?>" alt="Pré-visualização para remoção da foto" class="rounded">
                          </a>
                          <div class="d-flex align-items-center px-2">
                            <a href="remove.php?id=<?php echo $row_linha['idfotos'] ?>&&idcomercio=<?php echo $idcomercio ?>"><img src="img/close.png" class="img-remove"></a>
                          </div>
                        </div>
                      </th>
                    <?php } ?>
                  </tr>
                </tbody>
              </table>
            </div>
            <p>
              <?php
              if (isset($_SESSION['erro'])) :
                echo $_SESSION['erro'];
              elseif (isset($_SESSION['sucesso'])) :
                echo $_SESSION['sucesso'];
              endif;

              ?>
            </p>
          </div>
        </div>
        <?php if ($linha['status'] == 1) { ?>
          <a href="./FormBlog.php?idcomercio=<?php echo $idcomercio; ?>">
            <div class="card">
              <div class="card-body text-center">
                <div class="table-responsive">
                  <table class="table card-table table-striped table-vcenter">
                    <thead>
                      <tr>
                        <th colspan="2">
                          <h3>Adicionar Notícia da sua Vitrine</h3>
                        </th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
          </a>
        <?php } else { ?>
          <div class="card">
            <div class="card-body text-center">
              <div class="table-responsive">
                <table class="table card-table table-striped table-vcenter">
                  <thead>
                    <tr>
                      <th colspan="2">
                        <h3>Adicione Notícias da sua Vitrine no Blog</h3>
                        <small>Necessário aprovação do comércio</small>
                      </th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        <?php } ?>
        <a href="../site/individual.php?id=<?php echo $linha['idcomercio']; ?>">
          <div class="card">
            <div class="card-body text-center">
              <div class="table-responsive">
                <table class="table card-table table-striped table-vcenter">
                  <thead>
                    <tr>
                      <th colspan="2">
                        <h3>Visualizar Alterações na Vitrine</h3>
                      </th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </a>
      </div>
    </div>
    <?php include "include/footer.php"; ?>
</body>

</html>
<!-- Script das 10 Tags -->
<script src="./assets/js/tags.js"></script>