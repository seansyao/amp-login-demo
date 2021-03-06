<?php
include('server.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <title>User Registration System (PHP & MySQL)</title>
        <link rel="stylesheet" type="text/css" href="./css/style.css">
        <link rel="stylesheet" href="./css/jquery-ui.css">
        <script type="text/javascript" src="./js/jquery-3.3.1.js"></script>
        <script src="./js/jquery-ui.js"></script>
        <script type="text/javascript" src="./js/register.min.js"></script>
    </head>
    <body>
        <div class="header">
            <h2>Registration</h2>
        </div>
        
        <form method="post" action="register.php">
            <!-- display validation errors here -->
            <?php include('errors.php') ?>
            
            <div class="input-group">
                <label>Username</label>
                <input type="text" name="username" value="<?php echo $username; ?>">
            </div>
            <div class="input-group">
                <label>First Name</label>
                <input type="text" name="first_name" value="<?php echo $first_name; ?>">
            </div>
            <div class="input-group">
                <label>Last Name</label>
                <input type="text" name="last_name" value="<?php echo $last_name; ?>">
            </div>
            <div class="input-group">
                <label>Email</label>
                <input type="text" name="email" value="<?php echo $email; ?>">
            </div>
            <div class="input-group">
                <label>Password</label>
                <input class="password" type="password" name="password_1">
            </div>
            <div class="input-group">
                <label>Confirm Password</label>
                <input type="password" name="password_2">
            </div>
            <div class="input-group">
                <button disabled type="submit" name="register" class="btn register_button">Register</button>
            </div>
            <p>
                Already a member? <a href="login.php">Sign In</a>
            </p>
        </form>
    </body>
</html>