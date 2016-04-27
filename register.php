<!DOCTYPE html>
<?php
session_start();
$_SESSION['token'] = substr(md5(rand()), 0, 10);
//session_destroy();
?>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>New User Register</title>

        <!-- Login CSS -->
        <link href="css/login.css" rel="stylesheet">

        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/business-casual.css" rel="stylesheet">

        <!-- Fonts -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <style type="text/css">
            err{color:red; font-weight: bold}
        </style>
    </head>


    <body>

        <div class="brand">Food Order System</div>
        <div class="address-bar">Washington University in St. Louis</div>

        <div class="container">
            <div class="register">
                <h1>Sign up</h1>
                <form action="signup.php" method="POST">
                    <p><input placeholder="Username" type="text" name="username" id="username" pattern="[A-Za-z0-9]{1,20}" required/> At least 6 only letters and numbers in length.</p>
                    <p><input placeholder="Password" type="password" name="password" id="password" pattern="[A-Za-z0-9\.\\s\-\_\!]{8,50}" required/> At least 8 characters in length and can contain only letters , numbers, space and . - _ !</p>
                    <p><input placeholder="Retype password" type="password" name="retypepassword" id="retypepassword" pattern="[A-Za-z0-9\.\\s\-\_\!]{3,20}" required/></p>
                    <p><input placeholder="First name" type="text" name="firstname" id="firstname" pattern="[A-Za-z0-9\.\\s]{1,30}" required/></p>
                    <p><input placeholder="Last name" type="text" name="lastname" id="lastname" pattern="[A-Za-z0-9\.\\s]{1,30}" required/></p>
                    <p><input placeholder="Student ID" type="number" name="studentid" id="studentid"/></p>
                    <p><input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>"/></p>
                    <input type="submit" value="Register"/>
                </form>
                <form action="login.html" method="POST"> 
                    <input type="submit" value="Login to System"/>
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
                interval: 5000 //changes the speed
            })
        </script>


    </body>
</html>
