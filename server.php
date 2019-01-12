<?php
	session_start();
	
    $username = "";
    $email = "";
    $errors = array();

    //connect to the database
    $db = mysqli_connect('localhost', 'admin', 'password', 'registration');

    //if the register button is clicked
    if(isset($_POST['register'])) {
        $username = strtolower(mysqli_real_escape_string($db, $_POST['username']));
        $first_name = ucfirst(strtolower(mysqli_real_escape_string($db, $_POST['first_name'])));
        $last_name = ucfirst(strtolower(mysqli_real_escape_string($db, $_POST['last_name'])));
        $email = strtolower(mysqli_real_escape_string($db, $_POST['email']));
        $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
        $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

        //ensure that form fields are filled properly
        if(empty($username)) {
            array_push($errors, "Username is required.");
        }
        else {
        	//username validation for duplication
        	$query = "SELECT * FROM users WHERE username = '$username'";
        	$result = mysqli_query($db, $query);
        	if(mysqli_num_rows($result) > 0) {
        		array_push($errors, "Username already in use.");
        	}
        }

        if(empty($email)) {
            array_push($errors, "Email is required.");
        }
        else {
        	//email validation for duplication
        	$query = "SELECT * FROM users WHERE email = '$email'";
        	$result = mysqli_query($db, $query);
        	if(mysqli_num_rows($result) > 0) {
        		array_push($errors, "Email already in use.");
        	}
        }

        if(empty($password_1)) {
            array_push($errors, "Password is required.");
        }

        if($password_1 != $password_2) {
            array_push($errors, "Passwords do NOT match.");
        }
        
        if(empty($first_name)){
        	array_push($errors, "First name is required.");
        }
        
        if(empty($last_name)){
        	array_push($errors, "Lasst name is required.");
        }

        //if there are no errors, save user to database
        if(count($errors) == 0) {
            //encrypt password before storing in database (security)
            $password = md5($password_1);
            $sql = "INSERT INTO users (username, email, password, first_name, last_name) 
                    VALUES ('$username', '$email', '$password', '$first_name', '$last_name')";
            mysqli_query($db, $sql);
            
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in.";
            //redirect to homepage.
            header('location: index.php');
        }
    }
    
    //log user in from login page
    if(isset($_POST['login'])) {
    	$username = mysqli_real_escape_string($db, $_POST['username']);
    	$password = mysqli_real_escape_string($db, $_POST['password']);
    	
    	//ensure that form fields are filled properly
    	if(empty($username)) {
    		array_push($errors, "Username is required");
    	}
    	
    	if(empty($password)) {
    		array_push($errors, "Password is required");
    	}
    	
    	if(count($errors) == 0) {
    		//encrypt password before comparing with that from database
    		$password = md5($password);
    		// AND first_name = '$first_name' AND last_name = '$last_name'
    		$query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    		$result = mysqli_query($db, $query);
    		if(mysqli_num_rows($result) == 1) {
    			
    			$row = mysqli_fetch_assoc($result);

    			
    			//log user in
    			$_SESSION['username'] = $username;
    			$_SESSION['first_name'] = $row['first_name'];
    			$_SESSION['last_name'] = $row['last_name'];
    			$_SESSION['success'] = "You are now logged in.";
    			//redirect to homepage.
    			header('location: index.php');
    		}
    		else {
    			array_push($errors, "Wrong username/password combination.");
    		}
    	}
    }
    
    //logout
    if(isset($_GET['logout'])){
    	session_destroy();
    	unset($_SESSION['username']);
    	header('location: login.php');
    }
?>