<?php
    require "config/database.php";

    // redirect to index
    if (count($_COOKIE) > 0) {
        header("Location:index.php");
    }
    
    // Login
    if (isset($_POST["btnLogin"])) {
        $email = $_POST["txtEmailAddress"];
        $pass = $_POST["txtPassword"];
    
        $sql = "SELECT * FROM users WHERE email = '$email'";
    
        $result = mysqli_query($conn, $sql);
    
        while ($row = mysqli_fetch_assoc($result)){
            $passHash = $row["password_text"];
    
            if (password_verify($pass, $passHash)) {
                setcookie('user_email', $email, time() + (86400 * 30), "/");
                setcookie('is_logged_in', true, time() + (86400 * 30), "/");                
    
                header("Location:index.php");
            } else {
    
            }
        }
    } 

    // Register
    if(isset($_POST['btnRegister'])){
        // Filter first name
        $first_name = filter_input(INPUT_POST, 'txtFirstName',FILTER_SANITIZE_SPECIAL_CHARS);
        $last_name = filter_input(INPUT_POST, 'txtLastName',FILTER_SANITIZE_SPECIAL_CHARS);
        $email = $_POST["txtEmailAddress"];
        $password = password_hash($_POST["txtPassword"], CRYPT_BLOWFISH);
        $sql = "INSERT INTO users (first_name, last_name, email, password_text) VALUES ('$first_name', '$last_name', '$email', '$password')";
        $result = mysqli_query($conn, $sql);
    }

    // Log out
    if (isset($_GET['type']) && $_GET['type'] == "logout"){
        setcookie('is_logged_in', false, time()-3600);
        setcookie('user_email', "", time()-3600);
        setcookie('user_id', "", time()-3600);
        header("Location:index.php");
        throw new Exception("No type in url");
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/account.css">
    <link rel="shortcut icon" href="images/inventory.png" type="image/png">
    <title>Register - Inventory</title>
</head>
<body class="bg-dark">
	<!-- Navbar -->
	<nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark" data-bs-theme="dark">
		<div class="container-fluid">
			<img class="navbar-brand img-fluid" src="images/inventory.png" style="height:50px;" alt="logo" />
			<!-- Button when compressed -->
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<!-- Navbar content-->
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					<li class="nav-item">
						<a class="nav-link navbar-sections navbar-login" href="?type=login" >Login</a>
					</li>
					<li class="nav-item">
						<a class="nav-link navbar-sections navbar-register active" href="?type=register">Register</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>   

    <!-- Login section -->
    <section class="login-section sections" hidden>
        <!-- Login Form -->
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Email</span>
                <input type="email" class="form-control" placeholder="Email address" aria-label="emailAddress" aria-describedby="basic-addon1" name="txtEmailAddress" required>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Password</span>
                <input type="password" class="form-control" placeholder="Password" aria-label="password" aria-describedby="basic-addon1" name="txtPassword" required>
            </div>
            <div>
                <input type="submit" class="btn btn-primary" value="Login" name="btnLogin"/>
            </div>
        </form>
    </section>

    <!-- Registry section -->
    <section class="register-section sections">
        <!-- Registry Form -->
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">First Name</span>
                <input type="text" class="form-control" placeholder="First name" aria-label="firstName" aria-describedby="basic-addon1" name="txtFirstName" required>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Last Name</span>
                <input type="text" class="form-control" placeholder="Last name" aria-label="lastName" aria-describedby="basic-addon1" name="txtLastName" required>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Email</span>
                <input type="email" class="form-control" placeholder="Email address" aria-label="emailAddress" aria-describedby="basic-addon1" name="txtEmailAddress" required>
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Password</span>
                <input type="password" class="form-control" placeholder="Password" aria-label="password" aria-describedby="basic-addon1" name="txtPassword" required>
            </div>
            <div>
                <input type="submit" class="btn btn-primary register-btn" value="Register" name="btnRegister"/>
            </div>
        </form>
    </section>
    
    <!-- Script -->
    <script src="javascripts/account.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
