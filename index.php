<?php
     if(!empty($_POST['city'])){
         header("Location: information.php?city=" . $_POST['city'] . '&unit'); //takes the city the user has entered and put it un the URL as well as navigating to a new page. The URL also comtains an empty unit querry paramiter 
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
            <div class="col-sm"></div>
            <div class="col-sm-8 text-white p-3 rounded vertical-center">
                <h2>Weather check</h2>
                <form method="POST" action="">
                    <input type="text" name="city" placeholder="Enter the name of a city..." class="search">
                    <button type="submit" class="btn btn-primary submit-search">Search</button>
                </form>
            </div>
            <div class="col-sm"></div>
        </div>
    </div>
    


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>