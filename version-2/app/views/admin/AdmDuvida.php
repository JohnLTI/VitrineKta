<?php session_start();
$id = $_SESSION['id'];
include 'include/conexao.php';
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
    <link rel="icon" href="../../public/img/32x32.png" type="image/x-icon" />
    <link rel="shortcut icon" type="image/x-icon" href="./favicon.ico" />
    <!-- Generated: 2018-04-16 09:29:05 +0200 -->
    <title>VitrineKta | Dúvidas</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
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
                                    <h3 class="card-title">Tire suas Dúvidas</h3>
                                </div>
                                <div class="card-body">
                                    <form method="POST">
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="form-label">Seu Email</label>
                                                    <input class="form-control" value="<?php echo $linha_usuario['email'] ?>" disabled />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Qual sua dúvida?</label>
                                            <textarea class="form-control" name='txtMsg' required rows='5' placeholder="Sua dúvida aqui"></textarea>
                                        </div>
                                        <div class="form-footer">
                                            <button name='btCadastrar' class="btn btn-primary btn-block">Enviar</button>
                                        </div>
                                    </form>

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
<?php
if (isset($_POST["btCadastrar"])) {
}
?>