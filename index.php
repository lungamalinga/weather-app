<?php
require 'fullDayTheme.php';

error_reporting(E_ALL ^ E_NOTICE);

$city_input = $_POST['search-city'];
echo $city_input;

$api_key = 'CREATE_YOUR_API_KEY_FROM_OPEN_WEATHER_API';
$city_name = ($city_input == '')  ? 'London' : $city_input;

#get latitude and longitude
function getLat($city, $api_key)
{
     $api_url = 'http://api.openweathermap.org/data/2.5/forecast?q=' . $city . '&appid=' . $api_key . '&units=metric';
     $json = file_get_contents($api_url);
     $data = json_decode($json, true);
     $coords = array($data['city']['coord']['lat'], $data['city']['coord']['lon']);
     return $coords;
}

#returned lat and lon
$lati = getLat($city_name, $api_key)[0]; # latitude
$long = getLat($city_name, $api_key)[1]; # longitude

#substitute them to the link
$url = 'https://api.openweathermap.org/data/2.5/onecall?lat=' . $lati . '&lon=' . $long . '&exclude=hourly,minutely&appid=' . $api_key . '&units=metric';

$json = file_get_contents($url);
if ($json == false) {
     #print_r('no city on site');
     header("refresh:0");
     echo '<script>alert("Invalid City");</script>';
} elseif ($json == true) {
     $data = json_decode($json, true);
}
$data = json_decode($json, true);

#end...

function dailyComponent(
     $theme_color,
     $icon,
     $temp,
     $min,
     $max,
     $rain,
     $humidity,
     $desdcription,
     $date,
     $day,
     $tempColor,
     $minColor,
     $maxColor,
     $rainColor,
     $humColor,
     $descColor
) {

     return '
   <div class="next-day-content">
   <div class="mini-date">
       <div id="small-font">' . $day . '</div>  
       <div id="big-font">
           ' . $date . '    
       </div>
   </div>
   <div class="day-theme" style="background-color: ' . $theme_color . ';">
       <img class="weather-icon" src="images/' . $icon . '" alt="">   
       <div class="day-temp" style="color:' . $tempColor . ';">' . $temp . '°</div>
       <div class="main-details-content">
           <div class="temp-details" style="color: ' . $minColor . ';">Min: ' . $min . '°</div>
           <div class="temp-details" style="color: ' . $maxColor . '">Max: ' . $max . '°</div>
           <div class="temp-details" style="color: ' . $rainColor . '">Rain: ' . $rain . 'mm</div>
           <div class="temp-details" style="color: ' . $humColor . '">Hum: ' . $humidity . '%</div>
           <div class="temp-details" style="color: ' . $descColor . '; padding-top: 5px; padding-bottom: 5px;"> ' . ucfirst($desdcription) . '</div>
       </div>
   </div>
</div>';
}

#generate dates ->
$datetime = new DateTime(date('y-m-d'));
$day_1 = $datetime->format('d');
$d_abr1 = $datetime->format('D');

$datetime = new DateTime(date('y-m-d'));
$datetime->modify('+1 day');
$day_2 = $datetime->format('d');
$d_abr2 = $datetime->format('D');

$datetime = new DateTime(date('y-m-d'));
$datetime->modify('+2 day');
$day_3 = $datetime->format('d');
$d_abr3 = $datetime->format('D');

$datetime = new DateTime(date('y-m-d'));
$datetime->modify('+3 day');
$day_4 = $datetime->format('d');
$d_abr4 = $datetime->format('D');

$datetime = new DateTime(date('y-m-d'));
$datetime->modify('+4 day');
$day_5 = $datetime->format('d');
$d_abr5 = $datetime->format('D');
#add days to an array to loop through
$days_dates = [$day_1, $day_2, $day_3, $day_4, $day_5];
$d_abrevs = [$d_abr1, $d_abr2, $d_abr3, $d_abr4, $d_abr5];

?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="css/style.css">
     <title>The Weather_</title>
</head>

<body>
     <!-- TODO: -->
     <video controls="hidden" autoplay = "autoplay" autoplay muted loop id="myVideo">
          <source src="videos/sky.mp4" type="video/mp4">
     </video>
     <img src="images/cloud.jpg" alt="">
     <div id="main-content">
          <div id="navigation">
               <div id="nav-content">
                    <a href="#footer-content">
                         About
                    </a> |
                    <a target="_blank" href="https://lungamalinga.netlify.app/">
                         Developer
                    </a> |
                    <a href="#footer-content">
                         API
                    </a>
               </div>
          </div>
          <div id="search-content">
               <form method="post">
                    <input class="bb" id="search-city" name="search-city" type="text" <?php echo 'placeholder="' . strtoupper($city_name) . '"'; ?> />
                    <input class="bb" id="search-btn" type="submit" value="Search" />
               </form>
          </div>
          <div id="transparent-tray">
               <div class="day-items">
                    <div id="today">Today</div>
                    <div id="date-day-today"><?php echo $day_1; ?> </div>
               </div>
               <div class="day-items">
                    <?php
                    echo '<img src="images/' . getFullTheme($data['daily'][0]['weather'][0]['description'])['icon'] . '" width="100%" height="120px" alt="">';
                    ?>
               </div>
               <div class="day-items">
                    <div id="temp-title">Temp:</div>
                    <div id="temp"><?php echo round($data['daily'][0]['temp']['max'], 0) . '°'; ?></div>
               </div>
               <div class="day-items">
                    <div id="v-center">
                         <div class="temp-content">Max: <?php echo round($data['daily'][0]['temp']['max'], 0); ?>°</div>
                         <div class="temp-content">Min: <?php echo round($data['daily'][0]['temp']['min'], 0); ?>°</div>
                         <div class="temp-content">Humidity: <?php echo  round($data['daily'][0]['humidity'], 0); ?>%
                         </div>
                         <div class="temp-content">Rain:
                              <?php echo ($data['daily'][0]['rain'] == '') ? 0 : $data['daily'][0]['rain']; ?>mm</div>
                         <div class="temp-content">
                              <?php echo ucfirst($data['daily'][0]['weather'][0]['description']); ?></div>
                    </div>
               </div>
          </div>
          <div class="" id="transparent-tray-2">
               <div class="next-five-day-data">
                    <?php
                    for ($i = 0; $i < 5; $i++) {
                         $max_ = round($data['daily'][$i]['temp']['max'], 0);
                         $min_ = round($data['daily'][$i]['temp']['min'], 0);
                         $humid_ = round($data['daily'][$i]['humidity'], 0);
                         $desc_ = $data['daily'][$i]['weather'][0]['description'];
                         $rain_c_ = ($data['daily'][$i]['rain'] == '') ? 0 : $data['daily'][$i]['rain'];

                         echo dailyComponent(
                              strval(getFullTheme($desc_)['bg color']),
                              strval(getFullTheme($desc_)['icon']),
                              $max_,
                              $min_,
                              $max_,
                              $rain_c_,
                              $humid_,
                              $desc_,
                              $days_dates[$i],
                              $d_abrevs[$i],
                              strval(getFullTheme($desc_)['temp color']),
                              strval(getFullTheme($desc_)['min color']),
                              strval(getFullTheme($desc_)['max color']),
                              strval(getFullTheme($desc_)['max color']),
                              strval(getFullTheme($desc_)['max color']),
                              strval(getFullTheme($desc_)['max color'])
                         );
                    }
                    ?>
               </div>
          </div>
          <div id="footer-content">
               <div class="footer-comp">
                    <h1>About</h1> <br>
                    <p>
                         This app is solely created by me (Lunga Malinga).<br>
                         It's just a basic weather web application, that uses an <br>
                         API, and returnd a five day weather forecast.<br>

                    </p>
                    <p>
                         THANK YOU FOR YOUR VISIT.
                    </p>
               </div>
               <div class="footer-comp">
                    <h1>API</h1> <br>
                    <p>
                         Data on this application is provided by OpenWeatherMap. <br>
                         I used the OpenWeatherMap API for the 5 day weather forecast.
                    </p>
                    <a href="https://openweathermap.org/api">
                         <img src="images/owa-logo.png" width="30%" height="auto" />
                    </a>
               </div>
          </div>
     </div>
     <main id="mobile-content">
          mobile content
     </main>
     </div>

     <script src="js/script.js"></script>
     
</body>
</html>