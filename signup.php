<?php

session_start();

if ($_SESSION['token'] !== $_POST['token']) {
    die("Request forgery detected");
}

function randomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['retypepassword']) && isset($_POST['firstname']) && isset($_POST['lastname'])) {

    $registersuccess = false;

    $inputcorrect = true;

    $username = preg_match('/[A-Za-z0-9]/', $_POST['username']) ? $_POST['username'] : "";
    $password = preg_match('/[A-Za-z0-9\.\\s\-\_\!]/', $_POST['password']) ? $_POST['password'] : "";
    $retypepassword = preg_match('/[A-Za-z0-9\.\\s\-\_\!]/', $_POST['retypepassword']) ? $_POST['retypepassword'] : "";
    $firstname = preg_match('/[A-Za-z0-9\.\\s]/', $_POST['firstname']) ? $_POST['firstname'] : "";
    $lastname = preg_match('/[A-Za-z0-9\.\\s]/', $_POST['lastname']) ? $_POST['lastname'] : "";

    if ($username == "" || (strtolower($username) == "guest")) {
        echo "<br><err>User name input invalid.</err>";
        $inputcorrect = false;
//                exit;
    }

    if ($password == "" || $retypepassword == "") {
        echo "<br><err>Password input invalid.</err>";
        $inputcorrect = false;
//                exit;
    }

    if ($password != $retypepassword) {
        echo "<br><err>Retype password does not match the password.</err>";
        $inputcorrect = false;
//                exit;
    }

    if ($firstname == "") {
        echo "<br><err>First name input invalid.</err>";
        $inputcorrect = false;
//                exit;
    }

    if ($lastname == "") {
        echo "<br><err>Last name input invalid.</err>";
        $inputcorrect = false;
//                exit;
    }

    if (!$inputcorrect) {
        exit;
    } else {

        $studentid = $_POST['studentid'];

        require 'database.php';
        $username = $mysqli->real_escape_string($_POST['username']);
        $username = preg_match('/[A-Za-z0-9]/', $username) ? $username : "";

        $stmt = $mysqli->prepare("SELECT username FROM users WHERE username=?");

        $stmt->bind_param('s', $username);
        $stmt->execute();

        $stmt->bind_result($user);
        $stmt->fetch();

        $stmt->close();

        if ($user) {
            echo "<script>console.log(\"user exist\");</script>";
//                    header('Location:error_page.php');
            //     session_destroy();
            $_SESSION['error_message'] = "Username exists";
            // $_SESSION['error_message'] = 'Username exists';
            $_SESSION['error_back'] = "register.php";
            exit(header("Location: error_page.php"));
//                    exit;
        }

        $stmt = $mysqli->prepare("insert into users (username, firstname, lastname, student_id, password) values (?, ?, ?, ?, ?)");
        if (!$stmt) {
            echo "<script>console.log(\"Query Prep Failed\");</script>";
            printf("Query Prep Failed: %s\n", $mysqli->error);
            exit;
        } else {

            $_SESSION['userlevel'] = "LV1";

            $length = rand(10, 20);

            $salt = randomString($length);

            $pwd_hash = crypt($password, $salt);

            $stmt->bind_param('sssss', $username, $firstname, $lastname, $studentid, $pwd_hash);

            $stmt->execute();

            $stmt->close();


            $registersuccess = true;
//                    if (!$registersuccess) {
//                        
//                    }
        }

        if ($registersuccess) {
            $_SESSION['username'] = $username;
            // $_SESSION['token'] = substr(md5(rand()), 0, 10); 
//                    header('Location:main.php');
            exit(header("Location:main.php"));
//                    exit;
        } else {
            echo "<script>console.log(\"Register Failed\");</script>";
            echo "not successful!";
            exit;
        }
    }
}
?>  