<?php   
 session_start();
 include("config.php"); //include the config
$db=new mysqli("$dbhost","$dbuser","$dbpass");
$db->select_db("$dbname");
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


     <!-- Scripts -->
    <script src="js/modal.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script> <!-- Bootstrap framework -->
    <script src="js/swiper.min.js"></script> <!-- Swiper for image and text sliders -->
    <script src="js/purecounter.min.js"></script> <!-- Purecounter counter for statistics numbers -->
    <script src="js/scripts.js"></script> <!-- Custom scripts -->

    
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
                        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-bs-toggle="dropdown" aria-expanded="false">Warehouses</a>
                        <ul class="dropdown-menu" aria-labelledby="dropdown01">
                            <?php
                            $sql = "SELECT * FROM Warehouse ";
                            $result = $db->query($sql);
                            if (isset($_SESSION['username'])){
                                if ($result->num_rows > 0) {
                                      while($row = $result->fetch_assoc()) {
                                        echo "<form action='warehouses.php' method='post'>";
                                        $wid=$row['WHID'];
                                        $name="Name: " . $row["WName"] ."  Adress: " . $row["Adress"];
                                        echo "<a class='dropdown-item'> <button type='submit' name='id' class='btn btn-success' value='$wid'>$name</button></a>";
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
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>';

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
     <div style="background-image: url('images/header-background.jpg.jpg'); background-repeat: repeat-y; ">
      

      
    <!-- Header -->
    <header id="header" class="header h-100" style=" padding-top: 5%;">
        <div class="container ">
            <div class="row">
                <div class="col-lg-12 offset-lg-0" style=" padding-top: 0%;">
                    <div class="button-container">
                        <table class="table table-success table-bordered">
                            <thead class="thead-dark">
                        <?php

$db=new mysqli("$dbhost","$dbuser","$dbpass");
$db->select_db("$dbname");
$sql = "SELECT * FROM Warehouse,Worker WHERE ManagerID=WorkerID";
$result = $db->query($sql);



if ($result->num_rows > 0) {



  // output data of each row
    echo "<tr>
        <th >Warehouse Name</th >  <th >Manager Name</th > <th >Manager Phone Number</th ><th >Adress</th ><th >Capacity</th ><th >Edit</th >
    </tr>";
  while($row = $result->fetch_assoc()) {
  	$id=$row['ManagerID'];
    $whid=$row['WHID'];
    $ad=$row['Adress'];
    $wn=$row['WName'];
    $pn=$row['PhoneNumber'];
    $nm=$row['Name'];
    $us=$_SESSION['username'];
    $cap=$row['Capacity'];

    $sql1 = "SELECT SUM(CapacityTaken) FROM Warehouse, Product WHERE Product.WHID=$whid AND Warehouse.WHID=Product.WHID";
    $result1 = $db->query($sql1);
    $row = $result1->fetch_assoc();
    $capy=$row['SUM(CapacityTaken)'];
    if($capy==NULL)
        $capy=0;




    echo "<tr> 
    <td>$wn</td>
    <td>$nm</td> 
    <td>$pn</td> 
    <td>$ad</td> 
    <td>$capy/$cap</td>
    <td> ";

    $staticpart1="exampleModal2";
    $dynamicname2=$staticpart1 . $whid;


    echo "<!-- Modal -->

    <form action='whedit.php' action='GET' style='Display: Inline-Block'>
            <input type='text' name='whid' style='display:none;' value='$whid';>
            



<div class='modal fade' id= '$dynamicname2' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>

        <h5 class='modal-title' id='exampleModalLabel'>Warehouse Editing</h5>
        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
      </div>
      <div class='modal-body'>
            <div class='form-group'>
                <label for='exampleInputPassword1'>Warehouse Name</label>
                <input type='text' name='wnm' value='$wn' class='form-control'  placeholder='Name'>
            </div>   
            <div class='form-group'>
                <label for='exampleInputPassword1'>Warehouse Adress </label>
                <input type='text' name='ad' value='$ad' class='form-control'  placeholder='Adress'>
            </div>  
            <div class='form-group'>
                <label for='exampleInputPassword1'>Warehouse Capacity </label>
                <input type='text' name='cap' value='$cap' class='form-control'  placeholder='Capacity'>
            </div>
            <div class='form-group'>
                <label for='exampleInputPassword1'>Warehouse Manager</label>
            	<select name='mid' class='form-select' aria-label='Default select example'>
            	<option selected>Open this select menu</option>";
            	$sql2 = "SELECT * FROM Worker ";
                $result2 = $db->query($sql2);
                if ($result2->num_rows > 0) {
                    while($row2 = $result2->fetch_assoc()) {
                        $ff1=$row2['Name'];
                        $dd1=$row2['WorkerID'];
                        echo "<option value='$dd1'>$ff1</option>";
                         
                        }
                    }
                        

            	echo "
            	</select>

            </div>  
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
        <button type='submit' class='btn btn-primary' name='pajser'>Save changes</button>
      </div>
    </div>
  </div>
</div>

";


    echo "<button type='button' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#$dynamicname2'>Edit</button>
    </form>
    <form action=whdel.php method='post' style='display: inline-block;'>
        <input type='text' name='id' style='display:none;' value='$whid';>
        <button type='button' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#doto'>Delete</button>


<div class='modal fade' id= 'doto' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>

        <h5 class='modal-title' id='exampleModalLabel'>Warehouse Deletion</h5>
        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
      </div>
      <div class='modal-body'>
            
                <label for='exampleInputPassword1'><h2>Are You Sure?<h2></label>

      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
        <button type='submit' class='btn btn-primary' name='plus'>Save changes</button>
      </div>
    </div>
  </div>
</div>


    </form>
    </td> 

    </tr>";}

}

                        ?>


    </table>



    <button type='submit' name='id' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#create'>Create New Warehouse</button>

    <div class='modal fade' id= 'create' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>

        <h5 class='modal-title' id='exampleModalLabel'>Warehouse Editing</h5>
        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
      </div>
      <form action='whcr.php' method='post'>
      <div class='modal-body'>
            <div class='form-group'>
                <label for='exampleInputPassword1'>Warehouse Name</label>
                <input name='wnm' type='text' name='wn' class='form-control'  placeholder='Name'>
            </div>   
            <div class='form-group'>
                <label for='exampleInputPassword1'>Warehouse Adress </label>
                <input type='text' name='ad' class='form-control'  placeholder='Adress'>
            </div>  
                        <div class='form-group'>
                <label for='exampleInputPassword1'>Warehouse Capacity </label>
                <input type='text' name='cap' class='form-control'  placeholder='Capacity'>
            </div>
            <label for='exampleInputPassword1'>Warehouse Manager </label>
            <select name='mid' class="form-select" aria-label="Default select example">
            	<option selected>Open this select menu</option>
            	<?php
                            $sql1 = "SELECT * FROM Worker ";
                            $result1 = $db->query($sql1);
                                if ($result1->num_rows > 0) {
                                      while($row1 = $result1->fetch_assoc()) {
                                      	$ff1=$row1['Name'];
                                      	$dd1=$row1['WorkerID'];
                                        echo "<option value='$dd1'>$ff1</option>";
                                        
                                      }
                                    }
                        ?>
</select>
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
        <button type='submit' name="id" class='btn btn-primary' name='plus'>Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>

    <!-- Button to Open the Modal -->
<!-- Button trigger modal -->
<!-- Button trigger modal -->


                    </div> <!-- end of button-container -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </header> <!-- end of header -->
    <!-- end of header -->
    

</div>

    <button onclick="topFunction()" id="myBtn">
        <img src="images/up-arrow.png" alt="alternative">
    </button>
    <!-- end of back to top button -->

</body>


</html>