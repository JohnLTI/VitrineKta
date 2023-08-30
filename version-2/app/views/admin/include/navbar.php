<header>
    <div class="container">
        <nav id="nav">
            <a href="index.php" class="logo-link"><img class="logo" src="../../../public/img/vitrine.png" alt="Logo do site"></a>
            <hr class="barra">
            <h1 class="tituloheader">Catálogo comercial<br> de Cataguases </h1>

            <div class="menu">
                <input type="checkbox" id="checkbox-menu">

                <label for="checkbox-menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </label>
            </div>

            <div class="select-menu">

                <ul class="list-content">

                    <li class="list-menu">
                        <a class="link-menu" href="./index.php">
                            <i class="fas fa-home"></i>
                            <div class="bottomBorder">Iniciar</div>
                        </a>
                    </li>

                    <?php
                    if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) { ?>
                        <li class="list-menu">
                            <a class="link-menu" href="../admin/register.php">
                                <i class="fas fa-bullhorn"></i>
                                <div class="bottomBorder">Divulgue aqui</div>
                            </a>
                        </li>
                        
                        <li class="list-menu">
                            <a class="link-menu" href="../admin/index.php">
                                <i class="fas fa-sign-in-alt"></i>
                                <div class="bottomBorder">Entrar</div>
                            </a>
                        </li>

                    <?php } else {
                        $id = $_SESSION['id'];

                    ?>
                        <li class="list-menu">
                            <a class="link-menu" href="../admin/formulario.php">
                                <i class="fas fa-bullhorn"></i>
                                <div class="bottomBorder">Divulgue aqui</div>
                            </a>
                        </li>
                        <li class="list-menu">
                            <a class="link-menu" href="../admin/AdmUser.php?id=<?php echo $id; ?>">
                                <i class="fas fa-sign-in-alt"></i>
                                <div class="bottomBorder">Painel Controle</div>
                            </a>
                        </li>
                    <?php } ?>
                    <li class="list-menu">
                        <a class="link-menu" href="./blog.php">
                            <i class="far fa-newspaper"></i>
                            <div class="bottomBorder">Últimas Notícias</div>
                        </a>
                    </li>

                    <li class="list-menu">
                        <a class="link-menu" href="./sobre.php">
                            <i class="fas fa-users"></i>
                            <div class="bottomBorder">Quem Somos</div>
                        </a>
                    </li>

                    <li class="list-menu">
                        <a class="link-menu" href="./termos.php">
                            <i class="far fa-address-card"></i>
                            <div class="bottomBorder">Termos e Condições</div>
                        </a>
                    </li>
                    <?php
                    if ((isset($_SESSION['email']))) {
                    ?>
                        <li class="list-menu">
                            <a class="link-menu" href="../admin/logout.php">
                                <i class="fas fa-sign-out-alt"></i>
                                <div class="bottomBorder">Sair</div>
                            </a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>


            </div>

        </nav>
    </div>
    <!-- Sub-menu -->
    <div class="menu-links">
        <div class="container" id="container-cabecalho">
            <?php
            if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) { ?>
                <div class="text-cadastre">

                    <ul class="links"><a class="link-cadastre" href="../admin/index.php">
                            <li>Entrar</li>
                        </a></ul>
                </div>
                <div class="text-cadastre">
                    <ul class="links"><a class="link-cadastre" href="../admin/register.php">
                            <li>Divulgue aqui</li>
                        </a></ul>
                </div>
            <?php } else {

            ?>
                <div class="text-cadastre">
                    <ul class="links">
                        <a class="link-cadastre" href="../admin/AdmUser.php?id=<?php echo $id; ?>">
                            <li>Painel de Controle</li>
                        </a>
                    </ul>
                </div>
            <?php } ?>
            <div class="text-cadastre">
                <ul class="links">
                    <a class="link-cadastre" href="./blog.php">
                        <li>Últimas Notícias</li>
                    </a>
                </ul>
            </div>


        </div>
    </div>
</header>