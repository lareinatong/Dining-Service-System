<!DOCTYPE html>
<?php
    session_start();
?>

<html>
<head>
    <meta charset= "UTF-8">
    <title>Signing In and Skipping</title>
    <meta http-equiv="refresh" content="5;url=login.html">

        <!-- Login CSS -->
    <link href="css/login.css" rel="stylesheet">

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/business-casual.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">
</head>


<body>
    <div class="brand">Food Order System</div>
    <div class="address-bar">Washington University in St. Louis</div>

    <div class="container">
        <div class="login">
            <h1>
                <?php 
                    echo $_SESSION['error_message'];
                    // unset($GLOBALS['_SESSION']['error_message']);
                ?>
            </h1>
            <form action=<?php 
                            echo '"'. $_SESSION['error_back'] .'"';
                            // unset($GLOBALS['_SESSION']['error_message']);
                            session_destroy();
                        ?> method="POST"> 
                <input type="submit" value="Back"/>
            </form>
        </div>

    </div>
    <!-- /.container -->

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>Copyright &copy; Yu Tong</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 3000 //changes the speed
    })
    </script>
</body>
</html>
