<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>My Order</title>

        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

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
        <nav class="navbar navbar-default" >
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
                        <li>
                            <a href="main.php">Home</a>
                        </li>
                        <li>
                            <a href="menu.php">Menu</a>
                        </li>
                        <li style="background-color: yellow">
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

        <div class="container"  style="background-color: white; opacity: 0.9;">

            <div class="row">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center"><strong>My Order</strong>
                        <!--<strong>Menu</strong>-->

                    </h2>
                    <hr>
                </div>
                <div class="box" id="myorderlist">

                </div>
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

        <script src="js/cookies.js"></script>

        <script type="text/javascript">
            //Display the menu div
            var cartData = [];
            if (getCookie("cart") === "") {
                cartData = [];
            } else {
                var cart = getCookie("cart");
//                console.log(cart);
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

                var dataString = "username=" + encodeURIComponent(username);


                var xmlHttp = new XMLHttpRequest();
                xmlHttp.open("POST", "loadorder.php", true);
                xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xmlHttp.addEventListener("load", function (event) {
                    var jsonData = JSON.parse(event.target.responseText);
                    if (jsonData.success) {
                        var myorderlist = document.getElementById("myorderlist");
                        var listtable = document.createElement("table");
                        listtable.setAttribute("class", "table");
                        var listtable_thead = document.createElement("thead");
                        listtable_thead.innerHTML = "<tr>" +
                                "<th> Order # </th>" +
                                "<th> Order Time </th>" +
                                "<th> Amount </th>" +
                                "<th> Total Cost </th>" +
                                "<th> Status </th>" +
                                "</tr>";
                        var listtable_tbody = document.createElement("tbody");
                        listtable_tbody.setAttribute("id", "listtable_tbody");
                        for (var i = 0; i < jsonData.result.length; i++) {
                            var listtable_tbody_tr = document.createElement("tr");
                            listtable_tbody_tr.innerHTML = "<td>" + jsonData.result[i].id + "</td>" +
                                    "<td>" + jsonData.result[i].time + "</td>" +
                                    "<td>" + jsonData.result[i].amount + "</td>" +
                                    "<td>$" + jsonData.result[i].cost + "</td>" +
                                    "<td>" + jsonData.result[i].status + "</td>";
                            listtable_tbody.appendChild(listtable_tbody_tr);
                        }
                        listtable.appendChild(listtable_thead);
                        listtable.appendChild(listtable_tbody);
                        myorderlist.appendChild(listtable)
                    }

                });
                xmlHttp.send(dataString);

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
