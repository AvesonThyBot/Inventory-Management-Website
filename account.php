<?php
    require "config/database.php";

    $input_error = [];
    // redirect to index
    if (count($_COOKIE) > 0) {
        header("Location:index.php");
    }
    // Login
    if (isset($_POST["btnLogin"])) {
        $email = filter_input(INPUT_POST, 'txtEmailAddress',FILTER_VALIDATE_EMAIL);
        $pass = $_POST["txtPassword"];
    
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
    
        while ($row = mysqli_fetch_assoc($result)){
            $passHash = $row["password_text"];
            $user_id = $row["user_id"];
            if (password_verify($pass, $passHash)) {
                setcookie('user_id', $user_id, time() + (86400 * 30), "/");
                setcookie('is_logged_in', true, time() + (86400 * 30), "/");                
                header("Location:index.php");
            }
        }
    } 

    // Register
    if(isset($_POST['btnRegister'])){
        $sql_accounts = "SELECT * FROM users";
        $account_result = mysqli_query($conn, $sql_accounts);
        // Filter first name
        if(empty($_POST["txtFirstName"])) {
            $input_error[] = "first";
        }else {
            $first_name = filter_input(INPUT_POST, 'txtFirstName',FILTER_SANITIZE_SPECIAL_CHARS);
        }
        // Filter last name
        if(empty($_POST["txtLastName"])) {
            $input_error[] = "last";
        }else {
            $last_name = filter_input(INPUT_POST, 'txtLastName', FILTER_SANITIZE_SPECIAL_CHARS);
        }
        // Filter email
        if(empty($_POST["txtEmailAddress"])) {
            $input_error[] = "email";
        }elseif(!empty($_POST["txtEmailAddress"])){
            // check if email is taken
            while ($account_row = mysqli_fetch_assoc($account_result)) {
                if ($account_row["email"] == $email){
                    $input_error[] = "email";
                    break;
                };
            }
        }
        else {
            $email = filter_input(INPUT_POST, 'txtEmailAddress', FILTER_VALIDATE_EMAIL);
        }
        // Filter password
        if(empty($_POST["txtPassword"])) {
           $input_error[] = "password";
        }

        // Add validation check for first, last, email and password

        
        // if theres no errors then it will submit
        if(count($input_error) == 0){
            $password = password_hash($_POST["txtPassword"], CRYPT_BLOWFISH);
            $sql = "INSERT INTO users (first_name, last_name, email, password_text) VALUES ('$first_name', '$last_name', '$email', '$password')";
            $result = mysqli_query($conn, $sql);
        }
    }

    // Log out
    if (isset($_GET['type']) && $_GET['type'] == "logout"){
        setcookie('is_logged_in', false, time()-3600);
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
        <form id="login-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
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
        <form id="register-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="row g-3 needs-validation" novalidate>
            <!-- First Name -->
            <div class="input-group mb-3 has-validation">
                <span class="input-group-text">First name</span>
                <input type="text" class="form-control <?php if(!empty($input_error)){ if(in_array("first", $input_error)){echo "is-invalid";}else{echo"is-valid";}}?>" name="txtFirstName" placeholder="First name" required>
                <div class="invalid-feedback invalid-first"> <!-- Invalid input-->
                <?php 
                    if(!empty($input_error) && in_array("first", $input_error)){
                        echo "Enter first name.";
                    }?>  
                </div>
            </div>
            <!-- Last Name -->  
            <div class="input-group mb-3 has-validation">
                <span class="input-group-text">Last name</span>
                <input type="text" class="form-control <?php if(!empty($input_error)){ if(in_array("last", $input_error)){echo "is-invalid";}else{echo"is-valid";}}?>" placeholder="Last name" name="txtLastName" required>
                <div class="invalid-feedback invalid-last"> <!-- Invalid input-->
                <?php 
                    if(!empty($input_error) && in_array("last", $input_error)){
                        echo "Enter last name.";
                    }?>  
                </div>
            </div>
            <!-- Email -->  
            <div class="input-group mb-3 has-validation">
                <span class="input-group-text">Email</span>
                <input type="email" class="form-control <?php if(!empty($input_error)){ if(in_array("email", $input_error)){echo "is-invalid";}else{echo"is-valid";}}?>" placeholder="Email address" name="txtEmailAddress" required>
                <div class="invalid-feedback invalid-email "> <!-- Invalid input-->
                    <?php 
                    if(!empty($input_error) && in_array("email", $input_error)){
                        echo "Email is already being used.";
                    }?>   
                </div>
                </div>
            </div>
            <!-- Password -->
            <div class="input-group mb-3">
                <span class="input-group-text">Password</span>
                <input type="password" class="form-control <?php if(!empty($input_error)){ if( in_array("password", $input_error)){echo "is-invalid";}else{echo"is-valid";}}?>" placeholder="Password" name="txtPassword" required>
                <div class="invalid-feedback invalid-password"> <!-- Invalid input-->
                <?php 
                    if(!empty($input_error) && in_array("password", $input_error)){
                        echo "Please enter password.";
                    }?>  
                </div>
            </div>
            <!-- Submit -->
            <div>
                <button class="btn btn-primary register-btn" type="submit" name="btnRegister">Submit form</button>
            </div>
        </form>
    </section>
    <!-- Script -->
    <script src="javascripts/account.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>