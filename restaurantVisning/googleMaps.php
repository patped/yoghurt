<?php
    echo "
        <script>
          function initMap() {
          var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 17,
            center: {lat: 0, lng: 0}
          });
          var geocoder = new google.maps.Geocoder();

            geocodeAddress(geocoder, map);
        }

        function geocodeAddress(geocoder, resultsMap) {
          var address = '$fullAdresse';
          geocoder.geocode({'address': address}, function(results, status) {
            if (status === 'OK') {
                document.getElementById('map').hidden=false;
              resultsMap.setCenter(results[0].geometry.location);
              var marker = new google.maps.Marker({
                map: resultsMap,
                position: results[0].geometry.location
              });
            } else {
              document.getElementById('map').hidden=true;
            }
          });
        }
                            </script>
                            
    ";  ?>
