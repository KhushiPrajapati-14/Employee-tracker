<?php
session_start();
     
$con=mysqli_connect("localhost","root","","empfitrack");


  $id=$_POST['EmployeeID1'];
  $lat="SELECT * FROM webtable WHERE EmployeeID=$id ";
  $result1=mysqli_query($con,$lat);
  $res_1 = mysqli_fetch_array($result1);
//   $lng="SELECT * FROM webtable WHERE EmployeeID=$id ";
//   $result2=mysqli_query($con,$lng);
  
//   $res_2 = mysqli_fetch_array($result2);
 

?>

<!DOCTYPE html>
<html>

<head>
    <title>Display Location</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <style type="text/css">
        
        
        #map 
        {
            height: 100%;
        }
        
        
        html,
        body {
            height: 98.5%;
            margin: 0;
         
            padding: 0;
        }
     
        .relative {
            padding-left: 590px;
            padding-bottom:10px;
            position: relative;
            background-color: #fff;
            margin: 10px;
        }
        
        button {
            display: inline-block;
            width: 200px;
            height: 30px;
            text-align: center;
            border: gray;
            background-color:#040035;
            color: #fff;
            cursor: pointer;
            font-weight: bold;
            align:center;
        }
        
        button[type=button]:hover,
        button[type=submit]:hover,
        button[type=reset]:hover {
            background-color: #fdbe34;
            
        }
        
        button[type=button]:active,
        button[type=submit]:active,
        button[type=reset]:active
        {
            -moz-transform: scale(0.95);
            -webkit-transform: scale(0.95);
            -o-transform: scale(0.95);
            -ms-transform: scale(0.95);
            transform: scale(0.95);
            
        }
        
    </style>
    

   
     <script>
        function initMap() {
    
                  
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 10,
                center: {lat:19.07283, lng:72.88261},
            });
       
            var myLatLng = {

                lat: <?php echo $res_1['Task1Latitude']; ?>,
                lng: <?php echo $res_1['Task1Longitude']; ?>
               
            };
            var myLatLng_1 = {

                lat: <?php echo $res_1['Task2Latitude']; ?>,
                lng: <?php echo $res_1['Task2Longitude']; ?>

            };
            var myLatLng_2 = {

                lat: <?php echo $res_1['Task3Latitude']; ?>,
                lng: <?php echo $res_1['Task3Longitude']; ?>

            };
            var myLatLng_3 = {

                lat: <?php echo $res_1['Task4Latitude']; ?>,
                lng: <?php echo $res_1['Task4Longitude']; ?>

            };
          

          
        
            
            <?php 

                $msg="";

                if($res_1['Task2Latitude']==0 && $res_1['Task2Longitude']==0)
                {
                    $msg=" (Current Location)";
                }
                $msg1="";
                
                if($res_1['Task3Latitude']==0 && $res_1['Task3Longitude']==0)
                {
                    $msg1=" (Current Location)";
                } 
                $msg2="";
                
                if($res_1['Task4Latitude']==0 && $res_1['Task4Longitude']==0)
                {
                    $msg2=" (Current Location)";
                }  
               
            
            
            
            
            if($res_1['Task1Latitude']!=0 && $res_1['Task1Longitude']!=0) {
                ?>
                    new google.maps.Marker({
                        position: myLatLng,
                        map,
                        title: "<?php echo "Task 1".$msg ; ?>",
                    });
            <?php 
            }
            if($res_1['Task2Latitude']!=0 && $res_1['Task2Longitude']!=0) {
                ?>
                    new google.maps.Marker({
                        position: myLatLng_1,
                        map,
                        title: "<?php echo "Task 2".$msg1 ; ?>",
                    });
            <?php 

            
            }
            if($res_1['Task3Latitude']!=0 && $res_1['Task3Longitude']!=0) {
                ?>
                    new google.maps.Marker({
                        position: myLatLng_2,
                        map,
                        title: "<?php echo "Task 3".$msg2 ; ?>",
                    });
            <?php 
            }if($res_1['Task4Latitude']!=0 && $res_1['Task4Longitude']!=0) {
                ?>
                    new google.maps.Marker({
                        position: myLatLng_3,
                        map,
                        title: "Task 4 (Current Location)",
                    });
            <?php 
            }
        
            ?>

            
        }
    </script> 
</head>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&callback=initMap&libraries=&v=weekly" async></script>
<body>
    <div id="map"></div>
   
    <div class="relative">
    <form method="POST" action="emploc.php">
        <button type="submit" class="fadeIn fourth" value="Back" > Back </button>
    </form>
    </div>
  
    
</body>

</html>