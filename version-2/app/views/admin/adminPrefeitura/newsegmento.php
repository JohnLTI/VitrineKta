<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
include '../include/conexao.php';
include 'verifica.php';
$servidor = $_SESSION['servidor'];
if ($servidor != 2) {
    header('location:../index.php');
}
?>
<!--CARD-->
<div class="col-xs-12 col-md-10 offset-md-1">
    <div class="image-flip">
        <div class="mainflip">
            <div class="frontside">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="col-xs-6">

                            <!-- FORMULÁRIO -->
                            <div id="formulario-cadastro">
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group row">
                                            <label class="col-sm-12 col-md-3 col-form-label">Nome do Segmento:</label>
                                            <div class="col-sm-12 col-md-9">
                                                <input type="text" name="txtNome" class="campo form-control" required>
                                            </div>
                                        </div>

                                        <div class="col-xs-12">
                                            <input type="submit" value="Gravar" name="btGravar" class="btn btn-primary">
                                            <br><br><br>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- ./FORMULÁRIO -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--./CARD-->

<div class="espaco"> &nbsp; </div>

<?php
if (isset($_POST["btGravar"])) {
    $nome = $_POST["txtNome"];
    $sql = "INSERT INTO `segmento`(nome)  VALUES ( '$nome') ";

    $conexao->query($sql);

    if ($conexao->errno == 0) {
        echo "<script>alert('Registro cadastrado com sucesso!');</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar o registro');</script>";
    }
}
?>