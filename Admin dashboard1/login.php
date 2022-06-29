<?php
$power_first = '';
$power_reload = '';
$power_header = '';
session_start();
if (isset($_SESSION['login'])) {
    if ($_SESSION['type'] == 'Waiter') {
        header("Location: table.php");
    } else if ($_SESSION['type'] == 'Cashier') {
        header("Location: billing.php");
    } else {
        header("Location: index.php");
    }
    exit();
}

if (isset($_POST['login'])) {
    $con = new mysqli('localhost', 'root', '', 'restaurant_management');

    $email = $con->real_escape_string($_POST['email_']);
    $password = $con->real_escape_string($_POST['password_']);
    $power_first = $email;

    $sql = $con->query(query: "SELECT * FROM user WHERE email='$email' AND password='$password'");
    if ($sql->num_rows > 0) {
        $data = $sql->fetch_array();
        $_SESSION['login'] = 1;
        $_SESSION['email'] = $email;
        $_SESSION['type'] = $data['type'];
        $power_first = $data['type'];
        if ($power_first == 'Waiter') {
            $power_header = "table.php";
        } else if ($power_first == 'Cashier') {
            $power_header = "billing.php";
        } else {
            $power_header = "index.php";
        }
        $response = array(
            'error' => '',
            'success' => $power_header
        );
        exit(json_encode($response));
    } else {
        $response = array(
            'error' => 'wrong',
            'success' => ''
        );
        exit(json_encode($response));
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Hestia|Login</title>
    <link rel="stylesheet" type="text/css" href="assets/css/login.css">
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="assets/img/icon.png">
</head>

<body>
    <div id="hidding">
        <div class="container">
            <div class=" img">
                <img src="assets/img/undraw_special_event.svg">
            </div>
            <div class="login-content">
                <form>
                    <img src="assets/img/undraw_profile.svg">
                    <br>
                    <img class="title-img" src="assets/img/title.png">
       
                    <div class="input-div one">
                        <div class="i">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="div">
                            <h5>Email</h5>
                            <input type="email" id="email" name="email" class="input" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="input-div pass">
                        <div class="i">
                            <i class="fas fa-lock"></i>
                        </div>
                        <div class="div">
                            <h5>Password</h5>
                            <input type="password" id="password" name="password" class="input" required>
                        </div>
                    </div>
                    <input type="button" id="submit" class="btn" value="Login">
                    <div id="message"></div>
                </form>

            </div>
        </div>
    </div>
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/login.js"></script>
    <script type="text/javascript" language="javascript">

    </script>
</body>

</html>