<?php 
session_start();
include "include/tstconexao.php";
//Recebe a busca
$busca=$_GET['btPesquisar'];
//Se não houver busca volta para index
if(!isset($busca)){
    echo "<script>document.location='index.php'</script>";
}
$pesquisar = $_GET['pesquisar']; 
//$pegavalores = "SELECT  comercio.idcomercio, comercio.imagem, comercio.nome_fantasia, comercio.telefone, segmento.nome FROM comercio,segmento WHERE segmento.nome LIKE '%$pesquisar%' OR comercio.nome_fantasia LIKE '%$pesquisar%' and status = 1 GROUP BY (idcomercio) ORDER BY CDL ASC" ;   


// procura por todos os dados que seja igual a busca
$pegavalores = "SELECT  * FROM comercio,segmento 
WHERE (idsegmento=segmento_idsegmento) AND 
(segmento.nome LIKE '%$pesquisar%' OR 
descricao_negocio LIKE '%$pesquisar%' OR 
bairro LIKE '%$pesquisar%' OR 
rua LIKE '%$pesquisar%' OR 
razao_social LIKE '%$pesquisar%' OR 
comercio.nome_fantasia LIKE '%$pesquisar%') AND
(comercio.status = 1) GROUP BY (idcomercio) ORDER BY CDL ASC" ;   
?>
 
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <!-- Palavras chaves para SEO -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Catálogo empresarial da cidade de Cataguases - MG. O site funciona como uma grande vitrine digital que aproxima potenciais consumidores dos comerciantes e prestadores de serviços.">
    <meta name="keywords" content="Comércio local, Cataguases,Catálogo, Vitrine, Marketing Digital, Empresas, Comércio, Prestadores de serviço, procurar por comercios, busca por lojas">
    <meta name="author" content="Prefeitura de Cataguases">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="style/style.css" rel="stylesheet">

    <title>VitrineKta</title>

</head>

<body>

    <!--Navigation Bar (CABEÇALHO)-->

    <?php include "include/cabecalho.php"; ?>
    <!--Campo de Pesquisa-->
    <div class="row">
        <div class="col-md-12" id="linha-pesquisa"  >
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
     <!--Fim do Campo de Pesquisa-->

    <!--Mapa de Localização-->

    <?php
    include './include/mapa.php';
    ?>
    <!--Fim doMapa de Localização-->
    
    <!-- Cards empresas -->

<div class="container">
    <div class="row g-0" style=' width:100%'>
        <div class="col-12 col-sm-12 col-md-12">
            <div class="row">
                <?php
                // Buscando do banco de dados cards do pesquisar
                $result = $conexao->query($pegavalores); 
                // Gerando colunas de acordo com a quantidade de cards (mysqli_num_rows conta a quantidade de itens)
                if($result->num_rows != 0  ){
                while ($row_linha = mysqli_fetch_assoc($result)) {
                    if (mysqli_num_rows($result) == 1) {
                        echo "<div class='col-12 col-sm-6 col-md-4'>";
                    } 
                    else if (mysqli_num_rows($result) == 2) {
                        echo "<div class='col-12 col-sm-6 col-md-4'>";
                    } 
                    else if (mysqli_num_rows($result) == 3) {
                        echo "<div class='col-12 col-sm-6 col-md-4'>";
                    } 
                    else if (mysqli_num_rows($result) >= 4) {
                        echo "<div class='col-12 col-sm-6 col-md-3'>";
                    }
                ?>
                   
                    <!--Card  -->
                    <a href="individual.php?id=<?php echo $row_linha['idcomercio'];?>" style=" text-decoration:none;">
                        <div class="card">
                            <div class="card-img">
                                <img class="card-img-top" src='<?php echo "images/" . $row_linha['imagem']; ?>' alt='Imagem de capa do card'>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row_linha['nome_fantasia']; ?></h5>
                                <p class="card-text"><?php echo $row_linha['telefone']; ?></p>
                            </div>
                         </div>  
                                
                    </a>
                    <!--Fim Card  -->
                </div>  
                <?php }}
                
                else{
                    echo "<h2 id='notfound' style='margin: 100px; margin-top:25px;'>Nenhum estabelecimento encontrado<h2>";
                }
                ?>
            </div>
        </div>
        </div>

        <!-- Carrosel -->

    
    </div>


    <!-- Footer -->
    <br><br><br><br><br><br><br><br><br>
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
    <script src="js/main.js"></script>

</body>

</html>