

<?php 

    $pieces = explode(",", $_POST['to']);
    $pieces1 = explode(",", $_POST['from']);

    $coordinates1 = get_coordinates($pieces1[0], $pieces1[1] , $pieces1[2]); // місто, вулиця,область
    $coordinates2 = get_coordinates($pieces[0], $pieces[1] , $pieces[2]); // місто, вулиця,область

    if (!$coordinates1 || !$coordinates2) {
      echo 'Bad address.';
    }
    else {
      $dist = GetDrivingDistance($coordinates1['lat'], $coordinates2['lat'], $coordinates1['long'], $coordinates2['long']);
      echo '<br>Distance: <b>'. $dist['distance'].'</b><br>Travel time duration: <b>'.$dist['time'].'</b>';
    }

  function GetDrivingDistance($lat1, $lat2, $long1, $long2) {
    $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$lat1.",".$long1."&destinations=".$lat2.",".$long2."&mode=driving&language=gb-gb";
    //echo "string <a href='".$url."'>Go to url</a>";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $response = curl_exec($ch);
    curl_close($ch);
    $response_a = json_decode($response, true);
    $dist = $response_a['rows'][0]['elements'][0]['distance']['text'];
    $time = $response_a['rows'][0]['elements'][0]['duration']['text'];

    return array('distance' => $dist, 'time' => $time);
  }

  function get_coordinates($city, $street, $province) {
    $address = urlencode($city.','.$street.','.$province);
    $url = "http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=GB";
    //echo "string <a href='".$url."'>Go to url</a>";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $response = curl_exec($ch);
    curl_close($ch);
    $response_a = json_decode($response);
    $status = $response_a->status;

    if ( $status == 'ZERO_RESULTS') {
      return FALSE;
    }
    else {
      $return = array('lat' => $response_a->results[0]->geometry->location->lat, 'long' => $long = $response_a->results[0]->geometry->location->lng);
      return $return;
    }
  }
?>


<script>
 

      var lat1 = <?php echo $coordinates1['lat'] ? json_encode($coordinates1['lat']) : "null";  ?>; // дані одної точки
      var lat2 = <?php echo $coordinates2['lat'] ? json_encode($coordinates2['lat']) : "null";  ?>; // дані одної точки

      var long1 = <?php echo $coordinates1['long'] ? json_encode($coordinates1['long']) : "null";  ?>; // дані другої точки
      var long2 = <?php echo $coordinates2['long'] ? json_encode($coordinates2['long']) : "null";  ?>; // дані другої точки
      var dist = <?php echo $dist['distance'] ? json_encode($dist['distance']) : "null";  ?>; // дистанція з першого скрипта 

      var time = <?php echo $dist['distance'] ? json_encode($dist['time']) : "null";  ?>; // тривалість з першого скрипта 

</script>