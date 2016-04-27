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
    
    <?php    
//    if($_SESSION['token'] !== $_POST['token']){
//	die("Request forgery detected");
//    }
    if (isset($_POST['username'])){
        
        require 'database.php';
        $username = $mysqli->real_escape_string($_POST['username']);
        $username = preg_match('/[A-Za-z0-9]/', $username) ? $username : "";

        // $username = $_POST['username'];

        if ($username == "") {
            echo '<p> User name invalid. Please click the button below to go back</p>
                 <input type="button" value="Back" onclick="location.href=\'login.html\'"/>';
            session_destroy();
            exit;
        } else {
            
            $stmt = $mysqli->prepare("SELECT username, password FROM users WHERE username=?");

            $stmt->bind_param('s', $username);
            $stmt->execute();
            
            $stmt->bind_result($user, $pwd_hash);
            $stmt->fetch();
            $stmt->close();
            $pwd_guess = $_POST['password'];
            // $pwd_hash = '111111';
            
            if(crypt($pwd_guess, $pwd_hash)==$pwd_hash){
            // if($pwd_guess == $pwd_hash){        
                    $_SESSION['username'] = $username;
                        // $_SESSION['userlevel'] = $userlevel;
                        // $_SESSION['token'] = substr(md5(rand()), 0, 10); 
                    header('Location:main.php');
                    // Redirect to your target page
            }else{
                    // Login failed; redirect back to the login screen
                // echo '<div class="brand">'+ $pwd_hash +'</div>';
                // echo '<div class="brand">'+ crypt($pwd_guess, $pwd_hash) +'</div>';
                // echo '<div class="brand">'+ $username +'</div>';
                session_destroy();
                // header('Location:index.html');
                // exit;
            }    
            
        }
    // } else if (isset($_POST['guest'])){
    //     $_SESSION['username'] = 'Guest';
    //     $_SESSION['userlevel'] = 'LV0';
    //     $_SESSION['token'] = substr(md5(rand()), 0, 10);
    //     header('Location:homepage.php');
    } else {
        echo '<h1>Unauthorized!</h1>';
        session_destroy();
        exit;
    }
    
    
    ?>
    <div class="brand">Food Order System</div>
    <div class="address-bar">Washington University in St. Louis</div>

    <div class="container">
        <div class="login">
            <h1>Invalid username or password</h1>
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
        interval: 5000 //changes the speed
    })
    </script>
</body>
</html>
