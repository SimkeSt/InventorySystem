<?php   
 session_start();
 include("config.php"); //include the config
$db=new mysqli("$dbhost","$dbuser","$dbpass");
$db->select_db("$dbname");

 if(isset($_POST['login']))
 {
   $username =$_POST['username'];
   $password=$_POST['password'];
   $query="SELECT * FROM Worker WHERE Name = '$username' AND password = '$password'"; //quary
   $result=$db->query($query);
   $num_rows=$result->num_rows;
   for($i=0;$i<$num_rows;$i++)
   {   $row=$result->fetch_row();
	}
   if(($username==$row[1])&&($password==$row[3])) //checking the username and password if right
   {

    $tim=date("d/m/Y");
    $tim1=date("H:i");
    $space=" ";
    $file="logs.txt";
    $newLine="\n";
    $txt = "Worker $username has Logged in";
    file_put_contents($file,$tim1.$space.$tim.$space.$txt.$newLine,FILE_APPEND);
     $_SESSION['username']=$username;
	 Header("location:index.php");

   }
   else
   {
     echo 'Wrong credentials';
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Your description">
    <meta name="author" content="Your name">

    <!-- OG Meta Tags to improve the way the post looks when you share the page on Facebook, Twitter, LinkedIn -->
    <meta property="og:site_name" content="" /> <!-- website name -->
    <meta property="og:site" content="" /> <!-- website link -->
    <meta property="og:title" content=""/> <!-- title shown in the actual shared post -->
    <meta property="og:description" content="" /> <!-- description shown in the actual shared post -->
    <meta property="og:image" content="" /> <!-- image link, make sure it's jpg -->
    <meta property="og:url" content="" /> <!-- where do you want your post to link to -->
    <meta name="twitter:card" content="summary_large_image"> <!-- to have large image post format in Twitter -->

    <!-- Webpage Title -->
    <title>WHMS</title>
    
    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&family=Poppins:wght@600&display=swap" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/fontawesome-all.min.css" rel="stylesheet">
    <link href="css/swiper.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
        <link href="styles.css" rel="stylesheet">

    
    <!-- Favicon  -->
    <link rel="icon" href="images/favicon.jpg">
</head>
<body  style="background-image: url('images/header-background.jpg');">
    
    <!-- Navigation -->
    <nav id="navbar" class="navbar navbar-expand-lg fixed-top navbar-dark" aria-label="Main navigation">
        <div class="container">

            <!-- Image Logo -->
            <a class="navbar-brand" href="index.php"><b>WHMS</b></a> 

            <!-- Text Logo - Use this if you don't have a graphic logo -->
            <!-- <a class="navbar-brand logo-text" href="index.php">Elma</a> -->

            <button class="navbar-toggler p-0 border-0" type="button" id="navbarSideCollapse" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse offcanvas-collapse" id="navbarsExampleDefault">
                <ul class="navbar-nav ms-auto navbar-nav-scroll">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-expanded="false">Warehouses</a>
                        <ul class="dropdown-menu" aria-labelledby="dropdown01">
                            <li><a class="dropdown-item" href="loginform.php">Login to see warehouses</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="loginform.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="registerform.php">Register</a>
                    </li>

                </ul>
                <span class="nav-item social-icons">
                    <span class="fa-stack">
                        <a href="#your-link">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fab fa-facebook-f fa-stack-1x"></i>
                        </a>
                    </span>
                    <span class="fa-stack">
                        <a href="#your-link">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fab fa-twitter fa-stack-1x"></i>
                        </a>
                    </span>
                </span>
            </div> <!-- end of navbar-collapse -->
        </div> <!-- end of container -->
    </nav> <!-- end of navbar -->
    <!-- end of navigation -->

      
    <!-- Header -->
    <header id="header" class="header h-100">
               <div class="container">
             <div class="row">
                <div class="col-lg-4 offset-lg-4">
                                        <h1 style="color:white">Log In</h1>
                                        <br>
                    <!-- Contact Form -->
                    <form method="post" action="loginform.php">
                        <div class="form-group">
                        <input type="text" class="form-control-input" name="username" placeholder="UserName" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control-input" name="password" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="login" class="form-control-submit-button" value="Log In">
                        </div>
                    </form>
                    <!-- end of contact form -->

                </div> <!-- end of col -->
            </div>
        </div>
    </header> <!-- end of header -->
    <!-- end of header -->
   



    <button onclick="topFunction()" id="myBtn">
        <img src="images/up-arrow.png" alt="alternative">
    </button>
    <!-- end of back to top button -->
        
    <!-- Scripts -->
    <script src="js/bootstrap.min.js"></script> <!-- Bootstrap framework -->
    <script src="js/swiper.min.js"></script> <!-- Swiper for image and text sliders -->
    <script src="js/purecounter.min.js"></script> <!-- Purecounter counter for statistics numbers -->
    <script src="js/scripts.js"></script> <!-- Custom scripts -->
</body>
</html>