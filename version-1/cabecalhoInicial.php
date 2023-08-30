
<div class="header">
    <div class="containercabecalho" id="header-cabecalho">
        <nav class="navbar navbar-dark">
            <a href="../site/index.php" class="logo-link"><img class="logo" src="../../public/img/vitrine.png" alt="Logo do site"></a>
            <hr class="barra">
            <h1 class="tituloheader">Catálogo comercial<br> de Cataguases </h1>
            <div class="final-header">
                <!-- <div class="section-logo">
                    <img class="logo-parceiros" src="img/LogoPrefeitura.png">
                </div>
                <div class="section-logo">
                    <img class="logo-parceiros" src="img/logo-cataguases.png">
                </div> -->
                <div class="flexDiv">
                    <button class="sec_btn" onclick="openMulti();"><img id="menu" src="./img/menu.png"></button>
                    <div class="selectWrapper">
                        <div class="multiSelect" id="menu-0">
                            <a href="../index.php" class="bottomBorder">
                                <div class="bottomBorder">Iniciar</div>
                            </a>
                            <?php
                            if((!isset ($_SESSION['email']) == true) and (!isset ($_SESSION['senha']) == true))
                            {?>
                                <a href="./register.php" class="itens-menu">
                                    <div  class="bottomBorder">Cadastrar</div>
                                </a>
                                <a href="./index.php" class="itens-menu">
                                    <div  class="bottomBorder">Entrar</div>
                                </a>
                            <?php  }
                            else{
                                $id=$id = $_SESSION['id'];
                            ?>
                             
                                <a href="./AdmUser.php?id=<?php echo $id;?>" class="itens-menu">
                                    <div class="bottomBorder">Painel Controle</div>
                                </a>
                            
                            <?php }?>
                            <a href="../sobre.php" class="itens-menu">
                                <div>Últimas Notícias</div>
                            </a>
                            <a href="../site/sobre.php" class="itens-menu">
                                <div>Quem Somos</div>
                            </a>
                            <a href="../site/sobre.php" class="itens-menu">
                                <div >Parceiros</div>
                            </a>
                            <a href="../site/termos de uso.php" class="itens-menu">
                                <div>Termos de Uso</div>
                            </a>
                            <?php  if((isset ($_SESSION['email']) == true) and (isset ($_SESSION['senha']) == true))
                            {?>
                                <a href="./logout.php" class="itens-menu">
                                    <div class="bottomBorder">Sair</div>
                                </a>
                            <?php } ?>
                        
                           
                            <!-- <div class="topBorder iconDiv"  onclick="nextMenu(event);">Categorias<i class="material-icons"></i></div>
                    </div>
                        
                        <div class="multiSelect">
                            <a href="./busca.php?pesquisar=Açougue&btPesquisar=" class="itens-menu"><div>Açougues</div></a>
                            <a href="./busca.php?pesquisar=Restaurante&btPesquisar=" class="itens-menu"><div>Restaurantes</div></a>
                            <a href="./busca.php?pesquisar=Bares&btPesquisar=" class="itens-menu"><div>Bares</div></a>
                            <a href="./busca.php?pesquisar=Pizzaria&btPesquisar=" class="itens-menu"><div>Pizzaria</div></a>
                            <a href="./busca.php?pesquisar=Padaria&btPesquisar=" class="itens-menu"><div>Padaria</div></a>

                        </div> -->
                    </div>
                    <div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>