//NAO ESTÁ SENDO USADO 
//Pegar a latitude e longitude do usuário
function initMap() {
    // function getLocationLat(address) {
    //     var geocoder = new google.maps.Geocoder();
    //     geocoder.geocode({
    //       'address': address
    //     }, function(results, status) {
    //       if (status == google.maps.GeocoderStatus.OK) {
    //         var latitude = results[0].geometry.location.lat();

    //         var resultado = results[0].geometry.location.lat();
    //         localStorage.setItem("resu", resultado);
    //       }
    //     });
    //     return (localStorage.getItem("resu"));
    //   }

    //   function getLocationLng(address) {
    //     var geocoder = new google.maps.Geocoder();
    //     geocoder.geocode({
    //       'address': address
    //     }, function(results, status) {
    //       if (status == google.maps.GeocoderStatus.OK) {
    //         var longitude = results[0].geometry.location.lng();
    //         var resultado = results[0].geometry.location.lng();
    //         localStorage.setItem("resu2", resultado);
    //       }
    //     });
    //    return (localStorage.getItem("resu2"));
    //   }
     
    function getLocationLat(address) {
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({
            'address': address
        }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                var latitude = results[0].geometry.location.lat();
                //var longitude = results[0].geometry.location.lng();
                //alert ("{lat: " + latitude+ ", lng: " +longitude+  "},");
                // var resultado = "{lat: " + latitude+ ", lng: " +longitude+  "},";
                var resultado = results[0].geometry.location.lat();
                localStorage.setItem("resu", resultado);
                //localStorage.setItem("resu", latitude);
            }
        });
        document.getElementById("lat").value = latitude;
        return (localStorage.getItem("resu"));
    }

    function getLocationLng(address) {
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({
            'address': address
        }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                // var latitude = results[0].geometry.location.lat();
                var longitude = results[0].geometry.location.lng();
                //alert ("{lat: " + latitude+ ", lng: " +longitude+  "},");
                // var resultado = "{lat: " + latitude+ ", lng: " +longitude+  "},";
                var resultado = results[0].geometry.location.lng();
                localStorage.setItem("resu2", resultado);
                //localStorage.setItem("resu", latitude);
            }
        });
        document.getElementById("lng").value = longitude;
        return (localStorage.getItem("resu2"));
    }
    //Call the function with address as parameter
    // alert(getLocationLat('Rua Geraldino Ferraz, 352. Paraíso, Cataguases, MG, Brasil'));
    // alert(getLocationLng('Rua Geraldino Ferraz, 352. Paraíso, Cataguases, MG, Brasil'));
}


