<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="../css/location.css">
     <!-- bootstrap -->
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
     <!-- font embeded -->
      <link href="https://fonts.googleapis.com/css?family=Cinzel:700|Lato|Montserrat|Open+Sans|Roboto|Shadows+Into+Light" rel="stylesheet">

    <title>Find Location</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script>
      $(document).ready(function(){
        // Set trigger and container variables
        var trigger = $('.locationselect'),
            container = $('#content');
        
        // Fire on click
        trigger.on('click', function(){
          // Set $this for re-use. Set target from data attribute
          var $this = $(this),
            target = $this.find(':selected').data('target');       
          
          // Load target page into container
          container.load(target + '.php');
          
          // Stop normal link behavior
          return false;
        });
      });
    </script>

</head>
<body>  
        <div id="background"></div>
        <div class="container-fluid">
            <div class="overlay-content">
                <div class="row">
                    <div class="formbox col-md-12">
                        
                                                <label class="indication" for="select">Choose your destination</label><br>
                                                <select class="locationselect" name="locationselect" id="selection">                             
                                                <option value="">Select</option>
                                                <option value="M" data-target="main" >Main warehouse</option>
                                                <option value="B1" data-target="branch1">Branch 1</option>
                                                <option value="B1" data-target="branch2">Branch 2</option>
                                                <option value="B1" data-target="branch3">Branch 3</option>
                                                <option value="B4" data-target="branch2">Branch 4</option>
                                                <option value="B5">Branch 5</option>
                                                <option value="B6">Branch 6</option>
                                                <option value="B7">Branch 7</option>
                                                <option value="B8">Branch 8</option>
                                                <option value="B9">Branch 9</option>
                                                <option value="B10">Branch 10</option>
                                                </select>
                                                <button id="searchbutton" type="submit" class="btn btn-primary">Search</button>
                        </div>
                
                </div>
                <div class="row">
                    <article class="infoarea" id="content"> 
]
                    </article>
                </div>
            </div>
        </div>

     <!-- bootstrap /js -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script> -->
    <script type="text/javascript" src="../js/sub.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

</body>
</html>