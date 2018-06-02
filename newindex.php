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



<!--main body-->
    <div class = "container">
    <!-- tab starts here-->
    <div class="container">

        <!--defining tab headings-->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a style="color:#2b5e40" class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Solved</a>
            </li>
            <li class="nav-item">
                <a style="color:#2b5e40" class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                    aria-selected="false">Unsolved</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <br>
                <div class = "card border-light mb-3">
                <div class = "card-body">
                    <div class = "card-body">
                        some php that checks the type of question and then displays it in the apt format. define format in some other file.
                    </div>
                </div>
                </div>        
                <br>
                <div class = "card border-light mb-3">
                <div class = "card-body">
                    <div class = "card-body">
                        some php that checks the type of answer and then displays it in the apt format. specify answer in some other format
                    </div>
                </div>
        </div>
                
                <br>
                option to insert comment must be in all three formats. similar to uplaod answer option. 
                <hr>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <br>
                    <a href="#"> + upload question here </a>
                    check the type of question and display accordingly

                    <br>
                            </div>
        </div>
    </div>









        
    </div>
<!--ending here-->



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