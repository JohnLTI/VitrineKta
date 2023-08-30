<?php
//Inicia sessão
if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}

$id = $_SESSION['id'];

include '../include/conexao.php';

include 'verifica.php';

//Inicia a lista e variaveis
$quantidade = [];
$idcomercio = [];
$posicao = 0;

//Busca todos os Dados que estão associados a id e estabele conexão
$pegavalores = "SELECT * FROM `acesso` a INNER JOIN comercio c ON c.usuario_idusuario = $id AND a.comercio_idcomercio = c.idcomercio INNER JOIN usuario u ON u.idusuario = $id WHERE a.data_acesso BETWEEN DATE_ADD(CURRENT_DATE(), INTERVAL -30 DAY) AND CURRENT_DATE() ORDER BY idcomercio ASC ";
$resultado = $conexao->query($pegavalores);

//Armazena todos os resultados na lista
while ($linha = mysqli_fetch_assoc($resultado)) {
  $quantidade[] = $linha['total_acesso'];
  $idcomercio[] = $linha['comercio_idcomercio'];
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
  <!-- Generated: 2018-04-16 09:29:05 +0200 -->
  <title>VitrineKta | Administrativo</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
  <script src="./assets/js/require.min.js"></script>
  <script>
    requirejs.config({
      baseUrl: '.'
    });
  </script>
  <!-- Dashboard Core -->
  <link href="./assets/css/dashboard.css" rel="stylesheet" />
  <script src="./assets/js/dashboard.js"></script>
  <!-- c3.js Charts Plugin -->
  <link href="./assets/plugins/charts-c3/plugin.css" rel="stylesheet" />
  <script src="./assets/plugins/charts-c3/plugin.js"></script>

</head>

<body>
  <?php include "include/cabecalho.php" ?>
  <div class="my-3 my-md-5">
    <div class="container">
      <div class="row">
        <?php
        $resultado = $conexao->query($usuario);
        if (mysqli_num_rows($resultado) > 0) {
          while ($linha = mysqli_fetch_assoc($resultado)) {//TODO PROCESSO ABAIXO É APENAS PARA PEGAR AS POSIÇÕES
            $total_acesso = 0;
            //id do comercio que está sendo gerado
            $idPosicao = $linha['idcomercio'];
            //Conta a quantidades de ids que tem na tabela acesso
            $posicao = count($idcomercio);
            $visu_posicao_acesso = [];
            $posicao_iniciar = 0;
            //Laço que verifica quais são as posições onde o comercio_idcomerio é igual o id do comercio que está sendo gerado
            for($k = 0; $k<$posicao;$k++):
              if($idcomercio[$k]==$idPosicao):
                $visu_posicao_acesso[$posicao_iniciar] = $k;
                $posicao_iniciar++;
              endif;
            endfor;
           
        ?>
            <div class="col-lg-6">
              <!-- Primeira empresa -->
              <div class="page-header">
                <h1 class="page-title">
                  Painel de Acessos: <?php echo $linha["nome_fantasia"]; ?>
                </h1>
              </div>
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Número de acessos nos últimos 30 dias</h3>
                </div>
                <div id="chart-development-activity-<?php echo $linha['idcomercio']; ?>" style="height: 10rem"></div>

              </div>
              <script>
                require(['c3', 'jquery'], function(c3, $) {
                  $(document).ready(function() {
                    var chart = c3.generate({
                      bindto: '#chart-development-activity-<?php echo $linha['idcomercio']; ?>', // id do gráfico
                      data: {
                        columns: [
                          // Dados obtidos para serem apresentados no gráfico
                          ['data1', <?php 
                          for($i = 0;$i<$posicao_iniciar;$i++):
                            $posicao_acesso = $visu_posicao_acesso[$i];
                            echo $quantidade[$posicao_acesso].',';
                             //Calcula total de acesso
                            $total_acesso = $total_acesso + $quantidade[$posicao_acesso];
                          endfor;
                          ?>]
                        ],
                        type: 'area', // default type of chart
                        groups: [
                          ['data1', 'data2', 'data3']
                        ],
                        colors: {
                          'data1': tabler.colors["blue"]
                        },
                        names: {
                          // name of each serie
                          'data1': 'Total Visualização:',

                        }
                      },
                      axis: {
                        y: {
                          padding: {
                            bottom: 0,
                          },
                          show: false,
                          tick: {
                            outer: false
                          }
                        },
                        x: {
                          padding: {
                            left: 0,
                            right: 0
                          },
                          show: true
                        }
                      },
                      legend: {
                        position: 'inset',
                        padding: 0,
                        inset: {
                          anchor: 'top-left',
                          x: 40,
                          y: 0,
                          step: 10
                        }
                      },
                      tooltip: {
                        format: {
                          title: function(x) {
                            return '';
                          }
                        }
                      },
                      padding: {
                        bottom: -7,
                        left: 2,
                        right:2
                      },
                      point: {
                        show: true
                      }
                    });
                  });
                });
              </script>
              <div class="card">
                <div class="card-body text-center">
                  <!-- Informando se o Comercio foi autorizado ou negado
                   Comercio aguardando autorização -->
                  <?php if($linha['status']==0):?>
                    <div class="h5">Comércio aguardando autorização</div>
                    <div>Aguarde 7 dias. <br> Verificaremos se seu comércio cumpre os requisitos de cadastro.</div>
                    <p><br>"Considera-se empresa ou prestador de serviço legalizado aquele que possua inscrição municipal junto ao cadastro econômico da Prefeitura Municipal de Cataguases, inscrição ativa e regular junto à Receita Federal e Junta Comercial ou Cartório de Registro."</p>
                    <!-- Comercio aprovado -->
                  <?php elseif($linha['status']==1): ?>
                    <div class="h5">Total de Acessos</div>
                    <div class="display-4 font-weight-bold mb-4"><?= $total_acesso?></div>
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-red" style="width: <?= $total_acesso ?>%"></div>
                    </div>
                    <!-- Comercio negado -->
                  <?php else: ?>
                    <div class="h5">Comércio não aprovado</div>
                    <p>"Considera-se empresa ou prestador de serviço legalizado aquele que possua inscrição municipal junto ao cadastro econômico da Prefeitura Municipal de Cataguases, inscrição ativa e regular junto à Receita Federal e Junta Comercial ou Cartório de Registro."</p>
                    <strong>Entre em contato para saber os motivos e regularizar sua empresa.</strong>
                    <p>Email: suporte.vitrinekta@gmail.com</p>
                    
                  <?php endif;?>
                </div>
              </div>
            </div>
          <?php }
        } else {
          ?>
          <div class="col-lg-6">
            <a href="formulario.php">
              <div class="card">
                <div class="card-body text-center">
                  <div class="table-responsive">
                    <table class="table card-table table-striped table-vcenter">
                      <thead>
                        <tr>
                          <th>
                            <h3>Inserir um Comercio</h3>
                          </th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
            </a>
          </div>
        <?php } ?>
      </div>
    </div>

    <!-- footer -->
    <?php include "include/footer.php"; ?>
</body>

</html>