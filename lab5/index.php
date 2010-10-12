<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <title>Lab 5: Web services</title>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script type="text/javascript">
      var map;
      
      function initialize() {
        // Google
        var myOptions = {
          zoom: 12,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        map = new google.maps.Map(document.getElementById("google_result"), myOptions);
        
        set_map_to("Ryd, Linköping");
      }
    
      function set_map_to(address) {
        // Google
        geocoder = new google.maps.Geocoder();
        
        geocoder.geocode( { 'address': address}, function(result, status) {
          map.setCenter(result[0].geometry.location);
        });
      }
    </script>
  </head>
  <body onload="initialize()">
    <div id="googlemaps" style="height:600px; width:700px;">
      <h1>Google Maps API</h1>
      <p>Ryd, Linköping</p>
      <div id="google_result" style="height:100%; width:100%"></div>
    </div>
    <div id="yahoo" style="margin-top:130px;">
      <?php        
        $address = "Manhattan, New York";
        $url = 'http://local.yahooapis.com/MapsService/V1/geocode?appid=YD-9G7bey8_JXxQP6rxl.fBFGgCdNjoDMACQA--&output=php&location=' . urlencode($address);
        
        $result = unserialize(file_get_contents($url));
        
        $lat = $result['ResultSet']['Result']['Latitude'];
        $lng = $result['ResultSet']['Result']['Longitude'];
        
      ?>
      <h1>Yahoo API</h1>
      <p>Manhattan, New York</p>
      <p id="yahoo_result">
        Latitude: <?php echo $lat; ?><br />
        Longitude: <?php echo $lng; ?>
      </p>
      
      <?php 
        $url = 'http://local.yahooapis.com/MapsService/V1/mapImage?appid=YD-4g6HBf0_JX0yq2IsdnV1Ne9JTpKxQ3Miew--&latitude=' . urlencode($lat) . '&longitude=' . urlencode($lng);
        
        $result = file_get_contents($url);
        
        $xml = new SimpleXMLElement($result);
        $result = $xml->xpath('/Result');
        
        while(list( , $node) = each($result)) {
          $img = $node;
        }
      ?>
      <br /><img src="<?php echo $img ?>" /><br /><br /><br /><br />
      <img src="http://maps.google.com/maps/api/staticmap?center=<?php echo $lat . "," . $lng; ?>&amp;zoom=14&amp;size=600x700&amp;sensor=false" />
    </div>
  </body>
</html>