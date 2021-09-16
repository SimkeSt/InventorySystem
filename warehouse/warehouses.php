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
    <header id="header" class="header h-100" style=" padding-top: 5%; width:50%; margin-left: 3%">
        <div class="container ">
            <div class="row">
                <div class="col-lg-12 offset-lg-0" style=" padding-top: 0%;">
                    <div class="button-container">
                        <table class="table table-success table-bordered">
                            <thead class="thead-dark">
                        <?php

$db=new mysqli("$dbhost","$dbuser","$dbpass");
$db->select_db("$dbname");
if(isset($_POST['id'])){
    $WH=$_POST['id'];
    $_SESSION["whid"] = $WH;

}
else
{
    $WH=$_SESSION["whid"];
}
$sql = "SELECT * FROM Product,Warehouse WHERE Warehouse.WHID=Product.WHID AND Product.WHID='$WH'";
$result = $db->query($sql);



if ($result->num_rows > 0) {



  // output data of each row
    echo "<tr>
        <th >Name of product</th > <th>Sale Price</th > <th >Purchase Price</th > <th >Quantity</th > <th >Capacity Taken</th > <th >Expiry Date</th > <th >+/-/Alter</th >
    </tr>";
  while($row = $result->fetch_assoc()) {
    $id=$row['ProductID'];
    $SP1=$row['SalePrice'];
    $IP1=$row['PurchasePrice'];
    $QT1=$row['Quantity'];
    $NM1=$row['Name'];
    $ss1=$row['CapacityTaken'];

    $whid=$row['WHID'];
    $wid=$_SESSION['username'];
    $ed=$row['ExpiryDate'];


    echo "<tr> 
    <td>$NM1</td>
    <td>$SP1</td> 
    <td>$IP1</td> 
    <td>$QT1</td> 
    <td>$ss1</td>
    <td>$ed</td>  
    <td> ";


        echo "<form action='reshapedform.php' method='post'>
        <input type='text' name='whid' style='display:none;' value='$whid';>";
        echo " <input type='text' name='id' style='display:none;' value='$id';>";
        echo " <input type='text' name='wid' style='display:none;' value='$wid';>";

    $staticpart="exampleModal";
    $dynamicname=$staticpart . $id;

    $staticpart1="exampleModal2";
    $dynamicname2=$staticpart1 . $id;

    $staticpart2="exampleModal3";
    $dynamicname3=$staticpart2 . $id;


    echo "<!-- Modal -->
<div class='modal fade' id='$dynamicname' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>Alter prices</h5>
        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
      </div>
      <div class='modal-body'>
            <div class='form-group'>
                <label for='exampleInputEmail1'>Sale Price</label>
                <input type='text' name='SP' class='form-control'  aria-describedby='emailHelp' value='$SP1' placeholder='Enter Sale Price'>
            </div>
            <div class='form-group'>
                <label for='exampleInputPassword1'>Purchase Price</label>
                <input type='text' name='IP' class='form-control' value='$IP1' placeholder='Enter Purchase Price'>
            </div>   
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
        <button type='submit' name='alt' class='btn btn-primary'>Save changes</button>
      </div>
    </div>
  </div>
</div>

<div class='modal fade' id= '$dynamicname2' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>

        <h5 class='modal-title' id='exampleModalLabel'>Imported Products</h5>
        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
      </div>
      <div class='modal-body'>
            <div class='form-group'>
                <input type='text' name='plus1' class='form-control'  placeholder='Add quantity'>
            </div>   
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
        <button type='submit' class='btn btn-primary' name='plus'>Save changes</button>
      </div>
    </div>
  </div>
</div>

<div class='modal fade' id= '$dynamicname3' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>Sold Products</h5>
        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
      </div>
      <div class='modal-body'>
            <div class='form-group'>
                <input type='text' name='minus1' class='form-control'  placeholder='Remove Quantity'>
            </div>   
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
        <button type='submit' class='btn btn-primary' name='minus' >Save changes</button>
      </div>
    </div>
  </div>
</div>
</form>
";


    echo "<button type='button' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#$dynamicname2'>+</button>
    <button type='button' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#$dynamicname3' >-</button> 
    <button type='button' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#$dynamicname'>Alter</button>
    <form action=del.php method='post' style='display: inline-block;'>
        <input type='text' name='id' style='display:none;' value='$id';>
        <button type='submit' name='del' class='btn btn-success' value='$WH'>X</button>
    </form>
    </td> 

    </tr>";}

}
    $wid=$_SESSION['username'];

                        
                        ?>
    <form action="insertion.php" method='post'>
        <tr> 
        <td><input type="text" name="nm"></td> <td><input type="text" name="sp"></td> <td><input type="text" name="ip"></td> <td><input type="text" name="qt"></td><td><input type="text" name="ss1"></td>  <td><input type="date" name="ed"></td> 
            <input type='text' name='id' style="display:none;" <?php echo "value='$WH'"; ?>>
            <input type='text' name='wid' style="display:none;" <?php echo "value='$wid'"; ?>>
            <input type='text' name='id' style="display:none;" <?php echo "value='$id'"; ?>>


        <td><button type='submit' name='qid' class='btn btn-success' <?php echo "value='$WH'"; ?>>Insert Product</button></td>
        </tr> 
    </form>

                        </table>

<button type='button' class='btn btn-success' data-bs-toggle='modal' data-bs-target='#modalung2'>Write Report</button>


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



    <div class='modal fade' id= 'modalung2' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h5 class='modal-title' id='exampleModalLabel'>Write Report</h5>
        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
      </div>
      <div class='modal-body'>

<form action='repwrite.php' method="post">
    <?php
    $ssla=$_SESSION['username'];
        echo " <input type='text' name='whid' style='display:none;' value='$whid';>";
        echo " <input type='text' name='wid' style='display:none;' value='$ssla';>";
    ?>
    <textarea rows = "5" cols = "130" name = "rep">
         </textarea>


      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
        <button type='submit'  class='btn btn-primary' name='fiq' >Send the report</button>
        </form>
      </div>
    </div>
  </div>
</div>

    <button onclick="topFunction()" id="myBtn">
        <img src="images/up-arrow.png" alt="alternative">
    </button>
    <!-- end of back to top button -->
        
    <!-- Scripts -->
    <script src="js/modal.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script> <!-- Bootstrap framework -->
    <script src="js/swiper.min.js"></script> <!-- Swiper for image and text sliders -->
    <script src="js/purecounter.min.js"></script> <!-- Purecounter counter for statistics numbers -->
    <script src="js/scripts.js"></script> <!-- Custom scripts -->

</body>


</html>