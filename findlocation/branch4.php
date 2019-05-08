<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/location.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js">
     <!-- font embeded -->
    <link href="https://fonts.googleapis.com/css?family=Cinzel:700|Lato|Montserrat|Open+Sans|Roboto|Shadows+Into+Light" rel="stylesheet">

    <title>Branch 1</title>
    <style>
        .row{
            text-align: center;
        }
        .storeimg{
            width: 500px;
            height: 400px;
            text-align: center;
            margin:0 auto;
        }
        .infobox{
            width: 500px;
            height: 400px;
            text-align: center;
            background-color: white;
        }

        @media(max-width:600px){
         .storeimg{
        max-width:200px;
        max-height: 200px;
    }
  }
        .headings{
            font-family: 'Montserrat', sans-serif;
            color:#8B0000;
            font-size: 20px;
            font-weight: 800;
            margin-top: 15px;
        }
        p{
            margin:0;
            text-align: left;
            margin-left: 10px;
        }
        #mapbutton{
            background-color: #8B0000;
            border: 1px solid #8B0000;
            width: 220px;
            height: 40px;
        }
        #mapbutton:hover{
            background-color: white;
            border: 1px solid #8B0000;
            color: #8B0000;
        }
    </style>
</head>
<body>
    <br><br><br>
    <div class="container">
        <div class="row">
            <div class="imgbox col-xs-12 col-md-6">
                <img src="../images/location4.jpg" class="storeimg" alt="storeimg">
            </div>
            <div class="infobox col-xs-12 col-md-6">
                <div class="addressbox">
                    <p class="headings">Address</p>
                    <p>10 hobson street, auckland CBD</p>
                    <br>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="workinghours">
                            <p class="headings">Service hours</p>
                            <p>Mon: 9AM-8PM</p>
                            <p>Tue: 9AM-8PM</p>
                            <p>Wed: 9AM-8PM</p>
                            <p>Thu: 9AM-8PM</p>
                            <p>Fri: 9AM-8PM</p>
                            <p>Sat: 10AM-8PM</p>
                            <p>Sun: 11AM-8PM</p>
                        </div> 
                        <br>
                        <div class="contactinfo">
                            <p class="headings">Contacts</p>    
                            <p> email: abbbaaa@gmail.com</p>
                            <p> phone: 0214254642</p>
                        </div>
                    </div>
                        <div class="mapinfo">
                            <img src="../images/map1.jpg" style="width: 220px; height: 250px;margin-right:10px;" alt="">
                            <button id="mapbutton" type="submit" class="btn btn-primary" onclick="location.href='https://goo.gl/maps/BigzMFapgzQp29ef8';">GET DIRECTIONS</button>
                        </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>