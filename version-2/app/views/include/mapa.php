 <?php
  if (isset($pesquisar)) {
    $result_geo =  "SELECT * FROM comercio,segmento
    WHERE segmento_idsegmento=idsegmento and nome LIKE '%$pesquisar%' OR nome_fantasia LIKE '%$pesquisar%' and status = 1";
  } else if (!isset($pesquisar)) {
    $result_geo = "SELECT * FROM comercio WHERE status = 1";
  }
  if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result_geo = "SELECT * FROM comercio WHERE idcomercio = $id";
  }

  $result = $conexao->query($result_geo);

  ?>

 <html>

 <head>
   <script src="https://api.mqcdn.com/sdk/mapquest-js/v1.3.2/mapquest.js"></script>
   <link type="text/css" rel="stylesheet" href="https://api.mqcdn.com/sdk/mapquest-js/v1.3.2/mapquest.css" />

   <script type="text/javascript">
     //https://developer.mapquest.com/documentation/mapquest-js/v1.3/examples/basic-geocoding
     //https://developer.mapquest.com/user/me/apps
     window.onload = function() {

       //chaves alternativas:
       //kUBydeFltLqlFwOlfJVCUE5GEiu6zEJc
       //EBTdbqWQXClaEngBGvRnvmAyHnHBA10Q
       //fzUbjJslAQDQA4wnlz3cLTgYCkfaZSbR
       //lie91CbaveExEwjcngJoKkZhNuQiIkBR
       //lG3tVlhLAS21KcJkovjAWh95GTDr2Pau
       //YkKS6vrSifF8LnbiHbNWvUAtTqUWAGI4

       L.mapquest.key = 'Ej4JJwaCp6hhI0Tw4NW54sxUInQXAwM3';

       L.mapquest.geocoding().geocode([<?php

                                        while ($row_linha = mysqli_fetch_assoc($result)) {
                                          if ($row_linha['rua'] != "") {
                                            echo "'" . $row_linha['rua'] . ", ";
                                            echo "" . $row_linha['numero'] . ", ";
                                            echo " cep " . $row_linha['CEP'] . ",";
                                            echo " cataguases, ";
                                            echo " mg ',";
                                          }
                                          // else if($row_linha['rua']==""){
                                          //   echo "' Praca Governador Valadares,";
                                          //   echo "176, " ;
                                          //   echo "cep 36770-071, ";
                                          //   echo " cataguases, ";
                                          //   echo " mg ',";
                                          // }

                                        }
                                        ?>], createMap);

       var descricao = [<?php
                        $result->data_seek(0);
                        while ($row_linha = mysqli_fetch_assoc($result)) {
                          if ($row_linha['rua'] != "") {
                            echo "'" . $row_linha['nome_fantasia'] . "' ,";
                          }
                        }
                        ?>];


       function createMap(error, response) {
         // Initialize the Map
         var map = L.mapquest.map('map', {
           layers: L.mapquest.tileLayer('map'),
           zoom: 16,
           center: [40000, 20000]
           
         });

         // Generate the feature group containing markers from the geocoded locations
         var featureGroup = generateMarkersFeatureGroup(response);

         // Add markers to the map and zoom to the features
         featureGroup.addTo(map);
         map.fitBounds(featureGroup.getBounds());
       }

       function generateMarkersFeatureGroup(response) {
         var group = [];
         for (var i = 0; i < response.results.length; i++) {
           var location = response.results[i].locations[0];
           var locationLatLng = location.latLng;

           // Create a marker for each location
           //var marker = L.marker(locationLatLng, {icon: L.mapquest.icons.marker()}).bindPopup(location.adminArea5 + ', ' + location.adminArea3 + ', ' + descricao[i]);
           var marker = L.marker(locationLatLng, {
             icon: L.mapquest.icons.marker()
           }).bindPopup(descricao[i]);

           group.push(marker);
         }
         return L.featureGroup(group);
       }
     }
   </script>
  
 </head>

 <body style="border: 0; margin: 0;">

   <div id="map"></div>

 </body>

 </html>