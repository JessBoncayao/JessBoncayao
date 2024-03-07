<?php
    session_start();
    if (isset($_SESSION["user"])) {
        header("Location: home.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>


<header class="header">
        <a href="#home" class="logo"> <span></span></a>


        <nav class="navbar">
            <a href=login.php>Login</a>
        </nav>
    </header>



    <div class="container">
    <?php 
        if (isset($_POST["Login"])){
            $email = $_POST["email"];
            $password = $_POST["password"];
                require_once "database.php";
                $sql = "SELECT * FROM re WHERE email = '$email'";
                $result = mysqli_query($conn, $sql);
                $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
                if ($user) {
                    $hashedPassword = $user["Password"];
                    if (password_verify($password, $hashedPassword)) {
                        $_SESSION["user"] = "yes";
                        header("Location: home.php");
                        die();
                    } else {
                        echo "<div class = 'alert alert-danger'> Password does not match </div>";
                    }
                } else {
                    echo "<div class = 'alert alert-danger'> Email does not match </div>";
                }
            }
    ?>

        <form action="login.php" method="post">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="form-btn">
                <input type="submit" value="Login" name="Login" class="btn btn-primary">
            </div>

        </form>

        <div><p>Not registered yet? </p><a href="registration.php"> Register here</a></div>
    </div>
    
</body>
</html>