<?php include ROOT . '/views/layout/header.php'; ?>

<section>
    <div class="container">
        <div class="row">

            <div class="col-sm-8  padding-right">

                    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
                    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC_KTpWta5tQW3fF_MLvEXFUx2wlt7yZdE&callback=initMap" type="text/javascript"></script>
                    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
                    <div class="maps" style="  position: relative;  margin: 2% 0;">
                        <h3>You can knwo how arrive to us</h3>
                        <h4>just write your address</h4>
                     
                            <input type="text" style="margin-top: 2%;border: 1px solid; padding: 1%;" class="from" name="from" placeholder="to adress" value="Львів,Пасічна 26, Львівська область" >
                            <input type="text" class="to" name="to" placeholder="to adress" value="<?=$_POST['to'];?>" style="margin-top: 2%;border: 1px solid; padding: 1%;">
                            <button id="show_map">Show Map</button>
                        
                        
                        <div id="blok" style="height: 100px;"></div>
                        <div id="map-canvas" style="height: 400px; margin: 0px; padding: 0px"></div>
                    </div>

                <br/>
                <br/>
            </div>
            <div class="col-sm-4  padding-right">

                <?php if ($result): ?>
                    <p>Message has been sent! We will answer on your email.</p>
                <?php else: ?>
                    <?php if (isset($errors) && is_array($errors)): ?>
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li> - <?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>

                    <div class="signup-form"><!--sign up form-->
                        <h2>Connect</h2>
                        <h5>Have a question? Write here</h5>
                        <br/>
                        <form action="#" method="post">
                            <p>Your name</p>
                            <input type="text" name="userName" placeholder="Name" value="<?php echo $name; ?>"/>
                            <p>Your email</p>
                            <input  type="email" name="userEmail" placeholder="E-mail" value="<?php echo $email; ?>"/>
                            <p>Message</p>
                            <textarea name="userText" placeholder="Message"><?php echo $userText; ?></textarea> 
                            <br/>
                            <input type="submit" name="submit" class="btn btn-default" value="Send" />
                        </form>
                    </div><!--/sign up form-->
                <?php endif; ?>

                <br/>
                <br/>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">

  $(document).ready(function(){
    $('#show_map').click(function(){
        var data = {
            from : $(".from").val(),
            to : $(".to").val()
        }
        $.ajax({
            url : "/ajax.php",
            data : data,
            method: "POST",
            success: function(data){
                console.log('good');
                console.log(data);
                $('#blok').html("<p>"+data+"</p>");


                initialize();
            },
            error: function(data){
              alert("Error")
            }
         }).done(function() {
              console.log("Done.");
            });

        return false;
        });
    });

</script>

<script type="text/javascript">

    var map;
    function initialize() {
      var map;
      var mapOptions = {
        zoom: 2,
        center: new google.maps.LatLng(lat1, long1) // дані одної точки
      };
      map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
      var directionsDisplay = new google.maps.DirectionsRenderer();
      var directionsService = new google.maps.DirectionsService();
      directionsDisplay.setMap(map);
      directionsDisplay.setOptions( { suppressMarkers: true, suppressInfoWindows: true } );
      
      var start_point = new google.maps.LatLng(lat1, long1); // дані одної точки
      var end_point = new google.maps.LatLng(lat2, long2); // дані другої точки
      
      var marker = new google.maps.Marker({
        position: start_point,
        map: map
      });
      
      var marker = new google.maps.Marker({
        position: end_point,
        map: map
      });   

      google.maps.event.addListener(marker, 'click', function () {
        infowindow.open(map, this);
      });     
      
      var request = {
       origin: start_point,
       destination: end_point,
       travelMode: google.maps.TravelMode.DRIVING,
       unitSystem: google.maps.UnitSystem.METRIC,
       provideRouteAlternatives: true,
       avoidHighways: false,
       avoidTolls: true
      };
      directionsService.route(request, function(result, status) {
       if (status == google.maps.DirectionsStatus.OK) {
        directionsDisplay.setDirections(result);
        var routes = result.routes;
        var leg = routes[0].legs;
        var lenght = leg[0].distance.text;
        var duration = leg[0].duration.text;
        infowindow = new google.maps.InfoWindow({ content: 'Дистанція: '+dist+'<br>Тривалість: '+time });
        infowindow.open(map, marker);
       }
      });
    }
    google.maps.event.addDomListener(window, 'load', initialize);

</script>

<?php include ROOT . '/views/layout/footer.php'; ?>