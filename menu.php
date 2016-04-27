<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Menu</title>

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
                        <li>
                            <a href="main.php">Home</a>
                        </li>
                        <li>
                            <a href="menu.php" style="background-color: yellow">Menu</a>
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

        <div class="container"  style="background-color: white; opacity: 0.9;">

            <div class="row">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center"><strong>Foods</strong>
                        <!--<strong>Menu</strong>-->

                    </h2>
                    <hr>
                </div>
                <div class="box" id="foodlist">
                    <!--                       <div class="img-responsive img-border img-full row">
                                                <div class="col-md-4">
                                                    <img src="img/2.jpg" alt="" class="img-thumbnail">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="row">
                                                        <div class="col-md-8"><h2>This is a test.</h2></div>
                                                        <div class="col-md-4"><h3>Price : $10</h3></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">1</div>
                                                        <div class="col-md-6">2</div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">3</div>
                                                        <div class="col-md-6">4</div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">5</div>
                                                        <div class="col-md-6">6</div>
                                                    </div>
                                                </div>
                                            </div>-->
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
        <!-- Menu -->
        <!--<script src="menu.js"></script>-->
        <script type="text/javascript">
            //Display the menu div
            var cart = [];
            var clicks = 0;
            var menuData = {};
            var cartData = [];
            if (getCookie("cart") === "") { 
                cartData = [];
            } else {
                var cart = getCookie("cart");
                console.log(cart);
//                cartData = JSON.stringify(cart.toString());
                var cartJson = eval(cart);
                for (var j = 0; j < cartJson.length; j++){
                    cartData.push(cartJson[j]);
                }                
            }
            
            console.log(cartData);
            
            var username = document.getElementById("username").textContent;
            var cartcounter = document.getElementById("shoppingcartcounter");
            updateCartAmount();
            if (cartcounter.value === undefined) {
                cartcounter.value = 0;
            }
//            console.log("outside - > " + cartcounter);
            document.addEventListener("DOMContentLoaded", function (data) {
//                console.log("updating menu");
                var dataString = "username=" + encodeURIComponent(username);
                var xmlHttp = new XMLHttpRequest();
                xmlHttp.open("POST", "loadmenu.php", true);
                xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xmlHttp.addEventListener("load", function (event) {
                    var jsonData = JSON.parse(event.target.responseText);
                    if (jsonData.success) {
                        menuData = jsonData;
                        var foodlist = document.getElementById("foodlist");
//                        console.log("get result");
                        for (var i = 0; i < jsonData.result.length; i++) {
                            //create menu list
                            var list = document.createElement("div");
                            list.setAttribute("class", "img-responsive img-border img-full row");
                            var imgsrc = "img/" + jsonData.result[i].id.toString().trim() + ".jpg";
                            var list_img = document.createElement("div");
                            list_img.setAttribute("class", "col-xs-4");
                            var img = document.createElement("img");
                            img.setAttribute("class", "img-thumbnail");
                            img.setAttribute("src", imgsrc);
                            img.setAttribute("alt", "");
                            list_img.appendChild(img);
                            var list_text = document.createElement("div");
                            list_text.setAttribute("class", "col-xs-8");
                            var list_text_title = document.createElement("div");
                            list_text_title.setAttribute("class", "row");
                            list_text_title.innerHTML = "<div class=\"col-xs-8\"><h2>" +
                                    jsonData.result[i].name +
                                    "</h2></div>" +
                                    "<div class=\"col-xs-4\"><h3>Price : $" +
                                    jsonData.result[i].price +
                                    "</h3></div>";
                            var list_text_details = document.createElement("div");
                            list_text_details.setAttribute("class", "row");
                            list_text_details.innerHTML = "<div class=\"col-xs-6\"> Location : " + jsonData.result[i].location + "</div>" +
                                    "<div class=\"col-xs-6\"> Prepare Time : " + jsonData.result[i].prepTime + "</div>" +
                                    "<div class=\"col-xs-12 \"> <h4>Nutrition Facts <h4></div>" +
                                    "<div class=\"col-xs-6\"> Calories : " + jsonData.result[i].calories + "</div>" +
                                    "<div class=\"col-xs-6\"> Serving Size : " + jsonData.result[i].servingSize + "</div>" +
                                    "<div class=\"col-xs-6\"> Total Fat : " + jsonData.result[i].totalFat + "g</div>" +
                                    "<div class=\"col-xs-6\"> Cholesterol : " + jsonData.result[i].cholesterol + "mg</div>" +
                                    "<div class=\"col-xs-6\"> Sodium : " + jsonData.result[i].sodium + "mg</div>" +
                                    "<div class=\"col-xs-6\"> Total Carbs : " + jsonData.result[i].totalCarbs + "g</div>" +
                                    "<div class=\"col-xs-6\"> Protein : " + jsonData.result[i].protein + "g</div>" +
                                    "<div class=\"col-xs-6\"> Calcium : " + jsonData.result[i].calcium + "mg</div>" +
                                    "<div class=\"col-xs-12\">"
                            var list_text_details_btn = document.createElement("div");
                            list_text_details_btn.setAttribute("class", "col-xs-12 text-right");
                            var amountPrompt = document.createTextNode("Amount: ");
                            var amount = document.createElement("input");
                            amount.setAttribute("id", "amount_" + i);
                            amount.type = "number";
                            amount.defaultValue = 1;
                            amount.min = 1;
                            amount.max = 10;
                            var addtocartbtn = document.createElement("button");
//                            addtocartbtn.class = "btn";
                            addtocartbtn.innerHTML = "Add to Cart";
                            addtocartbtn.setAttribute("onclick", "addtocart("+ i + ")");


                            list_text_details_btn.appendChild(amountPrompt);
                            list_text_details_btn.appendChild(amount);
                            list_text_details_btn.appendChild(addtocartbtn);
                            list_text_details.appendChild(list_text_details_btn);
                            list_text.appendChild(list_text_title);
                            list_text.appendChild(list_text_details);
                            list.appendChild(list_img);
                            list.appendChild(list_text);
                            foodlist.appendChild(list);

//                            var list = document.createElement("div");
//                            list.setAttribute("class", "col-lg-12 text-center");
//                            var listImg = document.createElement("img");
//                            var imgsrc = "img/" + jsonData.result[i].id.toString().trim() + ".jpg";
////                            listImg.setAttribute("class", "img-responsive img-border img-full");
//                            listImg.class = "img-thumbnail";
//                            listImg.setAttribute("src", imgsrc);
//                            listImg.setAttribute("alt", "");
//                            var title = document.createElement("h2");
//                            title.appendChild(document.createTextNode(jsonData.result[i].name));
//                            var description = document.createElement("p");
//                            description.appendChild(document.createTextNode(jsonData.result[i].price + "<br>" + jsonData.result[i].location));
//                            var amountPrompt = document.createTextNode("Amount: ");
//                            var amount = document.createElement("input");
//                            amount.type = "number";
//                            amount.defaultValue = 1;
//                            amount.min = 1;
//                            amount.max = 10;
//                            var addtocartbtn = document.createElement("button");
//                            addtocartbtn.class = "btn";
//                            addtocartbtn.innerHTML = "Add to Cart";
//                            addtocartbtn.onclick = function () {
//                                var count = amount.value;
////                                console.log(count);
//
//                            }
//                            list.appendChild(listImg);
//                            list.appendChild(title);
//                            list.appendChild(amountPrompt);
//                            list.appendChild(amount);
//                            list.appendChild(addtocartbtn);
//                            foodlist.appendChild(list);
                        }
                    } else {
                        console.log("no result");
                        alert(jsonData.message);
                    }
                }, false);
                xmlHttp.send(dataString);
            });


            function addtocart(i) {

                //add to shopping cart
//                console.log("index : " + i);
//                console.log("select name = " + menuData.result[i].name);
                var count = 0;
                var amount = document.getElementById("amount_" + i);
                count = amount.value;
//                console.log("cartcounter value : " + cartcounter.value);
//                var precounter;
//                if (cartcounter.value === undefined) {
//                    precounter = 0;
//                } else {
//                    precounter = parseInt(cartcounter.value);
//                }
//                console.log("count = " + count);
//                console.log("cart = " + precounter);
//                cartcounter.value = parseInt(precounter) + parseInt(count);
//                cartcounter.innerHTML = cartcounter.value;
                var incartdata = false;
//                console.log("cartData.length = " + cartData.length);
                for (var j = 0; j < cartData.length; j++){
//                    console.log("j = " + j);
//                    console.log("foodid = " + cartData[j]);
//                    var tmp = eval( "(" + cartData[j] + ")" );
                    if (parseInt(cartData[j].foodId) === i){
                        cartData[j].amount = parseInt(cartData[j] .amount) + parseInt(count);
//                        cartData[j] = tmp.toString();
                        incartdata = true;
                    }
                }
                if (!incartdata){
//                    var order = new Object();
                    var order = {};
                    order.foodId = i;                    
                    order.name = menuData.result[i].name;
                    order.amount = count;
                    order.price = menuData.result[i].price;
//                    var orderJson = JSON.stringify(order);
                    cartData.push(order);
                }
//                console.log(JSON.stringify(cartData));
                document.cookie = "cart=" + JSON.stringify(cartData).toString();
                updateCartAmount();
            }
            function updateCartAmount(){
                var sum = 0;
                for (var i = 0; i < cartData.length; i++){
                    sum = sum + parseInt(cartData[i].amount);
                }
                cartcounter.innerHTML = sum;
            }
        </script>



    </body>

</html>
