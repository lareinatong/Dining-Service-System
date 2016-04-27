<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Food Order System</title>

        <!--        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
                <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>-->

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

    </head>

    <body>

        <?php
        session_start();
        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
        } else {
            header('Location:login.html');
        }
        ?>

        <nav id="nav-wrap" class="js-nav-primary dark-background" style="text-align:right; color:#777; background: white; opacity: 0.8; height: 30px; top: 0; width: 100%; z-index: 51;">
            <div id="nav-login">
                <?php
                echo "Hi, " . "<span id=\"username\">" . $username . '</span>   <a href="logout.php">log out</a>'
                ?>
            </div>
        </nav>
        <div class="brand">Food Order System</div>
        <div class="address-bar">Washington University in St. Louis</div>

        <!-- Navigation -->
        <nav class="navbar navbar-default">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- navbar-brand is hidden on larger screens, but visible when the menu is collapsed -->
                    <a class="navbar-brand" href="login.html">Food Order System</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li style="background-color: yellow">
                            <a href="main.php">Home</a>
                        </li>
                        <li>
                            <a href="menu.php">Menu</a>
                        </li>
                        <li>
                            <a href="myorder.php">My Order</a>
                        </li>
                        <li>
                            <a href="shoppingcart.php"><span class="glyphicon glyphicon-shopping-cart" > (<span id="shoppingcartcounter">0</span>) </span></a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>

        <div class="container">

            <div class="row">
                <div class="box">
                    <div class="col-lg-12 text-center">
                        <div id="carousel-example-generic" class="carousel slide">
                            <!-- Indicators -->
                            <ol class="carousel-indicators hidden-xs">
                                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                            </ol>

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img class="img-responsive img-full" src="img/slide-1.jpg" alt="">
                                </div>
                                <div class="item">
                                    <img class="img-responsive img-full" src="img/slide-2.jpg" alt="">
                                </div>
                                <div class="item">
                                    <img class="img-responsive img-full" src="img/slide-3.jpg" alt="">
                                </div>
                            </div>

                            <!-- Controls -->
                            <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                <span class="icon-prev"></span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                <span class="icon-next"></span>
                            </a>
                        </div>
                        <h2 class="brand-before">
                            <small>Welcome to</small>
                        </h2>
                        <h1 class="brand-name">Food Order System</h1>
                        <hr class="tagline-divider"/>
                        <h2>
                            <small>By
                                <strong>Yu Tong</strong>
                            </small>
                        </h2>
                    </div>
                </div>
            </div>
        </div>

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

        <script src="js/cookies.js"></script>

        <!-- Script to Activate the Carousel -->
        <script>
            $('.carousel').carousel({
                interval: 5000 //changes the speed
            })
        </script>

        <script type="text/javascript">
            //Display the menu div
            var cartData = [];
            if (getCookie("cart") === "") {
                cartData = [];
            } else {
                var cart = getCookie("cart");
                console.log(cart);
//                cartData = JSON.stringify(cart.toString());
                var cartJson = eval(cart);
                for (var j = 0; j < cartJson.length; j++) {
                    cartData.push(cartJson[j]);
                }
            }

            var username = document.getElementById("username").textContent;
            var cartcounter = document.getElementById("shoppingcartcounter");
            updateCartAmount();

            document.addEventListener("DOMContentLoaded", function (data) {
                updateCartAmount();
            });

            function updateCartAmount() {
                var sum = 0;
                for (var i = 0; i < cartData.length; i++) {
                    sum = sum + parseInt(cartData[i].amount);
                }
                cartcounter.innerHTML = sum;
            }


        </script>

    </body>

</html>
