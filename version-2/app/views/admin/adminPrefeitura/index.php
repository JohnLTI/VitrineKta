<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
include '../verifica.php';
$servidor = $_SESSION['servidor'];

if($servidor!= 2){
    header('location:../index.php');
}
?>
<html>

<head>
    <title>Sistema Administrativo</title>
    <link rel="icon" type="imagem/png" href="../img/32x32.png" />
    <link href="../assets/css/estilo.css" rel="stylesheet">
    <link href="../assets/css/dashboard.css" rel="stylesheet" />
</head>

<body>
    <?php
    include '../../include/conexao.php';
    $pegavalores = "SELECT * FROM comercio,usuario WHERE usuario.idusuario = comercio.usuario_idusuario ORDER BY status ";
    $result = $conexao->query($pegavalores);
    ?>
    <div class="page">
            <div class="header py-4">
                <div class="container">
                    <div class="d-flex">
                        <a class="header-brand" href="../index.php">
                            <img src="../../../../public/img/vitrine.png" class="header-brand-img" alt="tabler logo">
                        </a>
                        <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                            <span class="header-toggler-icon"></span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="header collapse d-lg-flex 
    -0" id="headerMenuCollapse">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg order-lg-first">
                            <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                                <li class="nav-item dropdown">
                                    <a href="../FormBlog.php?idcomercio=150" class="nav-link"><i class="fe fe-check-square"></i>Adicionar Notícia</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            
        </div>
        <center>
            <table>
                <tr id="linha-titulo">
                    <td>Status</td>
                    <td>Código</td>
                    <td>Email</td>
                    <td>Nome Fantasia</td>
                    <td>Razão Social</td>
                    <td>CNPJ</td>
                    <td>Aprovar</td>
                    <td>Editar</td>
                    <td>Desaprovar</td>
                    <td>Deletar</td>
                </tr>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($row['status'] == '0')
                        echo ("<tr><td id='td-pendente'>Pendente</td><td>$row[idcomercio]</td><td>$row[email]</td> <td>$row[nome_fantasia]</td><td>$row[razao_social]</td> <td>$row[cnpj]</td> </td>
                        <td style='padding:20px;'><a href='aprovar.php?cod=$row[idcomercio]' id='pv-aprovar'>Aprovar</a> </td> 
                        <td style='padding:20px;'><a href='editar.php?cod=$row[idcomercio]' id='pv-editar'>Editar</a> </td> 
                        <td style='padding:20px'><a href='desaprovar.php?cod=$row[idcomercio]' id ='pv-desaprovar'>Desaprovar</a></td>
                        <td style='padding:20px'><a href='deletar.php?cod=$row[idcomercio]' id='pv-deletar'>Deletar</td></tr> ");
                    else if ($row['status'] == '1')
                        echo ("<tr><td id='td-aprovado'>Aprovado</td><td>$row[idcomercio]</td><td>$row[email]</td> <td>$row[nome_fantasia]</td><td>$row[razao_social]</td> <td>$row[cnpj]</td> </td>
                        <td style='padding:20px;'> <a href='aprovar.php?cod=$row[idcomercio]' id='pv-aprovar'>Aprovar</a> </td> 
                        <td style='padding:20px;'><a href='editar.php?cod=$row[idcomercio]' id='pv-editar'>Editar</a> </td> 
                        <td style='padding:20px'><a href='desaprovar.php?cod=$row[idcomercio]' id ='pv-desaprovar'>Desaprovar</a></td>
                        <td style='padding:20px'> <a href='deletar.php?cod=$row[idcomercio]' id='pv-deletar'>Deletar</td></tr> ");
                    else if ($row['status'] == '2')
                        echo ("<tr><td id='td-negado' style='background: #E63946 !important;'>Negado</td><td>$row[idcomercio]</td><td>$row[email]</td> <td>$row[nome_fantasia]</td><td>$row[razao_social]</td> <td>$row[cnpj]</td> </td>
                        <td style='padding:20px;'> <a href='aprovar.php?cod=$row[idcomercio]' id='pv-aprovar'>Aprovar</a> </td> 
                        <td style='padding:20px;'><a href='editar.php?cod=$row[idcomercio]' id='pv-editar'>Editar</a> </td> 
                        <td style='padding:20px'><a href='desaprovar.php?cod=$row[idcomercio]' id ='pv-desaprovar'>Desaprovar</a></td>
                        <td style='padding:20px'> <a href='deletar.php?cod=$row[idcomercio]' id='pv-deletar'>Deletar</td></tr> ");
                }
                ?>
            </table>
        </center>
</body>

</html>