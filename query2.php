<?php
 $temp = ''
 ?>
 <!--template for all pages-->
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!--custom css-->
    <link rel = "stylesheet" href = "css/bootstrap.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,900" rel="stylesheet">
  </head>
  <body>
    <nav class = "navbar navbar-expand-md">
        <a href = "#" style = "color: #FAFEF9" class = "navbar-brand"> Q/A App for farmers </a>
        <div id="google_translate_element"></div>
        <button type="button" data-target="#menu" data-toggle="collapse" aria-controls="menu" aria-expanded="false" aria-label = "toggle navigation" class="navbar-toggler navbar-dark" >
                <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="menu">
                
                <ul class = "navbar-nav ml-auto">
                    <li class = "nav-item active">
                        <a class = "nav-link" href = "#">Ask question</a>
                    </li>
                    <li class = "nav-item">
                        <a class = "nav-link" href = "#">Frequently asked</a>
                    </li>
                    <li class = "nav-item">
                            <a class = "nav-link" href="#">My questions</a>
                    </li>
                    <li class = "nav-item">
                            <a class = "nav-link" href="#">Signout</a>
                    </li>
                </ul>
        </div>           
    </nav>

    <div class = "container text-center">
        <h1>Krishi Sahayak</h1>
    </div>
    <hr>

    <div class = "container">
        <!--main body starting here-->
        <h6> Vegetable plants spacing </h6><br>
    <form action = "query2.php " method = "POST">

    <label for= "cause">Select vegetable: </label>
    <select required class="form-control" name="cause" id="cause">
            <option value = '' selected disabled>-- Vegetable -- </option>
            <option>Asparagus	</option>
            <option>Beans, Broad	</option>
            <option>Beans, Lima bush pole	</option>
            <option>Beans, Snap or Green bush pole	</option>
            <option>Beetroot	</option>
            <option>Broccoli	</option>
            <option>Brussels Sprouts	</option>
            <option>Cabbage	</option>
            <option>Carrot	</option>
            <option>Cauliflower	</option>
            <option>Celery	</option>
            <option>Chard	</option>
            <option>Chayote	</option>
            <option>Chick pea	</option>
            <option>Chicory	</option>
            <option>Chinese Cabbage	</option>
            <option>Collards	</option>
            <option>Corn	</option>
            <option>Cucumber	</option>
            <option>Eggplant	</option>
            <option>Endive	</option>
            <option>Horseradish	</option>
            <option>Kale	</option>
            <option>Kohlrabi	</option>
            <option>Leek	</option>
            <option>Lettuce	</option>
            <option>Muskmelon	</option>
            <option>Mustard	</option>
            <option>Okra	</option>
            <option>Onion sets seeds	</option>
            <option>Peas	</option>
            <option>Peanut	</option>
            <option>Pepper	</option>
            <option>Potato	</option>
            <option>Sweet Potato	</option>
            <option>Pumpkin	</option>
            <option>Radish	</option>
            <option>Shallot	</option>
            <option>Sorrel	</option>
            <option>Soybean	</option>
            <option>Spinach	</option>
            <option>Squash, Summer	</option>
            <option>Squash, Winter	</option>
            <option>Tomato	</option>
            <option>Watermelon	</option>
    </select> <br>
    <input type="submit" value="SUBMIT" name="submit" class="btn btn-lg btn-primary btn-block">
    </form>
<br><br><br>
    

     <?php     
     $_SESSION['var1']='';
     $servername = "localhost";
     $username = "root";
     $password = "";
     $dbname = "ks";
     
     // Create connection
     $conn = new mysqli($servername, $username, $password, $dbname);
     // Check connection
     if ($conn->connect_error) {
         die("Connection failed: " . $conn->connect_error);}
    if(isset($_POST['submit']))
    {   
        $cause=$_POST['cause'];
        $sql = "SELECT plant,inchBwPlants, depthOfSeed FROM vps where plant = '".$cause."'";
        $result = $conn->query($sql);
        if($result){ 
            if ($result->num_rows > 0) {
                //displaying the table header
                echo '<h3>'."Calender for common crops".'</h3><div class = "table-responsive"><table class = "table"><thead><tr><th>'."Plant".'</th><th>'."Inch between plants".'</th><th>'."Depth of seed".'</th></tr></thead><tbody>';
                while($row = $result->fetch_assoc()) {
                    echo '<tr><td>'.$row['plant'].'</td><td>'.$row['inchBwPlants'].'</td><td>'.$row['depthOfSeed'].'</td></tr>';     
                }
            } else { echo "Try with different values.";}
    }
}
   
    $conn->close();
    ?>
        </table>
        <br><br>
</div>
</div>


        
    </div>
    <script type="text/javascript">
        function googleTranslateElementInit() {
          new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
        }
        </script>
        <script type="text/javascript" src="http://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>