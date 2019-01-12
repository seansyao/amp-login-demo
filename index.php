<?php 
	include ('server.php');
	//if user is not logged in, they cannot access this page
	if(empty($_SESSION['username'])) {
		header('location: login.php');
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>User Registration System (PHP & MySQL)</title>
        <link rel="stylesheet" type="text/css" href="./css/style.css">
    </head>
    <body>
        <div class="header">
            <h2>Homepage</h2>
        </div>
        
        <div class="content">
        	<?php if(isset($_SESSION['success'])): ?>
        		<div class="error success">
        			<h3>
        				<?php 
        					echo $_SESSION['success'];
        					unset($_SESSION['sucess']);
        				?>
        			</h3>
        		</div>
        	<?php endif ?>
        	
        	<?php if(isset($_SESSION['first_name']) && isset($_SESSION['last_name'])):?>
        		<p>Welcom <strong><?php echo ($_SESSION['first_name'] . ' ' . $_SESSION['last_name']) ?></strong></p>
        		<p><a href="index.php?logout=1" style="color: red;">Logout</a>
        	<?php endif ?>
        </div>
    </body>
</html>