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

    <div class="categorias-pesquisa">
        <div class="container">
            <div class="pesquisa">
                <form method="GET" action="busca.php">
                    <input type="text" id="pesquisa-input" name="pesquisa" placeholder="Estou procurando por...">
                    <button type="submit" class="search-comercio"><i class="fas fa-search"></i></button>
                </form>
            </div>

            <div class="categorias">
                <div class="slider owl-carousel carrosel-categorias">
                    <ul class="list-categorias">
                        <a href="./busca.php?pesquisa=Restaurante" class="a-categorias">
                            <li class="li-categorias">
                                <span class="icon-background"><i class="fas fa-utensils"></i></span>
                                <small class="small-categorias">Restaurante</small>
                            </li>
                        </a>
                        <a href="./busca.php?pesquisa=Farmácia" class="a-categorias">
                            <li class="li-categorias">
                                <span class="icon-background"><i class="fas fa-clinic-medical"></i></span>
                                <small class="small-categorias">Farmácia</small>
                            </li>
                        </a>

                        <a href="./busca.php?pesquisa=Vestuário" class="a-categorias">
                            <li class="li-categorias">
                                <span class="icon-background"><i class="fas fa-tshirt"></i></span>
                                <small class="small-categorias">Vestuário</small>
                            </li>
                        </a>
                        <a href="./busca.php?pesquisa=Lanches" class="a-categorias">
                            <li class="li-categorias">
                                <span class="icon-background"><i class="fas fa-hamburger"></i></span>
                                <small class="small-categorias">Lanches</small>
                            </li>
                        </a>
                        <a href="./busca.php?pesquisa=Bebidas" class="a-categorias">
                            <li class="li-categorias">
                                <span class="icon-background"><i class="fas fa-wine-glass-alt"></i></span>
                                <small class="small-categorias">Bebidas</small>
                            </li>
                        </a>

                        <a href="./busca.php?pesquisa=Hotel" class="a-categorias">
                            <li class="li-categorias">
                                <span class="icon-background"><i class="fas fa-hotel"></i></span>
                                <small class="small-categorias">Hotel</small>
                            </li>
                        </a>

                        <a href="./busca.php?pesquisa=Pet-shop" class="a-categorias">
                            <li class="li-categorias">
                                <span class="icon-background"><i class="fas fa-dog"></i></span>
                                <small class="small-categorias">Pet-shop</small>
                            </li>
                        </a>

                        <a href="./busca.php?pesquisa=Perfumaria" class="a-categorias">
                            <li class="li-categorias">
                                <span class="icon-background"><i class="fas fa-air-freshener"></i></span>
                                <small class="small-categorias">Perfumaria</small>
                            </li>
                        </a>

                        <a href="./busca.php?pesquisa=Moveis" class="a-categorias">
                            <li class="li-categorias">
                                <span class="icon-background"><i class="fas fa-couch"></i></span>
                                <small class="small-categorias">Móveis</small>
                            </li>
                        </a>

                        <a href="./busca.php?pesquisa=Gás" class="a-categorias">
                            <li class="li-categorias">
                                <span class="icon-background"><i class="fas fa-burn"></i></span>
                                <small class="small-categorias">Gás</small>
                            </li>
                        </a>

                        <a href="./busca.php?pesquisa=Automotivos" class="a-categorias">
                            <li class="li-categorias">
                                <span class="icon-background"><i class="fas fa-car-alt"></i></span>
                                <small class="small-categorias">Automotivos</small>
                            </li>
                        </a>

                        <a href="./categorias.php" class="a-categorias">
                            <li class="li-categorias">
                                <span class="icon-background"><i class="fas fa-th-large"></i></span>
                                <small class="small-categorias">Todas as Categorias</small>
                            </li>
                        </a>
                    </ul>
                </div>
                <script>
                    $(".slider").owlCarousel({
                        loop: true,
                        autoplay: true,
                        autoplayTimeout: 3000,
                        autoplayHoverPause: true,
                        responsiveClass: true,

                    });
                </script>
            </div>
        </div>
    </div>
    <script src="../../../public/js/menu.js"></script>
</header>