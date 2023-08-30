<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
$id = $_SESSION['id'];
$idcomercio = $_REQUEST['idcomercio'];
include '../include/conexao.php';
include 'verifica.php';
?>
<!doctype html>
<html lang="pt-br" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Language" content="en" />
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#4188c9">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <link rel="icon" href="img/32x32.png" type="image/x-icon" />
    <link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
    <!-- Generated: 2018-04-16 09:29:05 +0200 -->
    <title>Adicione Noticias</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    <script src="./assets/js/require.min.js"></script>
    <!-- CSS e JS para menu do cabeçalho -->
    <link href="./assets/css/dashboard.css" rel="stylesheet" />
    <script src="./assets/js/dashboard.js"></script>
</head>
<?php include "./include/cabecalho.php"; ?>

<body class="">
    <div class="page">
        <div class="page-main">
            <div class="my-3 my-md-5">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Adicione Notícias sobre seu estabelecimento</h3>
                                </div>
                                <div class="card-body">
                                    <form method="POST" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Título da Notícia</label>
                                                    <input class="form-control" name='txtTitulo' placeholder="Título da Notícia" maxlength="90"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Descrição da notícia</label>
                                            <textarea class="form-control" name='txtMsg' required rows='3' maxlength="254" placeholder="Digite sobre o que se trata sua notícia"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Link</label>
                                            <input type="url" class="form-control" name='txtLink' placeholder="Link para redirecionar ao clicar em sua notícia" />
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Uma Foto que defina a notícia</label>
                                            <tbody>
                                            <tr>
                                                <th>
                                                    <div>
                                                        <input type="file" name="txtimagem" required accept='image/*' /> 
                                                    </div>
                                                </th>
                                            </tr>                                       
                                            </tbody>
                                        </div>  
                                        <div class="form-group">
                                        <?php if($idcomercio=='150'){
                                            echo " <select name='rank' class='form-select'>
                                                <option value=0 selected>VitrineKta</option>
                                                <option value=1>Prefeitura de Cataguases</option>
                                                <option value=2>CDL</option>
                                            </select>";
                                        }?>
                                        </div>
                                        <!-- Para os administradores -->
                                       
                                        <div class="form-footer">
                                            <button name='btCadastrar' class="btn btn-primary btn-block">Compartilhar</button>
                                        </div>   
                                    </form>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="media">
                                        <span class="avatar avatar-xxl mr-5" style="background-image: url(img/32x32.png)"></span>
                                        <div class="media-body">
                                            <h4 class="m-0">Olá,</h4>
                                            <p class="text-muted mb-0">Compartilhe Notícias sobre seu estabelecimento e deixe seus Clientes sempre atualizados sobre boas novas. Aumente seu engajamento compartilhando gratuitamente aqui.</p>
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
<?php 
include 'include/footer.php'; 
if(isset($_POST["btCadastrar"])){
    $titulo = $_POST['txtTitulo'];
    $descricao = $_POST['txtMsg'];
    $link = $_POST['txtLink'];
    //Para identificar administrador
    if($idcomercio=='150'){
        $rank = $_POST['rank']; 
        if($rank=='0') $idcomercio = 150;
        else if($rank=='1') $idcomercio = 148;
        else $idcomercio = 149;
    } 
    else $rank = 4;
    // Fim
    $data_envio = date('Y-m-d');
    
    //ARQUIVOS de imagem
    $imagemTmp = $_FILES["txtimagem"]["tmp_name"];
    $imagem = date("dmyHis") . $_FILES["txtimagem"]["name"];
    //enviar a imagem
    move_uploaded_file($imagemTmp, "../../../public/assets/" . $imagem);
    $sql = "INSERT INTO `blog` (`comercio_idcomercio`,`titulo`,`descricao`,`link`,`imagem_blog`,`data_envio`,`ranking`) VALUES ('$idcomercio','$titulo','$descricao','$link','$imagem','$data_envio','$rank')";
    $conexao->query($sql);
    if ($conexao->errno == 0) {
    echo "<script>alert('Notícia cadastrada com sucesso!');</script>";
    echo "<script>document.location='../site/blog.php'</script>";
    }
    else{
        echo "<script>alert('Ocorreu algum erro, tente novamente!');</script>";
    }

}

?>

</html>