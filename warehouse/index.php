<?php   
 session_start();
 include("config.php"); //include the config
$db=new mysqli("$dbhost","$dbuser","$dbpass");
$db->select_db("$dbname");
if(isset($_SESSION['username']))
$ses=$_SESSION['username'];
?>


<!DOCTYPE html>
<html lang="en" style="background-image: url('images/header-background.jpg');">

<head
>
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

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="dropdown01" data-bs-toggle="dropdown" aria-expanded="false">Warehouses</a>
                        <ul class="dropdown-menu" aria-labelledby="dropdown01">
                        <?php
                            $sql = "SELECT * FROM Warehouse ";
                            $result = $db->query($sql);
                            if (isset($_SESSION['username'])){
                                if ($result->num_rows > 0) {
                                      while($row = $result->fetch_assoc()) {
                                        echo "<form action='warehouses.php' method='post'>";
                                        $id=$row['WHID'];
                                        $name="Name: " . $row["WName"] ."  Adress: " . $row["Adress"];
                                        echo "<a class='dropdown-item'> <button type='submit' name='id' class='btn btn-success' value='$id'>$name</button></a>";
                                        echo "</form>";
                                      }
                                    } else {
                                      echo "0 results";
                                    }
                            }
                            else echo '<a class="dropdown-item" href="loginform.php">Login to see warehouses</a></li>';
                        ?>

                        </ul>
                    </li>
                    <li class="nav-item">
                        <?php
                        if (isset($_SESSION['username'])){
                        $us=$_SESSION['username'];
                        $sql2 = "SELECT * FROM Worker WHERE Name= '$us'";
                        $result = $db->query($sql2);
                        $row1 = $result->fetch_assoc();
                        $mid=$row1['BinM'];
                        $aid=$row1['BinAd'];
                        if($mid==1)
                            echo '<li class="nav-item">
                            <a class="nav-link" href="logs.php">See Logs</a>
                            </li>';
                        if($aid==1){
                            echo '<li class="nav-item">
                            <a class="nav-link" href="WHCreate.php">Create Warehouses</a>
                            </li>';
                            echo '<li class="nav-item">
                            <a class="nav-link" href="choosewh.php">Import/Export Logs</a>
                            </li>';
                        }
                        echo '<li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                        </li>';
                         if($aid==1){
                            echo "<button type='button' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#modalung'>See Warnings</button>";

                         }
                         
                    }
                    else echo '<a class="nav-link" href="loginform.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="registerform.php">Register</a>
                        </li>'


                        ?>
                        

                </ul>
                
            </div> <!-- end of navbar-collapse -->
        </div> <!-- end of container -->
    </nav> <!-- end of navbar -->
    <!-- end of navigation -->

      
    <!-- Header -->
    <header id="header" class="header h-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="button-container">
                        <?php
                        if (isset($_SESSION['username'])){
                        echo "<h1 class='text-success'>Welcome $ses </h1>";
                    
                        echo '<a class="btn-solid-lg page-scroll" href="acset.php">Account settings</a>
                        <a class="btn-solid-lg page-scroll" href="managinfo.php">Manager Contact info</a>';
                        }
                        ?>
                    </div> <!-- end of button-container -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div>

         <!-- end of container -->
    </header> <!-- end of header -->
    <!-- end of header -->


    



    <button onclick="topFunction()" id="myBtn">
        <img src="images/up-arrow.png" alt="alternative">
    </button>



    <div class='modal fade' id= 'modalung' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>Warnings</h5>
        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
      </div>
      <div class='modal-body'>
            <p>
                <?php

        $curdate=date("Y/m/d");


         if (isset($_SESSION['username'])){
            $sql12="SELECT * FROM Product";
            $result3 = $db->query($sql12);
             while($row3 = $result3->fetch_assoc()) {
             $dotung=$row3['Name'];
             $dating=$row3['ExpiryDate'];
             $whiding=$row3['WHID'];
             $sql33="SELECT WName FROM Warehouse WHERE WHID=$whiding";
             $result33 = $db->query($sql33);
             $row33 = $result33->fetch_assoc();
             $namai=$row33['WName'];


             if(($dating!= NULL) && ($dating < $curdate))
             echo "The $dotung has expired on $dating in $namai<br>";
             if(($dating == $curdate))
             echo "The $dotung expires today in $namai<br>";
     }

         $sql55="SELECT * FROM Warehouse";
         $result55 = $db->query($sql55);
             while($row55 = $result55->fetch_assoc()) {
                $whidinga=$row55['WHID'];
                $wnamaz=$row55['WName'];
                $wcaping=$row55['Capacity'];

                $sql44="SELECT SUM(CapacityTaken) FROM Product WHERE WHID=$whidinga";
                $result44 = $db->query($sql44);
                $row44 = $result44->fetch_assoc();
                $kotal=$row44['SUM(CapacityTaken)'];
                if($kotal==0)
                    $kotal=1;
                if(($kotal/$wcaping)< 0.5)
                    echo "$wnamaz has a capacity less than 50%<br>";
                if(($kotal/$wcaping)> 0.9)
                    echo "$wnamaz has a capacity more than 90%<br>";

            }

         
     }


        ?>


            </p> 
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
        <button type='submit' class='btn btn-primary' name='minus' >Save changes</button>
      </div>
    </div>
  </div>
</div>


    <!-- end of back to top button -->
        
    <!-- Scripts -->
    <script src="js/bootstrap.min.js"></script> <!-- Bootstrap framework -->
    <script src="js/swiper.min.js"></script> <!-- Swiper for image and text sliders -->
    <script src="js/purecounter.min.js"></script> <!-- Purecounter counter for statistics numbers -->
    <script src="js/scripts.js"></script> <!-- Custom scripts -->
</body>
</html>