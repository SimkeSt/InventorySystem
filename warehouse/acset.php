<?php   
 session_start();
 include("config.php"); //include the config
$db=new mysqli("$dbhost","$dbuser","$dbpass");
$db->select_db("$dbname");
if(isset($_SESSION['username']))
$ses=$_SESSION['username'];


if(isset($_POST['pajser'])){
    $n=$_POST['wnm'];
    $sql="UPDATE Worker
    SET Name='$n'
    WHERE Name='$ses';";
    $db->query($sql);
    $_SESSION['username']=$n;
    $_POST['pajser']=NULL;
    Header("location:acset.php");

}

if(isset($_POST['pajser1'])){
    $n1=$_POST['wnm1'];
    $sql="UPDATE Worker
    SET PhoneNumber='$n1'
    WHERE Name='$ses';";
    $db->query($sql);
    Header("location:acset.php");

}

if(isset($_POST['pajser2'])){
    $n2=$_POST['wnm2'];
    $sql="UPDATE Worker
    SET password='$n2'
    WHERE Name='$ses';";
    $db->query($sql);
    Header("location:acset.php");

}


?>


<!DOCTYPE html>
<html lang="en" style="background-image: url('images/header-background.jpg');">

<head
>

 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

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
                        <a class="nav-link active" aria-current="page" href="#header">Home</a>
                    </li>
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
                        if($aid==1)
                            echo '<li class="nav-item">
                            <a class="nav-link" href="WHCreate.php">Create Warehouses</a>
                            </li>';
                        echo '<li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                        </li>';
                    }
                    else echo '<a class="nav-link" href="loginform.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="registerform.php">Register</a>
                        </li>'


                        ?>
                        

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
<div class="button-container" style="margin-top: 15%; margin-right: 25%; margin-left: 25%;">
                         <?php
                        if (isset($_SESSION['username'])){
                        
                        $username=$_SESSION['username'];

                        $sql="SELECT * FROM Worker WHERE Name='$username'";
                        $result = $db->query($sql);
                        $row = $result->fetch_assoc();

                        $ps=$row['password'];
                        $pn=$row['PhoneNumber'];
                        $nm=$row['Name'];
                        $string = str_repeat('*', strlen($ps));


                        echo "<h5 class='text-light'>";
                        echo "Username: $username &nbsp;&nbsp;<button type='button' class='btn btn-secondary' data-bs-toggle='modal' data-bs-target='#ses'>Change</button> <br><br>";
                        echo "Phone Number: $pn &nbsp;&nbsp;<button type='button' class='btn btn-secondary' data-bs-toggle='modal' data-bs-target='#ses1'>Change</button> <br><br>";
                        echo "Password: $string &nbsp;&nbsp;<button type='button' class='btn btn-secondary' data-bs-toggle='modal' data-bs-target='#ses2'>Change</button> <br>";

                        echo "</h5>";
                        }
                        
                        ?>
                    </div> 
      
    <!-- Header -->
    <header id="header" class="header h-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-7"><!-- end of button-container -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </header> <!-- end of header -->
    <!-- end of header -->
    

      <div class='modal fade' id= 'ses' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>

        <h5 class='modal-title' id='exampleModalLabel'>Username Editing</h5>
        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
      </div>
      <div class='modal-body'>
        <form action=acset.php method="post" oninput='ad.setCustomValidity(ad.value != up.value ? "Wrong password" : "")'>

            <div class='form-group'>
                <label for='exampleInputPassword1'>Change username</label>
                <input type='text' name='wnm' value='' class='form-control'  placeholder='Name'>
            </div>   
            <div class='form-group'>
                <label for='exampleInputPassword1'>Insert Password</label>
                <input type='text' name='ad' value='' class='form-control'  placeholder='Password'>
            </div>
            <div class='form-group' style="display: none">
                <input type='text' name='up' value=<?php 
                $username=$_SESSION['username'];

                        $sql1="SELECT * FROM Worker WHERE Name='$username'";
                        $result1 = $db->query($sql1);
                        $row = $result1->fetch_assoc();

                        $ps1=$row['password'];
                        $pn1=$row['PhoneNumber'];
                        $nm1=$row['Name'];
                         echo"$ps1";?> >
            </div>  
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
        <button type='submit' class='btn btn-primary' name='pajser'>Save changes</button>
            </form>

      </div>
    </div>
  </div>
</div>


      <div class='modal fade' id= 'ses1' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>

        <h5 class='modal-title' id='exampleModalLabel'>Phonenumber Editing</h5>
        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
      </div>
      <div class='modal-body'>
        <form action=acset.php method="post" oninput='ad.setCustomValidity(ad.value != up.value ? "Wrong password" : "")'>

            <div class='form-group'>
                <label for='exampleInputPassword1'>New Phone number</label>
                <input type='text' name='wnm1' value='' class='form-control'  placeholder='Name'>
            </div>   
            <div class='form-group'>
                <label for='exampleInputPassword1'>Insert Password</label>
                <input type='text' name='ad' value='' class='form-control'  placeholder='Adress'>
            </div>  
            <div class='form-group' style="display: none">
                <input type='text' name='up' value=<?php 
                $username=$_SESSION['username'];

                        $sql1="SELECT * FROM Worker WHERE Name='$username'";
                        $result1 = $db->query($sql1);
                        $row = $result1->fetch_assoc();

                        $ps1=$row['password'];
                        $pn1=$row['PhoneNumber'];
                        $nm1=$row['Name'];
                         echo"$ps1";?> >
            </div>  
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
        <button type='submit' class='btn btn-primary' name='pajser1'>Save changes</button>
            </form>

      </div>
    </div>
  </div>
</div>



      <div class='modal fade' id= 'ses2' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>

        <h5 class='modal-title' id='exampleModalLabel'>Password Editing</h5>
        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
      </div>
      <div class='modal-body'>
        <form action=acset.php method="post" oninput='wnm.setCustomValidity(wnm.value != up.value ? "Wrong password" : "")'>

            <div class='form-group'>
                <label for='exampleInputPassword1'>Old password</label>
                <input type='text' name='wnm' value='' class='form-control'  placeholder='Old Password'>
            </div>   
            <div class='form-group'>
                <label for='exampleInputPassword1'>Insert new password</label>
                <input type='text' name='wnm2' value='' class='form-control'  placeholder='New Password'>
            </div>
                        <div class='form-group'>
                <label for='exampleInputPassword1'>Repeat new password</label>
                <input type='text' name='wnm3' value='' class='form-control'  placeholder='New Password'>
            </div>
             <div class='form-group' style="display: none">
                <input type='text' name='up' value=<?php 
                $username=$_SESSION['username'];

                        $sql1="SELECT * FROM Worker WHERE Name='$username'";
                        $result1 = $db->query($sql1);
                        $row = $result1->fetch_assoc();

                        $ps1=$row['password'];
                        $pn1=$row['PhoneNumber'];
                        $nm1=$row['Name'];
                         echo"$ps1";?> >
            </div>  
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
        <button type='submit' class='btn btn-primary' name='pajser2'>Save changes</button>
      </div>
    </form>

    </div>
  </div>
</div>




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