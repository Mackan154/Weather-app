<?php
    $exists = true;

    
    $kelvinConvert;
    $unit; 

    $city = $_GET['city'];
    //Collects information on the current information from the city the user searched on. The @ ignors errors from the API if user has entered the name of a city that does not exist
    $APIData = @file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=". $city ."&appid=a4ef76854eb4c5f92d3854a84b54b21c");

    //Checkes if the API found the city and if it does it converets Json encoded sting to PHP usable values
    if(empty($APIData)){
        $exists = false;
    }else{
        $informationArray = json_decode($APIData, true);
    }

    //if the city exists convert unit from kelvin to faharenheit (if unit in URL is equal to fahrenheit) otherwise celsius
    //the converted temprature is rounded to only contain two decimals
    if($exists){
        if($_GET['unit'] == "fahrenheit"){
            $temp = round(($informationArray['main']['temp'] - 273.15) * 9/5 + 32, 2);
            $minTemp = round(($informationArray['main']['temp_min'] - 273.15) * 9/5 + 32, 2);      
            $maxTemp = round(($informationArray['main']['temp_max'] - 273.15) * 9/5 + 32, 2);
            $unit = "°F";
        }
        else{
            $temp = round($informationArray['main']['temp'] - 273.15, 2);
            $minTemp = round($informationArray['main']['temp_min'] - 273.15, 2);      
            $maxTemp = round($informationArray['main']['temp_max'] - 273.15, 2);
            $unit = "°C";
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather check</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm mt-4">
                <a href="index.php">
                <button type="button" class="btn btn-secondary">Back</button></a>
            </div>
            <div class="col-sm-8 text-white p-3 rounded vertical-center-information">
                <h2>Weather check</h2>
                <div class="row">
                    <div class="col-sm"></div>
                    <div class="col-sm-5 lightgray-background rounded">
                        <h5>Current weather:</h5>
                        <div class="text-center">
                            <?php
                            //if the city the user has entered exists a weather description, current temperature, min and max temperature of the day as well as current windspeed and current humidity are displayed.
                            if($exists){
                            ?>
                            <strong>
                            <?="Weather: " . $informationArray['weather']['0']['main'] ?>
                            </strong>
                             <br>
                             <strong><?php 
                             echo( "Temprature: " . $temp . " " . $unit);
                             ?></strong>
                             <br>
                             <strong>
                                <?php                                
                                echo("Temprature range: " . $minTemp . " " . $unit . " - " . $maxTemp . " " . $unit);
                                ?>
                             </strong>
                                <br>
                             <strong>
                                <?="Wind speed: " . $informationArray['wind']['speed'] . " m/s"?>
                             </strong>
                             <br>
                             <strong>
                                <?="Humidity: " . $informationArray['main']['humidity'] . " %"?>
                             </strong>
                             <br>
                             <br>
                             <a href="<?= "information.php?city=" . $city . "&unit=celsius" ?>" >
                            <button type="button" class="btn btn-primary submit-search">Celsius</button></a>
                        <a href="<?= "information.php?city=" . $city . "&unit=fahrenheit" ?>" >
                            <button type="button" class="btn btn-primary submit-search">Fahrenheit</button></a>
                            <br><br>

                             <?php
                            }
                            //if the city does not exist (can't be found) the error massage "Can't find the city you're looking for" will be displayed in red.
                            else{
                             ?>
                            <strong class="text-danger">Can't find the city you're looking for</strong>
                             <?php
                             }
                             ?>
                        </div>
                    </div>
                    <div class="col-sm"></div>
                </div>
                
            </div>
            <div class="col-sm"></div>
        </div>
    </div>
    


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>