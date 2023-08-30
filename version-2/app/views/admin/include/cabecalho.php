<?php
  // $usuario = "SELECT * FROM `usuario` WHERE idusuario = $id";
  $usuario = "SELECT * FROM comercio,usuario WHERE comercio.usuario_idusuario='$id' and usuario.idusuario = $id ORDER BY idcomercio DESC";
  $testeUser =  $conexao->query($usuario);
  if (mysqli_num_rows($testeUser) < 1) {
    echo "<script>document.location='./formulario.php'</script>";
  }
?>
<div class="page">
  <div class="page-main">
    <div class="header py-4">
      <div class="container">
        <div class="d-flex">
          <a class="header-brand" href="../site/index.php">
            <img src="../../../public/img/vitrine.png" class="header-brand-img" alt="tabler logo">
          </a>
          <div class="d-flex order-lg-2 ml-auto">
            <div class="nav-item d-none d-md-flex">

            </div>
            <!-- ICONE DE NOTIFICAÇÃO
              <div class="dropdown d-none d-md-flex">
              <a class="nav-link icon" data-toggle="dropdown">
                <i class="fe fe-bell"></i>
                <span class="nav-unread"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                <a href="#" class="dropdown-item d-flex">
                  <span class="avatar mr-3 align-self-center" style="background-image: url(demo/faces/male/41.jpg)"></span>
                  <div>
                    <strong>Nathan</strong> pushed new commit: Fix page load performance issue.
                    <div class="small text-muted">10 minutes ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item d-flex">
                  <span class="avatar mr-3 align-self-center" style="background-image: url(demo/faces/female/1.jpg)"></span>
                  <div>
                    <strong>Alice</strong> started new task: Tabler UI design.
                    <div class="small text-muted">1 hour ago</div>
                  </div>
                </a>
                <a href="#" class="dropdown-item d-flex">
                  <span class="avatar mr-3 align-self-center" style="background-image: url(demo/faces/female/18.jpg)"></span>
                  <div>
                    <strong>Rose</strong> deployed new version of NodeJS REST Api V3
                    <div class="small text-muted">2 hours ago</div>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item text-center text-muted-dark">Mark all as read</a>
              </div>
            </div> -->

           
            <div class="dropdown">
              <?php 
                $resultado_usuario = $conexao->query($usuario);
                $linha_usuario = $resultado_usuario->fetch_array();
              ?>
              <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                <span class="avatar"><img src="img/user.png "></span>
                <span class="ml-2 d-none d-lg-block">
                  <span class="text-default"><?php echo $linha_usuario['nome_responsavel'];?></span>
                  <small class="text-muted d-block mt-1">Administrador(a)</small>
                </span>
              </a>
              <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                <a class="dropdown-item" href="AdmPerfil.php?idUsuario=<?php echo $linha_usuario['idusuario'];?>">
                  <i class="dropdown-icon fe fe-user"></i> Editar perfil
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="AdmDuvida.php">
                  <i class="dropdown-icon fe fe-help-circle"></i> Precisa de ajuda?
                </a>
                <a class="dropdown-item" href="logout.php">
                  <i class="dropdown-icon fe fe-log-out"></i> Sair
                </a>
              </div>
            </div>
          </div>
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
              <li class="nav-item">
                <a href="./AdmUser.php?id=<?php echo $id; ?>" class="nav-link active"><i class="fe fe-home"></i>Inicio</a>
              </li>

              <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-box"></i>Personalizar Comércio</a>
                <div class="dropdown-menu dropdown-menu-arrow">
                  <?php
                  //Resultado da busca
                  $result = $conexao->query($usuario);
                  //Roda o laço enquanto houver resultados
                  while ($row_linha = mysqli_fetch_assoc($result)) {
                    if($row_linha['status']==1):
                  ?>
                  <a href="./AdmEditar.php?idcomercio=<?php echo $row_linha['idcomercio']; ?>" class="dropdown-item "><?php echo $row_linha['nome_fantasia'] ?></a>
                  <?php endif; } ?>

              </li>
              <li class="nav-item dropdown">
                <a href="./formulario.php" class="nav-link"><i class="fe fe-check-square"></i>Inserir novo Comércio</a>
              </li>

              <!-- <li class="nav-item">
                <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-box"></i>Mais</a>
                <div class="dropdown-menu dropdown-menu-arrow">
                  <a href="./cards.html" class="dropdown-item ">Adicionar Fotos</a>
                  <a href="./charts.html" class="dropdown-item ">Editar Usuario</a>
                  <a href="./pricing-cards.html" class="dropdown-item ">Remover Comércio</a>
                </div>
              </li> -->
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>