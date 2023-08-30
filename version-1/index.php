<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- Permitir caracteres especiais-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- icone da aba-->
    <link rel="icon" type="imagem/png" href="img/32x32.png" />
    <!-- Palavras chaves de SEO-->
    <meta name="description" content="Catálogo empresarial da cidade de Cataguases - MG. O site funciona como uma grande vitrine digital que aproxima potenciais consumidores dos comerciantes e prestadores de serviços.">
    <meta name="keywords" content="Comércio local, Cataguases,Catálogo, Vitrine, Marketing Digital, Empresas, Comércio, Prestadores de serviço">
    <meta name="author" content="Prefeitura de Cataguases">
    <!-- Bootstrap CSS e estilo -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="style/style.css" rel="stylesheet">

    <title>VitrineKta</title>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-RHYH98E6WE"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-RHYH98E6WE');
    </script>


</head>

<body>
    <!--Conexao tst = teste local -->
    <?php include "include/tstconexao.php"; ?>
    <!--Navigation Bar (CABEÇALHO)-->
    <?php include "include/cabecalho.php"; ?>
    <!--Campo de Pesquisa-->

    <div class="row">
        <div class="col-md-12" id="linha-pesquisa">
            <div class="pesquisa">
                <div class='container'>
                    <form action="busca.php" method="GET" class='autocomplete-container' id="caixa-texto" autocomplete="off">
                        <div class='autocomplete' role='combobox' aria-expanded='false' aria-owns='autocomplete-results' aria-haspopup='listbox'>
                            <input class='autocomplete-input' placeholder='Estou procurando por' name="pesquisar" maxlength="70b" aria-label='Search for a fruit or vegetable' aria-autocomplete='both' aria-controls='autocomplete-results'>
                            <button type='submit' name='btPesquisar' class='autocomplete-submit' aria-label='Search'>
                                <svg aria-hidden='true' viewBox='0 0 24 24'>
                                    <path d='M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z' />
                                </svg>
                            </button>
                        </div>
                        <ul id='autocomplete-results' class='autocomplete-results hidden' role='listbox' aria-label='Search for a fruit or vegetable'>
                        </ul>
                    </form>
                    <p class='search-result'></p>
                </div>
                </main>
            </div>
        </div>
    </div>


    <!--Mapa de Localização-->
    <?php include "include/mapa.php"?>

    <!-- Cards empresas -->

    <div class="container">
        <div class="row g-0" id="blococard">
            <div class="col-12 col-sm-12 col-md-10">
                <div class="row">
                    <?php
                    //Busca todos os Dados com um limite de 8 caracteres (limit 8) E aleatorios (ORDER BY RAND), por isso cada vez que atualiza muda os cards
                    $pegavalores = "SELECT * FROM comercio WHERE status = 1 ORDER BY RAND()limit 8;";
                    //Resultado da busca
                    $result = $conexao->query($pegavalores);
                    //Roda o laço enquanto houver resultados
                    while ($row_linha = mysqli_fetch_assoc($result)) {
                    ?>
                        <div class="col-12 col-sm-6 col-md-4">
                            <a href="individual.php?id=<?php echo $row_linha['idcomercio']; ?>" style="text-decoration:none;">
                                <div class="card">
                                    
                                    <div class="card-img">
                                        <!-- lOGO DA EMPRESA -->
                                        <img class="card-img-top" src='<?php echo "images/" . $row_linha['imagem']; ?>' alt='Imagem de capa do card'>
                                        <!-- tag da CDL -->
                                        <?php if ($row_linha['CDL'] == 1) {
                                            echo "<img  class='cdl' src='img/bandeira cdl.png' >";
                                        }
                                        ?>
                                    </div>
                                    <!-- INFORMAÇÕES DO CARD -->
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $row_linha['nome_fantasia']; ?></h5>
                                        <p class="card-text"><?php echo $row_linha['telefone']; ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>

                    <?php }
                    ?>
                    <!--Botão Cadastrar empresa aqui-->
                <div class="col-12 col-sm-6 col-md-4">
                    <?php 
                    // Usuario desblogado
                    if((!isset ($_SESSION['email']) == true) and (!isset ($_SESSION['senha']) == true))
                    {?>
                        <a href="sistema/register.php" style="text-decoration:none;">
                    <?php } 
                    // Usuario logado
                    else{ ?>
                      <a href="sistema/formulario.php" style="text-decoration:none;"> 
                    <?php } ?>
                        <div class="card-extra">
                            <img class="card-extra-img" src="img/card-extra.png"></img>
                        </div>
                    </a>
                </div>
                </div> 
                 
               
            </div>

            <!-- Carrosel -->

            <div class="col-12 col-sm-12 col-md-2" id="carousel" data-interval="10000">
                <!--o tempo do carrousel está de 10s-->
                <div id="carouselExampleCaptions" class="carousel-slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                        <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                        <!-- <li data-target="#carouselExampleCaptions" data-slide-to="3"></li> -->
                    </ol>

                    <div class="carousel-inner-join">
                        <div class="carousel-item active">
                            <a href="https://cataguases.mg.gov.br/" target="_blank">
                                <img src="img/Carrossel Prefeitura.png" id="imgcarrossel" class="d-block w-100" alt="..." style="height:500.5px;border:solid 1px black"></a>
                        </div>
                        <div class="carousel-item">
                            <a href="https://vitrinekta.com.br/sistema/register.php">
                                <img src="img/Carrossel_SINE.png" id="imgcarrossel" class="d-block w-100" alt="..." style="height:500.5px;"></a>
                        </div>
                        <div class="carousel-item">
                            <a href="https://www.facebook.com/ACIC-Associa%C3%A7%C3%A3o-Comercial-e-Industrial-de-Cataguases-422881014559226/" target="_blank">
                                <img src="img/Carrossel sala mineira.jpg" id="imgcarrossel" class="d-block w-100" alt="..." style="height:500.5px;"></a>
                        </div>
                        <div class="carousel-item">
                            <a href="https://cataguases.cdls.org.br/" target="_blank">
                                <img src="img/Carrossel contrata mg.jpg" id="imgcarrossel" class="d-block w-100" alt="..." style="height:500.5px;"></a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Footer -->

    <?php
    include './include/footer.php';
    ?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js" type="text/javascript"></script>
    <script>
        window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')
    </script>
    <script>
        //Animação da Barra de pesquisa e autocomplete, Busca de todos os dados da tabela segmentos para aparecer no campo da pesquisa
        function openMulti() {
            if (document.querySelector(".selectWrapper").style.pointerEvents == "all") {
                document.querySelector(".selectWrapper").style.opacity = 0;
                document.querySelector(".selectWrapper").style.pointerEvents = "none";
                resetAllMenus();
            } else {
                document.querySelector(".selectWrapper").style.opacity = 1;
                document.querySelector(".selectWrapper").style.pointerEvents = "all";
            }
        }

        function nextMenu(e) {
            menuIndex = eval(event.target.parentNode.id.slice(-1));
            document.querySelectorAll(".multiSelect")[menuIndex].style.transform =
                "translateX(-100%)";
            // document.querySelectorAll(".multiSelect")[menuIndex].style.clipPath = "polygon(0 0, 0 0, 0 100%, 0% 100%)";
            document.querySelectorAll(".multiSelect")[menuIndex].style.clipPath =
                "polygon(100% 0, 100% 0, 100% 100%, 100% 100%)";
            document.querySelectorAll(".multiSelect")[menuIndex + 1].style.transform =
                "translateX(0)";
            document.querySelectorAll(".multiSelect")[menuIndex + 1].style.clipPath =
                "polygon(0 0, 100% 0, 100% 100%, 0% 100%)";
        }

        function resetAllMenus() {
            setTimeout(function() {
                var x = document.getElementsByClassName("multiSelect");
                var i;
                for (i = 1; i < x.length; i++) {
                    x[i].style.transform = "translateX(100%)";
                    x[i].style.clipPath = "polygon(0 0, 0 0, 0 100%, 0% 100%)";
                }
                document.querySelectorAll(".multiSelect")[0].style.transform =
                    "translateX(0)";
                document.querySelectorAll(".multiSelect")[0].style.clipPath =
                    "polygon(0 0, 100% 0, 100% 100%, 0% 100%)";
            }, 300);
        }
        console.clear()

        const data = [
            <?php
            $pegavalores = "SELECT * FROM segmento;";
            $result = $conexao->query($pegavalores);
            while ($row_linha = mysqli_fetch_assoc($result)) {
                echo "'" . $row_linha['nome'] . "',";
            }
            ?>
        ]

        class Autocomplete {
            constructor({
                rootNode,
                inputNode,
                resultsNode,
                searchFn,
                shouldAutoSelect = false,
                onShow = () => {},
                onHide = () => {}
            } = {}) {
                this.rootNode = rootNode
                this.inputNode = inputNode
                this.resultsNode = resultsNode
                this.searchFn = searchFn
                this.shouldAutoSelect = shouldAutoSelect
                this.onShow = onShow
                this.onHide = onHide
                this.activeIndex = -1
                this.resultsCount = 0
                this.showResults = false
                this.hasInlineAutocomplete = this.inputNode.getAttribute('aria-autocomplete') === 'both'

                // Setup events
                document.body.addEventListener('click', this.handleDocumentClick)
                this.inputNode.addEventListener('keyup', this.handleKeyup)
                this.inputNode.addEventListener('keydown', this.handleKeydown)
                this.inputNode.addEventListener('focus', this.handleFocus)
                this.resultsNode.addEventListener('click', this.handleResultClick)
            }

            handleDocumentClick = event => {
                if (event.target === this.inputNode || this.rootNode.contains(event.target)) {
                    return
                }
                this.hideResults()
            }

            handleKeyup = event => {
                const {
                    key
                } = event

                switch (key) {
                    case 'ArrowUp':
                    case 'ArrowDown':
                    case 'Escape':
                    case 'Enter':
                        event.preventDefault()
                        return
                    default:
                        this.updateResults()
                }

                if (this.hasInlineAutocomplete) {
                    switch (key) {
                        case 'Backspace':
                            return
                        default:
                            this.autocompleteItem()
                    }
                }
            }

            handleKeydown = event => {
                const {
                    key
                } = event
                let activeIndex = this.activeIndex

                if (key === 'Escape') {
                    this.hideResults()
                    this.inputNode.value = ''
                    return
                }

                if (this.resultsCount < 1) {
                    if (this.hasInlineAutocomplete && (key === 'ArrowDown' || key === 'ArrowUp')) {
                        this.updateResults()
                    } else {
                        return
                    }
                }

                const prevActive = this.getItemAt(activeIndex)
                let activeItem

                switch (key) {
                    case 'ArrowUp':
                        if (activeIndex <= 0) {
                            activeIndex = this.resultsCount - 1
                        } else {
                            activeIndex -= 1
                        }
                        break
                    case 'ArrowDown':
                        if (activeIndex === -1 || activeIndex >= this.resultsCount - 1) {
                            activeIndex = 0
                        } else {
                            activeIndex += 1
                        }
                        break
                    case 'Enter':
                        activeItem = this.getItemAt(activeIndex)
                        this.selectItem(activeItem)
                        return
                    case 'Tab':
                        this.checkSelection()
                        this.hideResults()
                        return
                    default:
                        return
                }

                event.preventDefault()
                activeItem = this.getItemAt(activeIndex)
                this.activeIndex = activeIndex

                if (prevActive) {
                    prevActive.classList.remove('selected')
                    prevActive.setAttribute('aria-selected', 'false')
                }

                if (activeItem) {
                    this.inputNode.setAttribute('aria-activedescendant', `autocomplete-result-${activeIndex}`)
                    activeItem.classList.add('selected')
                    activeItem.setAttribute('aria-selected', 'true')
                    if (this.hasInlineAutocomplete) {
                        this.inputNode.value = activeItem.innerText
                    }
                } else {
                    this.inputNode.setAttribute('aria-activedescendant', '')
                }
            }

            handleFocus = event => {
                this.updateResults()
            }

            handleResultClick = event => {
                if (event.target && event.target.nodeName === 'LI') {
                    this.selectItem(event.target)
                }
            }

            getItemAt = index => {
                return this.resultsNode.querySelector(`#autocomplete-result-${index}`)
            }

            selectItem = node => {
                if (node) {
                    this.inputNode.value = node.innerText
                    this.hideResults()
                }
            }

            checkSelection = () => {
                if (this.activeIndex < 0) {
                    return
                }
                const activeItem = this.getItemAt(this.activeIndex)
                this.selectItem(activeItem)
            }

            autocompleteItem = event => {
                const autocompletedItem = this.resultsNode.querySelector('.selected')
                const input = this.inputNode.value
                if (!autocompletedItem || !input) {
                    return
                }

                const autocomplete = autocompletedItem.innerText
                if (input !== autocomplete) {
                    this.inputNode.value = autocomplete
                    this.inputNode.setSelectionRange(input.length, autocomplete.length)
                }
            }

            updateResults = () => {
                const input = this.inputNode.value
                const results = this.searchFn(input)

                this.hideResults()
                if (results.length === 0) {
                    return
                }

                this.resultsNode.innerHTML = results.map((result, index) => {
                    const isSelected = this.shouldAutoSelect && index === 0
                    if (isSelected) {
                        this.activeIndex = 0
                    }
                    return `
            <li
                id='autocomplete-result-${index}'
                class='autocomplete-result${isSelected ? ' selected' : ''}'
                role='option'
                ${isSelected ? "aria-selected='true'" : ''}
                >
                ${result}
            </li>
        `
                }).join('')

                this.resultsNode.classList.remove('hidden')
                this.rootNode.setAttribute('aria-expanded', true)
                this.resultsCount = results.length
                this.shown = true
                this.onShow()
            }

            hideResults = () => {
                this.shown = false
                this.activeIndex = -1
                this.resultsNode.innerHTML = ''
                this.resultsNode.classList.add('hidden')
                this.rootNode.setAttribute('aria-expanded', 'false')
                this.resultsCount = 0
                this.inputNode.setAttribute('aria-activedescendant', '')
                this.onHide()
            }
        }

        const search = input => {
            if (input.length < 1) {
                return []
            }
            return data.filter(item => item.toLowerCase().startsWith(input.toLowerCase()))
        }

        const autocomplete = new Autocomplete({
            rootNode: document.querySelector('.autocomplete'),
            inputNode: document.querySelector('.autocomplete-input'),
            resultsNode: document.querySelector('.autocomplete-results'),
            searchFn: search,
            shouldAutoSelect: true
        })
    </script>

</body>

</html>