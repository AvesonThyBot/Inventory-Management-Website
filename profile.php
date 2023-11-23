<?php
require "config/database.php";

// send to account
if (count($_COOKIE) <= 0) {
    header("Location:account.php");
}

// Get user data
$user_id = $_COOKIE['user_id'];
$sql = "SELECT * FROM users WHERE user_id = $user_id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// array to handle inputs error and value
$input_error = [];
$input_array = array("first" => "", "last" => "", "email" => "");
// Update general information
if (isset(($_POST["updateBtn"]))) {
    // Filter first name
    if (empty($_POST["updateFirst"])) {
        $input_error[] = "first";
    }
    $first_name = filter_input(INPUT_POST, 'updateFirst', FILTER_SANITIZE_SPECIAL_CHARS);
    $first_name = preg_replace("/[^a-zA-Z]/", "", $first_name);
    $input_array["first"] = $first_name;

    // Filter last name
    if (empty($_POST["updateLast"])) {
        $input_error[] = "last";
    }
    $last_name = filter_input(INPUT_POST, 'updateLast', FILTER_SANITIZE_SPECIAL_CHARS);
    $last_name = preg_replace("/[^a-zA-Z]/", "", $last_name);
    $input_array["last"] = $last_name;

    // Filter email
    if (empty($_POST["updateEmail"]) || !filter_var($_POST["updateEmail"], FILTER_VALIDATE_EMAIL)) {
        $input_error[] = "email";
    } elseif (!empty($_POST["updateEmail"])) {
        // check if email is taken
        $account_results = mysqli_query($conn, "SELECT email FROM users WHERE email != '{$row['email']}'");
        $email = filter_input(INPUT_POST, 'updateEmail', FILTER_VALIDATE_EMAIL);
        while ($account_row = mysqli_fetch_assoc($account_results)) {
            if ($account_row["email"] == $email) {
                $input_error[] = "email_2";
                break;
            } else {
                $input_array["email"] = $email;
            }
        }
    }
    var_dump($input_error);
    echo "<br>";
    var_dump($input_array);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/profile.css">
    <link rel="shortcut icon" href="images/inventory.png" type="image/png">
    <title>Catalogue - Inventory</title>
</head>

<body class="bg-dark text-white">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary bg-dark" data-bs-theme="dark">
        <div class="container-fluid">
            <img class="navbar-brand img-fluid" src="/images/inventory.png" style="height:50px;" alt="logo" draggable="false" />
            <!-- Button when compressed -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navbar content-->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- navbar list -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link catalogue-navbar-section navbar-sections" aria-current="page" href="index.php?type=catalogue">Catalogue</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link cart-navbar-section navbar-sections" href="index.php?type=cart">Cart</a>
                    </li>
                </ul>
            </div>
            <!-- Account dropdown -->
            <div class="navbar-nav me-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Account
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end w-100 mw-100">
                        <?php if (isset($_COOKIE["is_logged_in"])) { ?>
                            <li>
                                <a class="dropdown-item" href="profile.php"><?php echo $row['first_name']; ?></a>
                            </li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="account.php?type=logout">Log out</a></li>
                        <?php } else { ?>
                            <li><a class="dropdown-item" href="/account.php?type=login">Login</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="/account.php?type=register">Register</a></li>
                        <?php } ?>
                    </ul>
                </li>
            </div>
        </div>
    </nav>

    <!-- Profile -->
    <h1>Hi, <?php echo $row["first_name"] ?></h1>
    <main class="profile">
        <h2>Profile</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="needs-validation" novalidate>
            <!-- Email -->
            <div class="input-group mb-3 has-validation">
                <span class="input-group-text">Email</span>
                <input type="email" class="form-control disable-input <?php echo $errorClass = (in_array("email", $input_error) || in_array("email_2", $input_error)) ? "is-invalid" : ((strlen($input_array["email"]) > 0 && !in_array("email", $input_error) && !in_array("email_2", $input_error)) ? "is-valid" : ""); ?>" id="email" value="<?php if (!isset(($_POST["updateBtn"]))) {
                                                                                                                                                                                                                                                                                                                                                    echo $row["email"];
                                                                                                                                                                                                                                                                                                                                                } elseif (strlen($input_array["email"]) > 0) {
                                                                                                                                                                                                                                                                                                                                                    echo $input_array["email"];
                                                                                                                                                                                                                                                                                                                                                } ?>" name="updateEmail">
                <button class="input-group-prepend btn btn-light" type="button" id="toggleEmail">Edit</button>
                <div class="invalid-feedback"> <!-- Invalid input-->
                    <?php
                    if (!empty($input_error) && in_array("email", $input_error)) {
                        echo "Please enter a valid email.";
                    } elseif (!empty($input_error) && in_array("email_2", $input_error)) {
                        echo "Email is already being used.";
                    }
                    ?>
                </div>
            </div>
            <!-- First name -->
            <div class=" input-group mb-3 has-validation">
                <span class="input-group-text">First name</span>
                <input type="text" class="form-control disable-input <?php echo $errorClass = in_array("first", $input_error) ? "is-invalid" : (strlen($input_array["first"]) > 0 && !in_array("first", $input_error) ? "is-valid" : ""); ?>" id="firstName" value="<?php if (!isset(($_POST["updateBtn"]))) {
                                                                                                                                                                                                                                                                        echo $row["first_name"];
                                                                                                                                                                                                                                                                    } elseif (strlen($input_array["first"]) > 0) {
                                                                                                                                                                                                                                                                        echo $input_array["first"];
                                                                                                                                                                                                                                                                    } ?>" name="updateFirst">
                <button class="input-group-prepend btn btn-light" type="button" id="toggleFirst">Edit</button>
                <div class="invalid-feedback"> <!-- Invalid input-->
                    <?php
                    if (!empty($input_error) && in_array("first", $input_error)) {
                        echo "First name cannot be empty.";
                    } ?>
                </div>
            </div>
            <!-- Last name -->
            <div class="input-group mb-3 has-validation">
                <span class="input-group-text">Last name</span>
                <input type="text" class="form-control disable-input <?php echo $errorClass = in_array("last", $input_error) ? "is-invalid" : (strlen($input_array["last"]) > 0 && !in_array("last", $input_error) ? "is-valid" : ""); ?>" id="lastName" value="<?php if (!isset(($_POST["updateBtn"]))) {
                                                                                                                                                                                                                                                                    echo $row["last_name"];
                                                                                                                                                                                                                                                                } elseif (strlen($input_array["last"]) > 0) {
                                                                                                                                                                                                                                                                    echo $input_array["last"];
                                                                                                                                                                                                                                                                } ?>" name="updateLast">
                <button class="input-group-prepend btn btn-light" type="button" id="toggleLast">Edit</button>
                <div class="invalid-feedback"> <!-- Invalid input-->
                    <?php
                    if (!empty($input_error) && in_array("last", $input_error)) {
                        echo "Last name cannot be empty.";
                    }
                    ?>

                </div>
            </div>
            <!-- Submit -->
            <div>
                <button class="btn btn-outline-light float-end" type="submit" name="updateBtn">Update info</button>
            </div>
        </form>
        <!-- Password -->
    </main>
    <!-- Update password in profile -->
    <section class="password-section">
        <h2>Update password</h2>
        <div class="input-group mb-3">
            <span class="input-group-text">Password</span>
            <input type="password" class="form-control" id="password" value="<?php echo $row["password_text"] ?>" disabled>
            <button class="input-group-prepend btn btn-light" type="button" id="togglePassword">&#128269;</button>
        </div>
    </section>

    <!-- Script -->
    <script src="javascripts/profile.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>